<?php 
	if($Auth->user('slug') != 'collabo'){
		$permission = $Auth->user('slug');

		$Auth->allow('$permission');

		//echo $permission;
	}else{
		die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
	}

$titre = "Administration - Cette page est restreinte";
require "titre.php";
?> 
