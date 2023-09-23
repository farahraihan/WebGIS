<?php
session_start();

$response = $_SESSION['response'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response</title>
    <style>
        body, a, p {
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #6b63ff16;
        }
        a{
            color: blue;
        }
        a:hover{
            color:grey;
        }

    </style>
</head>
<body>
    <div class="container">
        <p><?= $response; ?><p><br>
        <a href="index.php">Kembali ke beranda</a>
    </div>
</body>
</html>