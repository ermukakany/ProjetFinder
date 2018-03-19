<?php 
$Auth->allow('collabo');
	if(!empty($_POST)){
		if($Auth->login($_POST)){
			//header('Location:index.php');
		}else{
			header('Location:index.php?p=login&msg=Login ou mot de passe incorrects');
			//echo 'Mauvais identifiants';
		}
	}

$titre = "Présentation - Page d'acceuil";
require "titre.php";
?>

<div class='container' >
<div class="row">
  <div class="col-sm-6 col-xs-3">
    <div class="thumbnail">
      <img src="http://placehold.it/250x150&text=img1" alt="">
      <div class="caption">
        <h3>Image 1</h3>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
        <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xs-3">
    <div class="thumbnail">
      <img src="http://placehold.it/250x150&text=img1" alt="">
      <div class="caption">
        <h3>Image 1</h3>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
        <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xs-3">
    <div class="thumbnail">
      <img src="http://placehold.it/250x150&text=img1" alt="">
      <div class="caption">
        <h3>Image 1</h3>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
        <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-xs-3">
    <div class="thumbnail">
      <img src="http://placehold.it/250x150&text=img1" alt="">
      <div class="caption">
        <h3>Image 1</h3>
        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
        <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
      </div>
    </div>
  </div>



</div>
<?php
if($Auth->user('slug')=='admin'){
	echo "<p><a href='index.php?p=presentation' class='btn btn-primary pull-right' style='clear:both'>Modifier</a></p> ";
}
?>
</div>

