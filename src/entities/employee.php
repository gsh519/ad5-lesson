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
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        if (array_key_exists('employee_id', $data) && is_int($data['employee_id'])) {
            $this->employee_id = $data['employee_id'];
        }

        if (array_key_exists('employee_name', $data) && is_string($data['employee_name'])) {
            $this->employee_name = $data['employee_name'];
        }

        if (array_key_exists('employee_name_kana', $data) && is_string($data['employee_name_kana'])) {
            $this->employee_name_kana = $data['employee_name_kana'];
        }

        if (array_key_exists('gender', $data) && is_int($data['gender'])) {
            $this->gender = $data['gender'];
        } else {
            $this->gender = null;
        }

        if (array_key_exists('birthday', $data) && is_string($data['birthday'])) {
            $this->birthday = $data['birthday'];
        }

        if (array_key_exists('created_at', $data) && is_string($data['created_at'])) {
            $this->created_at = new DateTime($data['created_at']);
        }

        if (array_key_exists('created_by', $data) && is_int($data['created_by'])) {
            $this->created_by = $data['created_by'];
        }

        if (array_key_exists('updated_at', $data) && is_string($data['updated_at'])) {
            $this->updated_at = new DateTime($data['updated_at']);
        }

        if (array_key_exists('updated_by', $data) && is_int($data['updated_by'])) {
            $this->updated_by = $data['updated_by'];
        }

        if (array_key_exists('deleted_timestamp', $data) && is_int($data['deleted_timestamp'])) {
            $this->deleted_timestamp = $data['deleted_timestamp'];
        }

        if (array_key_exists('deleted_by', $data) && is_int($data['deleted_by'])) {
            $this->deleted_by = $data['deleted_by'];
        } {
            $this->deleted_by = null;
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
