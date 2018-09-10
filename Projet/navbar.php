<nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #12a117">
  <a class="navbar-brand pacifico" href="/Projet/index.php">JumpLoud</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>
  <?php
  if (isConnected()) {
	?>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
		<li class="nav-item">
		  <a class="nav-link" href="/Projet/index.php"><i class="fas fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="searchobject.php"><i class="fas fa-search"></i> Rechercher évènement ou un lieu</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="addobject.php"><i class="fas fa-plus"></i> Ajouter un évènement ou un lieu</a>
		</li>
	  </ul>
	  <div class="my-2 my-lg-0">
		<ul class="navbar-nav mr-auto">
		  <?php 
		  if (isAdmin()){
			?>
			<?php
		  }
		  ?>
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  <i class="fas fa-user"></i> <?php echo getPseudo($_SESSION['email']); ?>
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item" href="/Projet/profil.php"><i class="far fa-id-card"></i> Mon profil</a>
			  <a class="dropdown-item" href="/Projet/messages.php"><i class="fas fa-comments"></i> Mes messages</a>
			  <a class="dropdown-item" href="/Projet/lendObject.php"><i class="fas fa-box"></i> Mes objets</a>
			 <a class="dropdown-item" href="/Projet/objectTracking.php"><i class="far fa-handshake"></i> Suivi des évènements</a>
			 <?php 
			 if ((getAccountRole($_SESSION['email'])) == 1) {
			   ?>
				<a class="dropdown-item" href="/Projet/sendCNI.php"><i class="fas fa-id-card"></i> Confirmer mon compte</a>
			   <?php
			 }
			 ?>
			 <?php
			 if (isset($_SESSION['activation'])) {
				?>
				<a class="dropdown-item" href="/Projet/accountActivation.php"><i class="fas fa-check"></i> Activer mon compte</a>
				<?php
			  } 
			 ?>
			</div>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="/Projet/logout.php"><i class="fas fa-power-off"></i> Se déconnecter</a>
		  </li>
		</ul>
	  </div>
	</div>
	<?php
  }else{
	?>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	  <ul class="navbar-nav mr-auto">
		<li class="nav-item">
		  <a class="nav-link" href="/Projet/index.php"><i class="fas fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
		</li>
	  </ul>
	  <div class="my-2 my-lg-0">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item">
			<a class="nav-link" href="/Projet/signup.php"><i class="fas fa-user-plus"></i> S'inscrire</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="/Projet/signup.php"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
		  </li>
		</ul>
	  </div>
	</div>
	<?php
   } 
  ?>
</nav>