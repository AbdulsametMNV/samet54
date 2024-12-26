<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
    protected $table = 'oluler'; // Veritabanı tablosu adı
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'baslik', 'icerik', 'ressim']; // Güncellenebilir sütunlar
    
    public function getComments()
    {
        return $this->findAll(); // Tüm kayıtları getir
    }
}


?>
