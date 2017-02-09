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
	<div class="container style=text-align:center">
	  <h2 class="text-primary">E-Commerce</h2>
	  <ul class="nav nav-pills">
		<li><a href="home.php">Home</a></li>
		<li><a href="prodotti.php">Prodotti</a></li>
		<li class="active"><a href="#">Acquisti</a></li>
		<?php 
		if(!isset($_SESSION['log']) && !$_SESSION['log']){
		?>
		<li><a href="registrazione.php">Registrazione</a></li>
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
	<div class="container style=text-align:center">
	  </br>
	  <h2 class="text-primary">Il tuo carrello</h2>
	</div>
	<div>
		<?php
		if(isset($_POST['Delete'])){
			foreach($_SESSION['carrello'] as &$rowdelete){
			}
			$_SESSION['carrello']_delete($rowdelete);
		}
			if(!isset($_SESSION['carrello']) && empty($_SESSION['carrello'])){
				echo 'Carrello vuoto';
			}
			else{
				foreach($_SESSION['carrello'] as &$row){
					?>
					<form method="POST">
						<input type="hidden" name="rowIdProduct" value="<?php echo $row[0]?>"/>
						<input type="text" name="rowNameProduct" value="<?php echo $row[1]?>"/>
						<input type="text" name="rowCost" value="<?php echo $row[2]?>"/>
						<input type="submit" name="deleteRow" value="Delete" />
						<br/>
					</form>
					<?php
				}
				unset($row);
				
			}
		?>
	</div>	
</body>
</html>