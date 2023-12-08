<?php

namespace app\models;
use app\core\DbModel;

class Transaksi extends DbModel
{
    public string $ID_Transaksi = '';
    public string $Date = '';
    public string $ID_Siswa = '';
    public $ID_Foto;
    public string $Makanan = '';
    public string $ID_Makanan = '';
    public string $Deskripsi_Transaksi = '';
    public string $Catatan_Guru = '';

    public static function tableName(): string
    {
        return 'Transaksi';
    }

    public function attributes(): array
    {
        return ['ID_Transaksi', 'Date', 'ID_Siswa', 'ID_Foto', 'ID_Makanan',
                'Deskripsi_Transaksi', 'Catatan_Guru'];
    }

    public function primaryKey(): string
    {
        return 'ID_Transaksi';
    }

    public function rules(): array
    {
      return [
        'ID_Transaksi' => [self::RULE_REQUIRED],
        'Date' => [self::RULE_REQUIRED],
        'ID_Siswa' => [self::RULE_REQUIRED],
        'ID_Makanan' => [self::RULE_REQUIRED],
        'Deskripsi_Transaksi' => [self::RULE_REQUIRED],
        'Catatan_Guru' => [self::RULE_REQUIRED]
      ];
    }

    public function save()
    {
        return parent::save();
    }
}

?>
