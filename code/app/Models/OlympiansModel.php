<?php

namespace App\Models;

use CodeIgniter\Model;

class OlympiansModel extends Model
{
    protected $table = 'tanrilar'; // Veritabanı tablosu adı
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'baslik', 'icerik', 'ressim']; // Güncellenebilir sütunlar
    
    public function getOlympians()
    {
        return $this->findAll(); // Tüm kayıtları getir
    }
}


?>
