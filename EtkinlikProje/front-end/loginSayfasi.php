

<?php
include("../veri_tabani/baglanti.php");
// oturumu başlattık
   session_start();
 // burada isset ile  true  mu yoksa false mı diye kontrol ediyoruz 

 if(isset($_POST['submit'])){
  // burada hata olabilir değişkenler de dikkat et  
  // kullanicinin giris sayfasında gönderdiği değerlerdir bunlar 
  // o değeleri karşılaştırıyoruz
  // input daki name değerlerini karşılaştırıyoruz 

  
  $gmailm = $_POST['email'];
    $gmail_sifrem = $_POST['sifre'];

  

  // sonuc burada sadecece sorgulama amacı var yani yazım yanlışı olmadığı sürece doğru yada yanlış sorgu çalışır 

   // burada mysqli sorgu gidir istenilen ifadeyi çalıştırır ve değişkene atar 
 // burada  satır bölmesini gönderir 

  // mysqli_query de bir hata oluşursa die komutu çalışır ekranda çıkar
  // yoksa null gönderir 
   $sonuc = mysqli_query($site_baglantisi, "SELECT * FROM kullanacilar WHERE email = '$gmailm' AND sifre = '$gmail_sifrem' ") or die(" veri tabanındaki veri ile giriste verilenler uyuşmuyor");
      // burada sonuc da sadece bir değer yok burada email ve sifre değerleri var 

    // kullanıcı varsa bir dizi gönderiyor 
    // mysqli burada bütün satırları döndüryor 
    // mesela agm@gmail.com 2 3 bunu hepsini döndürüyor 

    $dizi = mysqli_fetch_assoc($sonuc);
     
    

    // gerçekten  bir dizi mi ve boş değil mi
    if(  is_array($dizi) && (!empty($dizi)) ){
      // diğer sayfalar da giren kişinin bilgileri saklamak için yapılmıştır $SESSION 
      $_SESSION['Egmail'] = $dizi['email'];
      $_SESSION['Esifre'] = $dizi['sifre'];
       
    
   
      
    } 
      // isset burada boş mu değil mi true false döner yani 

    if((!empty($dizi))){
      
      // burada geçici ye o an giren ve login in olan hesabı maili
      $gecici =  $dizi['email'];     
      
      // tam olarak burada ne yapılıyor 
      // burada bu email hesabına sahip birisini rol bilgisi alıyor da o zaman neden direkmen 
      // sonuc2 burada bir metin içeriyor ondan dolayı ayıklama işlemi yapılması şart


      $sonuc2 = "SELECT rol FROM kullanacilar WHERE email = '$gecici'";

       // burada adminlik için  bir sistem yapıyoruz 
             $sonuc3 = "SELECT onayla FROM kullanacilar WHERE email = '$gecici'";
             $onayKontrol = mysqli_query($site_baglantisi,$sonuc3);
             $dizi3 = mysqli_fetch_assoc($onayKontrol);

           
    
         if($dizi3['onayla'] == '1'){
          echo " <p> &nbsp; &nbsp; &nbsp; &nbsp;bu kullanici onaylidir <p>";
            $rol_bilgisi = mysqli_query($site_baglantisi, $sonuc2);

           $dizi2 = mysqli_fetch_assoc($rol_bilgisi);
           // buradan dolayı işe yaramayabilir 
           //enum olsa bile burada böyle yapılması lazım 
              
           // burada rol ifadesini almamızın sebebi ise etkinlik sayfasında admine özel alanlar olduğu onları kontrol ediyoruz ondan dolayı 
             $_SESSION['kontrol_rol'] = $dizi2['rol'];
             // veirleri saklıyoruz 

              if($dizi2['rol'] == 'admin' ){
           echo " <p> &nbsp; &nbsp; &nbsp; &nbsp;bu admin <p>";
                    
           echo '<script>
   setTimeout(() => {
            window.location.href = "admin_sayfa.php";
          }, 3000);

  </script>';
                // buraya daha eklemeler yapılacaktır 
              }else{
          echo " <p> &nbsp; &nbsp; &nbsp; &nbsp; bu normal  kullanicidir  <p>";

            

     echo "<p> &nbsp; &nbsp; &nbsp; &nbsp; giris başarılı etkinlik sayfasına aktarılıyorsunuz </p>";
   // giriş işlemi olduktan sonra giriş sayfasına yönlendiriyor
  echo '<script>
   setTimeout(() => {
            window.location.href = "etkinlikler_sayfa.php";
          }, 3000);

  </script>';
              }

         }else{
          echo " bu kullanici onaylanmamıştır ";
            
         }
        
        
    }
    else {
      echo "<p> &nbsp; &nbsp;  yanlış   gmail ve yanlış şifre </p>";

   

    }
    }



?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Giriş Sayfası </title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    #girisForm {
      background-color: #e6f4ea;
      padding: 20px;
      width: 350px;
      margin: 100px;
      border-radius: 10px;
      /* position: relative; */
    }

    #girisForm input {
      width: 100%;
      padding: 4px;
    }

    #girisForm button {
      background-color: white;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;

    }

    .butonlar {
      display: flex;
      justify-content: center;
      gap: 5px;
      padding: 10px 10px;
      border: none;
      border-radius: 6px;
       /* cursor: pointer; */
    }

    .girisKutusu {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>

</head>

<body>


  <div class="girisKutusu">
    <!-- buradaki action yapısı "" böyle olursa kendi sayfasını döndürüyor -->
    <form id="girisForm" method = "POST" action = "">
      <h1 style="text-align: center;">Kullanıcı Girişi</h1>
      <label>Email:</label><br />
      <input type="email" id="email" name = "email"   required/><br /><br />

      <label>Şifre:</label><br />
      <input type="password" id="sifre"  name = "sifre"  required  /><br /><br />
      <div class="butonlar">
        <button type="submit" id = "submit" name = "submit" style="cursor: pointer; margin-right: 115px">Giriş Yap</button><br>
        
      </div>

        <a href="sifre_degistirme.php"><button type="button" style="cursor: pointer; padding: 7px 7px; 
        
         position: absolute;
      top: 60.5%;
      left: 52%;
        ">Şifre Değiştir</button></a>
      <p>
        Hesabınız yok mu? <a href="kayıtSayfasi.php"><button type="button" style="cursor: pointer;">Kayıt Ol </button></a>
      </p>
    </form>
  </div>
    
</body>

 </html>