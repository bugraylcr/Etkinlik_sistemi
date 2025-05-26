
 <?php
include("../veri_tabani/baglanti.php");

?>

<!DOCTYPE html>
<html lang="tr">


<head>
  
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sepetim</title>
  <style>
    body {
      background-color: whitesmoke;
      cursor: default;
    }

    #Sepet {
      background-color: #e6f4ea;
      padding: 60px;
      width: 350px;
      margin: 80px auto;
      border-radius: 10px;

    }

    #Sepet button {
      background-color: white;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;

      cursor: pointer;

    }

    .butonlar {
      padding-top: 30px;
    }

    #sepetListesi li {
      margin-bottom: 7px;

    }
  </style>
</head>

<body>
  <div class="Sepetler">

    <form id="Sepet">
      <h1 style="text-align: center; margin-top: 4px;">Sepetim</h1><br>
      <ul id="sepetListesi"></ul>
      <h3 style="margin-bottom: 4px ;">Toplam Tutar: <span id="toplam">₺0</span></h3> <br>

      <label >Ödeme Yöntemi:</label>
      <select >
        <option value="">-- Ödeme yöntemi seçin --</option>
        <option value="kredi_karti"> Kredi/banka Kartı</option>
        <option value="havale"> Havale</option>
      </select>
      <br><br>
      <div class="butonlar">
        <button  style="margin-top: 15px; margin-inline: 131px; padding: 10px 16px;">Satın Al</button>
         <br><br>
        <button  type = "button" onclick="window.location.href='etkinlikler_sayfa.php'" style="
  background-color: white;
 
  padding: 10px 16px;
  margin-top: 15px;
  margin-inline: 126px;
  border-radius: 5px;
  border: none;
  text-align: center;
  font-size: 13px;
  cursor: pointer;
">
          Etkinlikler
        </button>
      </div>

    </form>
  </div>

</body>
</html>