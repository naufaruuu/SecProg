<?php

namespace app\models;

use app\core\DbModel;

class Makanan extends DbModel 
{
    public string $ID_Makanan;
    public string $Nama_Makanan;

    public static function tableName(): string
    {
        return 'Makanan';
    }

    public function attributes(): array
    {
        return ['ID_Makanan', 'Nama_Makanan'];
    }

    public function primaryKey(): string
    {
        return 'ID_Makanan';
    }

    public function rules(): array
    {
        return [
          'ID_Makanan' => [self::RULE_REQUIRED],
          'Nama_Makanan' => [self::RULE_REQUIRED]
        ];
    }

    public function save()
    {
        return parent::save();
    }
}

?>
