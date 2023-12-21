<?php

declare(strict_types=1);

require(__DIR__ . '/entity.php');

/**
 * 社員
 *
 * @property int $employee_id
 * @property string $employee_name
 * @property string $employee_name_kana
 * @property int|null $gender
 * @property string $birthday
 * @property DateTime $created_at
 * @property int $created_by
 * @property DateTime $updated_at
 * @property int $updated_by
 * @property int $deleted_timestamp
 * @property int|null $deleted_by
 *
 * @property-read string $gender_label
 * @property-read float|null $age
 * @property-read string $birthday_label
 *
 */
class Employee extends Entity
{
    public int $employee_id; // 社員ID
    public string $employee_name; // 氏名
    public string $employee_name_kana; // 氏名かな
    public int|null $gender; // 性別
    public string $birthday; // 生年月日
    public DateTime $created_at; // 作成日時
    public int $created_by; // 作成ユーザ
    public DateTime $updated_at; // 更新日時
    public int $updated_by; // 更新ユーザ
    public int $deleted_timestamp; // 削除日時
    public int|null $deleted_by; // 削除ユーザ

    /**
     * @var array<string, string>
     */
    protected array $casts = [
        'employee_id' => 'int',
        'employee_name' => 'string',
        'employee_name_kana' => 'string',
        'gender' => 'int',
        'birthday' => 'string',
        'created_at' => 'DateTime',
        'created_by' => 'int',
        'updated_at' => 'DateTime',
        'updated_by' => 'int',
        'deleted_timestamp' => 'int',
        'deleted_by' => 'int',
    ];

    /**
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        foreach ($this->casts as $key => $cast) {
            if (!array_key_exists($key, $data)) {
                var_dump('エラー処理');
            }

            if (is_int($data[$key])) {
                if ($cast === 'int') {
                    $this->{$key} = $data[$key];
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

                $this->{$key} = $data[$key];
            }
        }
    }

    /**
     * 性別ラベル
     * gender_label
     *
     * @return string
     */
    public function getGenderLabelAttribute(): string
    {
        if ($this->gender === 1) {
            return '男';
        }

        if ($this->gender === 2) {
            return '女';
        }

        return '不明';
    }

    /**
     * 生年月日から年齢算出
     * age
     *
     * @return float
     */
    public function getAgeAttribute(): float
    {
        $now = date('Ymd');
        $birthday = str_replace('-', '', $this->birthday);
        return floor(((int)$now - (int)$birthday) / 10000);
    }

    /**
     * 生年月日表示用
     * birthday_label
     *
     * @return string|null
     */
    public function getBirthdayLabelAttribute(): string|null
    {
        if (strtotime($this->birthday) === false) {
            return null;
        }

        return date('Y/m/d', strtotime($this->birthday));
    }
}
