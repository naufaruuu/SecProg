<!DOCTYPE html>
<?php
session_start();

use app\core\Session;
use app\core\Application;
use app\core\form\Form;
use app\models\Kelas;
use app\models\Siswa;

if (!isset($_SESSION[Session::FLASH_KEY]['guru'])) {
    header("Location: login");
}

?>
<!-- CONTENT START -->
  <?php $form = Form::begin('', 'post', '') ?>
    <div class="row m-3">
        <h1>Transaksi Input</h1>
        <div class="input-group mb-3">
            <div class="input-group-text">Kelas</div>
            <?php
                $id_guru = $_SESSION[Session::FLASH_KEY]['guru']['value'];
                $kelasObj = Kelas::findAll()
                  ->join('Guru', "Kelas.ID_Guru = '$id_guru'")
                  ->getAll();

                $kelasOptions = [];
                foreach($kelasObj as $kelas) {
                    $kelasOptions[$kelas->Nama_Kelas] = $kelas->Nama_Kelas;
                }
                echo $form->field($model, 'Nama_Kelas')->selectField($kelasOptions);
             ?>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-text">Siswa</div>
            <?php
                $siswaObj = Siswa::findAll()
                      ->join('Kelas',"Kelas.ID_Kelas = Siswa.ID_Kelas")
                      ->join('Guru', "Kelas.ID_Guru = '$id_guru'")
                      ->getAll();

                $siswaOptions = [];
                foreach($siswaObj as $siswa) {
                    $siswaOptions[$siswa->ID_Siswa] = $siswa->Nama_Siswa;
                }

                echo $form->field($model, 'ID_Siswa')->selectField($siswaOptions);
             ?>
        </div>


        <div class="input-group mb-3">
            <?php echo $form->field($model, 'Image')->fileField() ?>
        </div>

        <div class="input-group mb-3 ms-4 d-flex flex-column">
            <label for="deskripsi_transaksi" class="form-label">Deskripsi Transaksi</label>
            <?php echo $form->field($model, 'Deskripsi_Transaksi')->textareaField(); ?>
        </div>
        <div class="input-group mb-3 ms-4 d-flex flex-column">
            <label for="catatan_guru" class="form-label">Catatan Guru</label>
            <?php echo $form->field($model, 'Catatan_Guru')->textareaField(); ?>
        </div>
        <div class="input-group mb-3 ms-4 d-flex flex-column">
            <label for="input_makanan" class="form-label">Input Makanan</label>
            <?php echo $form->field($model, 'Makanan')->textareaField(); ?>
        </div>
    <button class="btn btn-primary ms-4" type="submit">Submit</button>
    </div>
  <?php Form::end() ?>
<!-- CONTENT END -->
</body>

</html>
