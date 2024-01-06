<?php 

namespace app\views;
use app\core\form\Form;
use app\core\Session;

unset($_SESSION[Session::FLASH_KEY]['siswa']);
unset($_SESSION[Session::FLASH_KEY]['guru']);

session_start();

function isRateLimited() {
    $limit = 5; // Maximum attempts
    $timeout = 15 * 60; // Timeout in seconds (15 minutes)

    if (!isset($_SESSION['login_attempts']) || !isset($_SESSION['last_login_attempt'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_login_attempt'] = time();
    }

    if ($_SESSION['login_attempts'] >= $limit && (time() - $_SESSION['last_login_attempt']) < $timeout) {
        return true; // Rate limited
    }

    if ((time() - $_SESSION['last_login_attempt']) > $timeout) {
        // Reset the counter after the timeout period has passed
        $_SESSION['login_attempts'] = 0;
        $_SESSION['last_login_attempt'] = time();
    }

    return false; // Not rate limited
}

function logAttempt() {
    // Increment the number of attempts
    $_SESSION['login_attempts']++;
    $_SESSION['last_login_attempt'] = time();
}

// Usage
if (isRateLimited()) {
    echo "You have exceeded the number of login attempts. Please try again later.";
    die();
} else {
    logAttempt();
}

?>
<link rel="stylesheet" href="css/loginStyle.css" >
<div class="container-fluid d-flex justify-content-center align-items-center h-100 p-0">
    <div class="row align-items-center m-5 container-t p-0">
        <div class="col-5 h-100 p-0">
            <img src="images/school-child.png" class="fit-image" alt="">
        </div>
        <div class="col-7 d-flex flex-column align-items-center">
            <h1 class="align-self-center m-3 fs-3">LOGIN</h1>
            <?php $form = Form::begin('', 'post', 'align-self-center m-3 d-flex flex-column')?>
                <?php echo $form->field($model, 'Nama_Siswa') ?>
                <br>
                <?php echo $form->field($model, 'ID_Siswa')->passwordField() ?>
                <button class="btn btn-primary p-2 m-auto w-25" type="submit" name="submit">Submit</button>
            <?php Form::end()?>
        </div>
    </div>
</div>
