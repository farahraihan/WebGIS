<?php
session_start();
require '../function.php';
    
    $level = $_SESSION["level"];
    if( !isset($_SESSION["login"])) {
        if($level!=="5"){
            header("Location: ../index.php");
            exit;
        }
    }
    
$ulp = ($_SESSION["ulp"]);

$kab_kota= query("SELECT kab_kota FROM master WHERE ulp='$ulp'");
$kab_kota= $kab_kota[0]['kab_kota'];
$induk= query("SELECT induk FROM master WHERE ulp='$ulp'");
$induk= $induk[0]['induk'];
$up3= query("SELECT up3 FROM master WHERE ulp='$ulp'");
$up3= $up3[0]['up3'];

// OPTION KECAMATAN
$kecamatan = query("SELECT DISTINCT kecamatan FROM master WHERE ulp = '$ulp'");
$j_kecamatan = intval(query("SELECT COUNT(DISTINCT kecamatan) FROM master WHERE ulp = '$ulp'")[0]["COUNT(DISTINCT kecamatan)"]);

// OPTION DESA
$desa = query("SELECT DISTINCT desa FROM master WHERE ulp = '$ulp'");
$j_desa = intval(query("SELECT COUNT(DISTINCT desa) FROM master WHERE ulp = '$ulp'")[0]["COUNT(DISTINCT desa)"]);

// OPTION TIPE
$tipe = query("SELECT DISTINCT tipe FROM master");
$j_tipe = intval(query("SELECT COUNT(DISTINCT tipe) FROM master")[0]["COUNT(DISTINCT tipe)"]);

$fotoErr1 = "";
$fotoErr2 = "";
// VALIDASI DATA FOTO
if(isset($_FILES['foto'])){
    // untuk ngecek format file
    $ekstensi_file    = array('jpg', 'png', 'jpeg', 'gif', 'svg');
    $ekstensi        = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $ekstensi_ok    = in_array($ekstensi, $ekstensi_file);
                  
    // validasi input type file
    if(!($ekstensi_ok)){
      $fotoErr1 = "* Foto should be an image !";
    }
    if($_FILES['foto']['size'] > 2000*1000){
      $fotoErr2 = "* Size exceeds capacity (2MB) !";
    }
}


