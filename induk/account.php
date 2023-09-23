<?php
session_start();
require '../function.php';

if(!isset($_SESSION["login"]) ) {
    header("Location: ../index.php");
    exit;
}

$result = "";
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $newpassword = $_POST['new_password'];
    $confirm_password = $_POST['confirm_pwd'];
    if($newpassword==$confirm_password){
        $token = encrypt2($username, $password, $newpassword);
        $result = request_API_Change_P($token);    
    }else{
        $result = "Konfirmasi password tidak sesuai";
    }

    if($result=="success"){
        $result = "Password berhasil diganti ";
        $_SESSION['response'] = $result; 
        header("Location: response.php");
        exit;
    }elseif($result=="gagal"){
        $result = "Gagal mengganti password ";
        $_SESSION['response'] = $result; 
        header("Location: response.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" conte nt="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <link rel="stylesheet" href="../style/style5.css">

</head>
<body>
    
    <div class="container1">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Header -->
            <div class="header">
                <h2>SIMP</h2>
            </div>
            <!-- Gambar / Icon -->
            <div class="icon">
                <img src="../image/data.svg" alt="dashboard_profile" id="dashboard_profile" >
            </div>

            <!-- Item List -->
            <!-- Dashboard -->
                <a href="index.php">
                    <div class="dashboard">
                        <i class="fa-solid fa-gauge fa-2x"></i>
                        <span class="item">Dashboard</span>
                    </div>
                </a>
                <a href="approval.php">
                    <div class="approval">
                        <i class="fa-solid fa-share-from-square fa-2x"></i>
                        <span class="item">Approval</span>
                    </div>
                </a>
                <a href="map.php">
                    <div class="map">
                        <i class="fa-solid fa-map-location-dot fa-2x"></i>
                        <span class="item">Map</span>
                    </div>
                </a>
                <a href="data.php">
                    <div class="data">
                        <i class="fa-solid fa-database fa-2x"></i>
                        <span class="item">Data</span>
                    </div>
                </a>
                <a href="account.php">
                    <div class="account">
                        <i class="fa-solid fa-user-gear fa-2x"></i>
                        <span class="item">Account</span>
                    </div>
                </a>

            
            <!-- Sidebar Footer -->
            <div class="footer">
                <a href="../logout.php">Log Out</a>
            </div>
        </div>

        <!-- Main Area /Content -->
        <div class="content">
            <div class="item">
                <form action="account.php" method="POST">
                    <label for="username">Username : </label>
                    <span class="warning">
                        <?php 
                             if($result=="username tidak ditemukan"){
                                echo "* Username tidak ditemukan";
                             }
                        ?>
                    </span>
                    <input type="text" name="username" id="username" placeholder="Username">
            
                    <label for="password">Password : </label>
                    <span class="warning">
                        <?php 
                             if($result=="password salah"){
                                echo "* Password salah";
                             }
                        ?>
                    </span>
                    <input type="password" name="password" id="password" placeholder="Password">

                    <label for="new_password">New Password : </label>
                    <input type="password" name="new_password" id="new_password" placeholder="New Password">
                    
                    <label for="confirm_pwd">Confirm password : </label>
                    <span class="warning">
                        <?php 
                             if($result=="Konfirmasi password tidak sesuai"){
                                echo "* ".$result;
                             }
                        ?>
                    </span>
                    <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Your New Password..">
                    
                    <button type="submit" name="submit">Submit</button>
                </form> 
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>
</html>