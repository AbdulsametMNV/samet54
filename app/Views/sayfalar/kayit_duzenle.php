
<div class="container">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <h1>Kayıt Düzenle</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Başlık Alanı -->
            <label for="baslik">Başlık:</label>
            <input type="text" id="baslik" name="baslik" value="<?= esc($kayit['baslik']) ?>" required>

            <!-- URL Alanı -->
            <label for="url">URL:</label>
            <input type="text" id="url" name="url" value="<?= esc($kayit['url']) ?>" required>

            <!-- İçerik Alanı -->
            <label for="icerik">İçerik:</label>
            <textarea id="icerik" name="icerik" required><?= esc($kayit['icerik']) ?></textarea>

            <!-- Resim Alanı -->
            <label for="resim">Resim:</label>
            <input type="file" id="resim" name="resim">

            <!-- Gönder Butonu -->
            <button type="submit">Kaydı Güncelle</button>
        </form>
    </div>
