<?php
require_once("controllers/Controller.php");
class Account extends Controller
{
	public function display($bdd)
	{
		require_once('./back/back.php');
		$compte = new compte ($_SESSION['mail']);
		$profil = $compte -> getProfil($bdd);
		return $this -> view("account",[
			"sexe" =>  $profil[2],
			"nom" => $profil[0],
			"prenom" => $profil[1],
			"naissance" => $profil[3],
			"ville" => $profil[4],
			"mail" => $profil[5]
		]);
	}
	public function modify($bdd)
	{
		return $this -> view("modify",["mail" => $_SESSION['mail']]);
	}
	public function sendModification($bdd)
	{
		require_once('./back/back.php');
		$update = new Modify($_SESSION['mail'],$_POST["mail"],$_POST["mdp"]); //création d'une instance avec les infos utilisateur
		if(!$update -> checkMail($bdd))//si checkMail renvoie false alors on modifie le mail et ou le mot de passe
		{
			$update -> updateDb($bdd);
			$_SESSION['mail'] = $_POST["mail"]; //session vaux le nouveau mail
			require_once('./back/back.php');
			$compte = new compte ($_SESSION['mail']);
			$profil = $compte -> getProfil($bdd);
			return $this -> view("account",[
				"sexe" =>  $profil[2],
				"nom" => $profil[0],
				"prenom" => $profil[1],
				"naissance" => $profil[3],
				"ville" => $profil[4],
				"mail" => $profil[5],
				"succes_update" =>  "succes"
			]);
			//return $this -> view("account",["succes_update" =>  "succes"]);
			//header('Location: index.php?controller=Account&action=displayMsgUpdateSucces');
		}
		else
		{
			return $this -> view("modify",[
				"mailFalse" =>  "Mail déjà utilisé"
			]);
		}
	}
	public function delete($bdd)
	{
		require_once('./back/back.php');
		$delete = new Delete($_SESSION['mail']);
		$delete -> updateDb($bdd);
		session_start ();
		session_unset ();
		session_destroy ();
		return $this -> view("signUp",["delete_succes" =>  "Compte fermé"]);
	}
	public function crud($bdd)
	{
		if(isset($_POST["modify"]))
			$this->modify($bdd);
		else if(isset($_POST["sendMofification"]))
		{
			$this->sendModification($bdd);
		}
		else if(isset($_POST["delete"]))
		{
			$this->delete($bdd);
		}
		else
		{
			return $this -> view("modify",[
				"mail" => $_SESSION['mail']
			]);
		}
	}
}
?>
