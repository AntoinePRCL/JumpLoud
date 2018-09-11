<?php
session_start();
include("head.php");
include("conf.inc.php");
include("functions.php");
$bdd = connectDB();
?>
<title>JUMP Loud - Accueil</title>
<?php include("navbar.php"); 
if (isset($_GET['info'])) {
	switch ($_GET['info']) {
		case 'signup':
			echo modal("Information","Vous avez bien été inscrit, regardez vos mails pour activer votre compte !","footer");
			break;
		case 'activation':
			echo modal("Information","Votre compte a bien été activé","footer");
			break;
		default:
			
			break;
	}
}
?>
<div class="container-fluid accueil">
	<div class="row justify-content-center accueil">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
		    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner accueil">
		    <div class="carousel1 carousel-item text-carousel active">
		    	<div class="row justify-content-center text-center text-accueil">
			    	<h2 class="h1">Se loger</h2>
			      	<p class="lead">
				      JumpLoud est la première plateforme collaborative étudiante qui vous permet de trouver un logement. Vous pouvez rechercher un logement et publier une annonce de logement pour des édudiants partout en France.
			  		</p>
		  		</div>
		    </div>
		    <div class="carousel2 carousel-item text-carousel">
		    	<div class="row justify-content-center text-center text-accueil">
			    	<h2 class="h1">Se restaurer</h2>
			      	<p class="lead">
				      Dans JumpLoud, vous pouvez rechercher les meilleurs points de resturation parmis une sélection d'étudiants comme vous afin de trouver le meilleur établissement pour déjeuner qui corresponde à vos attentes.
			  		</p>
		  		</div>
		    </div>
		    <div class="carousel3 carousel-item text-carousel">
		    	<div class="row justify-content-center text-center text-accueil">
			    	<h2 class="h1">Sortir</h2>
			      	<p class="lead">
				      Vous cherchez une sortie entre amis ? N'attends plus et inscrits toi vite sur Jump Loud pour avoir accès aux meilleurs plans et soirées près de chez toi.
			  		</p>
		  		</div>
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

<?php include("footer.php"); ?>