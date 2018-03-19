<?php

if($Auth->user('slug') == 'admin') {
	
	if (isset($_GET['pole'])) {
		$id_pole = $_GET['pole'];

		//Suppression du pole depuis la table pole
		global $PDO;
			$req = $PDO->prepare('DELETE FROM pole WHERE id_pole = :Id')

			or exit(print_r($PDO->errorInfo()));
			$req->execute(array(
				'Id' => $id_pole
				)
			);


		//Suppression du pole depuis la table agence_pole (s'il existe)
		//On teste d'abord s'il existe
		global $PDO;
			$req0 = $PDO->prepare('SELECT id_pole FROM agence_pole WHERE id_pole = :Id')

			or exit(print_r($PDO->errorInfo()));
			$req0->execute(array(
				'Id' => $id_pole
				)
			);

			$data = $req0 -> fetchAll();
			if(count($data)>0){

					//Suppression
					global $PDO;
						$req00 = $PDO->prepare('DELETE FROM agence_pole WHERE id_pole = :Id')

						or exit(print_r($PDO->errorInfo()));
						$req00->execute(array(
							'Id' => $id_pole
							)
						);

			}

		//Suppression du pole depuis la table projet (s'il existe)
		//On teste d'abord s'il existe
		global $PDO;
			$req1 = $PDO->prepare('SELECT id_pole FROM projet WHERE id_pole = :Id')

			or exit(print_r($PDO->errorInfo()));
			$req1->execute(array(
				'Id' => $id_pole
				)
			);

			$data = $req1 -> fetchAll();
			if(count($data)>0){

					//Suppression
					global $PDO;
						$req11 = $PDO->prepare('DELETE FROM projet WHERE id_pole = :Id')

						or exit(print_r($PDO->errorInfo()));
						$req11->execute(array(
							'Id' => $id_pole
							)
						);

			}

		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=poles&c=0&msg=oks>');
	}else{
		if (isset($_GET['agc']) and isset($_GET['pays']) and isset($_GET['poles'])) {
			$id_agc = $_GET['agc'];
			$pays = $_GET['pays'];
			$id_pole = $_GET['poles'];

			//print $id_agc;


			//Suppression du pole depuis la table agence_pole
			global $PDO;
				$req = $PDO->prepare('DELETE FROM agence_pole 
									  WHERE id_pole = :IdP
									  AND id_agc = :IdA
									')

				or exit(print_r($PDO->errorInfo()));
				$req->execute(array(
					'IdP' => $id_pole,
					'IdA' => $id_agc
					)
				);

			//On teste si le pole existe dans la table projet ensuite on le supprime
			global $PDO;
				$req1 = $PDO->prepare('SELECT id_agc, id_pole 
									   FROM projet 
									   WHERE id_agc = :IdA
									   AND id_pole = :IdP
									 ')

				or exit(print_r($PDO->errorInfo()));
				$req1->execute(array(
					'IdA' => $id_agc,
					'IdP' => $id_pole
					)
				);

				$data = $req1 -> fetchAll();
				if(count($data)>0){

						//Suppression
						global $PDO;
							$req11 = $PDO->prepare('DELETE FROM projet 
													WHERE id_pole = :IdP
													AND id_agc = :IdA
												  ')

							or exit(print_r($PDO->errorInfo()));
							$req11->execute(array(
								'IdP' => $id_pole,
								'IdA' => $id_agc
								)
							);

				}

			die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=poles&c='.$id_agc.'&pays='.$pays.'&msg=oks>');

		}
	}

}else{
	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden');
}

?>

