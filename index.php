<?php
    session_start();
    require 'function.php';

    // cek cookie
    if( isset($_COOKIE['key'])) {
        $key = $_COOKIE['key'];
        $result = request_API_Login($key);
        $obj = json_decode($result, true);
        // cek cookie (username dan password)
        if($obj != NULL){
            $_SESSION["login"] = true;
            $_SESSION["level"] = $obj["data"][0]["level"];
            $_SESSION["up3"] = $obj["data"][0]["up3"];
            $_SESSION["ulp"] = $obj["data"][0]["ulp"];
            // $_SESSION["level"] = "5";
            // $_SESSION["up3"] = "BANDA ACEH";
            // $_SESSION["ulp"] = "MERDUATI";
        }
    }

    if(isset($_SESSION["login"]) and $_SESSION["level"] == "7") {
        header("Location: induk");
        exit;
    }elseif(isset($_SESSION["login"]) and $_SESSION["level"] == "6"){
        header("Location: up3");
        exit;
    }elseif(isset($_SESSION["login"]) and $_SESSION["level"] == "5"){
        header("Location: ulp");
        exit;
    }

    if(isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $token = encrypt($username, $password);
        $result = request_API_Login($token);

        $obj = json_decode($result, true);
        if($obj != NULL){

            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if(isset($_POST['remember'])){
                // buat cookie
                // setcookie('name', 'value', time() + (60 * 60 * 24);
                setcookie('key', encrypt($username, $password), time()+(60 * 60 * 24));
            }

            $_SESSION["level"] = $obj["data"][0]["level"];
            $_SESSION["up3"] = $obj["data"][0]["up3"];
            $_SESSION["ulp"] = $obj["data"][0]["ulp"];
            // $_SESSION["level"] = "5";
            // $_SESSION["up3"] = "BANDA ACEH";
            // $_SESSION["ulp"] = "MERDUATI";
            if($_SESSION["level"] == "7"){
                header("Location: induk");
                exit;
            }elseif($_SESSION["level"] == "6"){
                header("Location: up3");
                exit;
            }
            elseif($_SESSION["level"] == "5"){
                header("Location: ulp");
                exit;
            }
        }

        $error = true;
       
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMP|LOGIN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container1">
        <div class="container2">
            <div class="box">
                <h3>Selamat datang di SIMP .. </h3>
                <h2>SISTEM INFORMASI MONITORING PJU</h2>
                <form action="" method="post">
                    
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username" class="text-input">
                
                    <label for="password">Password : </label>
                    <input type="password" name="password" id="password" class="text-input">
                    <span>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember me</label>
                    </span>
                    <?php if(isset($error)) : ?>
                        <p style="color : red; margin-bottom : 5px; text-align : left; font-style : normal;">Username / password salah ! </p>
                    <?php endif; ?>
                    <button type="submit" name="login">Login</button>
                </form>
            </div>
        </div>
        <div class="footer">
            <p align="center">Copyright &copy [2023] [PLN Aceh]. All Right Reserved</p>
        </div>
    </div>
</body>
</html>