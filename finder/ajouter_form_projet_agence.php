<?php 
if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist'){

	if(isset($_GET['agc']) and isset($_GET['pays'])){

		$id_agc = $_GET['agc'];
		$pays = $_GET['pays'];

		global $PDO;
				$req0 = $PDO->prepare('SELECT nom_agc FROM agence WHERE id_agc = :Id');

				$req0->execute(array(
					'Id' => $id_agc
					)
				);

				$agc0 = $req0->fetch();
				$nom_agc = utf8_encode($agc0->nom_agc);


		$titre = "Nouveau projet pour l'$nom_agc";

		require "titre.php";
		global $PDO;
			$req = $PDO->prepare('SELECT DISTINCT P.nom_pole, P.id_pole
									FROM pole P, agence_pole A
									WHERE P.id_pole = A.id_pole
									AND A.id_agc = :Id
								');

			$req->execute(array(
					'Id' => $id_agc
					)
				);

}else{
	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
}		
?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Nouveau projet</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">
                <input name="ref" value="2" type="hidden" />
                <span class="reauth-email"></span>
                <div class="form-group">

                	<div class="icon-addon addon-right">
				        <input type="text" name="nom_proj"  placeholder="Nom du projet (30 caractères max) *" value="" class="form-control" />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="desc_proj"  placeholder="Description du projet (300 caractères max)" value="" class="form-control" />
				    </div><br><br>


				    <div class="icon-addon addon-right">
				        <input type="text" name="debut"  placeholder="Date de début jj/mm/aaaa *" value="" class="form-control" />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input type="text" name="effectif"  placeholder="Effectif du projet - Ex: 10" value="" class="form-control" />
				    </div><br><br>

				    <div class="icon-addon addon-right">
				        <input disabled type="text" name="nom_agc"  placeholder="" value="<?php echo $nom_agc; ?>" class="form-control"  />
				    </div><br><br>


				    <div class="icon-addon addon-right">
				    	<select class="form-control" id="pole" name="pole">
                		<option value="">- Choisir le pole à ajouter sur cette liste -</option>
                		<?php 
                			while($pole = $req->fetch()){
								$id_pole = ($pole->id_pole);
								$nom_pole = utf8_encode($pole->nom_pole);
								echo "<option value='$id_pole'>$nom_pole</option>"; 
							}

                		 ?>
                		</select>
					</div>

				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_agc" placeholder="" value="<?php echo $id_agc; ?>" class="form-control"   />
				    </div><br><br>
				    <small><i>* : champs obligatoires</i></small>

				</div><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton5()">Annuler</button>
	                <button class="btn btn-lg btn-primary pull-right" type="submit" onClick="bouton8()">Créer</button>
	            </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
<?php 
	
	if (isset($_GET['msg'])) {
		if ($_GET['msg'] == non) {
			echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
				<strong>Veuillez remplir tous les champs svp !</strong>
			 </p>";
		}else{
			if ($_GET['msg'] == num){
				echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
						<strong>Le nom du projet ne peut pas être un nombre !</strong>
					 </p>";
			}else{
				if ($_GET['msg'] == dt){
					echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
							<strong>Mauvais format de la date !</strong>
						 </p>";
				}
			}
		}
	}

} else{
	echo "Erreur inattendue !";
}
?>

<script src="choix_bouton.js"></script>