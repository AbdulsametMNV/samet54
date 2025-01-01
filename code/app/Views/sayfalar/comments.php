<!DOCTYPE html>
<html>
<head>
    <title>Ölüler Diyarı ve Ahiret İnancı</title>
    <style>
       body {
            font-family: Calibri;
            color: #6c7899;
        }

        img {
            float: left; /* Resimleri sola hizalar */
            margin: 0 15px 20px 0; /* Sağ ve alt boşluk ekler */
            height: auto;
            width: 280px; /* Resim genişliği */
        }

        h3 {
            margin: 0 0 10px 0; /* Başlık ile altındaki yazı arasında boşluk bırakır */
            color: #6c7899;
        }

        p {
            margin: 0 0 20px 0; /* Yazı ile bir sonraki blok arasında boşluk bırakır */
            overflow: hidden; /* Resimle taşan yazıyı düzeltir */
        }



    </style>
</head>
<body>
    <div id="content_area">
        <?php if (!empty($oluler)): ?>
            <?php foreach ($oluler as $olu): ?>
                <br><img src="<?php echo base_url('uploads2/' . $olu['resim']); ?>" class="img" />
                <br><h3><a name="<?php echo strtolower($olu['url']); ?>"><?php echo $olu['baslik']; ?></h3></a>
                <p><?php echo $olu['icerik']; ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Henüz tanrı bilgisi bulunmamaktadır.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include '../app/Views/tema/footer.php'; ?>
