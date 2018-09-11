<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
isPrivate();
include "navbar.php";
$bdd = connectDB();
if ((isset($_FILES['CNI'])) && (isset($_POST['send']))) {
	if(!empty($_FILES['CNI']['name'])){
		$type = explode('/', $_FILES['CNI']['type']);
		$type = $type[1];
		if (($type != 'jpeg') && ($type != 'png')) {
			echo modal('Erreur','Votre fichier doit être en png, jpg ou jpeg','footer');
		}else{
			if ($_FILES['CNI']['size'] > 5000000) {
				echo modal('Erreur','Votre image doit faire moins de 5mo','footer');
			}else{
				$path = 'backoffice/cni/'.$_SESSION['idUser'].'.png';
				copy($_FILES['CNI']['tmp_name'], $path);
				$request = $bdd->prepare('INSERT INTO confirmation (pseudo_user, image_cni, approbation, commentaire) VALUES (:pseudo_user, :image_cni, :approbation, :commentaire)');
				$request->execute([
					"pseudo_user" => getPseudo($_SESSION['email']),
					"image_cni" => $_SESSION['idUser'].'.png',
					"approbation" => 0,
					"commentaire" => ''
				]);
				echo modal('Info','Votre demande a bien été reçue','footer');
			}
		}
	}else{
		echo modal('Erreur','Merci de séléctionner un fichier','footer');
	}
}
?>
<title>Profil de <?php echo getPseudo($_SESSION['email']);?></title>
<body>
	<div class="container">
		<div class="resume decalageTop">
			<div class="row justify-content-center">
				<div class="col-lg-10 justify-content-center">
					<h1 class="titleUnderlined">Confirmer votre compte avec votre CNI</h1>
					<div class="jumbotron justify-content-center text-center">
						<?php
						if (!CNIUploaded()) {
							?>
							<p class="lead">Votre carte doit être lisible, en jpg ou en png, et faire moins de 5mo</p>
							<form method="POST" enctype="multipart/form-data">
								<input type="file" name="CNI" class="form-control mb-2">
								<input type="submit" value="Envoyer ma CNI" name="send" class="btn btn-primary">
							</form>
							<?php
						}else{
							?>
							<p class="lead">Vous avez déjà effectué une demande de confirmation, ou votre demande est en attente.</p>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>