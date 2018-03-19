<?php
if(isset($_POST['login'])){
	$a = $_POST['login']; 
	print_r($a);
}
global $PDO;

$req = $PDO->prepare('SELECT questSecr_collabo 
					  FROM collaborateur 
					  WHERE login_collabo=:id_collabo');
$req->execute(array(
			'id_collabo' => $a
		)
	);
	$user = $req->fetch();
	//print_r($user->questSecr_collabo);

?>

<form name="" method="post" action="index.php?p=forget">
	<input type="text" name="login" placeholder="Login" value=" <?php echo $a; ?> " />
	<input type="text" name="question" placeholder="" value="<?php echo $user->questSecr_collabo; ?>" disabled="disabled"/>
	<input type="submit" value="Envoyer"/>
</form>


<p><a href="index.php?p=login"> Retour </a></p>



