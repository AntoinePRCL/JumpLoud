<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
include "navbar.php";
$bdd = connectDB();
?>
<title>Suivi des échanges</title>
<body>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined">Suivi des échanges</h1>
			<div class="jumbotron">
				<div class="row justify-content-center">
					<div class="col-lg-12">
						<?php
						if (isset($_POST['keyReturn'])) {
							if (isYourTrade($_POST['idTrade'])) {
								verifyReturnKey($_POST['keyReturn'],$_POST['idTrade']);
							}
						}
						if ((isset($_POST['reviveUser'])) && (isset($_POST['idObject']))){
							reviveUser($_POST['idObject']);
						}
						if (isset($_POST['giveBack'])) {
							if (isYourTrade($_POST['idTrade'])){
								returnObject($_POST['idTrade']);
							}
						}elseif (isset($_POST['acceptObject'])) {
							acceptObject($_POST['idTrade']);
						}elseif (isset($_POST['getBack'])){
							if (isYourTrade($_POST['idTrade'])){
								
							}
						}elseif(isset($_POST['giveBack2'])){
							if (isYourTrade($_POST['idTrade'])) {
								$form = "
								<p class='text-center'>Il vous faut demander la clef de retour au prêteur</p>
								<form method='POST' class='text-center justify-content-center'>
									<input type='text' class='form-control' name='keyReturn' placeholder='Clef de retour'>
									<input type='hidden' name='idTrade' value=".$_POST['idTrade'].">
									<br>
									<input type='submit' class='btn btn-primary' value='Valider'>
								</form>";
								echo modal("Retourner un objet",$form,"");
							}
						}
						$request = $bdd->prepare('SELECT * FROM echange WHERE pseudo_taker =:pseudo OR pseudo_giver=:pseudo');
						$request->execute([
							"pseudo" => getPseudo($_SESSION['email']),
						]);
						$result = $request->fetchAll(PDO::FETCH_ASSOC);
						?>
						<table class="table table-bordered text-center">
							<tr>
								<th>ID</th>
								<th>Votre rôle</th>
								<th>Pseudo de l'autre personne</th>
								<th>Objet</th>
								<th>Action</th>
							</tr>
							<?php
							foreach ($result as $key => $value) {
								if ($value['pseudo_taker'] == getPseudo($_SESSION['email'])) {
									$role = 'Receveur';
									$pseudo = $value['pseudo_giver'];
								}else{
									$role = 'Prêteur';
									$pseudo = $value['pseudo_taker'];
								}
								?>
								<tr>
									<td><?php echo $value['id'];?></td>
									<td><?php echo $role; ?></td>
									<td><?php echo $pseudo; ?></td>
									<td><?php echo getObjectName($value['idObject']); ?></td>
									<td class="justify-content-center">
										<?php 
										if ($role == "Prêteur") {
											if ((getTradeState($value['idObject'])) == 0){
												echo "En attente";
											}elseif ((getTradeState($value['idObject'])) == 1){
												?>
												<form class="form-inline justify-content-center" method="POST">
													<input type="hidden" value="<?php echo $value['idObject']?>" name="idObject">
													<input style="color: white;" type="submit" name="reviveUser" value="Faire une relance" class="btn btn-warning">
												</form>
												<?php
											}elseif((getTradeState($value['idObject'])) == 2){
												echo "Clé à donner : ".$value['keyGiver'];
											}elseif((getTradeState($value['idObject'])) == 3){
												echo "Echange terminé";
											}
										}else{
											if ((getTradeState($value['idObject'])) == 0) {
												?>
												<form method="POST" class="justify-content-center">
													<input type="submit" class="btn btn-primary" name="acceptObject" value="Accepter l'objet">
													<input type="hidden" name="idTrade" value="<?php echo $value['id']; ?>">
												</form>
												<?php
											}elseif ((getTradeState($value['idObject'])) == 1) {
												?>
												<form method="POST" class="justify-content-center">
													<input type="submit" class="btn btn-primary" name="giveBack" value="Rendre l'objet">
													<input type="hidden" name="idTrade" value="<?php echo $value['id']; ?>">
												</form>
												<?php
											}elseif((getTradeState($value['idObject'])) == 2){
												?>
												<form method="POST" class="justify-content-center">
													<input type="submit" class="btn btn-primary" name="giveBack2" value="Rentrer la clef de retour">
													<input type="hidden" name="idTrade" value="<?php echo $value['id']; ?>">
												</form>
												<?php
											}elseif((getTradeState($value['idObject'])) == 3){
												echo "Echange terminé";
											}
										}
										?>
									</td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>