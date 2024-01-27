<?php

declare(strict_types=1);

require('./Requests/FormRequest.php');

/**
 * @property string|null $employee_name
 * @property string|null $employee_name_kana
 * @property int|null $gender
 * @property string|null $birthday
 */
class CreateRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    protected array $fillable = [
        'employee_name' => 'string',
        'employee_name_kana' => 'string',
        'gender' => 'int',
        'birthday' => 'string',
    ];
}
