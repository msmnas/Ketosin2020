<!DOCTYPE html>
<html>
<head>
    <!-- ============================== -->
    <meta charset="utf-8" />
    <!-- ============================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- ============================== -->
    <title>Pilketos 2020 | Smakensa</title>
    <!-- ============================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ==================================== -->
	<link href="https://fonts.googleapis.com/css?family=K2D:600" rel="stylesheet">
    <!-- ============================== -->
    <link rel="stylesheet" type="text/css" href="vendors/materialize/css/materialize.css"/>
    <!-- ============================== -->
    <link rel="stylesheet" type="text/css" href="assets/css/dKandidat.css">
    <script src="vendors/jQuery.js"></script>
    <!-- ============================== -->
    <script src="vendors/materialize/js/materialize.min.js"></script>
    <!-- ============================== -->
    <!-- ============================== -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper navbar-fixed grey darken-3">
        <a href="http://pilketos2019.smkn1bws.sch.id" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">arrow_back</i></a>
            <ul class="left hide-on-med-and-down">
                <li onclick="history.back();"><i class="material-icons">arrow_back</i></a></li>
                <!-- <li><a href="http://pilketos2019.smkn1bws.sch.id"><i class="material-icons">arrow_back</i></a></li> --> <!-- ASLI -->
            </ul>
        </div>
  </nav>
  </div>
    
    <div class="dk-header">
        <div class="dim-bg">
            <div class="text-position">
            Daftar Kandidat
            <div class="animationLine"></div>
            </div>
        </div>
    </div>

    <div class="second-part">

    <div class="container-fluid">
    <div class="row">
        
        <?php 
            
            include "sys/ORM.php";
            $obj = new ORM;
            
            $qr = $obj->Select("kandidat.id, kandidat.nama as nama, kandidat.visi, kandidat.misi, kandidat.slogan, kandidat.kata, kandidat.id_jurusan, kandidat.foto, jurusan.nama as jurusan", "kandidat join jurusan on kandidat.id_jurusan = jurusan.id");
            foreach($qr as $a) {
        ?>
        
        <div class="col m6">
        <div class="card">
        
        <div class="card-image">    
            <img src="assets/kandidat/<?php echo $a['foto']; ?>">
        </div>

        <div class="card-content" align="center">
            <?php echo $a['nama']; ?>
            <br><?php echo $a   ['jurusan'];?>

        </div>

        <ul class="collapsible">
            <li>
            <div class="collapsible-header"><h7><i class="material-icons">call_made</i>Visi</h7></div>
            <div class="collapsible-body" style="display:block;"><h7><?= $a['visi']; ?></h7></span></div>
            </li>
            
            <li>
            <div class="collapsible-header"><i class="material-icons">show_chart</i><strong>Misi</strong></div>
            <div class="collapsible-body" style="display: block;"><span><?= $a['misi']; ?></span></div>
            </li>
        </ul>
        
        </div>
        </div>
           <?php } ?>
        
    

    </div>
    </div>

    </div>        
        
    <div class="footer">Copyright &copy; Pilketos Smakensa 2020</div>

</body>
</html>