<?php

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
 * @property int $updated_at
 * @property int $updated_bt
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
        $this->employee_id = (int)$data['employee_id'];
        $this->employee_name = $data['employee_name'];
        $this->employee_name_kana = $data['employee_name_kana'];
        $this->gender = (int)$data['gender'];
        $this->birthday = $data['birthday'];
        $this->created_at = new DateTime($data['created_at']);
        $this->created_by = (int)$data['created_by'];
        $this->updated_at = new DateTime($data['updated_at']);
        $this->updated_by = (int)$data['updated_by'];
        $this->deleted_timestamp = (int)$data['deleted_timestamp'];
        $this->deleted_by = (int)$data['deleted_by'];
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
        $age = floor(((int)$now - (int)$birthday) / 10000);

        if ($age === false) {
            return null;
        }

        return $age;
    }

    /**
     * 生年月日表示用
     * birthday_label
     *
     * @return string
     */
    public function getBirthdayLabelAttribute(): string
    {
        if (strtotime($this->birthday) === false) {
            return null;
        }

        return date('Y/m/d', strtotime($this->birthday));
    }
}
