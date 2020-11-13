<?php
session_start();
if(isset($_SESSION['user']))
{
  header("location:backend");
}
?>

<!DOCTYPE html>
<html>
	<head>
	<!-- ==================================== -->
	<title>Pilketos 2020 | Login</title>
	<!-- ==================================== -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!-- ==================================== -->
	<link href="https://fonts.googleapis.com/css?family=K2D:600" rel="stylesheet">
	<!-- ==================================== -->
	<meta charset="utf-8" name="viewport" content="initial-scale=1.0">
	<!-- ==================================== -->
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<!-- ==================================== -->
	</head>

	<body>
		<div class="box">

			<div class="title-box">
			<center>PILKETOS 2020</center>
			</div>

			<div class="form-box">
			<?php
							if(isset($_GET['error']))
							{
										echo "<div class='alert alert-danger danger'>";
										if($_GET['error']=='salah')
										{
											echo "Username Atau Password Salah";
										}
										else
										{
											if($_GET['error']=='belumdiisi')
											{
												echo 'Pastikan Semua Field Terisi';
											}
											else
											{
												echo "-";
											}
										}
										echo "</div>";
							}
				?>
				<form method="POST" action="auth.php">
				<div class="form-group">
				<center><input type="text" name="user" placeholder="Username" class="form-control"></center>
				</div>

				<div class="form-group">
				<center><input type="password" name="pass" placeholder="Password" class="form-control"></center>
				</div>

				<div class="form-group">
				<center><input type="submit" value="MASUK" class="btn btn-outline">
				</center>
				</div>
				</form>
				<center><br><a href="daftarKandidat.php"><button type="button" class="btn btn-outline">LIHAT KANDIDAT</button></a></center>
			</div>
		</div>
	</body>
</html>