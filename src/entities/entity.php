<?php

declare(strict_types=1);

abstract class Entity
{
    public function __get(string $key): mixed
    {
        // アクセサ
        $pascal_key = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
        $method_name = 'get' . $pascal_key . 'Attribute';
        if (method_exists($this, $method_name)) {
            return $this->{$method_name}();
        }

        return null;
    }
}
