<?php
session_start();
include("head.php");
include("conf.inc.php");
include("functions.php");
$bdd = connectDB();
?>
<title>Jump Loud - Accueil</title>
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
<div id="cgu"> 
	<h1 style="text-align: center"> Conditions générales d'utilisation du site JumpLoud</h1>
<p>
	<br>
<br>

ARTICLE 1 : Objet
<br>
Les présentes « conditions générales d'utilisation » ont pour objet l'encadrement juridique des modalités de mise à disposition des services du site JumpLoud et leur utilisation par « l'Utilisateur ».
<br>
Les conditions générales d'utilisation doivent être acceptées par tout Utilisateur souhaitant accéder au site. Elles constituent le contrat entre le site et l'Utilisateur. L’accès au site par l’Utilisateur signifie son acceptation des présentes conditions générales d’utilisation.
<br><br>

Éventuellement :
<br>

En cas de non-acceptation des conditions générales d'utilisation stipulées dans le présent contrat, l'Utilisateur se doit de renoncer à l'accès des services proposés par le site.
<br>

JumpLoud se réserve le droit de modifier unilatéralement et à tout moment le contenu des présentes conditions générales d'utilisation.
<br><br>
<br>


ARTICLE 2 : Mentions légales
<br>

L'édition du site JumpLoud est assurée par la Société JumpLoud SARL [SAS / SA / SARL, etc.] au capital de [montant en euros] € dont le siège social est situé au [adresse du siège social].
<br>

[Le Directeur / La Directrice] de la publication est [Madame / Monsieur] [Nom & Prénom].
<br><br>


Éventuellement :
<br>

JumpLoud SARL est une société du groupe JumpLoud SARL [SAS / SA / SARL, etc.] au capital de [montant en euros] € dont le siège social est situé au [adresse du siège social].
<br>

L'hébergeur du site JumpLoud est la Société JumpLoud SARL [SAS / SA / SARL, etc.] au capital de [montant en euros] € dont le siège social est situé au [adresse du siège social].
<br><br>
<br>


ARTICLE 3 : Définitions
<br>

La présente clause a pour objet de définir les différents termes essentiels du contrat :
<br>

Utilisateur : ce terme désigne toute personne qui utilise le site ou l'un des services proposés par le site.
<br>

Contenu utilisateur : ce sont les données transmises par l'Utilisateur au sein du site.
<br>

Membre : l'Utilisateur devient membre lorsqu'il est identifié sur le site.
<br>

Identifiant et mot de passe : c'est l'ensemble des informations nécessaires à l'identification d'un Utilisateur sur le site. L'identifiant et le mot de passe permettent à l'Utilisateur d'accéder à des services réservés aux membres du site. Le mot de passe est confidentiel.

<br><br>

<br>
ARTICLE 4 : accès aux services
<br>

Le site permet à l'Utilisateur un accès gratuit aux services suivants :
<br>

[articles d’information] ;
<br>

[annonces classées] ;
<br>

[mise en relation de personnes] ;
<br>

[publication de commentaires / d’œuvres personnelles] ;
<br>

[…].
<br>

Le site est accessible gratuitement en tout lieu à tout Utilisateur ayant un accès à Internet. Tous les frais supportés par l'Utilisateur pour accéder au service (matériel informatique, logiciels, connexion Internet, etc.) sont à sa charge.
<br>

Selon le cas :
<br>

L’Utilisateur non membre n'a pas accès aux services réservés aux membres. Pour cela, il doit s'identifier à l'aide de son identifiant et de son mot de passe.
<br>

Le site met en œuvre tous les moyens mis à sa disposition pour assurer un accès de qualité à ses services. L'obligation étant de moyens, le site ne s'engage pas à atteindre ce résultat.
<br>

Tout événement dû à un cas de force majeure ayant pour conséquence un dysfonctionnement du réseau ou du serveur n'engage pas la responsabilité de JumpLoud.
<br>

L'accès aux services du site peut à tout moment faire l'objet d'une interruption, d'une suspension, d'une modification sans préavis pour une maintenance ou pour tout autre cas. L'Utilisateur s'oblige à ne réclamer aucune indemnisation suite à l'interruption, à la suspension ou à la modification du présent contrat.
<br>

L'Utilisateur a la possibilité de contacter le site par messagerie électronique à l’adresse [contact@JumpLoud.com].
<br><br>

<br>
ARTICLE 5 : Propriété intellectuelle
<br>

Les marques, logos, signes et tout autre contenu du site font l'objet d'une protection par le Code de la propriété intellectuelle et plus particulièrement par le droit d'auteur.
<br>

L'Utilisateur sollicite l'autorisation préalable du site pour toute reproduction, publication, copie des différents contenus.
<br>

L'Utilisateur s'engage à une utilisation des contenus du site dans un cadre strictement privé. Une utilisation des contenus à des fins commerciales est strictement interdite.
<br>

