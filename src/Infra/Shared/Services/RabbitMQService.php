<?php

namespace Infra\Shared\Services;

use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected $connection;

    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_USER'),
            env('RABBITMQ_PASSWORD')
        );

        $this->channel = $this->connection->channel();
        $this->channel->queue_declare(env('RABBITMQ_QUEUE'), false, false, false, false);
    }

    public function publish($message)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', env('RABBITMQ_QUEUE'));
        Log::info('Send queue by notif');
    }

    public function consume()
    {
        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->body, true);
            Log::info('Received message from RabbitMQ: '.$msg->body);
            echo 'Received message from RabbitMQ: '.$msg->body.PHP_EOL;

            // Proses pesan yang diterima
            $this->processMessage($data);
        };

        $this->channel->basic_consume(env('RABBITMQ_QUEUE'), '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    protected function processMessage($data)
    {
        Log::info('Processing message: '.json_encode($data));
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
