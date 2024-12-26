<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
</head>
<body>
	<!-- Flash Mesaj Alanı -->
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; font-weight: bold; text-align: center; margin-bottom: 10px;">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

	<?php if (session()->getFlashdata('error')): ?>
    <div style="color: red; font-weight: bold; text-align: center; margin-bottom: 10px;">
        <?php 
        $errors = session()->getFlashdata('error'); 
        if (is_array($errors)): 
            foreach ($errors as $error): ?>
                <p><?= esc($error); ?></p>
            <?php endforeach; 
        else: ?>
            <p><?= esc($errors); ?></p>
        <?php endif; ?>
    </div>
<?php endif; ?>


	<p><font color="#AFEEEE">
		<table border="0" color="#d38900" align="center">
			<tr>
				<td>
					<h2 align="center"><a name="about"><font color="#d38900">İskandinav Mitolojisi Hakkında ve İletişim</font></a></h2>
				</td>
			</tr>
			<tr>
				<td>
					<p align="left">
						<strong>İskandinav Mitolojisinin Derinliklerine Hoş Geldiniz!</strong><br>
						İskandinav mitolojisi, Norse tanrıları ve efsaneleriyle dolu, büyüleyici bir dünya sunar. Bu mitoloji, kuzey halklarının inançlarını, değerlerini ve kahramanlık öykülerini anlatan bir hazinedir. Odin, Thor, Freyja ve Loki gibi tanrılar, güçlü kahramanlar ve ilginç yaratıklarla dolu bir evreni keşfetmek için doğru yerdesiniz.<br><br>
						
						<strong>Misyonumuz:</strong><br>
						Amacımız, İskandinav mitolojisinin derinliklerine inmeyi ve bu eşsiz hikayeleri günümüze taşımayı hedefliyoruz. Bu kadim efsaneler, bize cesaret, sadakat ve bilgelik hakkında çok şey öğretir.<br><br>

						<strong>Vizyonumuz:</strong><br>
						İskandinav mitolojisinin büyüsünü, tüm dünyaya tanıtarak kültürler arası bir köprü kurmak. Her bir mitolojik karakterin hikayesini anlama ve anlatma misyonu ile tarihî geçmişi geleceğe taşımak.<br><br>

						<strong>Değerlerimiz:</strong><br>
						- Cesaret ve Kahramanlık: Thor'un devlerle mücadelesi, kahramanlık ve cesaretin simgesidir.<br>
						- Sadakat ve Aile: Odin'in oğlu Thor'a olan sevgisi, aile bağlarının gücünü simgeler.<br>
						- Bilgelik ve Adalet: Odin'in bilgi arayışı, bilgelik ve adaletin peşinden gitmeyi öğretir.<br>
						- Değişim ve Kaos: Loki'nin hileleri, kaosun ve değişimin her zaman var olduğunu hatırlatır.<br><br>
						
						Bu mitolojik figürler, insan doğası ve evrenin işleyişi hakkında önemli dersler verir. Her bir karakterin öyküsü, zamanla şekillenen değerleri ve inançları keşfetmenize yardımcı olacaktır.
					</p>
				</td>
			</tr>
			<tr>
				<td>
					<h2 align="center"><font color="#d38900">İletişim</font></h2>

					<!-- Kurucuların İletişim Bilgileri -->
					<h3 align="center">Kurucularımız ile İletişime Geçin</h3>
					<p align="left">
						<strong>Admin</strong><br>
						İsim: Abdülsamet MANAV<br>
						Email: asamet@example.com<br>
						Telefon: +90 234 567 8901<br><br>
						
						Yukarıdaki iletişim bilgileriyle kurucularımıza ulaşabilirsiniz. Ayrıca, sayfanın alt kısmında yer alan formu kullanarak da bizlere mesaj gönderebilirsiniz.
					</p>

					 <!-- İletişim Formu -->
					 <p align="left">
                    <form name="contact" action="<?= site_url('contact/submit') ?>" method="POST">
                        <p>Adınız: <input type="text" name="name"></p>
                        <p>Yazma nedeniniz: <input type="text" name="reason"></p>
                        <p>Lütfen, aşağıda daha fazla bilgi veriniz:</p>
                        <textarea name="description" rows="4" cols="60"></textarea><br><br>
                        <input type="submit" name="sub" value="Gönder">
                    </form>
					</p>


				</td>
			</tr>
		</table>
	</p>

	
</body>

<?php include '../app/Views/tema/footer.php'; ?>

</html>
