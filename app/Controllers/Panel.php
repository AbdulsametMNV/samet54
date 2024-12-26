<?php

namespace App\Controllers;

use MongoDB;// composerla yüklendi

use App\Models\PanelModel;

class Panel extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $session = session();

        if($session->has('durum') && $session->get('durum'))
        {
            return view('tema/header', ['isim'=>$session->get('isim'), 'durum'=>$session->get('durum')])
                .view('tema/panel_header')
                .view('sayfalar/panasayfa')
                .view('tema/panel_footer');
        }
        else
        {
            return redirect()-> to(base_url('login'));
        }
    }

  
    public function kayit_ekle()
    {
        $session = session();

        if ($session->has('durum') && $session->get('durum')) {
            if (!$this->request->is('post')) {
                return view('tema/header', ['isim' => $session->get('isim'), 'durum' => $session->get('durum')])
                    . view('tema/panel_header')
                    . view('sayfalar/kayit_ekle')
                    . view('tema/panel_footer');
            }

            $rules = [
                'baslik' => 'required',
                'icerik' => 'required',
                'resim' => 'uploaded[resim]|max_size[resim,1024]',
                'hedef' => 'required|in_list[uploads,uploads2,uploads3]', // Geçerli hedef klasörler
            ];

            if (!$this->validate($rules)) {
                return view('tema/header', ['isim' => $session->get('isim'), 'durum' => $session->get('durum')])
                    . view('tema/panel_header')
                    . view('sayfalar/kayit_ekle')
                    . view('tema/panel_footer');
            }

            $veri = $this->validator->getValidated();
            $model = model('PanelModel');

            $img = $this->request->getFile('resim');
            $hedef = $this->request->getPost('hedef'); // `hedef` parametresini doğru şekilde alıyoruz
            $tabloAdi = '';
        
            // Hedef klasöre göre tablo adı belirleme
            switch ($hedef) {
                case 'uploads':
                    $tabloAdi = 'tanrilar';
                    break;
                case 'uploads2':
                    $tabloAdi = 'oluler';
                    break;
                case 'uploads3':
                    $tabloAdi = 'efsanevi';
                    break;
            }

            if ($img->isValid()  && !$img->hasMoved()) {
                $yol = FCPATH . $hedef . '/'; // Kullanıcının seçimine göre yükleme yolu belirleniyor
                $isim = $img->getRandomName();

                $img->move($yol, $isim);

                $sonuc = $model->veri_ekle($tabloAdi, $veri['baslik'], url_title($veri['baslik'], '_', true), $veri['icerik'], $isim);

                if($sonuc) {
                    return redirect()->to(base_url('kayit_ekle'));
                }
            }
        } else {
            return redirect()->to(base_url('login'));
        }
    }

    public function kayit_listele()
    {
        $session = session();

        if ($session->has('durum') && $session->get('durum')) {
            $data['isim'] = $session->get('isim');
            $data['durum'] = $session->get('durum');

            $model = model('AnasayfaModel');

            // Her tablo için ayrı ayrı verileri çekiyoruz
            $data['kayitlar'] = [
                'tanrilar' => $model->getKayitlar('tanrilar'),
                'oluler' => $model->getKayitlar('oluler'),
                'efsanevi' => $model->getKayitlar('efsanevi'),
            ];

            return view('tema/header', $data)
                . view('tema/panel_header')
                . view('sayfalar/kayit_listele', $data)
                . view('tema/panel_footer');
        } 
        else 
        {
            return redirect()->to(base_url('login'));
        }
    }

    public function kayit_sil()
    {
        $session = session();

        if ($session->has('durum') && $session->get('durum')) {
            $id = $this->request->getPost('id');
            $tablo = $this->request->getPost('tablo');

            if ($id && $tablo) {
                $db = db_connect();
                $builder = $db->table($tablo);

                if ($builder->delete(['id' => $id])) {
                    $session->setFlashdata('success', 'Kayıt başarıyla silindi.');
                } else {
                    $session->setFlashdata('error', 'Kayıt silinirken bir hata oluştu.');
                }
            }
        }

        return redirect()->to(base_url('kayit_listele'));
    }

    public function kayit_duzenle($id, $tabloAdi)
    {
        $session = session();

        if ($session->has('durum') && $session->get('durum')) {
            $model = model('PanelModel');

            // Mevcut kaydı al
            $kayit = $model->kayit_getir($tabloAdi, $id);

            if (!$kayit) {
                return redirect()->to(base_url('kayit_listele'))->with('error', 'Kayıt bulunamadı.');
            }

            if ($this->request->getMethod() === 'post') {
                // Formdan gelen veriler
                $baslik = $this->request->getPost('baslik');
                $url = $this->request->getPost('url');
                $icerik = $this->request->getPost('icerik');
                $img = $this->request->getFile('resim');

                // Validasyon
                $rules = [
                    'baslik' => 'required',
                    'url' => 'required',
                    'icerik' => 'required',
                ];

                if ($this->validate($rules)) {
                    // Resim güncellenmişse, yükle
                    if ($img && $img->isValid() && !$img->hasMoved()) {
                        $yol = FCPATH . 'uploads/';
                        $isim = $img->getRandomName();
                        $img->move($yol, $isim);
                        $resim = $isim;
                    } else {
                        // Resim mevcutsa, eski resmi kullan
                        $resim = $kayit['resim'];
                    }

                    // Verileri güncelle
                    $model->kayit_guncelle($tabloAdi, $id, [
                        'baslik' => $baslik,
                        'url' => $url,
                        'icerik' => $icerik,
                        'resim' => $resim, // Yeni veya eski resmi kaydet
                    ]);

                    return redirect()->to(base_url('kayit_listele'))->with('success', 'Kayıt başarıyla güncellendi.');
                } else {
                    return view('tema/header', ['isim' => $session->get('isim'), 'durum' => $session->get('durum')])
                        . view('tema/panel_header')
                        . view('sayfalar/kayit_duzenle', ['kayit' => $kayit, 'tablo' => $tabloAdi])
                        . view('tema/panel_footer');
                }
            }

            return view('tema/header', ['isim' => $session->get('isim'), 'durum' => $session->get('durum')])
                . view('tema/panel_header')
                . view('sayfalar/kayit_duzenle', ['kayit' => $kayit, 'tablo' => $tabloAdi])
                . view('tema/panel_footer');
        } else {
            return redirect()->to(base_url('login'));
        }
    }





}
