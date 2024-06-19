<?php

namespace App\Http\Controllers\Web;

use Infra\Shared\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        return view('admin.index');
    }

    public function index_bahan()
    {
        return view('admin.bahan.index');
    }

    public function category_bahan()
    {
        return view('admin.bahan.category');
    }

    public function satuan_bahan()
    {
        return view('admin.bahan.satuan');
    }

    public function detail_bahan($id)
    {
        return view('admin.bahan.detail', compact('id'));
    }

    public function index_product()
    {
        return view('admin.product.index');
    }

    public function detail_product($id)
    {
        return view('admin.product.detail', compact('id'));
    }

    public function category_product()
    {
        return view('admin.product.category');
    }

    public function user()
    {
        return view('admin.user');
    }

    public function satuan_product()
    {
        return view('admin.product.satuan');
    }

    public function supplier()
    {
        return view('admin.PO.supplier');
    }

    public function index_po()
    {
        return view('admin.PO.CRUD.index');
    }

    public function create_po()
    {
        return view('admin.PO.CRUD.create');
    }

    public function detail_po($id)
    {
        return view('admin.PO.CRUD.detail', compact('id'));
    }

    public function customer()
    {
        return view('admin.SO.Customer.index');
    }

    public function sales_order()
    {
        return view('admin.SO.Index');
    }

    public function create_sales_order()
    {
        return view('admin.SO.create');

    }

    public function detail_sales_order($id)
    {
        return view('admin.SO.detail', compact('id'));
    }

    public function stok_opname()
    {
        return view('admin.Laporan.stokopname');
    }

    public function stok()
    {
        return view('admin.Laporan.stok');
    }

    public function stok_product()
    {
        return view('admin.product.Laporan.stok');
    }

    public function production()
    {
        return view('admin.product.production');
    }

    public function stok_opname_product()
    {
        return view('admin.product.Laporan.stokopname');
    }
}
