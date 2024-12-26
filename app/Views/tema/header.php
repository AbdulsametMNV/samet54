<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>İskandinav Mitolojisi</title>
        <link rel="stylesheet" type="text/css" href="../public/Styles/Style.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner"></div>

            <nav id="navigation">
                <ul id="nav"><p align="center">
                    <li><a href="<?=base_url()?>"><i>Anasayfa</i></a></li>
                    <li><a href="<?=base_url("panel")?>"><i>Panel</i></a></li>
                    <li><a href="<?=base_url('contact')?>"><i>Hakkımızda ve İletişim</i></a></li>
                    <li><a href="<?=base_url('olympians')?>"><i>Tanrılar ve Tanrıçalar</i></a></li>
                    <li><a href="<?=base_url('comments')?>"><i>Ölüler Diyarı ve Ahiret İnancı</i></a></li>
                    <li><a href="<?=base_url('titans')?>"><i>Efsanevi Varlıklar</i></a></li>
                    <?php
                    if(isset($durum) && $durum)
                    { 
                    ?>
                    <li><a href="<?=base_url('logout')?>"><i>Çıkış</i></a></li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li><a href="<?=base_url('login')?>"><i>Panel Giriş</i></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
