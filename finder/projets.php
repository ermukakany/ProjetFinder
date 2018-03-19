
<?php 
$Auth->allow('collabo');

	if (isset($_GET['agence']) and isset($_GET['pays'])){
		$agence = $_GET['agence'];
		$pays = $_GET['pays'];

		global $PDO;

			$req0 = $PDO->prepare('SELECT nom_agc FROM agence WHERE id_agc = :Id');

			$req0->execute(array(
				'Id' => $agence
				)
			);

			$agc0 = $req0->fetch();
			$nom0 = utf8_encode($agc0->nom_agc);

		$retour = 'index.php?p=agences&pays='.$pays;

		$titre = "Les projets de l'$nom0 - Choisir un projet";
		//echo "<h1>Les agences pour $pays</h1>";

		$ajouter = 'index.php?p=ajouter_form_projet_agence&agc='.$agence.'&pays='.$pays.'';

		if($Auth->user('slug')=='admin' or $Auth->user('slug')=='assist'){
			$bouton_ajouter = "<a href='$ajouter' class='btn btn-primary pull-left'>Nouveau projet</a>";
		}
		
		$i = 0;
		global $PDO;

		$req = $PDO->prepare('SELECT DISTINCT P.id_proj, P.nom_proj, A.nom_agc, Pl.nom_pole, P.desc_proj, DATE_FORMAT(P.dateDeb_proj, GET_FORMAT(DATE, "EUR")) AS dateDeb_proj, DATE_FORMAT(P.dateFin_proj, GET_FORMAT(DATE, "EUR")) AS dateFin_proj, P.effectif_proj, P.directeur_proj
								  FROM projet P, agence A, pole Pl
								  WHERE P.id_pole = Pl.id_pole
								  AND P.id_agc = A.id_agc
								  AND P.id_agc = :Agence
								');
		$req->execute(array(
			'Agence' => $agence
			)
		);

	}else{
		if (isset($_GET['pole'])) {
			$pole = $_GET['pole'];

			$retour = 'index.php?p=poles&c=0';

			global $PDO;

			$req0 = $PDO->prepare('SELECT nom_pole FROM pole WHERE id_pole = :Id');

			$req0->execute(array(
				'Id' => $pole
				)
			);

			$pole0 = $req0->fetch();
			$nom0 = utf8_encode($pole0->nom_pole);


			//echo "<h1>Les projets dans le pôle $nom0</h1>";
			$titre = "Les projets du pôle $nom0 - Choisir un projet";

			$ajouter = 'index.php?p=ajouter_form_projet_pole&pole='.$pole.'';

			if($Auth->user('slug')=='admin' or $Auth->user('slug')=='assist'){
				$bouton_ajouter = "<a href='$ajouter' class='btn btn-primary pull-left'>Nouveau projet</a>";
			}

			$i = 0;
			global $PDO;

			$req = $PDO->prepare('SELECT DISTINCT P.id_proj, P.nom_proj, A.nom_agc, Pl.nom_pole, P.desc_proj, DATE_FORMAT(P.dateDeb_proj, GET_FORMAT(DATE, "EUR")) AS dateDeb_proj, DATE_FORMAT(P.dateFin_proj, GET_FORMAT(DATE, "EUR")) AS dateFin_proj, P.effectif_proj, P.directeur_proj
								  FROM projet P, agence A, pole Pl
								  WHERE P.id_agc = A.id_agc
								  AND P.id_pole = Pl.id_pole
								  AND P.id_pole = :Pole
								');
			$req->execute(array(
				'Pole' => $pole
				)
			);
		}
	}

	require "titre.php";
	//echo "<h1>Choisir une agence </h1>";
	
	echo "<div class='container' style='width:100%;>";	
	echo "<div class='container' style='width:100%; padding-left:3%; padding-right:2%;'>";
	while ($proj = $req->fetch()){

		$id = $proj->id_proj;
		$nom_proj = utf8_encode($proj->nom_proj);

		if(isset($_GET['agence'])){
			$nom = utf8_encode($proj->nom_pole);
			$label = 'Pôle';
		}else{
			$nom = utf8_encode($proj->nom_agc);
			$label = 'Agence';
		}

		$desc_proj = utf8_encode($proj->desc_proj);
		$debut = ($proj->dateDeb_proj);
		$fin = ($proj->dateFin_proj);
		$effectif = ($proj->effectif_proj);
		$directeur = utf8_encode($proj->directeur_proj);
		
		echo 
			"<div style='float:left; margin-right:3%; align:center;  margin-bottom:1%; border-color:#666666; border-style:solid; border-width:1px; border-radius:10px; box-shadow:5px 5px 5px #666666; padding-bottom:0px; padding-top:10px;'>";	
				
				
				if($Auth->user('slug')=='admin' or $Auth->user('slug')=='assist'){
					if(isset($_GET['agence']) and isset($_GET['pays'])){
						$supprimer = 'index.php?p=supprimer_projet&proj='.$id.'&agc='.$agence.'&pays='.$pays.'';
					}else{
						$supprimer = 'index.php?p=supprimer_projet&proj='.$id.'&pole='.$pole.'';
					}
					echo"
					<div class='dropdown'>
				        <a data-toggle='dropdown' class='btn btn-xs btn-default dropdown-toggle' type='button' id='myTabDrop1' href='#' style='border-style:solid; margin-left:2px; border-width:1px; border-color:blue;'><strong>Options</strong><b class='caret'></b></a>
				        <ul aria-labelledby='myTabDrop1' role='menu' class='dropdown-menu dropdown-menu-primary'>
				            <li><a href='#dropdown1'>Modifier</a></li>
				            <li>
				            	<a href='$supprimer' onclick=\"if (window.confirm('Etes-vous sur de vouloir supprimer ce projet ?')) {return true;} else {return false;}\">
				            		Supprimer
				            	</a>
				            </li>
				        </ul>
				    </div>";
				}
			    

			    echo"
				<p style='width:200px; height:150px;'>
					<a class='thumbnail' style='width:200px; height:130px; margin-bottom:2px; border-width:3px;' href='index.php?p=infos_projet&projet=$id'>
						<strong>$nom_proj </strong><br>
						$label : $nom<br>
						Début : $debut <br>
						Effectif : $effectif<br>
						<--->

					</a>
					<a href='index.php?p=agences&pole=$id'><span class=' label label-primary pull-left' style='margin-bottom:1%; border-style:solid; border-width:1px; margin-left:2px;'>Bureaux</span></a>
					<a href='index.php?p=projets&pole=$id'><span class='label label-primary pull-right' style='margin-bottom:1%; border-style:solid; border-width:1px; margin-right:2px;'>Collaborateurs</span></a>
				</p>
			</div>
			";

		$i ++;
	}
	echo "</div>";

	if ($i<1) {
		echo "<h3>Aucun contenu pour ce projet</h3>";
	}

	if (isset($_GET['msg'])) {
		if ($_GET['msg'] == 'ok') {
			echo "<p style='background-color:white; width:100%; color:green; text-align:center;'>
				<strong>Insertion effectuée avec succès.</strong>
			 </p>";
		}else{
			if ($_GET['msg'] == 'oks') {
				echo "<p style='background-color:white; width:100%; color:green; text-align:center;'>
					<strong>Suppression effectuée avec succès.</strong>
				 </p>";
			}
		}
	}

	echo "<p style='margin-right:5px;'>
			$bouton_ajouter
			<a href='$retour' class='btn btn-primary pull-right'>
				Retour
			</a>
		 </p> ";
	echo "</div>";
	
?>