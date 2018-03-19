
<?php 
if(isset($_GET['msg'])){
	if($_GET['msg'] == 'oui'){
		echo "Vous êtes déconnecté !";
	}else{
		echo "Authentification";
	}
}else{
 
	if(isset($_POST) and !empty($_POST)){
		//print_r($_POST);
		if($Auth->login($_POST)){
			die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=presentation>');
			exit();
		}
	}

	if ((isset($_POST['login']) and !empty($_POST['login']))
		or (isset($_POST['password']) and !empty($_POST['password']))) {
			
			if(empty($_POST['login'])){
				echo "<script>
						alert('Le champs Login ne doit pas être vide !'); 
					</script>";
			}else{
				if(empty($_POST['password'])){
					echo "<script>
						alert('Le champs Mot de passe ne doit pas être vide !'); 
					</script>";
				}else{
					echo "<script>
							alert('Login ou Mot de passe incorrects !'); 
						</script>";
				}
			}

	}else{
		echo "<script>
				alert('Aucun champ ne doit être vide !'); 
			</script>";
	}
}
?>

<script src="https://use.typekit.net/ayg4pcz.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link rel="stylesheet" href="styles/login.css">


<div><img src="images/soprasteria.png" class="image"></div><hr>


    <div class="container">
    
        <div class="card card-container">
        <h2 class='login_title text-center'><strong>CONNEXION</strong></h2>
        <hr>

            <form class="form-signin" name="calcul" method="post" action="">

                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title"><strong>Login</strong></p>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input type="text" name="login" placeholder="Exemple : abcdef" class="form-control" id="Textemd" required autofocus />
				        <i class="icon icon-user"></i>
				    </div><br>
				</div>
                
                <p class="input_title"><strong>Password</strong></p>
                <div class="form-group">
				    <div class="icon-addon addon-right">
				        <input type="password" name="password" placeholder="**********" class="form-control" id="Textemd" required />
				        <i class="icon icon-lock"></i>
				    </div>
				</div>

                <div id="remember" class="checkbox">
                    <label>
                        
                    </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit" name="bouton" onClick="bouton1()">Se connecter</button>
                <button class="btn btn-lg btn-primary" type="submit" onClick="bouton2()">Mot de passe oublié</button>
            
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

<script src="choix_bouton.js"></script>




