<?php 
	$Auth->allow('collabo');

	$titre = "Mon compte";

	require "titre.php";
 
	/**$req = $PDO->prepare('SELECT login_collabo from collaborateur WHERE id_collabo=:id_collabo');
	$req->execute(array(
			'id_collabo' => $Auth->user('id_collabo')
		)
	);
	$user = $req->fetch();
	print_r($user); **/
	
?>

<h3>Mon login : <?php echo utf8_encode($Auth->user('login_collabo')); ?></h3>

<h3>Ma fonction : <?php echo utf8_encode($Auth->user('fonction_collabo')); ?></h3>

<h3>Mon statut : <?php echo utf8_encode($Auth->user('nom')); ?></h3>

<p><strong></strong></p>