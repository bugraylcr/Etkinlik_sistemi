<?php
// burada neden .. var çünkü aynı dosya da değil diğer dosyalar bakmak için 
include("../veri_tabani/baglanti.php");

 // isset burada tanımlı değil ona bakar 

  if (isset($_POST['kayit'])) {
    $gmail = $_POST['email'];
    $gmail_sifresi = $_POST['sifre'];
      // veri tabanındaki sutunlara değerleri aktarmak için kullanılır 
      // true yada false döner 
  if(mysqli_query($site_baglantisi,"INSERT INTO  kullanacilar (email,sifre) VALUES ('$gmail' , '$gmail_sifresi')") )
 {
  echo "<p> &nbsp; &nbsp; kayıt başarılı  giriş sayfasına aktarılıyorsunuz </p>";
   // kayıt işlemi olduktan sonra giriş sayfasına yönlendiriyor
  echo '<script>
   setTimeout(() => {
            window.location.href = "loginSayfasi.php";
          }, 1500);

  </script>';

  
 }else{
  echo "<p> sistem düzgün çalışmadı  </p>";
 }
  }


?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8" />
  <title>Kayıt Olma Sayfası</title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    .kayitForm {
      background-color: #e6f4ea;
      padding: 15px;
      width: 355px;
      margin: 140px auto;
      border-radius: 10px;

    }

    .kayitForm input {
      width: 100%;
      padding: 4px;
    }

    .kayitForm button {
      background-color: white;
      border: none;
      border-radius: 4px;
      padding: 7px 14px;

    }

    .buton {
      margin-top: 2px;
      margin-bottom: 2px;
      display: flex;
      justify-content: center;
      gap: 3px;
      padding: 6px 6px;
      border: none;
      border-radius: 2px;
      cursor: pointer;
    }
  </style>

</head>

<body>


<!-- action a gerek yok çünkü bütün işlemler burada yapılıyor -->
  <form method="POST" action = "">
    <div class = "kayitForm">
      <h1 style="text-align: center;">Kayıt Ol</h1>
    <label>Email:</label><br />
    <input type="email" id= "email" name = "email" required /><br /><br />

    <label>Şifre:</label><br />
    <!-- buraya dikkat et password demez ise görünür şifre -->
    <input type="password"  id = "sifre" name= "sifre" required /><br /><br />
    <div class="buton"> 
      <!-- buradaki name değerleri çok önemli çünkü buradan POSt ediyoruz -->
      <button type="submit" name = "kayit">Kayıt Ol</button>
    </div>
    <p id="mesaj"></p>
    <p style="text-align: center;">Zaten hesabınız var mı? <a href="loginSayfasi.php" style = "color: black">Giriş Yap</a></p>

    </div>
    
  </form>
    
  </body>
</html>