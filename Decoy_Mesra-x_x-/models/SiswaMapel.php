<?php

namespace app\models;

use app\core\DbModel;

class SiswaMapel extends DbModel
{
    public string $ID_SiswaMapel = '';
    public string $ID_Siswa = '';
    public string $Nama_Guru = '';
    public string $Nama_Mapel = '';
    public string $Nilai = '';
    public string $Deskripsi = '';

    public static function tableName(): string
    {
        return 'SiswaMapel';
    }

    public function attributes(): array
    {
        return ['ID_SiswaMapel', 'ID_Siswa', 'Nama_Guru', 'Nama_Mapel',
              'Nilai', 'Deskripsi'];
    }

    public function primaryKey(): string
    {
        return 'ID_SiswaMapel';
    }

    public function rules(): array
    {
        return [
          'ID_SiswaMapel' => [self::RULE_REQUIRED],
          'ID_Siswa' => [self::RULE_REQUIRED],
          'Nama_Guru' => [self::RULE_REQUIRED],
          'Nama_Mapel' => [self::RULE_REQUIRED],
          'Nilai' => [self::RULE_REQUIRED],
          'Deskripsi' => [self::RULE_REQUIRED]
        ];
    }

    public function save()
    {
        return parent::save();
    }
}

?>
