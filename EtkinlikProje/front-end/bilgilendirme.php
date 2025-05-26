

<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkında</title>
    <style>
        body {

            background-color: whitesmoke;
        }

        .Bilgi img {
            width: 120px;
            margin-top: -20px;
            margin-left: 110px;
        }

        .Bilgi {
            padding: 40px;
            width: 300px;
            height: 485px;
            margin: 40px auto;
            background-color: #e6f4ea;
            border-radius: 10px;
            width: 75%;
        }


        .Bilgi p {
            font-size: 25px;

            
        }

        button {
            display: block;
            position: relative;
            background-color: white;
            margin-top: 100px;
            margin-left: 110px;
            border-radius: 10px;
            padding: 10px;
            width: 120px;
            border: none;
            cursor: pointer;
            text-align: center;
            font-size: 17px;
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

    <div class="Bilgi">
        <div> <img src="Logoo.png" class="logo"> </div>
        <p> Buğra Yolaçar </p>
        <p>230707065</p>
        <p style = " display:flex; justify-center: flex-start; width: 100%">PHP tabanlı bir etkinlik sitesidir.Veritabanı olarak ise MySQL kullanılmıştır. (Etkinlik Yönetim Sistemi).</p>
        <p>Doç.Dr.Ferhat Bozkurt</p>
        <a href="ana_sayfa.php" style="text-decoration: none;"> <button> AnaSayfa </button></a>
    </div>

</body>

</html>