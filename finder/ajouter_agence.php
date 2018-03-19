<?php 
	if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist') {
		if (isset($_POST['ref']) and $_POST['ref'] == 1) {
			if (isset($_POST['id_agc']) and !empty($_POST['id_agc']) and isset($_POST['pays']) and isset($_POST['nom_agc']) and isset($_POST['adresse'])) {
				
				$id = htmlspecialchars($_POST['id_agc']);
				$pays = htmlspecialchars($_POST['pays']);
				$nom = htmlspecialchars($_POST['nom_agc']);
				$localisation = htmlspecialchars($_POST['adresse']);

				$nom = utf8_decode($nom);
				$localisation = utf8_decode($localisation);


				//echo "$id, $pays, $nom, $adresse";

				if ($nom == '') {
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_agence&pays='.$pays.'&msg=non>');
				}else{

					global $PDO;
					$req0 = $PDO->prepare('SELECT max(id_plan + 1) AS id_plan FROM plan');

					$req0->execute();

					$plan0 = $req0->fetch();
					$id_plan = ($plan0->id_plan);

					global $PDO;
					$req1 = $PDO->prepare('INSERT INTO plan (id_plan) VALUES (:Id)')
					or exit(print_r($PDO->errorInfo()));

					$req1->execute(array(
						'Id' => $id_plan
						)
					);

					global $PDO;
					$req2 = $PDO->prepare('SELECT id_pays FROM pays WHERE nom_pays = :Pays');

					$req2->execute(array(
						'Pays' => $pays
						)
					);

					$pays2 = $req2->fetch();
					$id_pays = ($pays2->id_pays);

					echo "$id, $nom, $id_pays, $pays, $localisation, $id_plan";
					


					global $PDO;

					$req = $PDO->prepare('INSERT INTO agence (id_agc, nom_agc, id_pays, localisation_agc, idPlan_agc) VALUES (:Id, :Nom, :Pays, :Localisation , :Plan)
										')
					or exit(print_r($PDO->errorInfo()));
					$req->execute(array(
						'Id' => $id,
						'Nom' => $nom,
						'Pays' => $id_pays,
						'Localisation' => $localisation,
						'Plan' => $id_plan
						)
					);

					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=agences&pays='.$pays.'&msg=ok>');
				}
			}
		}else{

			if (isset($_POST['agence']) and isset($_POST['id_pole'])){
				
				$id_agc = $_POST['agence'];
				$id_pole = $_POST['id_pole'];

				if ($_POST['agence'] ==''){
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_agence_pole&pole='.$id_pole.'&msg=oui>');
				}else{
					//echo "$id_agc, $id_pole";

					global $PDO;

					$req = $PDO->prepare('INSERT INTO agence_pole (id_agc, id_pole) VALUES (:IdAgc, :IdPole)
										')
					or exit(print_r($PDO->errorInfo()));
					$req->execute(array(
						'IdAgc' => $id_agc,
						'IdPole' => $id_pole,
						)
					);

					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=agences&pole='.$id_pole.'&msg=ok>');
				}
			}
		}
	}else{
		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden');
	}
?>