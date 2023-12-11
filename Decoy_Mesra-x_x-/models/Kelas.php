<?php

namespace app\models;

use app\core\DbModel;

class Kelas extends DbModel
{
    public string $ID_Kelas = '';
    public string $Nama_Kelas = '';
    public string $ID_Guru = '';

    public static function tableName(): string
    {
        return 'Kelas';
    }

    public function attributes(): array
    {
        return ['ID_Kelas', 'Nama_Kelas', 'ID_Guru'];
    }

    public function primaryKey(): string
    {
        return 'ID_Kelas';
    }

    public function rules(): array
    {
      return [
        'ID_Kelas' => [self::RULE_REQUIRED],
        'Nama_Kelas' => [self::RULE_REQUIRED],
        'ID_Guru' => [self::RULE_REQUIRED]
      ];
    }

    public function save()
    {
        return parent::save();
    }
}
