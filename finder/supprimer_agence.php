<?php

if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist') {
	
	if (isset($_GET['agc']) and isset($_GET['pays'])) {
		$id_agc = $_GET['agc'];
		$pays = $_GET['pays'];

		//Suppression de l'agence depuis la table agence
		global $PDO;
			$req = $PDO->prepare('DELETE FROM agence WHERE id_agc = :Id')

			or exit(print_r($PDO->errorInfo()));
			$req->execute(array(
				'Id' => $id_agc
				)
			);


		//Suppression de l'agence depuis la table agence_pole (si elle existe)
		//On teste d'abord si elle existe
		global $PDO;
			$req0 = $PDO->prepare('SELECT id_agc FROM agence_pole WHERE id_agc = :Id')

			or exit(print_r($PDO->errorInfo()));
			$req0->execute(array(
				'Id' => $id_agc
				)
			);

			$data = $req0 -> fetchAll();
			if(count($data)>0){

					//Suppression
					global $PDO;
						$req00 = $PDO->prepare('DELETE FROM agence_pole WHERE id_agc = :Id')

						or exit(print_r($PDO->errorInfo()));
						$req00->execute(array(
							'Id' => $id_agc
							)
						);

			}

		//Suppression du pole depuis la table projet (s'il existe)
		//On teste d'abord s'il existe
		global $PDO;
			$req1 = $PDO->prepare('SELECT id_agc FROM projet WHERE id_agc = :Id')

			or exit(print_r($PDO->errorInfo()));
			$req1->execute(array(
				'Id' => $id_agc
				)
			);

			$data = $req1 -> fetchAll();
			if(count($data)>0){

					//Suppression
					global $PDO;
						$req11 = $PDO->prepare('DELETE FROM projet WHERE id_agc = :Id')

						or exit(print_r($PDO->errorInfo()));
						$req11->execute(array(
							'Id' => $id_agc
							)
						);

			}

		//On teste si l'id du plan de l'agence existe dans la table plan
		global $PDO;
			$req2 = $PDO->prepare('SELECT P.id_plan FROM plan P, Agence A 
									WHERE P.id_plan = A.idPlan_agc
									AND A.id_agc = :Id
								 ')

			or exit(print_r($PDO->errorInfo()));
			$req2->execute(array(
				'Id' => $id_agc
				)
			);

			$data = $req2 -> fetch();
			if(count($data)>0){

					$id_plan = ($data->id_plan);

					//Suppression
					global $PDO;
						$req22 = $PDO->prepare('DELETE FROM plan WHERE id_plan = :Id')

						or exit(print_r($PDO->errorInfo()));
						$req22->execute(array(
							'Id' => $id_plan
							)
						);

			}

		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=agences&pays='.$pays.'&msg=oks>');

	}else{
		if (isset($_GET['agc']) and isset($_GET['pole'])) {
			$id_agc = $_GET['agc'];
			$id_pole = $_GET['pole'];

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

			die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=agences&pole='.$id_pole.'&msg=oks>');

		}
	}

}else{
	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden');
}

?>

