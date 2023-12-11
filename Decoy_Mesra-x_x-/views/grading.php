<!DOCTYPE html>
<?php
session_start();

use app\core\Session;
use app\core\Application;
use app\core\form\Form;
use app\models\Siswa;
use app\models\Mapel;

if (!isset($_SESSION[Session::FLASH_KEY]['guru'])) {
    header("Location: login");
}
?>
<!-- CONTENT START -->
<div class="col-10 main-content">
  <?php $form = Form::begin('', 'post', '') ?>
    <div class="row m-3">
        <h1>Grading siswa</h1>
        <div class="input-group mb-3">
          <div class="input-group-text">Siswa</div>
          <?php 
              // Get Siswa List
              $id_guru = $_SESSION[Session::FLASH_KEY]['guru']['value'];
              $siswaObj = Siswa::findAll()
                     ->join('Kelas', 'Siswa.ID_Kelas = Kelas.ID_Kelas')
                     ->join('Guru', "Kelas.ID_Guru = '$id_guru'")->getAll();

              
              $siswaOptions = [];
              foreach ($siswaObj as $siswa) {
                  $siswaOptions[$siswa->ID_Siswa] = $siswa->Nama_Siswa;
              }

              echo $form->field($model, 'ID_Siswa')->selectField($siswaOptions);
          ?>
            
        </div>
        <div class="input-group mb-3">
          <div class="input-group-text">Mapel</div>
            <?php
              $mapelObj = Mapel::findAll()->getAll();

              $mapelOptions = [];
              foreach ($mapelObj as $mapel) {
                  $mapelOptions[$mapel->Nama_Mapel] = $mapel->Nama_Mapel;
              };
              echo $form->field($model, 'Nama_Mapel')->selectField($mapelOptions);
            ?>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-text">Nilai</div>
            <?php
              $options = ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'];
              echo $form->field($model, 'Nilai')->selectField($options);
            ?>
        </div>
        <div class="input-group mb-3 d-flex flex-column">
            <?php echo $form->field($model, 'Deskripsi'); ?>
        </div>


    </div>
    <button class="btn btn-primary ms-4" type="submit">Submit</button>
    <br>
    <? php Form::end() ?>
</div>
<!-- CONTENT END -->

