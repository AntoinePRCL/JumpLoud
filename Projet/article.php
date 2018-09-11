<?php 
session_start();
include("head.php");
include("conf.inc.php");
include("functions.php");
$bdd = connectDB();
include("navbar.php");
$article = $_GET["ref"];
$resultat = getArticle($article);
?>
<title>Article : <?php echo $resultat['nom_objet']; ?></title>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<h1 class="titleUnderlined"><?php echo $resultat['nom_objet']; ?></h1>
			<div class="jumbotron justify-content-center text-center">
				<?php
				$test = glob("image_objets/".$article."/*");
				if ((count($test)) == 1) {
					?>
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<img src="image_objets/<?php echo $article; ?>/firstPhoto.png">
						</div>
					</div>
					<?php
				}else{
					?>
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							  <div class="carousel-inner">
							    <div class="carousel-item active">
							      <img class="d-block w-100" src="image_objets/<?php echo $article; ?>/firstPhoto.png" alt="First slide">
							    </div>
							    <div class="carousel-item">
							      <img class="d-block w-100" src="image_objets/<?php echo $article; ?>/secondPhoto.png" alt="Second slide">
							    </div>
							  </div>
							  <a class="carousel-control-prev" id="carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
							    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							    <span class="sr-only">Previous</span>
							  </a>
							  <a class="carousel-control-next" id="carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
							    <span class="carousel-control-next-icon" aria-hidden="true"></span>
							    <span class="sr-only">Next</span>
							  </a>
							</div>
						</div>
					</div>
					<?php
				}
				?>
				<p class="lead">Description:  <?php echo $resultat['description']; ?></p>
				<p class="lead">Prêté par : <a href="profil.php?pseudo=<?php echo $resultat['pseudo_user'];?>"><?php echo $resultat['pseudo_user'];?></a></p>
				<form method="POST" action="newMessage.php">
					<input type="hidden" value="<?php echo $resultat['pseudo_user'];?>" name="pseudo">
					<input type="submit" class="btn btn-primary" value="Contacter le vendeur">
				</form>
			</div>
		</div>
	</div>
</div>