Tout contenu mis en ligne par l'Utilisateur est de sa seule responsabilité. L'Utilisateur s'engage à ne pas mettre en ligne de contenus pouvant porter atteinte aux intérêts de tierces personnes. Tout recours en justice engagé par un tiers lésé contre le site sera pris en charge par l'Utilisateur.
<br>

Le contenu de l'Utilisateur peut être à tout moment et pour n'importe quelle raison supprimé ou modifié par le site. L'Utilisateur ne reçoit aucune justification et notification préalablement à la suppression ou à la modification du contenu Utilisateur.
<br><br>
<br>


ARTICLE 6 : Données personnelles
<br>

Les informations demandées à l’inscription au site sont nécessaires et obligatoires pour la création du compte de l'Utilisateur. En particulier, l'adresse électronique pourra être utilisée par le site pour l'administration, la gestion et l'animation du service.
<br>

Le site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés. Le site est déclaré à la CNIL sous le numéro [numéro].
<br>

En vertu des articles 39 et 40 de la loi en date du 6 janvier 1978, l'Utilisateur dispose d'un droit d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur exerce ce droit via :
<br>

son espace personnel ;
<br>


par mail à [adresse mail] ;
<br>

par voie postale au [adresse].
<br>

ARTICLE 7 : Responsabilité et force majeure
<br>

Les sources des informations diffusées sur le site sont réputées fiables. Toutefois, le site se réserve la faculté d'une non-garantie de la fiabilité des sources. Les informations données sur le site le sont à titre purement informatif. Ainsi, l'Utilisateur assume seul l'entière responsabilité de l'utilisation des informations et contenus du présent site.
<br>

L'Utilisateur s'assure de garder son mot de passe secret. Toute divulgation du mot de passe, quelle que soit sa forme, est interdite.
<br>

L'Utilisateur assume les risques liés à l'utilisation de son identifiant et mot de passe. Le site décline toute responsabilité.
<br>

Tout usage du service par l'Utilisateur ayant directement ou indirectement pour conséquence des dommages doit faire l'objet d'une indemnisation au profit du site.
<br>

Une garantie optimale de la sécurité et de la confidentialité des données transmises n'est pas assurée par le site. Toutefois, le site s'engage à mettre en œuvre tous les moyens nécessaires afin de garantir au mieux la sécurité et la confidentialité des données.
<br>

La responsabilité du site ne peut être engagée en cas de force majeure ou du fait imprévisible et insurmontable d'un tiers.
<br>
<br><br>


ARTICLE 8 : Liens hypertextes
<br>

De nombreux liens hypertextes sortants sont présents sur le site, cependant les pages web où mènent ces liens n'engagent en rien la responsabilité de JumpLoud qui n'a pas le contrôle de ces liens.
<br>

L'Utilisateur s'interdit donc à engager la responsabilité du site concernant le contenu et les ressources relatives à ces liens hypertextes sortants.
<br>
<br><br>


ARTICLE 9 : Évolution du contrat
<br>

Le site se réserve à tout moment le droit de modifier les clauses stipulées dans le présent contrat.
<br>
<br>
<br>

ARTICLE 10 : Durée
<br>

La durée du présent contrat est indéterminée. Le contrat produit ses effets à l'égard de l'Utilisateur à compter de l'utilisation du service.
<br><br>
<br>


ARTICLE 11 : Droit applicable et juridiction compétente
<br>

La législation française s'applique au présent contrat. En cas d'absence de résolution amiable d'un litige né entre les parties, seuls les tribunaux [du ressort de la Cour d'appel de / de la ville de] [Ville] sont compétents.
<br><br>


Éventuellement
<br>
<br>
<br>

ARTICLE 12 : Publication par l’Utilisateur
<br>

Le site permet aux membres de publier [des commentaires / des œuvres personnelles].
<br>

Dans ses publications, le membre s’engage à respecter les règles de la Netiquette et les règles de droit en vigueur.
<br>

Le site exerce une modération [a priori / a posteriori] sur les publications et se réserve le droit de refuser leur mise en ligne, sans avoir à s’en justifier auprès du membre.
<br>

Le membre reste titulaire de l’intégralité de ses droits de propriété intellectuelle. Mais en publiant une publication sur le site, il cède à la société éditrice le droit non exclusif et gratuit de représenter, reproduire, adapter, modifier, diffuser et distribuer sa publication, directement ou par un tiers autorisé, dans le monde entier, sur tout support (numérique ou physique), pour la durée de la propriété intellectuelle. Le Membre cède notamment le droit d'utiliser sa publication sur internet et sur les réseaux de téléphonie mobile.
<br>

La société éditrice s'engage à faire figurer le nom du membre à proximité de chaque utilisation de sa publication. </p></div>

</body>
</html>