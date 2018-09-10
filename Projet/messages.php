<?php
session_start();
include("head.php");
include("conf.inc.php");
include("functions.php");
$bdd = connectDB();
$conversations = getLastConversations($_SESSION['idUser']);
if (!isset($_GET['conv'])) {
	header("Location: messages.php?conv=".$conversations[0]['idConversation']);
}
if (isset($_POST['message'])) {
	sendMessage($_SESSION['idUser'], $_POST['message'], $_GET['conv']);
}
include("navbar.php");
?>
<title>Give It Back - Accueil</title>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined">Mes messages</h1>
			<div class="jumbotron justify-content-center text-center">
				<a href="newMessage.php" class="btn btn-primary">
					Créer une nouvelle conversation
				</a>
				<br>
				<br>
				<?php
				if (empty($_GET['conv'])) {
					echo "Vous n'avez pas encore envoyé de messages";
				}else{
					?>
					<div class="row">
						<div class="col-lg-4">
							<table class="table table-bordered table-hover">
								<?php
								foreach ($conversations as $key => $value) {
									$dateHour = timeStamp($value['dateHour']); 
									if ($value['user1'] == $_SESSION['idUser']) {
										$destinataire = $value['user2'];
									}else{
										$destinataire = $value['user1'];
									}
									?>
									<?php
									if ($value['conversation'] == $_GET['conv']) {
									 	echo "<tr style='background-color: #B3B7B9'>";
									}else{
										echo "<tr>";
									} 
									?>
										<td>
											<a href="messages.php?conv=<?php echo $value['conversation']?>">
											<?php 
											if (strlen($value['message']) > 30) {
												$value['message'] = substr($value['message'], 0,25)."...";
											}
											echo "<span style='color: black'>".getPseudoFromId($destinataire)." ";
											echo "<span style='color: darkgrey'>".$value['message']."</span>"; 
											?>
											</a>
										</td>
									</tr>
									<?php
								}
								?>
							</table>
						</div>
						<div class="col-lg-8 scrollableMessages">
							<?php
							$messages = getConversation($_GET['conv']);
							$request = $bdd->prepare('SELECT user1,user2 FROM conversation WHERE idConversation=:idConv');
							$request->execute([
								"idConv" => $_GET['conv'],
							]);
							$participants = $request->fetch(PDO::FETCH_ASSOC);
							if (($_SESSION['idUser'] != $participants['user1']) && ($_SESSION['idUser'] != $participants['user2'])) {
								echo "Vous n'avez pas accès à cette conversation";
							}else{
								foreach ($messages as $key => $value) {
									if ($value['sender'] == $_SESSION['idUser']) {
										?>
										<p class="messageBorder messageBorderLeft"><?php echo $value['message'];?></p>
										<?php
									}else{
										?>
										<p class="messageBorder messageBorderRight"><?php echo $value['message'];?></p>
										<?php
									}
								}
							}
							?>
						</div>
						<form method="POST" class="form-inline">
							<div class="row justify-content-center">
								<input type="text" name="message" class="form-control mx-2" placeholder="Votre message...">
								<input type="submit" class="btn btn-primary" value="Envoyer">
							</div>
						</form>
						<script type="text/javascript">
							$(".scrollableMessages").scrollTop(999999999);
						</script>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>