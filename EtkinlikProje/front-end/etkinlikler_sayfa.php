
<?php
session_start();
   include("../veri_tabani/baglanti.php");
   $kontrol_dizi =  $_SESSION['kontrol_rol'];
         if(empty($kontrol_dizi)){
                     echo "  burada ne işin var giriş yap";
                     header("Location: loginSayfasi.php");
                     exit;
         }

         $rol_etkinlik = $_SESSION['kontrol_rol'];
         // apilerde  curl daha büyük çarpl projeler içindir 

 

      $apiKey= "https://api.open-meteo.com/v1/forecast?latitude=39.9&longitude=41.27&daily=weather_code&timezone=auto";
           
       $yanit = file_get_contents($apiKey); // apiden veri aldık
       $veri = json_decode($yanit,true); // json türünden php  ye  çevirdik
     // print_r hepsini yazdırıyor bütün dizileri yazıyor 
    //    print_r($veri);
  
       function havaKodlari($hava_kod){
        
         switch ($hava_kod) {
            case 0:
                return "hava açık";
                break;

               case 1:
               case 2:
               case 3:
                 return " hava bulutlu";
                break;

                case 61:
               case 63:
               case 65:
                 return " hava yağmurlu";
                    break;

               case 45:
               case 48:
                return " hava sisli";
                  break;

               case 77:
               return  " hava karlı";
                break;

                
                default:
                  return "bilinmeyen bir hava tipi";
                break;
         }
       }
                // yedi günlük hava kodunu alır ve 0 ile ilk indexini alır 
       $havaK = $veri['daily']['weather_code'][0]; 
       // funk a atıyoruz  
       $hava_durumu = havaKodlari($havaK);

 // yine burada bir kontrol ifadesi yapılır 
         if (  isset($_POST['etkinlik_ekle'])) {             
             // form dan gelen verileri alırız ve değişkenlere koyarız
            $adE = $_POST['etkinlikAd'];
            $knE = $_POST['etkinlikKontenjan'];
            $trE = $_POST['etkinlikTarih'];
            // formdaki bilgileri veri tabanına yazdırıyoruz 
         mysqli_query($site_baglantisi, "INSERT INTO etkinlikler (tarih, kontenjan, etkinlik_adi) VALUES ('$trE', '$knE', '$adE')"); 

         }



          if ( isset($_POST['duyuru_ekle'])) {
             
             // form dan gelen verileri alırız ve değişkenlere koyarız
            $idr = $_POST['duyuruIcerik'];
            $bdr = $_POST['duyuruBaslik'];
                        // formdaki bilgileri veri tabanına yazdırıyoruz 

         mysqli_query($site_baglantisi, "INSERT INTO duyurular (duyuru_baslik, duyuru_icerik) VALUES ('$bdr', '$idr')"); 
         }


 // burada ise etkinlik ve duyuruları veri tabanında alıcağız 
 // burası etkinlikler isim tabloyu hepsini getir demektir
 // burada yapılan order by tarih göre DESC ise azalan olarak sırala  
  $et = "SELECT * FROM etkinlikler ORDER BY tarih DESC";
  // yukardaki ifadeyi çalıştırır ve tablo değerine aktarır 
  $tablo = mysqli_query($site_baglantisi,$et);

  

 
 // burası duyurular isim tabloyu hepsini getir demektir 
  $et1 = "SELECT * FROM duyurular";
  // yukardaki ifadeyi çalıştırır ve tablo değerine aktarır 
  $tablo1 = mysqli_query($site_baglantisi,$et1);



?>

<!DOCTYPE html>
<html lang="tr">

