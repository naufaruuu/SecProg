<?php

namespace app\models;
use app\core\DbModel;
use app\core\QueryBuilder;
use app\models\Guru;

class SaranGuru extends DbModel
{
    public string $ID_Siswa = '';
    public string $ID_Guru = '';
    public string $Saran = '';

    public static function tableName(): string
    {
        return 'SaranGuru';
    }

    public function attributes(): array
    {
        return ['ID_Siswa', 'ID_Guru', 'Saran'];
    }

    public function findGuru(): void
    {
        $guru = Guru::findOne(['ID_Siswa' => $this->ID_Siswa])->join('Kelas', 'Kelas.ID_Guru = Guru.ID_Guru')->join('Siswa', 'Kelas.ID_Kelas = Siswa.ID_Kelas')->get();
        $this->ID_Guru = $guru->ID_Guru;
    }

    public function primaryKey(): string
    {
        return 'ID_Siswa';
    }

    public function rules(): array
    {
      return [
        'ID_Siswa' => [self::RULE_REQUIRED],
        'ID_Guru' => [self::RULE_REQUIRED],
        'Saran' => [self::RULE_REQUIRED],
      ];
    }

    public function save()
    {
        return parent::save();
    }
}

?>
