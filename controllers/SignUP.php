<?php
require_once("controllers/Controller.php");
class SignUp extends Controller
{
	public function show()
	{
		if(isset($_SESSION['mail']))//si une session est demarrer on envoie l'utilisateur sur la page account / sinon page sign up
			header('Location: index.php?controller=Account&action=display');
		else
			return $this -> view("signUp");
	}
	public function send($bdd)//check et envoie du form d'inscription
	{
		if(isset($_SESSION['mail']))
			header('Location: index.php?controller=Account&action=display');
		else
		{
			require_once('./back/back.php');
			$city =(stripos($_POST["ville"], ',')) ? strstr($_POST["ville"],",",TRUE) : $_POST["ville"];
			$bday = substr($_POST["bday"],0,4);
			intval($bday);
			if($bday >= 2001)
				return $this -> view("signUp",["age_false" =>  "Il faut avoir plus de 18 ans"]);
			$signUp = new SendForm($_POST["last"],$_POST["first"],$_POST["genre"],$_POST["bday"],$city,$_POST["mail"],$_POST["mdp"]);
			if(!$signUp->checkMail($bdd))
			{
				$signUp->insertDb($bdd);
				$_SESSION['mail'] = $_POST["mail"];
				header('Location: index.php?controller=Profil&action=show');
			}
			else if($signUp->checkMail($bdd))
				return $this -> view("signUp",["mail_false" =>  "Mail déjà utilisé"]);
		}
	}
	public function log($bdd)//check des id lors de la connexion (mdp,compte actif) / si la session est active -> page welcome / sinon -> page account
	{
		if(!$_POST)
				return $this -> view("signUp");
		require_once('./back/back.php');
		$conn = new Log($_POST["mail"],$_POST["mdp"]);
		if(isset($_SESSION['mail']))
			header('Location: index.php?controller=Account&action=display');
		else if($conn->checkAuth($bdd))
		{
			if($conn->checkStatut($bdd))
			{
				$_SESSION['mail'] = $_POST["mail"];
				header('Location: index.php?controller=Profil&action=welcome');
			}
			else
				return $this -> view("signUp",["errCompte" =>  "Compte fermé"]);
		}
		else
			return $this -> view("signUp",["errMdp" =>  "Mail ou mot passe incorrect"]);
		}
}
?>
