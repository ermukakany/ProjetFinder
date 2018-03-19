 <?php
 	$_SESSION = array();
 	//header("Location:index.php");
 	$message = utf8_encode("Vous êtes déconnecté");
 	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=login&msg=oui>');
 	
 	print "Vous êtes déconnecté"
 ?>
 <a href="index.php?p=login">Se connecter</a>