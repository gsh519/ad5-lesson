<?php

declare(strict_types=1);

require('./Requests/FormRequest.php');

/**
 * @property string|null $name
 * @property int|null $gender
 * @property int $page
 */
class FetchRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    protected array $fillable = [
        'name' => 'string',
        'gender' => 'int',
        'page' => 'int',
    ];
}
