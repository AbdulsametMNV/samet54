<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" type="text/css" href="../public/Styles/Style.css" />
   
    <style>
       

        #content_area1 {
            border: 2px solid #dedede; /* Çerçeve eklenmesi */
            padding: 20px;
            margin: 20px auto;
            width: 35%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #f9f9f9; /* Arka plan rengi */
            float: left;
    
        }

        #content_area1 p {
            margin: 6px 0; /* Yazılar arasında boşluk */
            text-decoration: none; /* Alt çizgiyi kaldır */
        }

        #content_area1 p a {
            color: #007BFF; /* Yazı rengi */
            text-decoration: none; /* Link alt çizgisi yok */
        }

        #content_area1 p a:hover {
            text-decoration: underline; /* Üzerine gelince alt çizgi */
        }

        
    </style>
</head>
<body>

    <div id="content_area1">
        <h1>Hoşgeldiniz, Samet MANAV </h1>
        <p>Burada site içeriğinizi yönetebilirsiniz.</p>

        <p><a href="<?=base_url('kayit_ekle')?>">Kayıt Ekle</a></p>
        <p><a href="<?=base_url('kayit_listele')?>">Kayıt Listele</a></p>
    </div>

    <div id="welcome_area">