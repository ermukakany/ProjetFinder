<?php 
$Auth->allow('admin'); 

	if(isset($_GET['pole'])){

		$id_pole = $_GET['pole'];

	}else{
		if (isset($_GET['agc']) and isset($_GET['pays']) and isset($_GET['poles'])) {
			
			$id_agc = $_GET['agc'];
			$pays = $_['pays'];
			$id_pole = $_GET['poles'];
		}else{
			echo "<h3>Erreur inconnue ! Réessayer ...</h3>";
			exit();
		}
	}

	global $PDO;
		$req = $PDO->prepare('SELECT id_pole, nom_pole, desc_pole
							  FROM pole
							  WHERE id_pole = :Id
							');

		$req->execute(array(
					'Id' => $id_pole
					)
				);


		$pole = $req->fetch();
		$idPole = utf8_encode($pole->id_pole);
		$nom_pole = utf8_encode($pole->nom_pole);
		$desc_pole = utf8_encode($pole->desc_pole);

		//echo $nv_pole
	$titre = "Modification du pôle $nom_pole - Saisir les informations à modifier";
	require "titre.php";


?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Modifier le pôle</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">

                <input name="agc" value="<?php if(isset($id_agc)){echo $id_agc;} ?>" type="hidden" />
                <input name="pays" value="<?php if(isset($pays)){echo $pays;} ?>" type="hidden" />
                <span class="reauth-email"></span>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_pole" placeholder="" value="<?php echo $id_pole; ?>" class="form-control" />
				    </div>

				    <div class="icon-addon addon-right">
				        <input type="text" disabled name="idPole" placeholder="" value="<?php echo $idPole; ?>" class="form-control" />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="nom_pole" placeholder="Nom du pôle*" value="<?php echo $nom_pole; ?>" class="form-control" required autofocus />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="desc_pole" placeholder="Description du pôle" value="<?php echo $desc_pole; ?>" class="form-control" />
				    </div><br><br>
				    <small><i>* : champs obligatoires</i></small>
				</div><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="<?php if(isset($id_agc)){echo 'bouton5()';}else{echo 'bouton3()';} ?>">Annuler</button>
	                <button class="btn btn-lg btn-primary pull-right" type="submit" onClick="bouton9()">Modifier</button>
	            </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

	<?php
		if (isset($_GET['msg'])) {
			echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
					<strong>Le champ 'Nom du pôle' ne doit pas être vide.</strong>
				 </p>";
		}
	?>


    <script src="choix_bouton.js"></script>