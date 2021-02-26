<?php
require_once("controllers/Controller.php");
class Profil extends Controller
{
	public function show()//si la session est active -> page profil / sinon -> page sign up
	{
		if(isset($_SESSION['mail']))
			return $this -> view("profil");
		else
			header('Location: index.php?controller=SignUp&action=show');
	}
	public function welcome()//popup welcome en cas de connexion
	{
		if(isset($_SESSION['mail']))
			return $this -> view("profil",["welcome" => "welcome"]);
		else
			header('Location: index.php?controller=SignUp&action=show');
	}
	public function showProfil($bdd)//si une recherche de profil est faite on renvoie les profils trouvé / sinon -> page profil
	{
		if($_POST)
		{
			$inputTab = explode("|", $_POST["city"]);
			$i = 0;
			while($i < count($inputTab))
			{
				$inputTab[$i] = (stripos($inputTab[$i], ',')) ? "\"".strstr($inputTab[$i],",",TRUE)."\"" : "\"".$inputTab[$i]."\"";
				$i++;
			}
			require_once('./back/back.php');
			$city ="(".implode(",", $inputTab).")";
			$profil = new SeekProfil($_POST["genre"],$_POST["age"],$city);
			$filter = $profil->getProfil($bdd);
			if(count($filter) != 0)
			return $this -> view("profil",[
				"profil_found" =>  $filter
			]);
			else
			return $this -> view("profil",["not_found" =>  "Aucun profil trouvé"]);
		}
		else
			header('Location: index.php?controller=Profil&action=show');
	}
}
?>
