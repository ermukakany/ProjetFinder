<?php  
	if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist'){

		if (isset($_POST['id_agc']) and isset($_POST['nom_agc']) and isset($_POST['localisation']) and isset($_POST['latitude']) and isset($_POST['longitude'])) {
			
			$id = htmlspecialchars($_POST['id_agc']);
			$nom = htmlspecialchars($_POST['nom_agc']);
			$localisation = htmlspecialchars($_POST['localisation']);
			$latitude = htmlspecialchars($_POST['latitude']);
			$longitude = htmlspecialchars($_POST['longitude']);


			$id = utf8_decode($id);
			$nom = utf8_decode($nom);
			$localisation = utf8_decode($localisation);


			if (isset($_POST['pays'])) {
				$pays = htmlspecialchars($_POST['pays']);
			}

			if (isset($_POST['pole'])) {
				$pole = htmlspecialchars($_POST['pole']);
			}

			//echo "$id, $nom, $desc";

			if (($nom == '') or is_numeric($nom)) {
				if (isset($pays) and $pays != '') {
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=modifier_form_agence&agc='.$id.'&pays='.$pays.'&msg=num>');
				}else{
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=modifier_form_agence&agc='.$id.'&pole='.$pole.'&msg=num>');
				}
			}else{

				if( (empty($latitude) and empty($longitude)) or (is_numeric($latitude) and is_numeric($longitude)) ){
					
					global $PDO;

					$req = $PDO->prepare('UPDATE agence 
										  SET nom_agc = :Nom, 
										  	  localisation_agc = :Local,
										  	  latitude_agc = :Lat,
										  	  longitude_agc = :Long
										  WHERE id_agc = :Id
										')
					or exit(print_r($PDO->errorInfo()));
					$req->execute(array(
						'Id' => $id,
						'Nom' => $nom,
						'Local' => $localisation,
						'Lat' => $latitude,
						'Long' => $longitude
						)
					);

					if (isset($pays) and $pays != '') {
						die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=agences&pays='.$pays.'&msg=ok>');
					}else{
						die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=agences&pole='.$pole.'&msg=ok>');
					}

				}else{
					
					if (isset($pays) and $pays != '') {
						die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=modifier_form_agence&agc='.$id.'&pays='.$pays.'&msg=fl>');
					}else{
						die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=modifier_form_agence&agc='.$id.'&pole='.$pole.'&msg=fl>');
					}
					
				}

			}

		}else{
			echo "<h3>Erreur inconnue ! Réessayer ...</h3>";
		}
	

	}else{
		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
	}
?>