// MENANGKAP DATA FORM
if($fotoErr1 == "" and $fotoErr2 == ""){
  if(isset($_POST['submit'])){
      $no_request= $_POST['no_request'];
      $no_item= $_POST['no_item'];
      $kab_kota= $kab_kota;
      $kecamatan= $_POST['kecamatan'];
      $desa= $_POST['desa'];
      $induk= $induk;
      $up3= $up3;
      $ulp= $ulp;
      $klasifikasi= $_POST['klasifikasi'];
      $tipe= $_POST['tipe'];
      $watt= $_POST['watt'];
      $kondisi= $_POST['kondisi'];
      $latitudey= $_POST['latitudey'];
      $longitudex= $_POST['longitudex'];
      $foto= $_FILES['foto']['tmp_name'];
      $id_pel= $_POST['id_pel'];
      $keterangan= $_POST['keterangan'];
      $petugas_survey= $_POST['petugas_survey'];
      $tanggaljam_survey= $_POST['tanggaljam_survey'];
      // ngubah format tanggal
      $tanggaljam_survey = str_replace("T"," ", $tanggaljam_survey); 
      $no_gardu= $_POST['no_gardu'];
      $fkali=$_POST['fkali'];
      $daya_sedir_kelompok=$_POST['daya_sedir_kelompok'];
      $daya_sedir_watt=$_POST['daya_sedir_watt'];
      $cosphi=$_POST['cosphi'];
      $daya_sedir_va=$_POST['daya_sedir_va'];
      $gol_sedir=$_POST['gol_sedir'];
    
    $ImagePath1 = "image_req/".$no_request.".png";
    $ImagePath2 = "../../android/simp/image_req/".$no_request.".png";
    $ServerURL = "https://www.agamdev.com/android/simp/$ImagePath1";
    $num = count(query("SELECT * FROM request WHERE no_request = '$no_request'"));
    if($num>0){
        $query1 = "UPDATE request  SET no_item='$no_item', kab_kota='$kab_kota', kecamatan='$kecamatan',
        desa='$desa',
        induk='$induk',
        up3='$up3',
        ulp='$ulp',
        klasifikasi='$klasifikasi',
        tipe='$tipe',
        watt='$watt',
        kondisi='$kondisi',
        latitudey='$latitudey',
        longitudex='$longitudex',
        link_foto='$ServerURL',
        id_pel='$id_pel',
        keterangan='$keterangan',
        petugas_survey='$petugas_survey',
        tanggaljam_survey='$tanggaljam_survey',
        no_gardu='$no_gardu',
        fkali='$fkali',
        daya_sedir_kelompok='$daya_sedir_kelompok',
        daya_sedir_watt='$daya_sedir_watt',
        cosphi='$cosphi',
        daya_sedir_va='$daya_sedir_va',
        gol_sedir='$gol_sedir',
        status = '0' WHERE no_request = '$no_request'";
        
        $result1 = update($query1);
        move_uploaded_file($foto, $ImagePath2);
        $_SESSION['response'] = "Data berhasil ditambahkan";
        header("Location: response.php");
        exit;
        
    }else{
        
        $query2 = "INSERT INTO request (no_request,no_item,kab_kota,kecamatan,desa,induk,up3,ulp,klasifikasi,tipe,watt,kondisi,latitudey,longitudex,link_foto,id_pel,keterangan,petugas_survey,tanggaljam_survey,no_gardu,status,fkali,daya_sedir_kelompok,daya_sedir_watt,cosphi,daya_sedir_va,gol_sedir) 
        VALUES ('$no_request','$no_item','$kab_kota','$kecamatan','$desa','$induk','$up3','$ulp','$klasifikasi','$tipe','$watt','$kondisi','$latitudey','$longitudex','$ServerURL','$id_pel','$keterangan','$petugas_survey','$tanggaljam_survey','$no_gardu','0','$fkali','$daya_sedir_kelompok','$daya_sedir_watt','$cosphi','$daya_sedir_va','$gol_sedir')";
        $result2 = insert($query2);
        move_uploaded_file($foto, $ImagePath2);
        $_SESSION['response'] = "Data berhasil ditambahkan";
        header("Location: response.php");
        exit;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Request</title>
    <link rel="stylesheet" href="../style/style6.css">
</head>
<body>
    <div class="container">
        <div class="row1">
            <p>TAMBAH DATA</p>
        </div>
        <form action="tambah_data.php" method="post" enctype="multipart/form-data">
        <div class="row2">
            <div class="col1">
                <p>No Item</p>
                <p>No Request</p>
                <p>Id Pel</p>
                <p>Kecamatan</p>
                <p>Desa</p>
                <p>Klasifikasi</p>
                <p>Tipe</p>
                <p>Watt</p>
                <p>Kondisi</p>
                <p>Lattitude</p>
                <p>Longitude</p>
            </div>
            <div class="col2">
                <input type="text" class="input-item" placeholder="Nomor Item" name="no_item" required>
                <input type="text" class="input-item" placeholder="Nomor Request" name="no_request" required> 
                <input type="text" class="input-item" placeholder="Id Pelanggan" name="id_pel">
                <select name="kecamatan" id="" class="input-item" required>
                    <option value="">-- Pilih Kecamatan --</option> 
                    <?php $x = 0; ?>
                    <?php while ($x < $j_kecamatan) : ?>
                    <option value="<?=$kecamatan[$x]['kecamatan']?>"><?=$kecamatan[$x]['kecamatan']?></option>
                    <?php $x++; ?>
                    <?php endwhile; ?>
                </select>
                <select name="desa" id="" class="input-item" required>
                    <option value="">-- Pilih Desa --</option>
                    <?php $x = 0; ?>
                    <?php while ($x < $j_desa) : ?>
                    <option value="<?=$desa[$x]['desa']?>"><?=$desa[$x]['desa']?></option>
                    <?php $x++; ?>
                    <?php endwhile; ?>
                </select>
                <select name="klasifikasi" id="" class="input-item" required>
                    <option value="">-- Pilih Klasifikasi --</option>
                    <option value="SWADAYA">Swadaya</option>
                    <option value="METERISASI">Meterisasi</option>
                    <option value="TERSEBAR">Tersebar</option>
                </select>
                <select name="tipe" id="" class="input-item" required>
                    <option value="">-- Pilih Tipe --</option>
                    <?php $x = 0; ?>
                    <?php while ($x < $j_tipe) : ?>
                    <option value="<?=$tipe[$x]['tipe']?>"><?=$tipe[$x]['tipe']?></option>
                    <?php $x++; ?>
                    <?php endwhile; ?>
                </select>
                <input type="number" class="input-item" placeholder="Watt (angka)" name="watt" required>
                <select name="kondisi" id="" class="input-item" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="NORMAL">Normal</option>
                    <option value="RUSAK">Rusak</option>
                    <option value="NYALA 24 JAM">Nyala 24 Jam</option>
                    <option value="SUDAH DIBONGKAR">Sudah Dibongkar</option>
                </select>
                <input type="text" class="input-item" placeholder="(Format lat dengan tanda titik '.')" name="latitudey" required>
                <input type="text" class="input-item" placeholder="(Format lon dengan tanda titik '.')" name="longitudex" required>
            </div>
            <div class="col3">
                <p>Keterangan</p>
                <p>Petugas Survey</p>
                <p>Tanggal Survey</p>
                <p>No Gardu</p>
                <p>Fkali</p>
                <p>Cosphi</p>
                <p>Daya SE Dir Kel</p>
                <p>Daya SE Dir Watt</p>
                <p>Daya SE Dir VA</p>
                <p>Gol SE Dir</p>
                <p>Foto</p>
            </div>
            <div class="col4">
                <input type="text" class="input-item" placeholder="Keterangan" name="keterangan">
                <input type="text" class="input-item" placeholder="Nama Petugas Survey" name="petugas_survey" required>
                <input type="datetime-local" class="input-item" name="tanggaljam_survey" required>
                <input type="text" class="input-item" placeholder="Nomor Gardu" name="no_gardu" required>
                <input type="number" class="input-item" placeholder="Fkali (angka)" name="fkali" required>
                <input type="number" class="input-item" placeholder="Cosphi (angka)" name="cosphi" required>
                <input type="number" class="input-item" placeholder="Daya SE Dir Kelompok (angka)" name="daya_sedir_kelompok" required>
                <input type="number" class="input-item" placeholder="Daya SE Dir Watt (angka)" name="daya_sedir_watt" required>
                <input type="number" class="input-item" placeholder="Daya SE Dir VA (angka)" name="daya_sedir_va" required>
                <select name="gol_sedir" id="" class="input-item" required>
                    <option value="">-- Pilih Golongan --</option>
                    <option value="PELEPAS GAS">Pelepas Gas</option>
                    <option value="PIJAR">Pijar</option>
                </select>
                <input type="file" class="input-item foto" name="foto" required>
                <span class="error" style="color:red; font-size:14px;"> <?php echo $fotoErr1;?></span>
                <span class="error" style="color:red; font-size:14px;"> <?php echo $fotoErr2;?></span>
                <label>Format: jpg/png/jpeg/gif/svg|maks:2mb</label>
            </div>
        </div>
        <div class="row3">
            <a href="approval.php">Kembali</a>
            <input type="submit" value="Submit" name="submit">
        </div>
        </form>
    </div>
</body>
</html>