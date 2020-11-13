<?php 
include "../config.php";
include "../sys/ORM.php";
include '../assets/phpqrcode/phpqrcode.php';
//include "../sys/ORM.php";
require "excel_reader.php";
require "../sys/Response.php";
  $obj = new ORM;
  $res = new Response;
$target = basename($_FILES['filesiswaall']['name']) ;

    move_uploaded_file($_FILES['filesiswaall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filesiswaall']['name'],false);
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
//    jika kosongkan data dicentang jalankan kode berikut
   
//    import data excel mulai baris ke-4 (karena tabel xls ada header pada baris 1)
  
    for ($i=2; $i<=$baris; $i++)
    { 
//       membaca data (kolom ke-1 sd terakhir)
      $nama         =$data->val($i, 1);
      $tipe         =$data->val($i, 2);
      $qr_code      =$res::randomString(7);
      $kelas        =$data->val($i, 3);
      $id_jurusan 	=$data->val($i, 4);
      // print_r($nama);
// //      setelah data dibaca, masukkan ke tabel pegawai sql
      /*$obj->Insert(
      	[
      	'nama' => $nama, 
      	'tipe' => $tipe, 
      	'qr_code' => $qr_code, 
      	'kelas' => $kelas, 
      	'id_jurusan' => $id_jurusan], 'peserta');
      // print_r($query);
    */

        //$obj = new ORM;

  $cek_kode = $obj->Select("qr_code", "peserta where qr_code = '$qr_code'");
  $status = false;
  // print_r($cek_kode);
  $jur = $obj->Select("*", "jurusan where id = '".$id_jurusan."'");
  // print_r($jur);
  if(count($cek_kode) > 0)
  {
    //header("location:add-peserta.php?error=qr_code&nama=$nama&tipe=$tipe&kelas=$kelas&jurusan=$jurusan&qr_code=$qr_code");
  }
  else
  {
    $arr = ['nama' => $nama, 'tipe' => $tipe, 'qr_code' => $qr_code];
    if($tipe  =='Guru')
    {
      $sql = "insert into peserta (nama,tipe,qr_code) values('".$nama."', '".$tipe."', '".$qr_code."')";
      $obj->Insert($arr, 'peserta');
      $status = true;
       if($status) {
            //Add qr code
            $nm = str_replace(' ', '-', $nama) . '.png';
            // echo "<pre>";
            // print_r($jur[0]['nama']);
            $extended = $tipe == 'Siswa' ? $kelas . '-' . $jur[0]['nama'] . '/' : '';
                // print_r($extended);
            QRcode::png($qr_code, "../assets/QR/$tipe/$extended" . $nm, QR_ECLEVEL_L, 4);
          }
     // echo "<script>alert('Berhasil');window.location='peserta.php'</script>";

    }
    else if($tipe=='Siswa')
    {
    
        $query_cek = $obj->Select("*", "peserta where nama = '".$nama."' and kelas = '".$kelas."' and id_jurusan = '".$id_jurusan."'");

        if(count($query_cek) < 1)
        {
          $sql = "insert into peserta (nama,tipe,qr_code,kelas,id_jurusan) values('".$nama."', '".$tipe."', '".$qr_code."', '".$kelas."', '".explode('-', $id_jurusan)[0]."')";

          $arr['kelas'] = $kelas;
          $arr['id_jurusan'] = explode('-', $id_jurusan)[0];
          // print_r($arr);
          $obj->Insert($arr, 'peserta');
          $status = true;
            if($status) {
            //Add qr code
            $nm = str_replace(' ', '-', $nama) . '.png';
            // echo "<pre>";
            // print_r($jur[0]['nama']);
            $extended = $tipe == 'Siswa' ? $kelas . '-' . str_replace(" ", "-", $jur[0]['nama']) . '/' : '';
                // print_r($extended);
            QRcode::png($qr_code, "../assets/QR/$tipe/$extended" . $nm, QR_ECLEVEL_L, 4);
          }
         // echo "<script>alert('Berhasil');window.location='peserta.php'</script>";

        }
        else
        {
          //header("location:add-peserta.php?error=terdaftar&nama=$nama&tipe=$tipe&kelas=$kelas&jurusan=$jurusan&qr_code=$qr_code");
        }

    }

  
  }
}



    echo "<script>alert('berhasil import data');window.location='peserta.php'</script>";
   ?>