<?php
    
    // koneksi database 
    $conn=mysqli_connect("localhost","agam5380_simp","Aceh@102022","agam5380_simp");
    // $conn = mysqli_connect("localhost", "root", "", "pju2");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }

    function update($query) {
        global $conn;
        $update = mysqli_query($conn, $query);
    }

    function insert($query){
        global $conn;
        $insert = mysqli_query($conn, $query);
    }

    function encrypt($username, $password) {
        $key = 'agamdev';
        $username = bin2hex($username);

        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode([
            'username' => $username,
            'password' => $password
        ]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        date_default_timezone_set('Asia/Jakarta');
        $date = date('dmY');

        $length_date = strlen($date);
        $length_msg = strlen($jwt);
        $max = 127;
        $min = 33;

        for($x=0; $x < $length_msg ;$x++){
            if($x < $length_date){
                $dt[$x] = substr($date,$x,1);
            }else if($x % $length_date >0){
                $sisa = $x % $length_date;
                $dt[$x] = substr($date,$sisa,1);
            }else{
                $dt[$x] = substr($date,0,1);
            }
            
        }

        $message = "";
        for($x=0; $x < $length_msg ;$x++){
            $temp = ord(substr($jwt, $x, 1));
            $temp = $temp + $dt[$x];
            if($temp > 126){
                $sisa = $temp - 126 + 32; 
                $msg[$x] = chr($sisa);
            }else if($temp < 33){
                $sisa = 127 - (33-$temp);
                $msg[$x] = chr($sisa);
            }
            else{
                $msg[$x] = chr($temp);
            }
            
        }

        $message = implode($msg);
        return $message;
    }

    function encrypt2($username, $password, $newpassword) {
        $key = 'agamdev';
        $username = bin2hex($username);

        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode([
            'username' => $username,
            'password' => $password,
            'newpassword' => $newpassword
        ]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        date_default_timezone_set('Asia/Jakarta');
        $date = date('dmY');

        $length_date = strlen($date);
        $length_msg = strlen($jwt);
        $max = 127;
        $min = 33;

        for($x=0; $x < $length_msg ;$x++){
            if($x < $length_date){
                $dt[$x] = substr($date,$x,1);
            }else if($x % $length_date >0){
                $sisa = $x % $length_date;
                $dt[$x] = substr($date,$sisa,1);
            }else{
                $dt[$x] = substr($date,0,1);
            }
            
        }

        $message = "";
        for($x=0; $x < $length_msg ;$x++){
            $temp = ord(substr($jwt, $x, 1));
            $temp = $temp + $dt[$x];
            if($temp > 126){
                $sisa = $temp - 126 + 32; 
                $msg[$x] = chr($sisa);
            }else if($temp < 33){
                $sisa = 127 - (33-$temp);
                $msg[$x] = chr($sisa);
            }
            else{
                $msg[$x] = chr($temp);
            }
            
        }

        $message = implode($msg);
        return $message;
    }

    function request_API_Login($chippertext){
        $url="https://www.agamdev.com/android/simp/login.php";
        $data=array("token"=>$chippertext);
        $options = array(
                    "http"=> array(
                        "method"=>"POST",
                        "header"=>"Content-Type: application/x-www-form-urlencoded",
                        "content"=>http_build_query($data)
                    )
        );
        $response=file_get_contents($url,false,stream_context_create($options));
        return $response;
    }

    function request_API_Change_P($chippertext){
        $url="https://www.agamdev.com/android/simp/changepassword.php";
        $data=array("token"=>$chippertext);
        $options = array(
                    "http"=> array(
                        "method"=>"POST",
                        "header"=>"Content-Type: application/x-www-form-urlencoded",
                        "content"=>http_build_query($data)
                    )
        );
        $response=file_get_contents($url,false,stream_context_create($options));
        return $response;
    }

?>