<!DOCTYPE html>
<html>
<head>
    <title>Tanrılar</title>
    <style>
       body {
            font-family: Calibri;
            color: #6c7899;
        }

        img {
            float: left; /* Resimleri sola hizalar */
            margin: 0 15px 20px 0; /* Sağ ve alt boşluk ekler */
            height: auto;
            width: 180px; /* Resim genişliği */
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
        <?php if (!empty($tanrilar)): ?>
            <?php foreach ($tanrilar as $tanri): ?>
                <br><img src="<?php echo base_url('uploads/' . $tanri['resim']); ?>" class="img" />
                <br><h3><a name="<?php echo strtolower($tanri['url']); ?>"><?php echo $tanri['baslik']; ?></h3></a>
                <p><?php echo $tanri['icerik']; ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Henüz tanrı bilgisi bulunmamaktadır.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include '../app/Views/tema/footer.php'; ?>
