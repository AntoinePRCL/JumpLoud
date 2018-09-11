<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
$bdd = connectDB();
if ((isset($_POST['pseudoText'])) && (isset($_POST['message']))) {
	if (userExists($_POST['pseudoText'])) {
		createConversation($_SESSION['idUser'],getId($_POST['pseudoText']),$_POST['message']);
	}else{
		echo modal('Info','Le pseudo saisi n\'existe pas','footer');
	}
}
include "navbar.php";
?>
<title>Ajouter mon objet</title>
<body>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined">Écrire un nouveau message</h1>
			<div class="jumbotron">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						<form method="POST" class="text-center justify-content-center">
							<input type="text" name="pseudoText" placeholder="Pseudo" class="form-control mb-2" <?php 
							if (isset($_POST['pseudo'])) {
								echo "value=".$_POST['pseudo']."";
							}?>>
							<input type="text" name="message" placeholder="Votre message.." class="form-control mb-2">
							<input type="submit" class="btn btn-primary" value="Envoyer">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
