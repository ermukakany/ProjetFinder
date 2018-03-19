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


		$titre = "Ajout d'une agence dans le pôle $nom_pole - Choisir une agence";

		require "titre.php";
		global $PDO;
			$req = $PDO->prepare('SELECT DISTINCT Ag.nom_agc, Ag.id_agc
									FROM agence Ag, agence_pole A
									WHERE Ag.id_agc = A.id_agc
									AND A.id_pole <> :Id
									AND A.id_agc NOT IN (
															SELECT id_agc 
															FROM agence_pole 
															WHERE id_pole = :Id)
									
									UNION

									SELECT nom_agc, id_agc
									FROM agence 
									WHERE id_agc
									NOT IN (
											SELECT id_agc 
											FROM agence_pole)');

			$req->execute(array(
					'Id' => $id_pole
					)
				);


			/*while($pole = $req->fetch()){

				echo utf8_encode($pole->id_pole); echo "<br>";
				echo utf8_encode($pole->nom_pole);echo "<br>";
			}*/

			//echo $nv_pole

}else{
	die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
}		
?>

<div class="container">
    
        <div class="card card-container" style='border-style:solid; border-width:1px; border-radius:10px; border-color:#5985C8; box-shadow:5px 5px 5px #666666;'>
        <h2 class='login_title text-center'><strong>Nouveau pôle</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">
                <span class="reauth-email"></span>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input disabled type="text" name="nom_pole"  placeholder="" value="<?php echo $nom_pole; ?>" class="form-control"  />
				    </div><br><br>


				    <div class="icon-addon addon-right">
				    	<select class="form-control" id="agence" name="agence">
                		<option value="">Choisir l'agence à ajouter sur cette liste</option>
                		<?php 
                			while($agc = $req->fetch()){
								$id_agc = utf8_encode($agc->id_agc);
								$nom_agc = utf8_encode($agc->nom_agc);
								echo "<option value='$id_agc'>$nom_agc</option>"; 
							}

                		 ?>
                		</select>
					</div>

				    <div class="icon-addon addon-right">
				        <input type="hidden" name="id_pole" placeholder="" value="<?php echo $id_pole; ?>" class="form-control"   />
				    </div><br><br>

				</div><br><br><hr>

                <div>
	                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton7()">Annuler</button>
	                <button class="btn btn-lg btn-primary pull-right" type="submit" onClick="bouton6()">Créer</button>
	            </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
<?php 
	
	if (isset($_GET['msg'])) {
		echo "<p style='background-color:white; width:100%; color:red; text-align:center;'>
				<strong>Le champ 'Nom de l'agence ne doit pas être vide.</strong>
			 </p>";
	}

} else{
	echo "Erreur inattendue !";
}
?>

<script src="choix_bouton.js"></script>