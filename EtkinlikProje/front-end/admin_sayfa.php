<?php
    include("../veri_tabani/baglanti.php");
   session_start();
      
   // burada yine bir kontrol yapıyoruz 
  // aynı mantık burada bir dizi oluşturuyoruz 
   $kullanacilar = [];
   $sonuc = mysqli_query($site_baglantisi,"SELECT email , onayla FROM kullanacilar");
// sadece email ve onayla bilgisi alıyoruz 
// ondan sonra bu bilgileri bir diziye atıyoruz 
   while ($bilgiler = mysqli_fetch_assoc($sonuc)) {
     $kullanacilar[] = $bilgiler;
   }
   // email ve onayla bilgileri burada olacak 
   // burada saklanacaktır 


   // html de her bir veri tabanındaki gmail while dongüsünde buraya gelir 
   // her geldiğinde yapılan değişik varsa o güncellenir yoksa aynı olduğu gibi birakılır 
   
   if(isset($_POST['etkinlikKay'])){
       
    // form dan gelen onaylama adlı veriyi  sırayla döndür
    // ve döndürülen verinin email burda da sadece emailim  yapılan_onayı 
    // olarak düşün yani burada önemli olan $yapilan_onay dır 

      // burada bir dizi de email ve onaylar saklanıyor 
   foreach ($_POST["yapilan_onaylar"] as $email => $yapilan_onaylar) {
    // bu if yapısıyla birlikte diğer seçenekleri doldurmaya gerek kalmadan istediğimiz onay ve onay vermiyoruz 
        if ($yapilan_onaylar == "") continue; 
            
        
        
        // burada ifadayi sayısal bir ifade yapıyoruz olay bu 
        $yapilan_onaylar = intval($yapilan_onaylar);  
  
         
        // Veritabanında yapılan değeri bu sayfa yapılan değişik ile
        
        
        // güncelleme yapıyoruz 
    // burada kullanaci tablosundaki emaili $email olan elemanın 
    // onayla verisini $yapılan_onay ile set et yani güncelle.

        $degistirme = "UPDATE kullanacilar SET onayla = $yapilan_onaylar WHERE email = '$email'";
     
        // burada güncellemeyi gerçekleştiriyoruz 
        mysqli_query($site_baglantisi, $degistirme);
   
    }

    echo "<p>Değişikler yapıldı </p>";
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
      #adminKontrol {
            background-color: #e6f4ea;
            padding: 60px;
            width: 1000px;
            margin: 80px auto;
            border-radius: 10px;
            height: 400px;

        }
         #adminKontrol button {
            background-color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            cursor: pointer;
          position: absolute;
        }
.buton {
      margin-left: 600px;
      margin-top: 100px;
      padding: 10px 20px;
      background-color: white;
        color:black;
      text-decoration: none;
      border-radius: 5px;
      position: absolute;
     display: flex;
  justify-content:center; 
    }
      

   
  </style>

</head>

<body>
 <form id="adminKontrol" method="POST" action="">
  <h1 style="text-align: center;">Admin Panel</h1><br>
       
 <?php
         // biz burada query ile sadece sütununu aldık   email sutununu
      $eemail = mysqli_query($site_baglantisi,"SELECT email FROM  kullanacilar");
           // assoc ise satırını almak için
      while ($satir_bilgi = mysqli_fetch_assoc($eemail)) {
        // while email sutunu bitene kadar döner 
        // burada sadece içerden email lari alır değişkene atar 
         // sadece ahmet@gmail.com  
        $emailler = $satir_bilgi["email"];


        
        echo "<div>";
            echo "<label> $emailler</label> ";

            echo "<select name='yapilan_onaylar[$emailler]'>";
            echo "<option value=''>-- Seç --</option>";
            echo "<option value='1'>Onayla</option>";
            echo "<option value='0'>Onaylama</option>";
            echo "</select>";
            echo "</div><br>";
      }
  ?>



                <button id="submit" name = "etkinlikKay" style="margin-top: 100px; margin-left: 850px; position:absolute;">Kaydet</button>
             
               <a href="etkinlikler_sayfa.php" class="buton">Etkinlikler </a>
              
     </form>
</body>


</html>