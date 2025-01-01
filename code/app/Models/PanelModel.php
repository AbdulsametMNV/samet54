<?php
namespace App\Models;

use CodeIgniter\Model;

class PanelModel extends Model
{
    protected $table = '';  // Tablo adı dinamik olacak
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'baslik', 'url', 'icerik', 'resim'];  // Gerekli alanlar
    protected $useTimestamps = false; // Zaman damgaları kullanmak istemiyorsanız false yapın

    public function veri_ekle($tablo, $baslik, $url, $icerik, $resim)
    {
        $builder = $this->db->table($tablo); // Dinamik tablo adı

        $data = [
            'baslik' => $baslik,
            'url' => $url,
            'icerik' => $icerik,
            'resim' => $resim,
        ];

        return $builder->insert($data);
    }

    // Dinamik olarak tabloya göre veri getirme fonksiyonu
    public function kayit_getir($tablo, $id)
    {
        $this->table = $tablo; // Tabloyu dinamik olarak ayarla
        return $this->where('id', $id)->first(); // Veriyi getir
    }

    // Veri güncelleme fonksiyonu
    public function kayit_guncelle($tablo, $id, $data)
    {
        $this->table = $tablo; // Tabloyu dinamik olarak ayarla
        return $this->update($id, $data); // Veriyi güncelle
    }
}



?>