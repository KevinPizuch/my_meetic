<?php

class Delete
{
	private $mail;
	function  __construct($mail)
    {
    	$this->setMail($mail);
    }
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function updateDb($bdd)//met le statut nonActif en cas de suppression du compte
	{
		try {
			$reponse = $bdd->prepare("UPDATE inscription SET statut=\"nonActif\" WHERE mail=?");
			$reponse->execute(array($this->mail));
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}
}

class SeekProfil
{
	private $genre;
	private $age;
	private $ville;
    function  __construct($genre,$age,$ville)
    {
	    $this->setGenre($genre);
	    $this->setAge($age);
	    $this->setVille($ville);
    }
	public function setAge($age)
	{
		$this->age = $age;
	}
	public function setVille($ville)
	{
		$this->ville = $ville;
	}
	public function setGenre($genre)
	{
		$this->genre = $genre;
	}

	public function getProfil($bdd)//requete bdd pour trouver les profils correspondant au infos saisie par l'utilisateur
	{
		$tab = [];
		$mail = $_SESSION["mail"];
		$min = ($this->age == 18) ? "year(curdate()) - year(naissance) >= '18' AND" : (($this->age == 25) ? "year(curdate()) - year(naissance) >= '25' AND" : (($this->age == 35) ? "year(curdate()) - year(naissance) >= '35' AND" : "year(curdate()) - year(naissance) >= '45' AND"));
		$max = ($this->age == 18) ? $min." year(curdate()) - year(naissance) < '25'" : (($this->age == 25) ? $min." year(curdate()) - year(naissance) < '35'" : (($this->age == 35) ? $min." year(curdate()) - year(naissance) < '45'" : "year(curdate()) - year(naissance) > '45'"));
		if($reponse = $bdd->query("SELECT nom,prenom,genre,TIMESTAMPDIFF(year,naissance, CURDATE()),ville,mail FROM inscription WHERE genre = '$this->genre' AND ville in $this->ville AND $max AND statut = \"actif\" AND mail != \"$mail\" "))
		{
			while ($row = $reponse->fetch()) {
				array_push($tab, $row);
			}
		}
		return $tab;
	}
}

class Log
{
	private $mail;
	private $mdp;
    function  __construct($mail,$mdp)
    {
    	$this->setMail($mail);
	    $this->setMdp($mdp);
    }
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function setMdp($mdp)
	{
		$this->mdp = $mdp;
	}
	public function checkAuth($bdd)//check le mdp
	{
		$flag = false;
		$reponse = $bdd->prepare("SELECT mdp FROM inscription WHERE mail = ?");
		if($reponse->execute(array($this->mail)))
		{
			while ($row = $reponse->fetch()) {
				if(password_verify($this->mdp , $row['mdp']))
					$flag = true;
			}
		}
		return $flag;
	}
	public function checkStatut($bdd)//check si le compte est toujours actif
	{
		$reponse = $bdd->prepare("SELECT statut FROM inscription WHERE mail = ?");
		if($reponse->execute(array($this->mail)))
		{
			if($row = $reponse->fetch()) {
				return ($row["statut"] == "actif") ? true : false;
			}
		}
	}
}

class Compte
{
	private $mail;
    function  __construct($mail)
    {
    	$this->setMail($mail);
    }
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function getProfil($bdd)//prend les infos de l'utilisateur pour les afficher sur la page account
	{
		$reponse = $bdd->prepare("SELECT nom,prenom,genre,TIMESTAMPDIFF(year,naissance, CURDATE()),ville,mail FROM inscription WHERE mail = ?");
		if($reponse->execute(array($this->mail)))
		{
			if($row = $reponse->fetch()) {
				return $row;
			}
		}
	}
}

class Contact
{
	private $mail;

    function  __construct($mail)
    {
    	$this->setMail($mail);
    }
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function getContact($bdd)//prend les infos de l'utilisateur pour les afficher sur la page account
	{
		$tab = [];
		$mail = $_SESSION['mail'];
		if($reponse = $bdd->query("SELECT * FROM messages WHERE msg_to = '$mail'"))
		{
			while ($row = $reponse->fetch()) {
				array_push($tab, $row);
			}
		}
		return $tab;
	}
	public function getMsg($bdd)//prend les infos de l'utilisateur pour les afficher sur la page account
	{
		$tab = [];
		$mail = $_SESSION['msg'];
		$mail1 = $_SESSION['mail'];
		if($reponse = $bdd->query("SELECT * FROM messages WHERE msg_to = '$mail' AND msg_from = '$mail1' OR msg_to = '$mail1' AND msg_from = '$mail' ORDER BY date ASC  "))
		{
			while ($row = $reponse->fetch()) {
				array_push($tab, $row);
			}
		}
		return $tab;
	}
}

class Send
{
	private $mail;
	private $msg;
	private $id;

