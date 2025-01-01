<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Listeleme</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> <!-- İsteğe bağlı CSS dosyanız -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            margin-top: 30px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        img {
            max-width: 100px; /* Resimlerin boyutunu sınırlayabiliriz */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kayıt Listeleme</h1>
        <?php if (isset($kayitlar) && is_array($kayitlar) && count($kayitlar) > 0): ?>
            <?php foreach (['tanrilar', 'oluler', 'efsanevi'] as $tabloAdi): ?>
                <?php if (isset($kayitlar[$tabloAdi]) && count($kayitlar[$tabloAdi]) > 0): ?>
                    <br><br><br><br><br><br><br><br><h2><?= ucfirst($tabloAdi) ?> Tablosu</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>URL</th>
                                <th>Başlık</th>
                                <th>İçerik</th>
                                <th>Resim</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kayitlar[$tabloAdi] as $kayit): ?>
                                <tr>
                                    <td><?= esc($kayit['id']) ?></td>
                                    <td><?= esc($kayit['url']) ?></td>
                                    <td><?= esc($kayit['baslik']) ?></td>
                                    <td><?= esc($kayit['icerik']) ?></td>
                                    <td>
                                        <?php
                                        // Resim klasörünü belirlemek
                                        if ($tabloAdi == 'tanrilar') {
                                            $resimKlasoru = 'uploads/';
                                        } elseif ($tabloAdi == 'oluler') {
                                            $resimKlasoru = 'uploads2/';
                                        } elseif ($tabloAdi == 'efsanevi') {
                                            $resimKlasoru = 'uploads3/';
                                        }
                                        ?>

                                        <?php if (!empty($kayit['resim'])): ?>
                                            <img src="<?= base_url($resimKlasoru . esc($kayit['resim'])) ?>" alt="Resim">
                                        <?php else: ?>
                                            <p>Resim yok</p>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Silme İşlemi -->
                                        <form action="<?= base_url('kayit_sil') ?>" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= esc($kayit['id']) ?>">
                                            <input type="hidden" name="tablo" value="<?= esc($tabloAdi) ?>">
                                            <button type="submit" class="btn-delete" onclick="return confirm('Bu kaydı silmek istediğinize emin misiniz?');">Sil</button>
                                        </form>

                                        <!-- Düzenleme İşlemi -->
                                        <a href="<?= base_url('kayit_duzenle/' . $kayit['id'] . '/' . $tabloAdi) ?>" class="btn-edit">Düzenle</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p><?= ucfirst($tabloAdi) ?> tablosunda kayıt bulunamadı.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Kayıt bulunamadı.</p>
        <?php endif; ?>
    </div>
</body>
</html>


