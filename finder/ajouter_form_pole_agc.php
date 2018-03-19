<?php 
$Auth->allow('admin'); 

if(isset($_GET['agc'])){

	$id_agc = $_GET['agc'];

	global $PDO;
			$req0 = $PDO->prepare('SELECT nom_agc FROM agence WHERE id_agc = :Id');

			$req0->execute(array(
				'Id' => $id_agc
				)
			);

			$agc0 = $req0->fetch();
			$nom_agc = utf8_encode($agc0->nom_agc);


	$titre = "Ajout d'un pôle dans l'$nom_agc - Choisir un pôle";

	require "titre.php";
	global $PDO;
		$req = $PDO->prepare('SELECT DISTINCT P.nom_pole, P.id_pole
								FROM pole P, agence_pole A
								WHERE P.id_pole = A.id_pole
								AND A.id_agc <> :Id
								AND A.id_pole NOT IN (
														SELECT id_pole 
														FROM agence_pole 
														WHERE id_agc = :Id)
								
								UNION

								SELECT nom_pole, id_pole 
								FROM pole 
								WHERE id_pole 
								NOT IN (
										SELECT id_pole 
										FROM agence_pole)');

		$req->execute(array(
				'Id' => $id_agc
				)
			);


		/*while($pole = $req->fetch()){

			echo utf8_encode($pole->id_pole); echo "<br>";
			echo utf8_encode($pole->nom_pole);echo "<br>";
		}*/

		//echo $nv_pole

	
?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Nouveau pôle</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">
                <span class="reauth-email"></span>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input disabled type="text" name="nom_agc"  placeholder="" value="<?php echo $nom_agc; ?>" class="form-control"  />
				    </div><br><br>


				    <div class="icon-addon addon-right">
				    	<select class="form-control" id="pole" name="pole">
                		<option value="">Choisir le pôle à ajouter sur cette liste</option>
                		<?php 
                			while($pole = $req->fetch()){
								$id_pole = utf8_encode($pole->id_pole);
								$nom_pole = utf8_encode($pole->nom_pole);
								echo "<option value='$id_pole'>$nom_pole</option>"; 
							}

                		 ?>
                		</select>
					</div>

				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_agc" placeholder="" value="<?php echo $id_agc; ?>" class="form-control"   />
				    </div><br><br>

				</div><br><br><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton5()">Annuler</button>
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

} else{
	echo "Erreur inattendue !";
}
?>

<script src="choix_bouton.js"></script>