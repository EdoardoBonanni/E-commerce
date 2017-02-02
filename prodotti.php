<?php session_start()?>
<html>
<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body> 
	<div class="container style=text-align:center">
	  <h2 class="text-primary">E-Commerce</h2>
	  <ul class="nav nav-pills">
		<li><a href="home.php">Home</a></li>
		<li class="active"><a href="#">Prodotti</a></li>
		<li><a href="#">Acquisti</a></li>
		<li><a href="registrazione.php">Registrazione</a></li>
		<li><a href="login.php">Login</a></li>
	  </ul>
	</div>
	<div class="container style=text-align:center">
	  </br>
	  <h5 class="text-primary">Prodotti disponibili</h5>
	</div>
	<?php
		if(isset($_SESSION['log']) && $_SESSION['log']){
			?>
			<div class="container">
				<h3 class="Text-success">Sei loggato</h3>
				</br>
				<form action="logout.php" method="POST">
					<input type="submit" class="btn btn-success" name="Logout" value="Logout"/>
				</form>
			</div>
			<?php
			try{
				$dbh = new PDO('mysql:host=localhost;dbname=quintaa_ecommerce','quintaa','NB7U@91A');
				$stm = $dbh->prepare('Select idProdotto, NomeProdotto, Costo, Categoria_idCategoria  from prodotto');
				
				?>
				<div class="container">
					<h5 class="text-primary"></h2>
				</div>
				<?php
			}catch(PDOException $e){
				echo 'Connection Failed ! ' . $e->getMessage();
			}
		}
		else{
			header('location:login.php');
		}
	?>
</body>
</html>