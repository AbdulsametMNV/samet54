<?php

namespace App\Models;

use CodeIgniter\Model;

class KullaniciModel extends Model
{
    protected $table = 'kullanicilar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kulad', 'sifre'];

    public function getUsers()
    {
        return $this->findAll();
    }

    public function updatePassword($id, $hashedPassword)
    {
        $data = ['sifre' => $hashedPassword];
        return $this->update($id, $data);
    }
}
?>
