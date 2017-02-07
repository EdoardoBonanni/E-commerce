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
	<?php
		if(isset($_SESSION['log']) && $_SESSION['log']){
			try{
				$dbh = new PDO('mysql:host=localhost;dbname=quintaa_ecommerce','quintaa','NB7U@91A');
				$stm2 = $dbh->prepare('Select * From categoria');
				?>
				<div class="container style=text-align:center">
					<h2 class="text-primary">Image Gallery</h2>
					<p>
					<h5 class="Text-primary">Categorie Disponibili</h5>
					<form method="get" action="prodotti.php">
						<select name="select" onchange="this.form.submit();">
						<option value='0' >Seleziona categoria</option>
						<?php
						if($stm2->execute()){
							while($c = $stm2->fetch()){
								$ic = $c['idCategoria'];
								$nc = $c['NomeCategoria'];
								echo "<option value='$ic' >$nc</option>";
							}
						}
						?>
						</select>
					</form>
					</p>
				</div>
				<div class="container">
				<?php
				$stm = $dbh->prepare('Select * From prodotto Where Categoria_idcategoria = '. $_GET['select']);
				if($stm->execute()){
					while($p = $stm->fetch()){
						$ip = $p['idProdotto'];
						$n = $p['NomeProdotto'];
						$c = $p['Costo'];
						$i = $p['Immagine'];
						?>
						
							<div class="row">
								<div class="col-md-4">
								  <div class="thumbnail">
									  <img src="<?php echo $i; ?>" alt="<?php echo $n ?>" style="width:100%">
									  <div class="caption">
										<p><?php echo 'NomeProdotto: ' . $n;
										?>
										</br>
										<?php
										echo 'Prezzo: ' . $c; ?></p>
									  </div>
								  </div>
								</div>
							</div>
						
					<?php
					}
				}
				else{
					?>
					<div class="container style=text-align:center">
						<h3 class="Text-warning">Prodotti non disponibili</h3>
					</div>
					<?php
				}
			}catch(PDOException $e){
				echo 'Connection Failed ! ' . $e->getMessage();
			}
		}
		else{
			header('location:login.php');
		}
	?>
	</div>
</body>
</html>