<!DOCTYPE html>
<?php
session_start();

use app\core\Session;
use app\models\Transaksi;
use app\core\form\Form;

?>
<!-- CONTENT START -->
<div class="col-10 main-content">
<?php 
    $id_guru = $_SESSION[Session::FLASH_KEY]['guru']['value'];
    $transaksiObj = Transaksi::findAll()
              ->join('Siswa', 'Transaksi.ID_Siswa = Siswa.ID_Siswa')
              ->join('Kelas', 'Kelas.ID_Kelas = Siswa.ID_Kelas')
              ->join('Guru', 'Kelas.ID_Guru = Guru.ID_Guru')
              ->getAll();
    ?>

    <div class="row mx-3 my-3">
        <?php foreach ($transaksiObj as $transaksi) {
          
         $form = Form::begin('/delete-transaksi', 'post', '');
              
         echo "<input type='hidden' name='id' value='{$transaksi->ID_Transaksi}'>"; 
         echo "<div class='mx-3 my-2 bg-primary col-6 rounded-5  p-4'>
                  <div class='m-2 h2'> $transaksi->Date</div>
                  <div class='mx-2 fs-5'> Makan Siang: $transaksi->ID_Makanan</div>
                  <div class='mx-2 fs-5'> $transaksi->Deskripsi_Transaksi </div>
                  <div class='mx-2 fs-5'>Catatan untuk murid:</div>
                  <p class='mx-2 ms-4'> $transaksi->Catatan_Guru </p>
            <button>Delete</button>
          </div>";
          
          Form::end();
        } ?>   
    </div>

</body>

</html>
