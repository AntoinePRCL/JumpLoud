<?php
session_start();
include("head.php");
include("conf.inc.php");
include("functions.php");
include("navbar.php");
$bdd = connectDB();
if (isset($_GET['key'])) {
	echo isConnected();
	if (!isConnected()) {
		$auth = $_GET['email'];
	}else{
		$auth = $_SESSION['email'];
	}
	$request = $bdd->prepare('SELECT validationKey FROM user WHERE email=:email');
	$request->execute([
		"email" => $auth,
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);
	if ($result['validationKey'] == $_GET['key']) {
		changeRole($auth, 1);
		echo modal('Information','Votre compte a bien été activé, bienvenue !','footer');
		unset($_SESSION['activation']);
	}else{
		echo modal('Information','La clef rentrée n\'est pas bonne, essayez de renvoyer l\'email','footer');
	}
}
?>
<title>Activer mon compte</title>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined">Activer mon compte</h1>
			<div class="jumbotron justify-content-center text-center">
				<form>
					<input type="text" name="key" placeholder="Code d'activation" class="form-control mb-2">
					<input type="submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>