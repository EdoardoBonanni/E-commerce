<?php session_start(); ?>
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
	<div class="container">
	  <h2 class="text-primary">E-Commerce</h2>
	  <ul class="nav nav-pills">
		<li><a href="home.php">Home</a></li>
		<li><a href="prodotti.php">Prodotti</a></li>
		<li><a href="#">Acquisti</a></li>
		<?php 
		if(!isset($_SESSION['log']) && !$_SESSION['log']){
		?>
		<li><a href="registrazione.php">Registrazione</a></li>
		<li class="active"><a href="#">Login</a></li>
		<?php 
		}else{
		?>
		<li><a href="logout.php">Logout</a></li>
		<?php
		}
		?>
	  </ul>
	</div>
	<?php
		try{
			$dbh = new PDO('mysql:host=localhost;dbname=quintaa_ecommerce','quintaa','NB7U@91A');
			if(isset($_POST['Login'])){
				$stm = $dbh->prepare('Select Username, Nome From utente where Username = :usernamel AND Password = :passwordl');
				$stm->bindValue(':usernamel', $_POST['Usernamel']);
				$stm->bindValue(':passwordl', MD5($_POST['Passwordl']));
				if($stm->execute()){
					if($stm->rowCount() == 1){
						$_SESSION['log'] = true;
						header('location:prodotti.php');
					}
					else{
						?>
						<div class="container">
							<h3 class="Text-success">Username o Password sbagliate</h3>
						</div>
						<?php
					}
				}
				else{
					?>
					<div class="container">
						<h3 class="Text-success">Errore</h3>
					</div>
					<?php
				}
			}
			?>
			<div class="container">
				<form method="post" action="">  
					<h2 class="text-primary">Login</h2>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="Usernamel" class="form-control" placeholder="Insert Email" value="" required/>
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="Passwordl" class="form-control" placeholder="Insert Password" value="" required/>
					</div>
					<br/>
					<input type="submit" class="btn btn-info" name="Login" value="Login"/>
				</form>
			</div>
			<?php
		}catch(PDOException $e){
			echo 'Connection Failed ! ' . $e->getMessage();
		}
	?>
	</body>
</html>