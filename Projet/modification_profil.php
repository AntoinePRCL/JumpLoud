<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
isPrivate();
include "navbar.php";
$bdd = connectDB();
$sql = $bdd->prepare("SELECT * FROM user WHERE email=:toto");
$sql->execute([
	"toto" => $_SESSION['email']
]);
$data = $sql->fetch();
if (isset($_SESSION['uploadAvatar'])) {
	if ($_SESSION['uploadAvatar'][0] == "OK") {
		$title = "Succès";
		$body = "Votre avatar a été upload avec succès";
	}elseif ($_SESSION['uploadAvatar'][0] == "NOK") {
		$title = "Erreur";
		$body = NULL;
		for ($i=1; $i < count($_SESSION['uploadAvatar']) ; $i++) { 
			$body = $body."<li>".$_SESSION['uploadAvatar'][$i]."</li>";
		}
	}
	echo modal($title,"<ul>".$body."</ul>","footer");
	unset($_SESSION['uploadAvatar']);
}
?>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<h2 class="titleUnderlined">Modification de profil</h2>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-10 jumbotron">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						<center>
							<img class="avatar" width="150" height="150" src="images/profils/<?php echo $data['email']; ?>/photo.png ">
							<form method="post" action="upload_avatar.php" enctype="multipart/form-data">
								<input type="file" name="avatar">
								<button class="btn btn-primary btn-send" type="submit" value="Envoyer">Uploader</button>
							</form>
						</center>
						<form method="post" class="justify-content-center">
							<label class="control-label">Nom </label>
							<input class="form-control" type="text" name="new_name" value="<?php echo $data['nom'];?>" id="form_name" readonly>
							<label class="control-label">Prenom </label>
							<input class="form-control" type="text" name="new_surname" value="<?php echo $data['prenom'];?>" id="form_lastname" readonly>
							<label class="control-label">Téléphone</label>
							<input class="form-control" type="number" name="new_phone" placeholder="Entrez un nouveau numéro de téléphone" id="form_phone">
							<label class="control-label">Adresse</label>
							<input class="form-control mb-2" type="text" name="new_adress" value="<?php echo $data['ville'];?>"placeholder="Entrez votre nouvelle adresse" id="form_adress" readonly>
							<input type="submit" value="Sauvegarder" class="btn btn-primary">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>