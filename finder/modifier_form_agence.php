<?php 
if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist'){

	if(isset($_GET['agc']) and isset($_GET['pays'])){

		$id_agc = $_GET['agc'];
		$pays = $_GET['pays'];

	}else{
		if (isset($_GET['agc']) and isset($_GET['pole'])) {
			
			$id_agc = $_GET['agc'];
			$id_pole = $_GET['pole'];
		}else{
			echo "<h3>Erreur inconnue ! Réessayer ...</h3>";
			exit();
		}
	}

	global $PDO;
		$req = $PDO->prepare('SELECT A.id_agc, A.nom_agc, P.nom_pays, A.localisation_agc, A.latitude_agc, A.longitude_agc
							  FROM agence A, pays P
							  WHERE A.id_pays = P.id_pays
							  AND A.id_agc = :Id
							');

		$req->execute(array(
					'Id' => $id_agc
					)
				);


		$agc = $req->fetch();
		$idAgc = utf8_encode($agc->id_agc);
		$nom_agc = utf8_encode($agc->nom_agc);
		$nom_pays = utf8_encode($agc->nom_pays);
		$localisation = utf8_encode($agc->localisation_agc);
		$latitude = utf8_encode($agc->latitude_agc);
		$longitude = utf8_encode($agc->longitude_agc);

		//echo $nv_pole
	$titre = "Modification du pôle $nom_pole - Saisir les informations à modifier";
	require "titre.php";

}else{
	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
}

?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Modifier le pôle</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">

                <input name="pole" value="<?php if(isset($id_pole)){echo $id_pole;} ?>" type="hidden" />
                <input name="pays" value="<?php if(isset($pays)){echo $pays;} ?>" type="hidden" />
                <span class="reauth-email"></span>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_agc" placeholder="" value="<?php echo $id_agc; ?>" class="form-control" />
				    </div>

				    <div class="icon-addon addon-right">
				        <input type="text" name="idAgc" disabled placeholder="" value="<?php echo $idAgc; ?>" class="form-control" />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="nom_agc" placeholder="Nom de l'agence*" value="<?php echo $nom_agc; ?>" class="form-control" required autofocus />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="nom_pays" disabled placeholder="" value="<?php echo $nom_pays; ?>" class="form-control"  />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="localisation" placeholder="Localisation" value="<?php echo $localisation; ?>" class="form-control"  />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="latitude" placeholder="Latitude" value="<?php echo $latitude; ?>" class="form-control"  />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="longitude" placeholder="Longitude" value="<?php echo $longitude; ?>" class="form-control" />
				    </div><br><br>
				    <small><i>* : champs obligatoires</i></small>
				</div><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="<?php if(isset($pays)){echo 'bouton5()';}else{echo 'bouton3()';} ?>">Annuler</button>
	                <button class="btn btn-lg btn-primary pull-right" type="submit" onClick="bouton10()">Modifier</button>
	            </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

	<?php
		if (isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 'num') {
				echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
					<strong>Le champ 'Nom agence' ne doit être ni vide ni numérique.</strong>
				 </p>";
			}else{
				if ($msg == 'fl') {
					echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
						<strong>Les champs 'Latitude' et 'Longitude' doivent être des décimaux.</strong>
					 </p>";
				}
			}
		}
	?>


    <script src="choix_bouton.js"></script>