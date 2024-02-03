<?php

declare(strict_types=1);

require_once('./Requests/FormRequest.php');

/**
 * @property integer $employee_id
 */
class UpdateInitRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    protected array $fillable = [
        'employee_id' => 'int',
    ];
}
