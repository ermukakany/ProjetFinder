<?php  
	if (isset($_POST['ref']) and $_POST['ref'] == 1) {
		if (isset($_POST['id_pole']) and isset($_POST['nom_pole']) and isset($_POST['desc'])) {
			
			$id = htmlspecialchars($_POST['id_pole']);
			$nom = htmlspecialchars($_POST['nom_pole']);
			$desc = htmlspecialchars($_POST['desc']);

			$id = utf8_decode($id);
			$nom = utf8_decode($nom);
			$desc = utf8_decode($desc);

			//echo "$id, $nom, $desc";

			if ($nom == '') {
				die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_pole&msg=non>');
			}else{
				global $PDO;

				$req = $PDO->prepare('INSERT INTO pole (id_pole, nom_pole, desc_pole) VALUES (:Id, :Nom, :Descr)
									')
				or exit(print_r($PDO->errorInfo()));
				$req->execute(array(
					'Id' => $id,
					'Nom' => $nom,
					'Descr' => $desc
					)
				);

				die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=poles&c=0&msg=ok>');

			}
		}
	}else{

		if (isset($_POST['id_agc']) and isset($_POST['pole'])) {
			
			$id_agc = htmlspecialchars($_POST['id_agc']);
			$id_pole = htmlspecialchars($_POST['pole']);

			if ($_POST['pole'] =='') {
				die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_pole_agc&agc='.$id_agc.'&msg=non>');
			}else{
				echo "$id_agc, $id_pole";

				global $PDO;
				$req0 = $PDO->prepare('SELECT P.nom_pays FROM agence A, pays P
										WHERE A.id_pays = P.id_pays
										AND A.id_agc = :Id');

				$req0->execute(array(
					'Id' => $id_agc
					)
				);

				$agc0 = $req0->fetch();
				$pays = ($agc0->nom_pays);



				global $PDO;

				$req = $PDO->prepare('INSERT INTO agence_pole (id_agc, id_pole) VALUES (:IdAgc, :IdPole)
									')
				or exit(print_r($PDO->errorInfo()));
				$req->execute(array(
					'IdAgc' => $id_agc,
					'IdPole' => $id_pole,
					)
				);

				die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=poles&c='.$id_agc.'&pays='.$pays.'&msg=ok>');
			}
		}
	}
?>