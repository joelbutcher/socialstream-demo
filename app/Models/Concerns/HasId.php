<?php

namespace App\Models\Concerns;

trait HasId
{
    public function id(): int
    {
        return $this->id;
    }
}
