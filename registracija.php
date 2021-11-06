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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <h1>Registracija</h1>
    <div class="card">
        <div class="main-div">
            <form action="#" method="POST" id="registrujForm">
                <div class="container">
                    <label for="naziv">Ime Preduzeca</label>
                    <input type="text" id="naziv" name="naziv">
                    <label for="pib">PIB</label>
                    <input type="text" id="pib" name="pib">
                    <br>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                    <label for="password">Sifra</label>
                    <input type="password" id="password" name="password">
                    <br>
                    <label for="adresa">Adresa</label>
                    <input type="text" id="adresa" name="adresa">
                    <button type="submit" name="register">Kreiraj nalog</button>
                </div>
            </form>
        </div>

    </div>
</body>
<script src="js/main.js"></script>

</html>