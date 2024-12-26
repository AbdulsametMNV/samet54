<?php

namespace App\Models;

use CodeIgniter\Model;

class AnasayfaModel extends Model 
{
    protected $table = 'kullanicilar';  // MySQL'deki tablo ismi
    
    // Tanrilar tablosundan tüm kayıtları al
    public function kayitlar()
    {
        $this->table = 'tanrilar';
        return $this->findAll();
    }

    // Belirtilen tabloyu kullanarak verileri almak
    public function getKayitlar($tableName)
    {
        return $this->db->table($tableName)
            ->select('id, url, baslik, icerik, resim')  // icerik ve resim alanlarını da ekleyin
            ->get()
            ->getResultArray();      
    }   
}







?>