<?php
session_start();
include "head.php";
require "conf.inc.php";
require "functions.php";
include "navbar.php";
$bdd = connectDB();
isConnected();
$request = $bdd->prepare('INSERT INTO formulaire (pseudo, object, message) VALUES (:pseudo, :object, :message)');
?>

 <body> 
  <div class="bigConteneur">
    <h1 class="contactUsTitle"> Contactez-nous </h1>
    <form method="POST">
     <div class="form-group col">
        <input type="text" class="form-control" placeholder="Object"  required="required" name="object">
      </div>
      <div class="form-goupe col contentMessage">
        <textarea type="text" class="form-control contentMessage" placeholder="Votre demande" name="message" required="required"></textarea>
      </div>
        <br>
      <center>
        <button type="submit" class="btn btn-primary" name="sendMessage">Envoyer</button>
      </center>
     </form>
  </div>

  <?php
if(isset($_POST['sendMessage'])){
  $request = $bdd->prepare('INSERT INTO formulaire (pseudo, object, message) VALUES(:pseudo, :object, :message)');
  $request->execute([
    "pseudo" => getPseudo($_SESSION['email']),
    "object" => $_POST['object'],
    "message" => $_POST['message']
  ]);
  echo modal('Information','Votre message a bien été envoyé','footer');
}
?>
