<?php

declare(strict_types=1);

abstract class Entity
{
    /**
     * @var array<string, string>
     */
    protected array $casts = [];

    /**
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        foreach ($this->casts as $key => $cast) {
            if (!array_key_exists($key, $data)) {
                var_dump('エラー処理');
            }

            if (is_null($data[$key])) {
                $this->{$key} = $data[$key];
                continue;
            }

            if (is_int($data[$key])) {
                if ($cast === 'int') {
                    $this->{$key} = $data[$key];
                    continue;
                }

                if (enum_exists($cast)) {
                    /** @var BackedEnum $cast */
                    $this->{$key} = $cast::tryFrom($data[$key]);
                    continue;
                }
            }

            if (is_string($data[$key])) {
                if ($cast === 'int') {
                    $this->{$key} = (int)$data[$key];
                    continue;
                }

                if ($cast === 'DateTime') {
                    $this->{$key} = new DateTime($data[$key]);
                    continue;
                }

                if (enum_exists($cast)) {
                    /** @var BackedEnum $cast */
                    $this->{$key} = $cast::tryFrom($data[$key]);
                    continue;
                }

                $this->{$key} = $data[$key];
            }
        }
    }

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
