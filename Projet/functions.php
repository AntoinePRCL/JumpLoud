<?php
function connectDB(){
	try{
		$connection = new PDO(
					DBDRIVER.":host=".DBHOST.";dbname=".DBNAME,
					DBUSER,
					DBPWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
	}catch(Exception $e){
		die( "Erreur SQL ".$e->getMessage() );
	}
	return $connection;
}
function createToken($id, $email){
	$sha1 = sha1($email."FDSQfdsq444FGSDQ".$id."fdsfqfsdq");
	return substr($sha1, 4, 10) ;
}
function isConnected(){
	if(isset($_SESSION["auth"]) && $_SESSION["auth"]==true){
		$connection = connectDB();
		$query = $connection->prepare("SELECT id FROM user WHERE email = :toto");
		$query->execute([
						"toto"=>$_SESSION["email"]
					]);
		$resultat = $query->fetch();
		if($_SESSION["token"] == createToken($resultat["id"], $_SESSION["email"]) ){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}
function isPrivate(){
	if (!isConnected()) {
		header("Location: /Projet/signup.php?url=".urlencode($_SERVER["REQUEST_URI"]));
	}
}
function timeStamp($timestamp){
	$heure = explode(" ", $timestamp);
	$date = explode("-", $heure[0]);
	$heure = explode(":", $heure[1]);
	$date = $date[2]."/".$date[1]."/".$date[0];
	return $timestamp = array(
		'date' => $date,
		'heure' => $heure[0].":".$heure[1]
	);
}
function modal($titre,$texte,$footer){
	if ($footer == "footer") {
		$footer = "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fermer</button>";
	}
	$modal = 
	"<script type='text/javascript'>
		$(window).on('load',function(){
			$('#myModal').modal('show');
		});
	</script>
	<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
		<div class='modal-dialog' role='document'>
			<div class='modal-content'>
				<div class='modal-header'>
					<h5 class='modal-title' id='exampleModalLabel'>".$titre."</h5>
					<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
						<span aria-hidden='true'>&times;</span>
					</button>
				</div>
				<div class='modal-body'>
					<p>".$texte."</p>
				</div>
				<div class='modal-footer'>
					".$footer."
				</div>
			</div>
		</div>
	</div>";
	return $modal;
}
function getId($pseudo){
	$connection = connectDB();
	$query = $connection->prepare("SELECT id FROM user WHERE pseudo = :toto");
	$query->execute([
					"toto"=>$pseudo
				]);
	$resultat = $query->fetch();
	return $resultat['id'];
}
function getPseudo($email){
	$connection = connectDB();
	$query = $connection->prepare("SELECT pseudo FROM user WHERE email = :toto");
	$query->execute([
					"toto"=>$email
				]);
	$resultat = $query->fetch();
	return $resultat['pseudo'];
}
function getPseudoFromId($id){
	$connection = connectDB();
	$query = $connection->prepare("SELECT pseudo FROM user WHERE id = :toto");
	$query->execute([
					"toto"=>$id
				]);
	$resultat = $query->fetch();
	return $resultat['pseudo'];
}
function isAdmin(){
	$bdd = connectDB();
	$sql = $bdd->prepare("SELECT role FROM user WHERE email=:email");
	$sql->execute([
		"email" => $_SESSION['email']
	]);
	$sql = $sql->fetch();
	if (($sql['role'] == 3) || ($sql['role'] == 4)) {
		return true;
	}else{
		return false;
	}
}
function getCategories(){
	$bdd = connectDB();
	$sql = $bdd->query('SELECT * FROM categories');
	$sql = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $sql;
}
function showAnnounce($idAnnonce){
	$bdd = connectDB();
	$annonce = $bdd->query('SELECT * FROM produit WHERE id='.$idAnnonce.'');
	$annonce = $annonce->fetch(PDO::FETCH_ASSOC);
	$dateHeure = timeStamp($annonce['dateHeure']);
	$villeUser = $bdd->query('SELECT ville FROM user WHERE pseudo="'.$annonce['pseudo_user'].'"');
	$villeUser = $villeUser->fetch(PDO::FETCH_ASSOC);
	if ($dateHeure['date'] == date("d/m/Y")) {
		$dateHeure['date'] = "Aujourd'hui";
	}
	$nbrImages = count(glob('image_objets/'.$annonce['id'].'/*.png'));
	$imageSize = getimagesize("image_objets/".$idAnnonce."/firstPhoto.png");
	$cheminPhoto = "image_objets/".$idAnnonce."/firstPhoto.png";
	if (($imageSize[0] / $imageSize[1]) > 1) {
		$image = "<img style='width:100%' src='".$cheminPhoto."'>";
	}else{
		$image = "<img height='200' src='".$cheminPhoto."'>";
	}
	echo $show = 
	"
	<div class='row justify-content-center'>
		<div class='col-lg-11'>
			<div class='row annonce'>
				<div class='col-lg-4 justify-content-center text-center' style='background-color: #DCDCDC;padding:0px'>
					".$image."
				</div>
				<div class='col-lg-8'>
					<p class='lead' style='font-size: 1.1rem;float:right;'>
						".$nbrImages." <i class='fas fa-images'></i>
					</p>
					<h2>".$annonce['nom_objet']."</h2>
					<p class='lead'> ".$annonce['description']."</p>
					<p><a href='profil.php?pseudo=".$annonce['pseudo_user']."'> ".$annonce['pseudo_user']."</a> - ".$villeUser['ville']." </p>
					<a href='article.php?ref=".$annonce['id']."' class='btn btn-success'>Voir l'annonce</a>
					<p style='float:right;'>
						".$dateHeure['date']." - ".$dateHeure['heure']."
					</p>
				</div>
			</div>
			<br>
		</div>
	</div>
	";
}
function getLastConversations($idUser){
	$bdd = connectDB();
	$request = $bdd->prepare('
		SELECT * FROM messages a
		INNER JOIN conversation b  on a.conversation = b.idConversation 
		WHERE id IN (SELECT MAX(id) FROM messages GROUP BY conversation) 
		AND (user1=:user OR user2=:user) ORDER BY dateHour DESC');
	$request->execute([
		"user" => $idUser,
	]);
	$reponse = $request->fetchAll(PDO::FETCH_ASSOC);
	return $reponse;
}
function getConversation($idConversation){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM messages WHERE conversation=:conversation ORDER BY dateHour ASC');
	$request->execute([
		"conversation" => $idConversation,
		]);
	$reponse = $request->fetchAll(PDO::FETCH_ASSOC);
	return $reponse;
}
function createConversation($creator, $user2,$message){
	$bdd = connectDB();
	$request = $bdd->prepare('INSERT INTO conversation (user1,user2) VALUES (:user1, :user2)');
	$request->execute([
		"user1" => $creator,
		"user2" => $user2
	]);
	$lastConvo = $bdd->prepare('SELECT idConversation FROM conversation ORDER BY idConversation DESC LIMIT 0,1');
	$lastConvo->execute();
	$result = $lastConvo->fetch();
	sendMessage($creator,$message,$result['idConversation']);
	header("Location: messages.php");
}
function sendMessage($idSender,$message,$convo){
	$bdd = connectDB();
	$request = $bdd->prepare('INSERT INTO messages (conversation, message, sender) VALUES (:convo, :message, :sender)');
	$request->execute([
		"convo" => $convo,
		"message" => $message,
		"sender" => $idSender,
	]);
}
function isYourObject($idObject){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT pseudo_user FROM produit WHERE id=:idObject');
	$request->execute([
		"idObject" => $idObject
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);
	if ($result['pseudo_user'] == getPseudo($_SESSION['email'])) {
		return 1;
	}else{
		return 0;
	}
}
function createTrade($pseudoReceiver, $idObject){
	$bdd = connectDB();
	$request = $bdd->prepare('INSERT INTO echange (keyGiver, pseudo_taker, pseudo_giver, idObject) VALUES (:keyGiver, :pseudo_taker, :pseudo_giver, :idObject)');
	$request->execute([
		"keyGiver" => substr(sha1($pseudoReceiver.$idObject),rand(0,2),rand(8,10)),
		"pseudo_taker" => $pseudoReceiver,
		"pseudo_giver" => getPseudo($_SESSION['email']),
		"idObject" => $idObject
	]);
	$changeObject = $bdd->prepare('UPDATE produit SET lent=1 WHERE id=:idObject');
	$changeObject->execute([
		"idObject" => $idObject,
	]);
}
function tradeTo($idObject){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT pseudo_taker,pseudo_giver FROM echange WHERE idObject=:idObject');
	$request->execute([
		"idObject" => $idObject,
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);
	if ($result['pseudo_taker'] == getPseudo($_SESSION['email'])) {
		return $result['pseudo_giver'];
	}else{
		return $result['pseudo_taker'];	
	}
}
function getArticle($reference){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM produit WHERE id=:id');
	$request->execute([
		"id" => $reference,
	]);
	$request = $request->fetch();
	return $request;
}
function reviveUser($idObject){
	$bdd = connectDB();

	$request = $bdd->prepare('SELECT lastRevive FROM echange WHERE idObject=:idObject');
	$request->execute([
		"idObject" => $idObject,
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);

	$getNbrRevives = $bdd->prepare('SELECT totalRevives,pseudo_taker FROM echange WHERE idObject=:idObject');
	$getNbrRevives->execute([
		"idObject" => $idObject,
	]);
	$nbrRevives = $getNbrRevives->fetch(PDO::FETCH_ASSOC);
	$nbrToUpdate = $nbrRevives['totalRevives']+1;

	$lastRevive = (time()+7200)-strtotime($result['lastRevive']);
	if ($lastRevive < 43200) {
		echo modal('Info','Vous avez déjà relancé pour cet évènement, vous devez attendre 12h entre chaque relance','footer');
	}else{
		$updateRevives = $bdd->prepare('UPDATE echange SET totalRevives=:revives WHERE idObject=:idObject');
		$updateRevives->execute([
			"revives" => $nbrToUpdate,
			"idObject" => $idObject,
		]);
		if (($nbrRevives['totalRevives']+1) >= 6) {
			removeScore($nbrRevives['pseudo_taker'],80);
			echo $nbrRevives['pseudo_taker'];
			echo modal('Info','L\'utilisateur a été relancé 6 fois ou plus et viens de perdre des points','footer');
			$bodyMessage = "
			L'utilisateur ".getPseudo($_SESSION['email'])." vous a relancé pour la 6ème fois ou plus, c'est donc un malus de point pour votre compte et une perte de fiabilité.
			Veuillez lui répondre, sous peine de prendre un banissement du site";
			mail("maxime.lalo.pro@gmail.com", "Relance JumpLoud", $bodyMessage);
		}else{
			$bodyMessage = "
			L'utilisateur ".getPseudo($_SESSION['email'])." vous relance par rapport à votre échange sur JumpLoud
			Veuillez lui répondre, sous peine de prendre un malus de points, voire un banissement du site";
			mail("maxime.lalo.pro@gmail.com", "Relance JumpLoud", $bodyMessage);
			echo modal('Info','L\'utilisateur a bien été relancé par mail','footer');
			//Relancer l'utilisateur avec un mail
			// mail();
		}
		$updateTime = $bdd->prepare('UPDATE echange SET lastRevive=:currentTime WHERE idObject=:idObject');
		$updateTime->execute([
			"currentTime" => date('Y-m-d H:i:s',time()+7200),
			"idObject" => $idObject
		]);
	}
}
function userExists($pseudo){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM user WHERE pseudo=:pseudo');
	$request->execute([
		"pseudo" => $pseudo
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);
	if (empty($result)) {
		return 0;
	}else{
		return 1;
	}
}
function deleteProduct($idProduct){
	if (isYourObject($idProduct)) {
		$bdd = connectDB();
		$request = $bdd->prepare('DELETE FROM produit WHERE id=:id');
		$request->execute([
			'id' => $idProduct
		]);
		echo modal('Info','L\'objet à bien été supprimé','footer');
	}else{
		echo modal('Info','Vous ne pouvez pas supprimer cet objet, il n\'est pas à vous','footer');
	}
}
function showScore($score){
	if ($score > 400) {
		$p = "<span style='color:green'><i class='fa fa-trophy'></i> ".$score." (Très fiable !)</span>";
	}elseif ($score > 200) {
		$p = "<span style='color:green'><i class='fa fa-trophy'></i> ".$score." (Fiable !)</span>";
	}elseif ($score == 200) {
		$p = "<span style='color:orange'><i class='fa fa-trophy'></i> ".$score." (Fiabilité moyenne)</span>";
	}else{
		$p = "<span style='color:red'><i class='fa fa-trophy'></i> ".$score." (Peu fiable)</span>";
	}
	echo $p;
}
function getTradeState($id){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT state FROM echange WHERE idObject=:id');
	$request->execute([
		"id" => $id,
	]);
	$result = $request->fetch();
	return $result['state'];
}
function isYourTrade($idTrade){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM echange WHERE id=:idTrade');
	$request->execute([
		"idTrade" => $idTrade
	]);
	$result = $request->fetch();
	if (($result['pseudo_taker'] == getPseudo($_SESSION['email'])) OR 
	($result['pseudo_giver'] == getPseudo($_SESSION['email']))) {
		return 1;
	}else{
		return 0;
	}
}
function changeTradeState($idTrade, $number){
	$bdd = connectDB();
	$request = $bdd->prepare('UPDATE echange SET state=:state WHERE id=:idTrade');
	$request->execute([
		"state" => $number,
		"idTrade" => $idTrade
	]);
}
function acceptObject($idTrade){
	$bdd = connectDB();
	if (isYourTrade($idTrade)) {
		changeTradeState($idTrade,1);
		echo modal('Info',"Vous avez accepté l'échange",'footer');
	}else{
		echo modal("Info","Ce n'est pas votre échange","footer");
	}
}
function addScore($pseudo,$score){
	$bdd = connectDB();

	$getScore = $bdd->prepare('SELECT score FROM user WHERE pseudo=:pseudo');
	$getScore->execute([
		"pseudo" => $pseudo,
	]);
	$getScore = $getScore->fetch();
	$score = $getScore['score']+$score;

	$request = $bdd->prepare('UPDATE user SET score=:score WHERE pseudo = :pseudo');
	$request->execute([
		"score" => $score,
		"pseudo" => $pseudo,
	]);
}
function removeScore($pseudo,$score){
	$bdd = connectDB();

	$getScore = $bdd->prepare('SELECT score FROM user WHERE pseudo=:pseudo');
	$getScore->execute([
		"pseudo" => $pseudo,
	]);
	$getScore = $getScore->fetch();
	$score = $getScore['score']-$score;

	$request = $bdd->prepare('UPDATE user SET score=:score WHERE pseudo = :pseudo');
	$request->execute([
		"score" => $score,
		"pseudo" => $pseudo,
	]);
}
function getEmail($pseudo){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT email FROM user WHERE pseudo=:pseudo');
	$request->execute([
		"pseudo" => $pseudo,
	]);
	$result = $request->fetch();
	return $result['email'];
}
function sendKey($pseudo,$idTrade){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM echange WHERE id=:id');
	$request->execute([
		"id" => $idTrade,
	]);
	$result = $request->fetch();
	$message = "Bonjour, votre échange numéro ".$result['id']."est bientôt finalisé, donnez la clef à votre interlocuteur pour finaliser l'échange. Clef : ".$result['keyGiver'];
	mail(getEmail($pseudo), 'Clef de validation', $message);
}
function returnObject($idTrade){
	if (isYourTrade($idTrade)) {
		$bdd = connectDB();
		$request = $bdd->prepare('SELECT idObject FROM echange WHERE id =:id');
		$request->execute([
			"id" => $idTrade,
		]);
		$result = $request->fetch();
		changeTradeState($idTrade,2);
		addScore(getPseudo($_SESSION['email']),50);
		echo modal('Info','Vous avez enclenché la procédure de retour','footer');
		sendKey(tradeTo($result['idObject']),$idTrade);
	}else{
		echo modal('Info','Cet échange n\'est pas à vous');
	}
}
function verifyReturnKey($key,$idTrade){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM echange WHERE id=:idTrade');
	$request->execute([
		"idTrade" => $idTrade,
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);

	if ($key == $result['keyGiver']) {
		changeTradeState($idTrade,3);
		$body = "<p class='text-center'>Votre clef a bien été validée, l'échange est terminé</p>";
		echo modal('Info',$body,'footer');
	}else{
		echo modal('Info','La clef rentrée n\'est pas la bonne','footer');
	}
}
function getObjectName($idObject){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT nom_objet FROM produit WHERE id=:idObject');
	$request->execute([
		"idObject" => $idObject,
	]);
	$result = $request->fetch();
	return $result['nom_objet'];
}
function getAccountRole($email){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT role FROM user WHERE email=:email');
	$request->execute([
		"email" => $email
	]);
	$result = $request->fetch();
	return $result['role'];
}
function changeRole($email,$role){
	$bdd = connectDB();
	$request = $bdd->prepare('UPDATE user SET role=:role WHERE email=:email');
	$request->execute([
		"role" => $role,
		"email" => $email
	]);
}
function CNIUploaded(){
	$bdd = connectDB();
	$request = $bdd->prepare('SELECT * FROM confirmation WHERE pseudo_user=:pseudo');
	$request->execute([
		"pseudo" => getPseudo($_SESSION['email']),
	]);
	$result = $request->fetch(PDO::FETCH_ASSOC);
	if (isset($result['pseudo_user'])) {
		return true;
	}else{
		return false;
	}
}