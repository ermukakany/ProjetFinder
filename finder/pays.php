
<?php  
$Auth->allow('collabo');

$titre = "Choisir un pays";
require "titre.php";


	global $PDO;

	$req = $PDO->prepare('SELECT id_pays, nom_pays FROM pays');
	$req->execute();

	echo "<div>";
	while ($pays = $req->fetch()){
		$id = $pays->id_pays;
		$nom = utf8_encode($pays->nom_pays);
		
		echo 
			"<p style='text-align:center;'>
				<a class='thumbnail' style='border-width:3px;' href='index.php?p=agences&pays=$nom'>
					<strong>$nom</strong> <br>
				</a>
			</p>";
	}
	echo "<p><a href='index.php?p=presentation' class='btn btn-primary pull-right' style='clear:both'>
				Retour</a>
			  </p> ";
	echo "</div>";

?>