<?php

declare(strict_types=1);

abstract class FormRequest
{
    /**
     * @var array<string, string>
     */
    protected array $fillable = [];

    /** @var array<string, mixed> $columns */
    private array $columns = [];

    /**
     * @param array<string, string> $request_data
     */
    public function __construct(array $request_data)
    {
        foreach ($this->fillable as $key => $cast_type) {
            if (array_key_exists($key, $request_data)) {
                switch ($cast_type) {
                    case 'int':
                        $this->$key = (int)$request_data[$key];
                        break;
                    default:
                        $this->$key = (string)$request_data[$key];
                }
                continue;
            }

            $this->$key = null;
        }
    }

    public function __set(string $key, mixed $value): void
    {
        $this->columns[$key] = $value;
    }

    public function __get(string $key): mixed
    {
        if (array_key_exists($key, $this->columns)) {
            return $this->columns[$key];
        }

        return null;
    }
}
