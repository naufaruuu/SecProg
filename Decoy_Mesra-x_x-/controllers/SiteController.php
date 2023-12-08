<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Application;
use app\core\Request;
use app\models\SaranGuru;
use app\core\Session;
use app\models\SiswaMapel;
use app\models\Guru;
use app\models\Siswa;

class SiteController extends Controller
{
    public function home(): string
    {
        $params = [
            'name' => "TheCodeholic"
        ];
        return $this->render('home', $params);
    }

    public function contact(): string
    {
        return $this->render('contact');
    }

    public function handleContact(Request $request): string
    {
        $body = $request->getBody();
    }

    public function dashboard(): string
    {
        $this->setLayout('murid');
        return $this->render('dashboard');
    }

    
    public function mapel(Request $request): string
    {
        $saranModel = new SaranGuru();
        
        if ($request->getMethod() == 'post') {
            $saranModel->loadData($request->getBody());
            $saranModel->ID_Siswa = $_SESSION[Session::FLASH_KEY]['siswa']['value'];
            $saranModel->findGuru();

            if ($saranModel->validate() && $saranModel->save()) {
              Application::$app->session->redirect('/mapel');
            }
 
            return $this->render('mapel', [
            'model' => $saranModel
            ]);
        }
        

        $this->setLayout('murid');
        return $this->render('mapel', [
            'model' => $saranModel
        ]);
    }

    public function transaksi_murid(): string
    {
        $this->setLayout('murid');
        return $this->render('transaksi_murid');
    }

    public function guruPage(): string
    {
        return $this->render('guruPage');
    }

    public function transaksi(): string
    {
        return $this->render('transaksi');
    }

    public function formTransaksi(): string
    { 
        return $this->render('formTransaksi');
    }

    public function grading(Request $request): string
    { 
        $siswaMapel = new SiswaMapel();
        if ($request->getMethod() == 'post') {
            $siswaMapel->loadData($request->getBody());
            $guruId = $_SESSION[Session::FLASH_KEY]['guru']['value'];
            $guru = Guru::findOne(['ID_Guru' => $guruId])->get();
            $siswaMapel->Nama_Guru = $guru->Nama_Guru;
            $siswaFind = $siswaMapel->findPrimaryKeyByAttributes('Deskripsi', 'Nilai');
            if ($siswaFind != false) {
                $siswaMapel->ID_SiswaMapel = $siswaFind;
                $siswaMapel->update();    
                return $this->render('grading', [
                    'model' => $siswaMapel
                ]);
            }
            $siswaMapel->setNextPrimaryKey();

            if ($siswaMapel->validate() && $siswaMapel->save()) {
              Application::$app->session->redirect('/grading');
            }
 
            return $this->render('grading', [
                'model' => $siswaMapel
            ]);
        }
        return $this->render('grading', [
            'model' => $siswaMapel
        ]);
    }

    
    public function logout(): string
    { 
        return $this->render('logout');
    }

    public function loginRedirect(): string
    {
        Application::$app->response->redirect('/login');
    }
}

?>
