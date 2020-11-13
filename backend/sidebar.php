<?php
session_start();
if(empty($_SESSION['user']))
{
  header("location:../index.php");
}
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>KETOSIN 2019</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <script src="../vendors/ckeditor/ckeditor.js"></script>
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/zabuto_calendar.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">     -->
    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <!-- <script src="../assets/js/chart-master/Chart.js"></script> -->
    
    <!-- <script src="../assets/js/jquery.js"></script> -->
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/highcharts.js"></script>
    <!-- <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script> -->
    <!-- <script src="../assets/js/common-scripts.js"></script> -->
    
    <!-- <script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script> -->
    <!-- <script type="text/javascript" src="../assets/js/gritter-conf.js"></script> -->

    <!--script for this page-->
    <!-- <script src="../assets/js/sparkline-chart.js"></script>     -->
  <!-- <script src="../assets/js/zabuto_calendar.js"></script>   -->


  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" style="background : #1d2127;border : none">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>KETOSIN 2019</b></a>
            <!--logo end-->
         
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../logout.php">Logout</a></li>
              </ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse " style="background : #1d2127;">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="../assets/img/smk.png" class="img-circle" width="60"></a></p>
                  <h5 class="centered">Admin</h5>
                    
                  <li class="mt">
                      <a href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="kandidat.php" >
                          <i class="fa fa-users"></i>
                          <span>Kandidat</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="pemilihan.php" >
                          <i class="fa fa-check-square-o"></i>
                          <span>Pemilihan</span>
                      </a></li>
                  <li class="sub-menu">
                      <a href="peserta.php" >
                          <i class="fa fa-child"></i>
                          <span>Peserta</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="hasil.php" >
                          <i class="fa fa-bars"></i>
                          <span>Hasil</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="setting.php" >
                          <i class="fa fa-cogs"></i>
                          <span>Setting</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>

<script type="text/javascript">
  $(document).ready(function(){
      $(document).on("click", ".link-edit", function(e){
          e.preventDefault()
          window.location = $(this).data("url") 
      })

      $(document).on("click", ".link-hapus", function(e){
          e.preventDefault()
          if(confirm('Apakah Anda Yakin?'))
          {
            window.location= $(this).data("url")
          }
          else
          {

          }
      })
  })
</script>