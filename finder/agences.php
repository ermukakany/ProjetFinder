
<?php 
$Auth->allow('collabo');

	if (isset($_GET['pays'])) {
		$pays = $_GET['pays'];

		$retour = 'index.php?p=pays';

		$ajouter = 'index.php?p=ajouter_form_agence&pays='.$pays.'';

		$titre = "Les agences pour $pays - Choisir une agence";
		//echo "<h1>Les agences pour $pays</h1>";


		if($Auth->user('slug')=='admin' or $Auth->user('slug')=='assist'){
			$bouton_ajouter = "<a href='$ajouter' class='btn btn-primary pull-left' style=''>Nouvelle agence</a>";
		}
		
		
		$i = 0;
		global $PDO;

		$req = $PDO->prepare('SELECT A.id_agc, A.nom_agc, A.localisation_agc, A.latitude_agc, A.longitude_agc, Pl.nom_plan, P.nom_pays  
							  FROM agence A, pays P, plan Pl
							  WHERE A.id_pays = P.id_pays
							  AND A.idPlan_agc = Pl.id_plan
							  AND P.nom_pays = :Pays
							');
		$req->execute(array(
			'Pays' => $pays
			)
		);

	}else{
		if (isset($_GET['pole'])) {
			$pole = $_GET['pole'];

			$retour = 'index.php?p=poles&c=0';

			$ajouter = 'index.php?p=ajouter_form_agence_pole&pole='.$pole.'';

			if($Auth->user('slug')=='admin' or $Auth->user('slug')=='assist'){
				$bouton_ajouter = "<a href='$ajouter' class='btn btn-primary pull-left' style=''>Nouvelle agence</a>";
			}

			global $PDO;

			$req0 = $PDO->prepare('SELECT nom_pole FROM pole WHERE id_pole = :Id');

			$req0->execute(array(
				'Id' => $pole
				)
			);

			$pole0 = $req0->fetch();
			$nom0 = utf8_encode($pole0->nom_pole);


			//echo "<h1>Les agences ayant le pôle $nom0</h1>";
			$titre = "Les agences ayant le pôle $nom0 - Choisir une agence";

			$i = 0;
			global $PDO;

			$req = $PDO->prepare('SELECT DISTINCT A.id_agc, A.nom_agc, A.localisation_agc, A.latitude_agc, A.longitude_agc, Pl.nom_plan, P.nom_pays  
								  FROM agence A, pays P, plan Pl, agence_pole Ap
								  WHERE A.id_pays = P.id_pays
								  AND A.idPlan_agc = Pl.id_plan
								  AND A.id_agc = Ap.id_agc
								  AND Ap.id_pole = :Pole
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
	while ($agc = $req->fetch()){

		$id = $agc->id_agc;
		$nom = utf8_encode($agc->nom_agc);
		$local = utf8_encode($agc->localisation_agc);
		$nomPays = utf8_encode($agc->nom_pays);
		$plan = utf8_encode($agc->nom_plan);
		
		echo 
			"<div style='float:left; margin-right:3%; align:center;  margin-bottom:1%; border-color:#666666; border-style:solid; border-width:1px; border-radius:10px; box-shadow:5px 5px 5px #666666; padding-bottom:0px; padding-top:10px;'>";	
				
				
				if($Auth->user('slug')=='admin' or $Auth->user('slug')=='assist'){
					if (isset($_GET['pays'])) {
						$supprimer = 'index.php?p=supprimer_agence&agc='.$id.'&pays='.$pays.'';
						$modifier = 'index.php?p=modifier_form_agence&agc='.$id.'&pays='.$pays.'';
					}else{
						$supprimer = 'index.php?p=supprimer_agence&agc='.$id.'&pole='.$pole.'';
						$modifier = 'index.php?p=modifier_form_agence&agc='.$id.'&pole='.$pole.'';
					}

					echo"
					<div class='dropdown'>
				        <a data-toggle='dropdown' class='btn btn-xs btn-default dropdown-toggle' type='button' id='myTabDrop1' href='#' style='border-style:solid; margin-left:2px; border-width:1px; border-color:blue;'><strong>Options</strong><b class='caret'></b></a>
				        <ul aria-labelledby='myTabDrop1' role='menu' class='dropdown-menu dropdown-menu-primary'>
				            <li><a href='$modifier'>Modifier</a></li>
				            <li>
				            	<a href='$supprimer' onclick=\"if (window.confirm('Etes-vous sur de vouloir supprimer cette agence ?')) {return true;} else {return false;}\">
				            		Supprimer
				            	</a>
				            </li>
				        </ul>
				    </div>";
				}
			    

			    echo"
				<p style='width:200px; height:150px;'>
					<a class='thumbnail' style='width:200px; height:130px; margin-bottom:2px; border-width:3px;' href='index.php?p=infos_agence&agence=$nom'>
						$id <br>
						<strong>$nom </strong><br>
						Adresse : $local<br>
						Pays : $nomPays
					</a>
					<a href='index.php?p=projets&agence=$id&pays=$pays'><span class='label label-primary pull-left' style='margin-bottom:1%; border-style:solid; border-width:1px; margin-left:2px;'>Projets</span></a>
					<a href='index.php?p=plan_agence&plan=$plan'><span class='label label-primary pull-left' style='margin-left:15px; margin-bottom:1%; border-style:solid; border-width:1px;'>Voir le plan</span></a>
					<a href='index.php?p=poles&c=$id&pays=$nomPays'><span class='label label-primary pull-right' style='margin-bottom:1%; border-style:solid; border-width:1px; margin-right:2px;'>Pôles</span></a>
				</p>
			</div>
			";

		$i ++;
	}
	echo "</div>";

	if ($i<1) {
		echo "<h3>Aucun contenu pour l'agence concernée</h3>";
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