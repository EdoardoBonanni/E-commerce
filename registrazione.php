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
		<li class="active"><a href="#">Registrazione</a></li>
		<li><a href="login.php">Login</a></li>
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
			if(isset($_POST['Registrati'])){
				$stm = $dbh->prepare('Insert into utente(Username, Nome, Cognome, Password) Values (:username, :name, :surname, :password);');
				$stm->bindValue(':name', $_POST['Namer']);
				$stm->bindValue(':surname', $_POST['Surnamer']);
				$stm->bindValue(':username', $_POST['Usernamer']);
				$stm->bindValue(':password', MD5($_POST['Passwordr']));
				if($stm->execute()){
					?>
					<div class="container">
						<h3 class="Text-success">Hai effettuato la registrazione, adesso puoi loggarti</h3>
					</div>
					<?php
				}
				else{
					?>
					<div class="container">
						<h3 class="Text-success">Errore durante la registrazione </h3>
					</div>
					<?php
				}
			}
			?>
			<div class="container">
				<form method="POST">  
					<h2 class="text-primary">Registrazione</h2>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="Namer" class="form-control" placeholder="Insert Name" value="" required/>
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="Surnamer" class="form-control" placeholder="Insert Surname" value="" required/>
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input type="email" name="Usernamer" class="form-control" placeholder="Insert Email" value="" required/>
					</div>
					<br/>
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="Passwordr" class="form-control" placeholder="Insert Password" value="" required/>
					</div>
					<br/>
					<input type="submit" class="btn btn-info" name="Registrati" value="Registrati"/>
					<br/>
				</form>
			</div>
			<?php
		}catch(PDOException $e){
			echo 'Connection Failed ! ' . $e->getMessage();
		}
	?>
		
	</body>
</html>