<head>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Etkinlikler</title>
  <style>
    body {
      overflow: hidden;
      background-color: whitesmoke;
      cursor: default;
    }


    #duyuruListesi {
      max-height: 450px;
      overflow-y: auto;
      margin-left: auto;
      position: absolute;
    }

    #etkinlikForm {
      background-color: #e6f4ea;
      padding: 20px;
      width: 170px;
      border-radius: 10px;
      position: absolute;
    
    }

    .container {
      position: absolute;
      top: 440px;
      left: 780px;


    }

    #duyuruFormAlani {
      background-color: #e6f4ea;
      padding: 7px;
      width: 450px;
      border-radius: 10px;
      position: absolute;
      height: 237px;
     top: 300px;

    }

    #duyuruFormAlani button {
      cursor: pointer;
      padding: 4px 10px;
      margin-top: 10px;
      border-radius: 6px;
      border: none;
      background-color: white;

    }

    #btn button {

      background-color: #e6f4ea;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;
      margin-top: 230px;
      cursor: pointer;
      gap: 4px;
 text-decoration: none;
    }

    .HavaD {
      background-color: #e6f4ea;
      padding: auto;
      width: 330px;
      border-radius: 10px;
      height: 100px;
      position: absolute;
      top: 20px;
      right: 20px;
     display: inline;
    
    }

    #duyuruListesi li {
      margin-top: 6px;
    }
    .butonlarE{
        margin-left :"10px";
         background-color :"#e6f4ea";
         border: "none";
         border-radius :"6px";
        padding:"4px 10px";
        cursor : "pointer";
    }

    a{
        text-decoration: none;
        
    }
  </style>

</head>

<body>
  <?php if ($rol_etkinlik == 'admin'): ?> 
    
  <h1 style=" margin-left: 85px;">Etkinlik Listesi
  </h1>

  
  <div class="HavaD"><span id="havaDurumu"
      style="top: 10px; right: 20px; position: absolute; font-size: 24px; text-align: center;">
 <?php echo "<p style =  'text-align:center '> hava bilgisi: $hava_durumu </p>";
 ?>
    </span>
</div>
  <ul id="liste"> 
 
 
  <!-- php de while ın böyle yapısı varmış  -->
<!-- burada ise  tablo daki değerleri hepsini anahtar değer gibi mesela tarih anahtar bunun işte 22.21.2025 ise bir değeri  -->
 <!-- burada da  while içinde tablodaki değerler bitene kadar while ifadesine girer ondan sonra girmez -->
  
 <?php while($gecici = mysqli_fetch_assoc($tablo)): ?>
        <li>
         <!-- buralara bir daha bak -->
            <strong> <?= $gecici['tarih']?></strong>&nbsp;&nbsp;
            <?=$gecici['etkinlik_adi']?>&nbsp;&nbsp;&nbsp;&nbsp;
             <?="kontenjan &nbsp; ".$gecici['kontenjan']?>&nbsp;&nbsp;
              
              <?php
               if($rol_etkinlik == 'admin') {
             $butonlarE = ["Sil", "Düzenle", "Sepet"]; // etkinlikler için 

foreach ($butonlarE as $nitelikler) { //Dizide ki her bir elemanı çağırır  
    echo "<button style = 
    ' margin-left :10px; 
      background-color :#e6f4ea;
         border: none;
         border-radius :6px;
        padding:4px 10px;
        cursor : pointer;
    
    '>$nitelikler</button> ";

}  
               }

 
?> 

      <br>
      <br>
      </li> 
         <?php endwhile; ?>
        </ul>

  <br>

  <h2 style=" position: relative;left: 85px;">DUYURULAR</h2>
  <ul id="duyuruListesi">
    
  <?php while($gecici1 = mysqli_fetch_assoc($tablo1)): ?>
        <li>
         <!-- buralara bir daha bak -->
           
         <strong><?=$gecici1['duyuru_baslik']?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
             <?=$gecici1['duyuru_icerik']?>&nbsp;&nbsp;
             
                       <?php
     if ($rol_etkinlik == 'admin') {

        $butonlarD = ["Sil", "Düzenle"];

foreach ($butonlarD as $nitelikler) { //Dizide ki her bir elemanı çağırır  
       echo "<button style = 
    ' margin-left :10px; 
      background-color :#e6f4ea;
         border: none;
         border-radius :6px;
        padding:4px 10px;
        cursor : pointer;
    
    '>$nitelikler</button> ";

}  
     }
 
