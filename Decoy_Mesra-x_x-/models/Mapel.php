<?php

namespace app\models;

use app\core\DbModel;

class Mapel extends DbModel
{
    public string $ID_Mapel = '';
    public string $Nama_Mapel = '';

    public static function tableName(): string
    {
        return 'Mapel';
    }

    public function attributes(): array
    {
        return ['ID_Mapel', 'Nama_Mapel'];
    }

    public function primaryKey(): string
    {
        return 'ID_Mapel';
    }

    public function rules(): array
    {
      return [
        'ID_Mapel' => [self::RULE_REQUIRED],
        'Nama_Mapel' => [self::RULE_REQUIRED]
      ];
    }

    public function save()
    {
        return parent::save();
    }
}

?>
