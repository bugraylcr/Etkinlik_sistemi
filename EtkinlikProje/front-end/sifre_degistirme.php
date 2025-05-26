
<?php
session_start();
   include("../veri_tabani/baglanti.php");
   // buraya type değil name gelecek hep dikkat et 
   if (isset($_POST['degistir'])) {
     // burada sayfada girilen mail ve sifreyi atıyoruz 
    $gmails = $_POST['email'];           
    $sifres = $_POST['sifre'];           
    $yeniSifre = $_POST['sifreYeni'];

 $sonucum = mysqli_query($site_baglantisi, "SELECT * FROM kullanacilar WHERE email = '$gmails' AND sifre = '$sifres' ") or die(" veri tabanındaki veri ile giriste verilenler uyuşmuyor");
 
    $dizii = mysqli_fetch_assoc($sonucum);
       

    if( is_array($dizii) && (!empty($dizii)) ){
        // burada şifreyi günceleme işlem yapıyoruz ve  girilen email ve eski şifre 
        // uyuşuyorsa şifreyi değiştirebişiyoruz 
    $gunceleme = "UPDATE kullanacilar SET sifre = $yeniSifre WHERE email = '$gmails'";
      
    // burada gerçekleştiriyoruz 
    mysqli_query($site_baglantisi, $gunceleme);
    echo " &nbsp;Tebrikler  şifreniz başarıyla değişitirildi" ;

    }else {
        echo " &nbsp; e posta ve şifre  veri tabanıyla uyuşmuyor tekrar deneyiniz";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Şifre Değiştir</title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    .SifreDegistir {
      background-color: #e6f4ea;
      padding: 30px;
      width: 350px;
      margin: 170px auto;
      border-radius: 10px;
      height: 260px;
    }

    .SifreDegistir input {
      width: 100%;
      padding: 5px;
    }

    .SifreDegistir button {
      background-color: white;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;
      cursor: pointer;

    }

    .tus {
      display: flex;
      justify-content: center;
      gap: 20px;
      cursor: pointer;
      border: none;
      border-radius: 6px;
      text-align: center;
    }
  </style>

</head>

<body>

    <form  id ="sifre_degis" action="" method="post">
  <div class="SifreDegistir">
    <h2 style="text-align: center;">Şifre Değiştir</h2>
    <input type="email" id="email" name = "email"placeholder="Email adresiniz" required><br><br>
    <input type="password" id="sifre " name = "sifre" placeholder="Eski şifre" required><br><br>
    <input type="password" id="sifreYeni" name = "sifreYeni" placeholder="Yeni şifre" required><br><br>
    <br>
 
  
     <div class="tus">
       <button style="padding: 7px 14px"  type = "submit" id ="degistir" name = "degistir">Şifreyi Güncelle</button>
      <a href="loginSayfasi.php"><button type="button"> Giris Yap </button></a>
    </div>
  </div>

</form>

</body>

</html>