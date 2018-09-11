<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
include "navbar.php";
$bdd = connectDB();
?>
<title>Poster évènement</title>
<body>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined">Mes évènements</h1>
			<div class="jumbotron">
				<p class="lead text-center"><a href="myObjects.php">Voir comment s'affichent vos évènements aux yeux des autres</a></p>
				<br>
				<form method="" onsubmit="return checkScore();" class="form-inline text-center justify-content-center">
					<input class="form-control mr-2" type="text" name="pseudoToCheck" id="pseudoToCheck" placeholder="Pseudo">
					<input type="submit" class="btn btn-primary" value="Voir le score">
				</form>
				<br>
				<div id="scoreHere" class="lead text-center"></div>
				<br>
				<div class="row justify-content-center">
					<div class="col-lg-12">
						<?php

						// ----------- SCRIPT -----------  //
						if ((isset($_POST['pseudo'])) && (isset($_POST['idObject']))){
							if (isYourObject($_POST['idObject'])) {
								if (userExists($_POST['pseudo'])) {
									echo modal('Info','L\'échange a bien été crée','footer');
									createTrade($_POST['pseudo'],$_POST['idObject']);
								}else{
									echo modal('Info','L\'utilisateur saisi n\'existe pas','footer');
								}
							}else{
								echo "Cet évènement n'est pas à vous !";
							}
						}
						if ((isset($_POST['deleteProduct'])) && (isset($_POST['idObject']))){
							deleteProduct($_POST['idObject']);
						}
						if ((isset($_POST['reviveUser'])) && (isset($_POST['idObject']))){
							reviveUser($_POST['idObject']);
						}


						// ----------- AFFICHAGE -----------  //
						$requestNotLent = $bdd->prepare('SELECT * FROM produit WHERE pseudo_user = :pseudo ORDER BY dateHeure DESC');
						$requestNotLent->execute([
							"pseudo" => getPseudo($_SESSION['email']),
							]);
						$result = $requestNotLent->fetchAll(PDO::FETCH_ASSOC);
						if (empty($result)) {
							?>
							<h3 class="text-center">Vous n'avez pas encore proposé d'évènement !</h3>
							<h4 class="text-center"><a href="addObject.php">Proposez en un dès maintenant !</a></h4>
							<?php
						}else{
							?>
							<table class="table table-bordered text-center">
								<tr>
									<th>Nom de l'évènement</th>
									<th style="width: 50%">Prêter à</th>
									<th>Action</th>
								</tr>
								<?php
								foreach ($result as $key => $value) {
									if ($value['approbation'] == 0) {
										?>
										<td><?php echo $value['nom_évènement']; ?></td>
										<td colspan="2">Cet évènement n'a pas encore été approuvé</td>
										<?php
									}else{
										?>
										<td><?php echo $value['nom_évènement']; ?></td>
										<td class="text-center">
											<?php
											if ($value['lent']) {
												?>
												évènement prêté à : <a href="profil.php?pseudo=<?php echo tradeTo($value['id'])?>"><?php echo tradeTo($value['id']) ?></a>
												<?php
											}else{
												?>
												<form method="POST" class="form-inline justify-content-center">
													<input type="hidden" value="<?php echo $value['id']?>" name="idObject">
													<input type="text" placeholder="Pseudo" name="pseudo" class="form-control mr-2">
													<input type="submit" value="Prêter" class="btn btn-primary">
												</form>
												<?php
											}
											?>
										</td>
										<td class="justify-content-center">
											<?php
											if ($value['lent']) {
												if (getTradeState($value['id']) == 1) {
													?>
													<form class="form-inline justify-content-center" method="POST">
														<input type="hidden" value="<?php echo $value['id']?>" name="idObject">
														<input style="color: white;" type="submit" name="reviveUser" value="Faire une relance" class="btn btn-warning">
													</form>
													<?php
												}elseif (getTradeState($value['id']) == 3) {
													echo "Echange terminé";
												}else{
													echo "Echange en cours";
												}
											}else{
												?>
												<form class="form-inline justify-content-center" method="POST">
													<input type="hidden" value="<?php echo $value['id']?>" name="idObject">
													<input type="submit" name="deleteProduct"value="Supprimer" class="btn btn-danger">
												</form>
												<?php
											}
											?>
										</td>
										<?php
									}
									?>
									</tr>
									<?php
								}
								?>
							</table>
							<?php
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
<script type="text/javascript">
	function checkScore(){
		var pseudoToCheck = document.getElementById('pseudoToCheck').value;
		var request = new XMLHttpRequest();
		request.onreadystatechange = function(){
			if (request.readyState === 4) {
				showScore(request.responseText);
			}
		}
		request.open('POST','script/checkScore.php');
		request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		var body = 'pseudo=' + pseudoToCheck;
		request.send(body);
		return false;
	}

	function showScore(score){
		var divToShow = document.getElementById('scoreHere');
		var scoreIcon = document.createElement('i');
		var spanText = document.createElement('span');
		var p = document.createElement('p');
		divToShow.innerHTML = "";
		scoreIcon.classList.add('fa');
		scoreIcon.classList.add('fa-trophy');
		if (score > 400) {
			p.style.color = 'green';
			spanText.innerHTML = " " + score + ' (Très fiable !)';
		}else if(score > 200){
			p.style.color = 'green';
			spanText.innerHTML = " " + score + ' (Fiable)';
		}else if(score == 200){
			p.style.color = 'orange';
			spanText.innerHTML = " " + score + ' (Fiabilité moyenne)';
		}else if(score >= 100){
			p.style.color = 'red';
			spanText.innerHTML = " " + score + ' (Peu fiable)';
		}else{
			p.style.color = 'red';
			spanText.innerHTML = " " + score + ' (Très peu fiable !)';
		}
		if(score == ""){
			p.style.color = 'red';
			spanText.innerHTML = ' Ce pseudo n\'existe pas';
		}
		p.appendChild(scoreIcon);
		p.appendChild(spanText);
		divToShow.appendChild(p);
	}
</script>