	function  __construct($mail,$msg,$id)
	{
		$this->setMail($mail);
		$this->setMsg($msg);
		$this->setId($id);
	}
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function setMsg($msg)
	{
		$this->msg= $msg;
	}
	public function setId($id)
	{
		$this->id= $id;
	}

	public function sendMsg($bdd)
	{
		try {
			$reponse = $bdd->prepare("INSERT INTO messages(msg_from, msg_to, message, date) VALUES (?,?,?,NOW())");
			$reponse->execute(array($this->mail,$this->id,$this->msg));
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}
}

class Modify
{
	private $mail;
	private $mdp;
	private $currentMail;
    function  __construct($currentMail,$mail,$mdp)
    {
    	$this->setcurrentMail($currentMail);
    	$this->setMail($mail);
	    $this->setMdp(password_hash($mdp, PASSWORD_DEFAULT));
    }
	public function setcurrentMail($currentMail)
	{
		$this->currentMail= $currentMail;
	}
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function setMdp($mdp)
	{
		$this->mdp = $mdp;
	}
	public function checkMail($bdd)//check si le nouveau mail existe deja dans la bdd et qu'il est different de l'ancien mail
	{
		$flag = false;
		if($reponse = $bdd->query("SELECT mail FROM inscription"))
		{
			while ($row = $reponse->fetch()) {
				if($row['mail'] == $this->mail && $row['mail'] != $this->currentMail)
					$flag = true;
			}
		}
		return $flag;
	}
	public function updateDb($bdd)//update du mail et mdp
	{
		try {
			$reponse = $bdd->prepare("UPDATE messages SET msg_from=? WHERE msg_from =?");
			$reponse->execute(array($this->mail,$this->currentMail));

			$reponse = $bdd->prepare("UPDATE messages SET msg_to=? WHERE msg_to =?");
			$reponse->execute(array($this->mail,$this->currentMail));

			$reponse = $bdd->prepare("UPDATE inscription SET mail=?,mdp=?  WHERE mail=?");
			$reponse->execute(array($this->mail,$this->mdp,$this->currentMail));
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}
}

class SendForm
{
	private $nom;
	private $prenom;
	private $genre;
	private $bday;
	private $ville;
	private $mail;
	private $mdp;
    function  __construct($nom,$prenom,$genre,$bday,$ville,$mail,$mdp)
    {
    	$this->setNom($nom);
	    $this->setPrenom($prenom);
	    $this->setGenre($genre);
	    $this->setBirthday($bday);
	    $this->setVille($ville);
	    $this->setMail($mail);
	    $this->setMdp(password_hash($mdp, PASSWORD_DEFAULT)); // hachage avec l'algorithme bcrypt
    }
	public function setNom($nom)
	{
		$this->nom = $nom;
	}
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	}
	public function setGenre($genre)
	{
		$this->genre = $genre;
	}
	public function setBirthday($bday)
	{
		$this->bday = $bday;
	}
	public function setVille($ville)
	{
		$this->ville = $ville;
	}
	public function setMail($mail)
	{
		$this->mail= $mail;
	}
	public function setMdp($mdp)
	{
		$this->mdp = $mdp;
	}
	public function checkMail($bdd)//tant que flag reste false -> aucun mail n'a été trouver donc -> nouveau utilisateur
	{
		$flag = false;
		if($reponse = $bdd->query("SELECT mail FROM inscription"))
		{
			while ($row = $reponse->fetch()) {
				if(password_verify($this->password , $row['password']))
					$flag = true;
			}
		}
		return $flag;
	}
	public function insertDb($bdd)//insert des infos dans la bdd saisie par l'utilisateur
	{
		try {
			$reponse = $bdd->prepare("INSERT INTO users (`nom`, `prenom`, `genre`,`naissance`, `ville`, `mail`,`mdp`) VALUES (?,?,?,?,?,?,?)");
			$reponse->execute(array($this->nom,$this->prenom,$this->genre,$this->bday,$this->ville,$this->mail,$this->mdp));
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	}
}
?>
