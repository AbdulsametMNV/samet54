<?php

namespace App\Controllers;

use App\Models\KullaniciModel;

class HashSifre extends BaseController
{
    public function index()
    {
        $model = new KullaniciModel();
        $kullanicilar = $model->getUsers();

        $hashedPassword = password_hash('123', PASSWORD_DEFAULT);

        foreach ($kullanicilar as $kullanici) {
            $model->updatePassword($kullanici['id'], $hashedPassword);
        }

        return 'Tüm şifreler başarıyla hashlenmiştir.';
    }
}
?>
