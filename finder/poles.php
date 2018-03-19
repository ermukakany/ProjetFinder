
<?php 
$Auth->allow('collabo');

	if (isset($_GET['c'])) {
		$c = $_GET['c'];
		$retour = "index.php?p=presentation";

		$i = 0;

		//On teste la valeur de 'c' pour savoir quelle requête déclencher

		//Si $c=0 alors on sélectionne tous les pôles
		if($c == 0){

			$titre = "Tous les pôles d'activité - Choisir une activité";
			//echo "<h1>Tous les pôles d'activité </h1>";

			$ajouter = 'index.php?p=ajouter_form_pole';
			

			//Récupération de tous les pôles
			global $PDO;

			$req = $PDO->prepare('SELECT id_pole, nom_pole, desc_pole FROM pole');
			$req->execute();

		//Sinon on récupère seulement les pôles pour l'agence concernée (avec $c comme id_pole)
		} else{
			$pays = $_GET['pays'];
			$retour = "index.php?p=agences&pays=$pays";

			//Récupération du nom de l'agence ayant comme id $c
			global $PDO;
			$req0 = $PDO->prepare('SELECT nom_agc FROM agence WHERE id_agc = :Id');

			$req0->execute(array(
				'Id' => $c
				)
			);

			$pole0 = $req0->fetch();
			$nom0 = utf8_encode($pole0->nom_agc);

			$titre = "Les pôles de l'$nom0 - Choisir une activité";
			//echo "<h1>Les pôles de l'$nom0 </h1>" ;

			$ajouter = 'index.php?p=ajouter_form_pole_agc&agc='.$c;


			//Récupération des pôles de l'agence ayant comme id $c
			global $PDO;

			$req = $PDO->prepare('SELECT P.id_pole, P.nom_pole, P.desc_pole 
								  FROM pole P, agence_pole Ap
								  WHERE P.id_pole = Ap.id_pole
								  AND Ap.id_agc=:Id
								');
			$req->execute(array(
				'Id' => $c
				)
			);
		}

		require "titre.php";
		//echo "<h1>Choisir une activité </h1>";

		echo "<div class='container' style='width:100%;>";
		echo "<div class='container' style='width:100%; padding-left:3%; padding-right:2%;'>";

		if($Auth->user('slug')=='admin'){
			$bouton_ajouter = "<a href='$ajouter' class='btn btn-primary pull-left' style=''>Nouveau Pôle</a>";
		}

		//On affiche les pôles suivant la condition qui est vérifiée
		while ($pole = $req->fetch()){

			$id = $pole->id_pole;
			$nom = utf8_encode($pole->nom_pole);
			$desc = utf8_encode($pole->desc_pole);

			echo 
				"<div style='float:left; margin-right:3%; align:center;  margin-bottom:1%; border-color:grey; border-style:solid; border-width:1px; border-radius:10px; box-shadow:5px 5px 5px #666666; padding-bottom:0px; padding-top:10px;'>";
					
				if($Auth->user('slug')=='admin'){
					if($c == 0){
						$supprimer = 'index.php?p=supprimer_pole&pole='.$id.'';
						$modifier = 'index.php?p=modifier_form_pole&pole='.$id.'';
					}else{
						$supprimer = 'index.php?p=supprimer_pole&agc='.$c.'&pays='.$pays.'&poles='.$id.'';
						$modifier = 'index.php?p=modifier_form_pole&agc='.$c.'&pays='.$pays.'&poles='.$id.'';
					}
					echo"	
						<div class='dropdown'>
					        <a data-toggle='dropdown' class='btn btn-xs btn-default dropdown-toggle' type='button' id='myTabDrop1' href='#' style='border-style:solid; margin-left:2px; border-width:1px; border-color:blue;'> <strong>Options</strong> <b class='caret'></b></a>
					        <ul aria-labelledby='myTabDrop1' role='menu' class='dropdown-menu dropdown-menu-primary'>
					            <li><a href='$modifier'>Modifier</a></li>
					            <li><a href='$supprimer' onclick=\"if (window.confirm('Etes-vous sur de vouloir supprimer le pôle ?')) {return true;} else {return false;}\">
					            		Supprimer
					            	</a>
					            </li>
					        </ul>
					    </div>";
				}

					echo"
					<p style='width:200px; height:150px;'>
						<a class='thumbnail' style='width:200px; height:130px; margin-bottom:2px; border-width:3px;' href='index.php?p=infos_pole&pole=$nom'>
							$id <br>
							<strong>$nom </strong><br>
							$desc
						</a>
						<a href='index.php?p=agences&pole=$id'><span class=' label label-primary pull-left' style='margin-bottom:1%; border-style:solid; border-width:1px; margin-left:2px;'>Agences</span></a>
						<a href='index.php?p=projets&pole=$id'><span class='label label-primary pull-right' style='margin-bottom:1%; border-style:solid; border-width:1px; margin-right:2px;'>Projets</span></a>
					</p>
				</div>";
				
			$i++;
		}

		echo "</div>";

		//On teste si la requête a renvoyé au moins une ligne
		if ($i<1) {
			echo "<h3>Aucun contenu pour le pôle concerné</h3>";
		}


		if (isset($_GET['msg'])) {
			if ($_GET['msg'] == 'ok') {
				echo "<p style='background-color:white; width:100%; color:green; text-align:center;'>
					<strong>Insertion effectuée avec succès.</strong>
				 </p>";
			}else{
				if ($_GET['msg'] == 'oks') {
					echo "<p style='background-color:white; width:100%; color:green; text-align:center;'>
						<strong>Suppression effectée avec succès.</strong>
					 </p>";
				}
			}
		}

		echo "<p style='margin-right:5px; margin-left:5px; clear:both;'>
				$bouton_ajouter
				<a href='$retour' class='btn btn-primary pull-right' style=''>
					Retour
				</a>
			  </p> ";
		echo "</div>";

	} else{
		echo "Erreur inattendue !";
	}

?>
