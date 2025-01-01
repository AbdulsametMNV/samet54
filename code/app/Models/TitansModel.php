<?php

namespace App\Models;

use CodeIgniter\Model;

class TitansModel extends Model
{
    protected $table = 'efsanevi'; // Veritabanı tablosu adı
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'baslik', 'icerik', 'ressim']; // Güncellenebilir sütunlar
    
    public function getTitans()
    {
        return $this->findAll(); // Tüm kayıtları getir
    }
}


?>