?>
     
      <br>
      <br>
      </li> 
         <?php endwhile; ?>



</ul>

   <!-- burada hem php hem de html css kodlarını kullanabilmek için 
   böyle bir yapı kullacağız  -->

  <?php if($rol_etkinlik == 'admin'): ?>
  <form id="Duyurular" method= "POST" action = "" >
   
    <div id="duyuruFormAlani" style="margin-left: 1050px; margin-top: 137px;">
      <h2 style="text-align:center;">
        DUYURULAR
      </h2>

      <h3>---Yeni Duyuru Ekle---</h3>
      <input type="text" style="width: 54%;" id="duyuruBaslik" name = "duyuruBaslik" placeholder="Duyuru başlığı" required />
      <br>
      <br>
      <input type="text" style="width: 100%;" id="duyuruIcerik"  name = "duyuruIcerik" placeholder="Duyuru içeriği" required />
      <br>
      <br>
      <button type="submit" name  = "duyuru_ekle"
        style="padding: 4px 10px ; border-radius: 6px; border: none; background-color: white; cursor: pointer;">Ekle</button>
    </div>
  </form>
   <?php endif; ?>
  
    <?php if($rol_etkinlik == 'admin'): ?>
  <div class="container">
    
    <form id="etkinlikForm" method= "POST" action = "" >
      <h2>Etkinlik Ekle</h2>
      <input type="text" id="etkinlikAd" name = "etkinlikAd" placeholder="Etkinlik adı girin" required /><br><br>
      <input type="date" id="etkinlikTarih"  name = "etkinlikTarih" placeholder="etkinlik tarihini girin" required> <br> <br>
      <input type="number" id="etkinlikKontenjan" name = "etkinlikKontenjan" placeholder="kontenjan sayisini girin" min="10" required> <br>
      <br>
      <button type="submit" name  = "etkinlik_ekle"
        style="padding: 4px 10px ; border-radius: 6px; border: none; background-color: white; cursor: pointer;">Ekle</button>
    </form>
  </div>
    <?php endif; ?>

  <div id="btn">
    
    <a href=" ../veri_tabani/hesaptanOut.php">
        <button style="margin-left: 140px;">
      Çıkış yap
    </button>
    </a>

    <a href="sepet_sayfa.php">
      <button style="margin-inline: 20px;"> Sepet </button> </a>
  </div>

<?php elseif ($rol_etkinlik !='admin'): ?>

  <h1 style=" margin-left: 620px;">Etkinlik Listesi
  </h1>

  
  <div class="HavaD"><span id="havaDurumu"
      style="top: 10px; right: 20px; position: absolute; font-size: 24px; text-align: center;">
 <?php echo "<p style =  'text-align:center '> hava bilgisi: $hava_durumu </p>";
 ?>
    </span>
</div>
  <ul id="liste" style = " position: relative; left:490px;list-style-position: center;"> 
 
 
  <!-- php de while ın böyle yapısı varmış  -->
<!-- burada ise  tablo daki değerleri hepsini anahtar değer gibi mesela tarih anahtar bunun işte 22.21.2025 ise bir değeri  -->
 <!-- burada da  while içinde tablodaki değerler bitene kadar while ifadesine girer ondan sonra girmez -->
  
 <?php while($gecici = mysqli_fetch_assoc($tablo)): ?>
        <li  style="margin-right: 50px;">
         <!-- buralara bir daha bak -->
            <strong> <?= $gecici['tarih']?></strong>&nbsp;&nbsp;
            <?=$gecici['etkinlik_adi']?>&nbsp;&nbsp;&nbsp;&nbsp;
             <?="kontenjan &nbsp; ".$gecici['kontenjan']?>&nbsp;&nbsp;
              
              <?php
               if($rol_etkinlik == 'admin') {
             $butonlarE = ["Sil", "Düzenle", "Sepet"]; // etkinlikler için 

foreach ($butonlarE as $nitelikler) { //Dizide ki her bir elemanı çağırır  
    echo "<button class = 'butonlarE'>$nitelikler</button> ";

}  
               }

 
