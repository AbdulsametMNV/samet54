<?php

namespace App\Controllers;

use MongoDB;// composerla yüklendi

use App\Models\OlympiansModel;

class Olympians extends BaseController
{
    protected $helpers = ['form'];
    
    public function index()
    {
        $model = new OlympiansModel();
        $data['tanrilar'] = $model->findAll(); // Veritabanından tüm kayıtları getirir
        return view('tanrilar_view', $data);
    }

    public function login()
    {
        $session = session();

        if ($session->has('durum') && $session->get('durum')) {
            return redirect()->to(base_url('panel'));
        } else {
            if ($session->has('durum') && $session->get('durum')) {
                return redirect()->to(base_url('panel'));
            } else {
                if (! $this->request->is('post')) {
                    return view('sayfalar/login');
                }
                
                $rules = [
                    'kulad' => 'required',
                    'sifre' => 'required'
                ];

                if (! $this->validate($rules)) {
                    return view('sayfalar/login');
                }

                $veri = $this->validator->getValidated();
                $model = model('OlympiansModel');
                
                $sor = $model->where(['kulad' => $veri['kulad'], 'sifre' => $veri['sifre']])->find();
                if (count($sor) > 0) {
                    $kul_bilgi = [
                        'isim' => 'Samet Manav',
                        'durum' => true
                    ];

                    $session->set($kul_bilgi);

                    return redirect()->to(base_url('panel'));
                } else {
                    return view('sayfalar/login');
                }
            }
        }

        return view('sayfalar/login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('login')); 
    }

    public function olympians()
    {
        $session = session();
        $model = model('OlympiansModel');
        $data['tanrilar'] = $model->getOlympians();

        return view('tema/header', ['isim' => $session->get('isim'), 'durum' => $session->get('durum')])
            .view('sayfalar/olympians', $data);
    }
}
?>
