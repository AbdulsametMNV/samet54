<?php

namespace App\Controllers;

use MongoDB;

class Contact extends BaseController
{
    public function submit()
    {
        // Form doğrulama kuralları
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[50]|alpha_numeric',
                'errors' => [
                    'required' => 'İsim alanı zorunludur.',
                    'min_length' => 'İsim en az 3 karakter uzunluğunda olmalıdır.',
                    'max_length' => 'İsim en fazla 50 karakter uzunluğunda olabilir.',
                    'alpha_numeric' => 'İsim sadece harf ve rakam içerebilir.'
                ]
            ],
            'reason' => [
                'label' => 'Reason',
                'rules' => 'required|min_length[5]|max_length[100]',
                'errors' => [
                    'required' => 'Sebep alanı zorunludur.',
                    'min_length' => 'Sebep en az 5 karakter uzunluğunda olmalıdır.',
                    'max_length' => 'Sebep en fazla 100 karakter uzunluğunda olabilir.'
                ]
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[10]|max_length[500]',
                'errors' => [
                    'required' => 'Açıklama alanı zorunludur.',
                    'min_length' => 'Açıklama en az 10 karakter uzunluğunda olmalıdır.',
                    'max_length' => 'Açıklama en fazla 500 karakter uzunluğunda olabilir.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Doğrulama hatalarını al ve göster
            session()->setFlashdata('error', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        // Form verilerini al
        $name = $this->request->getPost('name');
        $reason = $this->request->getPost('reason');
        $description = $this->request->getPost('description');

        // MongoDB bağlantısını kur
        $kul_adi = "samet";
        $sifre = "atGM5Sgp9hOEhk3l";
        $adres = "cluster0.hb48p.mongodb.net";
        $veritabani = "sample_mflix";
        $koleksiyon_adi = "contact_form";

        try {
            $client = new MongoDB\Client("mongodb+srv://$kul_adi:$sifre@$adres");
            $koleksiyon = $client->selectCollection($veritabani, $koleksiyon_adi);

            // Veriyi MongoDB'ye ekle
            $sonuc = $koleksiyon->insertOne([
                'name' => $name,
                'reason' => $reason,
                'description' => $description
            ]);

            if ($sonuc->getInsertedCount() === 1) {
                session()->setFlashdata('success', 'Veri başarıyla kaydedildi!');
            } else {
                session()->setFlashdata('error', 'Veri kaydedilirken bir hata oluştu.');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Bir hata oluştu: ' . $e->getMessage());
        }

        return redirect()->back(); // Aynı sayfaya geri dön
    }
}
