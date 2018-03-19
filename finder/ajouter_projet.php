<?php  
if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist'){
	if (isset($_POST['ref']) and $_POST['ref'] == 1) {

		if(isset($_POST['nom_proj']) 
			and isset($_POST['desc_proj']) 
			and isset($_POST['debut']) 
			and isset($_POST['effectif']) 
			and isset($_POST['id_pole'])
			and isset($_POST['agence'])){

			
				$nom_proj = htmlspecialchars($_POST['nom_proj']);
				$desc_proj = htmlspecialchars($_POST['desc_proj']);
				$debut = htmlspecialchars($_POST['debut']);
				$effectif = htmlspecialchars($_POST['effectif']);
				$id_pole = htmlspecialchars($_POST['id_pole']);
				$id_agc = ($_POST['agence']);

				$nom_proj = utf8_decode($nom_proj);
				$desc_proj = utf8_decode($desc_proj);


				if (($nom_proj == '') or ($debut == '') or ($id_agc == '')) {
					die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_projet_pole&pole='.$id_pole.'&msg=non>');
				}else{
					if(is_numeric($nom_proj)){
						die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_projet_pole&pole='.$id_pole.'&msg=num>');
					}else{
							if(!preg_match( '`(\d{1,2})/(\d{1,2})/(\d{4})`' , $debut ) ){
								die ('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_projet_pole&pole='.$id_pole.'&msg=dt>');
							}else{

								$debut = explode("/", $debut);
								$date_deb=$debut[2].'-'.$debut[1].'-'.$debut[0];
								
								
								global $PDO;
								$req0 = $PDO->prepare('SELECT max(id_proj + 1) AS id_proj FROM projet');

								$req0->execute();

								$proj0 = $req0->fetch();
								$id_proj = ($proj0->id_proj);


								global $PDO;

								$req = $PDO->prepare('INSERT INTO projet 

									(id_proj, id_agc, id_pole, nom_proj, desc_proj, dateDeb_proj, effectif_proj) 

									VALUES (:IdProj, :IdAg, :IdPo, :NomProj, :DescProj, :Deb, :Eff)
													')
								or exit(print_r($PDO->errorInfo()));
								$req->execute(array(
									'IdProj' => $id_proj,
									'IdAg' => $id_agc,
									'IdPo' => $id_pole,
									'NomProj' => $nom_proj,
									'DescProj' => $desc_proj,
									'Deb' => $date_deb,
									'Eff' => $effectif
									)
								);

								die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=projets&pole='.$id_pole.'&msg=ok>');

							}
						
						}
					}
					
			}
	}else{

			if (isset($_POST['ref']) and $_POST['ref'] == 2) {

				if(isset($_POST['nom_proj']) 
					and isset($_POST['desc_proj']) 
					and isset($_POST['debut']) 
					and isset($_POST['effectif']) 
					and isset($_POST['id_agc'])
					and isset($_POST['pole'])){

					
						$nom_proj = htmlspecialchars($_POST['nom_proj']);
						$desc_proj = htmlspecialchars($_POST['desc_proj']);
						$debut = htmlspecialchars($_POST['debut']);
						$effectif = htmlspecialchars($_POST['effectif']);
						$id_agc = htmlspecialchars($_POST['id_agc']);
						$id_pole = ($_POST['pole']);

						$nom_proj = utf8_decode($nom_proj);
						$desc_proj = utf8_decode($desc_proj);

						
						global $PDO;
						$req1 = $PDO->prepare('SELECT P.nom_pays 
												FROM pays P, agence A
												WHERE P.id_pays = A.id_pays
												AND A.id_agc = :Id');

						$req1->execute(array(
							'Id' => $id_agc
							)
						);

						$pays1 = $req1->fetch();
						$pays = ($pays1->nom_pays);



						if (($nom_proj == '') or ($debut == '') or ($id_pole == '')) {
							die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_projet_agence&agc='.$id_agc.'&pays='.$pays.'&msg=non>');
						}else{
							if(is_numeric($nom_proj)){
								die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_projet_agence&agc='.$id_agc.'&pays='.$pays.'&msg=num>');
							}else{
									if(!preg_match( '`(\d{1,2})/(\d{1,2})/(\d{4})`' , $debut ) ){
										die ('<META HTTP-equiv="refresh" content=0;URL=index.php?p=ajouter_form_projet_agence&agc='.$id_agc.'&pays='.$pays.'&msg=dt>');
									}else{

										$debut = explode("/", $debut);
										$date_deb=$debut[2].'-'.$debut[1].'-'.$debut[0];
										//echo $date_deb;
										
										global $PDO;
										$req0 = $PDO->prepare('SELECT max(id_proj + 1) AS id_proj FROM projet');

										$req0->execute();

										$proj0 = $req0->fetch();
										$id_proj = ($proj0->id_proj);


										global $PDO;

										$req = $PDO->prepare('INSERT INTO projet 

											(id_proj, id_agc, id_pole, nom_proj, desc_proj, dateDeb_proj, effectif_proj) 

											VALUES (:IdProj, :IdAg, :IdPo, :NomProj, :DescProj, :Deb, :Eff)
															')
										or exit(print_r($PDO->errorInfo()));
										$req->execute(array(
											'IdProj' => $id_proj,
											'IdAg' => $id_agc,
											'IdPo' => $id_pole,
											'NomProj' => $nom_proj,
											'DescProj' => $desc_proj,
											'Deb' => $date_deb,
											'Eff' => $effectif
											)
										);

										die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=projets&agence='.$id_agc.'&pays='.$pays.'&msg=ok>');

									}
								
								}
							}
							
					}
			}
		
	}
}else{
	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
}
?>