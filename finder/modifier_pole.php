<?php  
	$Auth->allow('admin');

	if (isset($_POST['id_pole']) and isset($_POST['nom_pole']) and isset($_POST['desc_pole'])) {
			
			$id = htmlspecialchars($_POST['id_pole']);
			$nom = htmlspecialchars($_POST['nom_pole']);
			$desc = htmlspecialchars($_POST['desc_pole']);

			$id = utf8_decode($id);
			$nom = utf8_decode($nom);
			$desc = utf8_decode($desc);


			echo $id, $nom;

			if (isset($_POST['agc']) and isset($_POST['pays'])) {
				$agc = htmlspecialchars($_POST['agc']);
				$pays = htmlspecialchars($_POST['pays']);
			}

			//echo "$id, $nom, $desc";

			if ($nom == '') {
				if (isset($agc) and isset($pays) and $agc != '' and $pays != '') {
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=modifier_form_pole&agc='.$agc.'&pays='.$pays.'&poles='.$id.'&msg=non>');
				}else{
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=modifier_form_pole&pole='.$id.'&msg=non>');
				}


			}else{
				global $PDO;

				$req = $PDO->prepare('UPDATE pole SET nom_pole=:Nom, desc_pole=:Descr WHERE id_pole=:Id
									')
				or exit(print_r($PDO->errorInfo()));
				$req->execute(array(
					'Id' => $id,
					'Nom' => $nom,
					'Descr' => $desc
					)
				);

				if (isset($agc) and isset($pays) and $agc != '' and $pays != '') {
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=poles&c='.$agc.'&pays='.$pays.'&msg=ok>');
				}else{
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=poles&c=0&msg=ok>');
				}

			}
		}
?>