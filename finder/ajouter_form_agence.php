<?php 
	if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist'){

		if(isset($_GET['pays'])){

			$pays = $_GET['pays'];

			$titre = "Ajout d'une nouvelle agence pour $pays - Saisir les informations de la nouvelle agence";
			require "titre.php";
			global $PDO;
				$req0 = $PDO->prepare('SELECT max(id_agc + 1) AS nv_agc FROM agence');

				$req0->execute();

				$agc0 = $req0->fetch();
				$nv_agc = ($agc0->nv_agc);

				//echo $nv_pole
		}else{
			echo "<h3>Erreur inconnue ! Réessayer ...</h3>";
		}

	}else{
		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
	}
?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Nouvelle agence</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="index.php?p=ajouter_agence">

                <input name="ref" value="1" type="hidden" />
                <span class="reauth-email"></span>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_agc" placeholder="" value="<?php echo $nv_agc; ?>" class="form-control" />
				    </div>

				    <div class="icon-addon addon-right">
				        <input type="hidden" name="pays" placeholder="" value="<?php echo $pays; ?>" class="form-control" />
				    </div>

				    <div class="icon-addon addon-right">
				        <input type="text" name="nom_agc" placeholder="Nom de l'agence : Ex: Agence de Lyon*" class="form-control"  />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="adresse" placeholder="Adresse de l'agence : Ex: Lyon" class="form-control" /><br><br>
				    </div>
				    <small><i>* : champs obligatoires</i></small>

				    
				</div><br><br><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton5()">Annuler</button>
	                <button class="btn btn-lg btn-primary pull-right" type="submit" onClick="bouton6()">Créer</button>
	            </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

	<?php
		if (isset($_GET['msg'])) {
			echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
					<strong>Le champ 'Nom de l'agence' ne doit pas être vide.</strong>
				 </p>";
		}
	?>


    <script src="choix_bouton.js"></script>