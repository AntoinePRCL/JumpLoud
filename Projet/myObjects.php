<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
include "navbar.php";
$bdd = connectDB();
?>
<title>Ajouter mon évènement</title>
<body>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined">Mes objets</h1>
			<div class="jumbotron">
				<div class="row justify-content-center">
					<div class="col-lg-10">
						<?php
						$request = $bdd->prepare('SELECT * FROM produit WHERE pseudo_user = :pseudo ORDER BY dateHeure DESC');
						$request->execute([
							"pseudo" => getPseudo($_SESSION['email']),
							]);
						$result = $request->fetchAll(PDO::FETCH_ASSOC);
						if (empty($result)) {
							?>
							<h3 class="text-center">Vous n'avez pas encore proposé d'évènements !</h3>
							<h4 class="text-center"><a href="addObject.php">Proposez en un dès maintenant !</a></h4>
							<?php
						}else{	
							?>
							<p class="text-center lead"><a href="lendObject.php">Retour à l'interface de vos évènements</a></p>
							<?php
							foreach ($result as $key => $value) {
								showAnnounce($value['id']);
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
