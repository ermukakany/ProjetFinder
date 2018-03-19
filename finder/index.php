<?php 
session_start();
//require "entete.html";

//Instance PDO
try {

	$PDO = new PDO('mysql:host=localhost;dbname=finder_2018','root', 'youssouf123');
	//$PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ATTR_ERRMODE_WARNING);
	$PDO -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	
} catch (PDOException $e) {
	echo "Connexion impossible";
}


//Class Auth
require "class.auth.php";


ob_start();
include((isset($_GET['p'])?$_GET['p']:'home').'.php');
$content_for_layout = ob_get_clean();
?>
<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    
</head>
<body style='background-color:lightgrey; overflow:scroll;'>
	<?php require "menu.php"; ?>
	<div>
		<?php echo $content_for_layout; ?>
		<?php //print_r($_SESSION); ?>
	</div>


<!-- jQuery (nécessaire pour les plugins javascript de Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Ce fichier javascript contient tous les plugins fournis par Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

<?php 
	if(!empty($_SESSION)){
		require "footer.php";
	}


?>
<br><br><br>
</body>
</html>