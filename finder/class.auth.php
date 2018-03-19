
<?php
	/**
	* Permet d'identifier un utilisateur
	*/
	class Auth
	{
		var $forbiddenPage = 'index.php?p=forbidden';
		
		function login($d){
			global $PDO;
			$req = $PDO->prepare('SELECT C.id_collabo, C.nom_collabo, C.prenom_collabo, C.login_collabo, C.fonction_collabo, S.nom, S.slug, S.niveau
								  FROM collaborateur C, statut S
								  WHERE C.id_statut = S.id_statut
								  AND C.login_collabo=:login 
								  AND C.mdp_collabo =:password');
			$req -> execute($d);
			$data = $req -> fetchAll();
			//print_r($data);
			if(count($data)>0){
				$_SESSION['Auth'] = $data[0];
				return true;
			}
			return false;
		}

		/**
		* Autorise un rang à accéder à une page, redirige vers forbidden sinon
		**/
		function allow($rang){
			global $PDO;
			$req = $PDO->prepare('SELECT slug, niveau
								  FROM statut');
			$req -> execute();
			$statut = array();
			$data = $req -> fetchAll();
			foreach ($data as $d) {
				$statut[$d->slug] = $d->niveau;
			}

			if(!$this->user('slug')){
				$this->forbidden();
			} else{
				if ($statut[$rang] > $this->user('niveau')) {
					$this->forbidden();
				} else{
					return true;
				}
			}
			 
		}

		/**
		*Récupère un info utilisateur
		**/
		function user($field){
			if(isset($_SESSION['Auth']->$field)){
				return $_SESSION['Auth']->$field;
			}else{
				return false;
			}
		}

		/**
		*Redirige un utilisateur
		**/
		function forbidden(){
			die('<META HTTP-equiv="refresh" content=0;URL=index.php?p=forbidden>');
			//header('Location:'.$this->forbiddenPage);
		}

	}

	$Auth = new Auth();
?>