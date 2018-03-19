<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8 sans BOM">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Remplacer la ligne du dessus par celle-ci pour désativer le zoom -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Permet d'afficher un icône dans la barre d'adresse -->
        <!-- <link rel="shortcut icon" href="image/favicon.png"> -->
        <title>Bootstrap v3.3.4</title>
 
        <!-- css Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles/menu.css">
 
        <!-- HTML5 Shim et Respond.js permet à IE8 de supporter les éléments du HTML5 -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>



<?php if($Auth->user('id_collabo')): ?>
<ul class="collapse navbar-collapse navbar-ex2-collapse nav nav-tabs nav-border-color " id="myTab">
    <li class="li1">
      <a href="index.php?p=presentation" class="a1">
        <img style="widh:10px; height:60%;" src="images/soprasteria.png"><br>
        <span style="color:black; font-size:10; ">
          Bienvenue <?php echo $Auth->user('prenom_collabo'); ?>
        </span>
      </a>
    </li>
    <li class="li1">
      <a  href="index.php?p=presentation" class="a1"><strong>Accueil</strong></a>
    </li>
    <li class="li1">
      <a href="index.php?p=poles&c=0" class="a1"><strong>Pôles d'activités</strong></a>
    </li>
    <li class="li1">
      <a href="index.php?p=pays" class="a1"><strong>Agences</strong></a>
    </li>
    <?php if(
            ($Auth->user('slug') == 'admin') OR ($Auth->user('slug') == 'assist') OR ($Auth->user('slug') == 'dir')
            OR ($Auth->user('slug') == 'presi') OR ($Auth->user('slug') == 'pdg') OR ($Auth->user('slug') == 'chef_proj')

        ): ?>
      <li class="li1">
        <a href="index.php?p=admin" class="a1"><strong>Administration</strong></a>
      </li>
    <?php endif; ?>
    

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown" id="li2">
        <a data-toggle="dropdown" class="dropdown-toggle" id="a2" href="#">
          <img src="images/user.png" style='widh:20px; height:70%;'><br>
          <?php echo utf8_encode($Auth->user('login_collabo')); ?>
          <b class="caret"></b></a>
        <ul role="menu" class="dropdown-menu dropdown-menu-primary">
            <li><a href="index.php?p=compte"><strong>Mon compte</strong></a></li>
            <li><a href="index.php?p=logout"><strong>Se déconnecter</strong></a></li>
        </ul>
      </li>
    </ul>


    <div style="float:right;">
      <form class="navbar-form navbar-left" role="search" action='index.php?p=presentation'>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher">
        </div>
        <button type="submit" class="btn btn-primary"><i class="icon icon-search"></i></button>
      </form>
    </div>
</ul>
<?php endif; ?>



