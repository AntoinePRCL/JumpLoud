<?php
session_start();
include "head.php";
include "functions.php";
include "conf.inc.php";
isPrivate();
include "navbar.php";
$bdd = connectDB();
?>
<title>Profil de <?php echo getPseudo($_SESSION['email'])?></title>
<body>
	<div class="container">
		<div class="resume decalageTop">
			<div class="row justify-content-center">
				<div class="col-lg-8  justify-content-center">
					<h1 class="titleUnderlined">Top 5 des plus gros scores</h1>
					<?php
					$request = $bdd->query('SELECT pseudo,score FROM user ORDER BY score DESC LIMIT 0,5');
					$result = $request->fetchAll(PDO::FETCH_ASSOC);
					?>
					<ul class="list-group">
						<?php
						$i = 1;
						foreach ($result as $key => $value) {
							?>
							<li class="list-group-item"><span><?php echo $i; ?>. <span style="color:green"><i class="fas fa-trophy"></i> <?php echo $value['score'] ?></span> | <a href="profil.php?pseudo=<?php echo $value['pseudo']; ?>"><?php echo $value['pseudo']; ?></a></span></li>
							<?php
							$i++;
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>