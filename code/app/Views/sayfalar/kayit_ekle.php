           
            
        <div class="wrapper"> 
            <?= validation_list_errors()?>
            <form id="loginForm" action="<?=base_url('kayit_ekle')?>" method="POST" enctype="multipart/form-data">
                <?=csrf_field()?>
                <h1 style="text-indent: 30px;" > KAYIT EKLE</h1>
                <div class="input-box">
                    <select name="hedef" id="hedef"  class="form-control" required>
                        <option value="uploads">Tanrılar</option>
                        <option value="uploads2">Ölüler</option>
                        <option value="uploads3">Efsanevi</option>
                    </select>
                </div>
                <div class="input-box">
                    <input id="baslik" type="text" name="baslik" placeholder="Başlık" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <textarea class="form-control" name="icerik" id="icerik" placeholder="İçerik"></textarea>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input id="resim" type="file" name="resim" placeholder="Resim" required>
                    <i class="bx bxs-user"></i>
                </div>
                <input type="submit" name="gonder" class="btn" value="Ekle">
                

                
            </form>
        </div>

            <style>
        

                h1 {
                    font-size: 24px;
                    color: #333;
                    margin-bottom: 20px;
                    
                    
                }

                /* Giriş formu */
                .input-box,
                .label {
                    position: relative;
                    margin-bottom: 20px;
                }

                .input-box input,
                .label {
                    width: 20%;
                    padding: 12px 20px;
                    font-size: 16px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    outline: none;
                    transition: all 0.3s ease;
                    margin-left: 20px;
                }

                .input-box input:focus,
                .label {
                    border-color: #4e73df;
                }

                .input-box i,
                .label {
                    position: absolute;
                    top: 50%;
                    left: 15px;
                    transform: translateY(-50%);
                    color: #888;
                }

                /* Buton */
                .btn {
                    width: 20%;
                    padding: 14px;
                    background-color: #4e73df;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    font-size: 16px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                    margin-left: 450px;
                }

                .btn:hover {
                    background-color: #3e63bf;
                }

                /* Linkler */
                .register-link {
                    margin-top: 15px;
                    font-size: 14px;
                    color: #555;
                }

                .register-link a {
                    color: #4e73df;
                    text-decoration: none;
                    transition: color 0.3s ease;
                }

                .register-link a:hover {
                    color: #3e63bf;
                }

                /* Responsive tasarım */
                @media (max-width: 500px) {
                    .wrapper {
                        padding: 20px;
                        width: 90%;
                    }

                    h1 {
                        font-size: 22px;
                    }

                    .input-box input {
                        font-size: 14px;
                    }

                    .btn {
                        font-size: 14px;
                    }
                }

            </style>