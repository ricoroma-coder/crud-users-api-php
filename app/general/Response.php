<?php

namespace App\General;

class Response
{
    protected $codes = [
        200 => 'OK',
        201 => 'Created',
        400 => 'Bad Request',
        404 => 'Not Found',
        409 => 'Conflict',
        500 => 'Internal Server Error',
    ];

    protected $message;
    protected $status;

    public function json($message = [], $status = 200)
    {
        if (!in_array($status, array_keys($this->codes)))
            $status = 500;

        if (empty($message))
            $message = [
                'success' => in_array($status, [200, 201]) ? true : false,
                'message' => $this->codes[$status]
            ];

        $this->status = $status;
        $this->message = json_encode($message);

        $this->setHeader("HTTP/1.1 {$this->status} {$this->codes[$this->status]}");
        $this->setHeader('Content-Type: application/json');

        $this->show();
    }

    protected function setHeader($header)
    {
        header($header);
    }

    protected function show()
    {
        exit($this->message);
    }
}
