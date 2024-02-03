<?php

declare(strict_types=1);

require_once('./Requests/FormRequest.php');

/**
 * @property int $employee_id
 * @property string|null $employee_name
 * @property string|null $employee_name_kana
 * @property int|null $gender
 * @property string|null $birthday
 */
class UpdateRequest extends FormRequest
{
    /**
     * {@inheritDoc}
     */
    protected array $fillable = [
        'employee_id' => 'int',
        'employee_name' => 'string',
        'employee_name_kana' => 'string',
        'gender' => 'int',
        'birthday' => 'string',
    ];
}