?> 

      <br>
      <br>
      </li> 
         <?php endwhile; ?>
        </ul>

  <br>

  <h2 style=" position: relative;left: 645px;">DUYURULAR</h2>
  <ul id="duyuruListesi"  style = " position: relative; left:430px; list-style-position: center; " >
    
  <?php while($gecici1 = mysqli_fetch_assoc($tablo1)): ?>
        <li>
           
         <strong><?=$gecici1['duyuru_baslik']?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
             <?=$gecici1['duyuru_icerik']?>&nbsp;&nbsp;
             
                       <?php
     if ($rol_etkinlik == 'admin') {

        $butonlarD = ["Sil", "Düzenle"];

foreach ($butonlarD as $nitelikler) { //Dizide ki her bir elemanı çağırır  
    echo "<button>$nitelikler</button> ";

}  
     }
 
?>
     
      <br>
      <br>
      </li> 
         <?php endwhile; ?>



</ul>

   <!-- burada hem php hem de html css kodlarını kullanabilmek için 
   böyle bir yapı kullacağız  -->

  <?php if($rol_etkinlik == 'admin'): ?>
  <form id="Duyurular" method= "POST" action = "" >
   
    <div id="duyuruFormAlani" style="margin-left: 1050px; margin-top: 137px;">
      <h2 style="text-align:center;">
        DUYURULAR
      </h2>

      <h3>---Yeni Duyuru Ekle---</h3>
      <input type="text" style="width: 54%;" id="duyuruBaslik" name = "duyuruBaslik" placeholder="Duyuru başlığı" required />
      <br>
      <br>
      <input type="text" style="width: 100%;" id="duyuruIcerik"  name = "duyuruIcerik" placeholder="Duyuru içeriği" required />
      <br>
      <br>
      <button type="submit" name  = "duyuru_ekle"
        style="padding: 4px 10px ; border-radius: 6px; border: none; background-color: white; cursor: pointer;">Ekle</button>
    </div>
  </form>
   <?php endif; ?>
  
    <?php if($rol_etkinlik == 'admin'): ?>
  <div class="container">
    
    <form id="etkinlikForm" method= "POST" action = "" >
      <h2>Etkinlik Ekle</h2>
      <input type="text" id="etkinlikAd" name = "etkinlikAd" placeholder="Etkinlik adı girin" required /><br><br>
      <input type="date" id="etkinlikTarih"  name = "etkinlikTarih" placeholder="etkinlik tarihini girin" required> <br> <br>
      <input type="number" id="etkinlikKontenjan" name = "etkinlikKontenjan" placeholder="kontenjan sayisini girin" min="10" required> <br>
      <br>
      <button type="submit" name  = "etkinlik_ekle"
        style="padding: 4px 10px ; border-radius: 6px; border: none; background-color: white; cursor: pointer;">Ekle</button>
    </form>
  </div>
    <?php endif; ?>

  <div id="btn">
    
    <a href=" ../veri_tabani/hesaptanOut.php">
        <button style=" position: relative; margin-left: 620px; margin-top:20px; text-decoration:none ;  cursor = default;">
      Çıkış yap
    </button>
    </a>

    <a href="sepet_sayfa.php">
      <button style="  position: relative; margin-inline: 20px; margin-top:75px;"> Sepet </button> </a>
  </div>

    <?php endif; ?>
  </body>
  </html>