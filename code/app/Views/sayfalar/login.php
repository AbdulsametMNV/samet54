<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Formu</title>
    <link rel="stylesheet" href="../public/Styles/style-login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper-container"> 
        <div class="wrapper"> 
            <?= validation_list_errors()?>
            <form id="loginForm" action="<?=base_url('login')?>" method="POST">
                <?=csrf_field()?>
                <h1>Giriş yap</h1>
                <div class="input-box">
                    <input id="kulad" type="text" name="kulad" placeholder="Kullanıcı adı" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input id="sifre" type="password" name="sifre" placeholder="Şifre" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>

                <input type="submit" name="gonder" class="btn" value="Giriş yap">
                
                <div class="register-link">
                    <p>Anasayfaya <a href="<?=base_url('index.php')?>">dön</a></p>
                </div>
            </form>
        </div>

    </div>
</body>
</html>
