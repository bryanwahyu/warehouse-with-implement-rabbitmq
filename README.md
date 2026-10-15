# Warehouse Management System

Inventory and production backend for a small manufacturer, built with Laravel 10. It tracks raw materials (bahan) and finished products, turns materials into products through recipes and production runs, and handles purchase orders, sales orders and stock history. Every stock movement on raw materials is published to RabbitMQ.

## What it does

- Raw materials and products, each with categories, units (satuan), stock in, stock out and stock-opname.
- Recipes: how much of each material one unit of a product needs.
- Production runs with a small state machine:
  - `menyiapkan` → `Proses` takes the materials out of stock, scaled by recipe × quantity.
  - `Proses` → `Completed` books the produced quantity into product stock.
  - `Proses` → `Failure` closes the run without adding stock.
- Purchase orders with suppliers, and sales orders with customers, status and payment.
- Stock history for every movement, plus Excel import/export (templates, stock-opname, PO requests) via `maatwebsite/excel`.
- REST API under `/api/v1`, protected with Laravel Passport, and a Blade admin panel.

## Architecture

```
app/Http/Controllers/API/V1   single-action controllers, one per endpoint
src/Domain/<Context>/Actions  use cases (CreateMasukBahanAction, ChangeStatusProduksiAction, ...)
src/Domain/<Context>/Filter   query filters for list endpoints
src/Infra/<Context>/Models    Eloquent models
src/Infra/Shared              base Action, controller, response helpers, RabbitMQService
```

Controllers only parse the request and call one Action. Business rules live in `src/Domain`, persistence in `src/Infra`. Bounded contexts: Bahan, Product, Produksi, PurchaseOrder, SalesOrder, Customer, History, User.

### RabbitMQ

`Infra\Shared\Services\RabbitMQService` publishes a JSON message to the queue named by `RABBITMQ_QUEUE` whenever raw-material stock moves:

- `CreateMasukBahanAction` (stock in)
- `CreateKeluarBahanAction` (stock out, including materials consumed by a production run)
- `ImportMasukKeluarAction` (bulk import from Excel)

The message is the same payload written to `history_stoks`, so a consumer (notifications, reporting, a sync to another system) can react to stock changes without polling the database. `RabbitMQService::consume()` is a reference consumer that logs each message.

## Running it

Requirements: PHP 8.1+, Composer, MySQL, RabbitMQ.

```bash
composer install
touch .env                  # fill DB_* and the RABBITMQ_* keys below
php artisan key:generate
php artisan migrate --seed
php artisan passport:install
php artisan serve
```

RabbitMQ settings in `.env`:

```
RABBITMQ_HOST=127.0.0.1
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASSWORD=guest
RABBITMQ_QUEUE=stock
```

A quick local broker: `docker run -d -p 5672:5672 -p 15672:15672 rabbitmq:3-management`.

`docker-compose.yml` runs the app on PHP-FPM behind nginx; point it at your own MySQL and RabbitMQ.

## API overview

All routes except `POST /api/v1/login` need a Passport bearer token.

| Resource | Routes |
|---|---|
| Auth | `POST login`, `GET auth` |
| Raw materials | `bahan`, `category`, `satuan`, `masuk`, `keluar` |
| Products | `product`, `product-category`, `product-satuan`, `product-masuk`, `product-keluar` |
| Production | `recipe`, `production`, `PATCH production/{id}/{status}` |
| Purchasing | `supplier`, `purchase-order`, `detail-po`, `PATCH purchase-order/{id}/{status}` |
| Sales | `customer`, `sales-order`, `detail-sales-order`, `PATCH sales-order/{id}/{status}/{payment}` |
| History | `history`, `product-history` |

The full list is in `routes/api/v1.php`.

## Known limitations

- The stock-movement message is published before the surrounding database transaction commits, so a rollback can leave a message for a movement that never happened. The fix is a transactional outbox or publishing after commit (`DB::afterCommit`).
- Stock is updated with read-modify-write on the model, without a row lock, so two concurrent movements on the same item can overwrite each other.
- The bundled consumer only logs; there is no artisan command to run it yet.
- Tests are the Laravel defaults only.

## License

MIT
