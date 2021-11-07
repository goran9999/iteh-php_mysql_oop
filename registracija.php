<?php

include 'model/izdavac.php';
include 'dbBroker.php';







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/registracija.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <div class="card">
        <div class="main-div">
            <h1>Registracija</h1>
            <form action="#" method="POST" id="registrujForm">
                <div class="container">
                    <div>
                    <label for="naziv">Preduzece</label>
                    <input type="text" id="naziv" name="naziv">
                    </div>
                    <div>
                    <label for="pib">PIB</label>
                    <input type="text" id="pib" name="pib">
                    </div>
                    <!-- <br> -->
                    <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                    </div>
                    <div>
                    <label for="password">Sifra</label>
                    <input type="password" id="password" name="password">
                    </div>
                    <!-- <br> -->
                    <div>
                    <label for="adresa">Adresa</label>
                    <input type="text" id="adresa" name="adresa">
                    </div>
                    <button type="submit" name="register">Kreiraj nalog</button>
                </div>
            </form>
        </div>

    </div>
</body>
<script src="js/main.js"></script>

</html>