<?php 
$Auth->allow('admin'); 

	$titre = "Ajout d'un nouveau pôle - Saisir les informations du nouveau pôle";
	require "titre.php";
	global $PDO;
		$req0 = $PDO->prepare('SELECT max(id_pole + 1) AS nv_pole FROM pole');

		$req0->execute();

		$pole0 = $req0->fetch();
		$nv_pole = ($pole0->nv_pole);

		//echo $nv_pole

	
?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Nouveau pôle</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">

                <input name="ref" value="1" type="hidden" />
                <span class="reauth-email"></span>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_pole" placeholder="" value="<?php echo $nv_pole; ?>" class="form-control" />
				    </div>

				    <div class="icon-addon addon-right">
				        <input type="text" name="nom_pole" placeholder="Nom du pôle" class="form-control" required autofocus />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="desc" placeholder="Description du pôle" class="form-control" />
				    </div><br><br>
				    <small><i>* : champs obligatoires</i></small>
				</div><br><br><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton3()">Annuler</button>
	                <button class="btn btn-lg btn-primary pull-right" type="submit" onClick="bouton4()">Créer</button>
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