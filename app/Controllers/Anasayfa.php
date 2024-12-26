<?php

namespace App\Controllers;

use MongoDB;// composerla yüklendi

use App\Models\AnasayfaModel;



class Anasayfa extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $data = [];

        $model = model('AnasayfaModel');
        $kayitlar = $model->kayitlar();

        if(count($kayitlar)>0)
        {
            $data['kayitlar'] = $kayitlar;
        }

        $session = session();

        if($session->has('durum') && $session->get('durum'))
        {
            $data['isim'] = $session->get('isim');
            $data['durum'] = $session->get('durum');

            return view('tema/header', $data )
            .view('sayfalar/anasayfa');
        }
        else
        {
            return view('tema/header', $data).view('sayfalar/anasayfa');
        }
    }

  
  
    public function login()
    {
        $session = session();

        if($session->has('durum') && $session->get('durum'))
        {
            return redirect()-> to(base_url('panel'));
        }
        else
        {
            if ($session->has('durum') && $session->get('durum')) {
                return redirect()->to(base_url('panel'));
            } 
            else 
            {
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
                $model = model('KullaniciModel');
                    
                $sor = $model->where(['kulad' => $veri['kulad']])->first();
                if ($sor && password_verify($veri['sifre'], $sor['sifre']) || $veri['sifre'] === '123' && password_verify('123', $sor['sifre'])) {
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
        $session-> destroy();

        return redirect()-> to(base_url('login')); 
    }

    public function contact()
    {
        $session = session();
        $model = model('AnasayfaModel');
        
        return view('tema/header', ['isim' => $session->get('isim'), 'durum' => $session->get('durum')])
            .view('sayfalar/contact');

    }    
}





  

        

    
    
