<?php

declare(strict_types=1);

namespace App\Classes\EventsPipeline;

class EventData
{
    protected mixed $data;

    protected mixed $attachment;

    public function __toString(): string
    {
        return json_encode([
            'data' => $this->data,
            'attachment' => $this->attachment,
            'created' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return self
     */
    public function setData(mixed $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttachment(): mixed
    {
        return $this->attachment;
    }

    /**
     * @return self
     */
    public function setAttachment(mixed $attachment)
    {
        $this->attachment = $attachment;
        return $this;
    }
}