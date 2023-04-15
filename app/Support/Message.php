<?php

namespace App\Support;


class Message
{
    private $type;
    private $message;
    private $status;
    private array $more = [];

    public function status(bool $status): Message
    {
        $this->status = $status;
        return $this;
    }

    public function all(): Object
    {
        $all = (object) $this->more;
        $all->type = $this->type;
        if (is_bool($this->status)) $all->status = $this->status;
        $all->message = $this->message;
        return $all;
    }

    public function render(): string
    {
        return "<div class='alert alert-{$this->type}'>{$this->message}</div>";
    }

    public function json(): string
    {
        $data = (array) $this->all();
        return json_encode($data);
    }

    public function error(string $message): Message
    {
        $this->type = 'error';
        $this->message = $message;
        return $this;
    }

    public function warning(string $message): Message
    {
        $this->type = 'warning';
        $this->message = $message;
        return $this;
    }

    public function success(string $message): Message
    {
        $this->type = 'success';
        $this->message = $message;
        return $this;
    }

    public function info(string $message): Message
    {
        $this->type = 'info';
        $this->message = $message;
        return $this;
    }

    public function more(array $data): Message
    {
        $this->more = array_merge($this->more, $data);
        return $this;
    }
}
