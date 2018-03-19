<?php 
if($Auth->user('slug') == 'admin' or $Auth->user('slug') == 'assist'){

	if(isset($_GET['pole'])){

		$id_pole = $_GET['pole'];

		global $PDO;
				$req0 = $PDO->prepare('SELECT nom_pole FROM pole WHERE id_pole = :Id');

				$req0->execute(array(
					'Id' => $id_pole
					)
				);

				$pole0 = $req0->fetch();
				$nom_pole = utf8_encode($pole0->nom_pole);


		$titre = "Nouveau projet pour l'activité $nom_pole";

		require "titre.php";
		global $PDO;
			$req = $PDO->prepare('SELECT DISTINCT Ag.nom_agc, Ag.id_agc
									FROM agence Ag, agence_pole A
									WHERE Ag.id_agc = A.id_agc
									AND A.id_pole = :Id
								');

			$req->execute(array(
					'Id' => $id_pole
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
                <input name="ref" value="1" type="hidden" />
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
				        <input disabled type="text" name="nom_pole"  placeholder="" value="<?php echo 'Activité : '.$nom_pole.''; ?>" class="form-control"  />
				    </div><br><br>


				    <div class="icon-addon addon-right">
				    	<select class="form-control" id="agence" name="agence">
                		<option value="">- Choisir l'agence à ajouter sur cette liste -</option>
                		<?php 
                			while($agc = $req->fetch()){
								$id_agc = ($agc->id_agc);
								$nom_agc = utf8_encode($agc->nom_agc);
								echo "<option value='$id_agc'>$nom_agc</option>"; 
							}

                		 ?>
                		</select>
					</div>

				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_pole" placeholder="" value="<?php echo $id_pole; ?>" class="form-control"   />
				    </div><br><br>
				    <small><i>* : champs obligatoires</i></small>

				</div><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton3()">Annuler</button>
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