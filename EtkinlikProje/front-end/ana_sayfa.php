 <?php
include("../veri_tabani/baglanti.php");

?>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ana SAYFA</title>
    <style>
        /* burdaki * işaret hepsinde geçerli olur */
        * {
            text-decoration: none;
        }

        body {

            background-color: whitesmoke;

        }

        .AnaSayfa {
            padding: 60px;
            width: 350px;
            height: 450px;
            margin: 50px auto;
            background-color: #e6f4ea;
            border-radius: 10px;
      
        }


        .AnaSayfa img {
            width: 120px;
            margin-top: -20px;
            margin-left: 110px;
        }

        li {
            list-style: none;
            display: inline-block;

        }


        button {
            display: inline-block;
            position: relative;
            background-color: white;
            margin-top: 110px;
            margin-left: 110px;
            border-radius: 10px;
            padding: 10px;
            width: 120px;
            border: none;
            cursor: pointer;

            background-color: white;
            transition: box-shadow 0.3s ease, transform 0.2s ease;

        }

        button:hover {
            box-shadow: 0 0 20px white, 0 0 20px white;
            transform: scale(1.05);

        }
    </style>
</head>

<body>

    <div class="AnaSayfa">
        <div> <img src="Logoo.png" class="logo" style="position: absolute;"> </div>

        <a href="loginSayfasi.php"><button style="text-align: center; font-size: 17px;"> Giriş
                Yap </button></a>
        <br>
        <br>
        <a href="kayıtSayfasi.php"><button style="margin-right: 50px; font-size: 17px;">
                Kayıt Ol</button></a>
        <br>
        <br>
        <a href="bilgilendirme.php"> <button style=" margin-right: 40px; font-size: 17px;"> Hakkında </button></a>

    </div>


</body>

</html>