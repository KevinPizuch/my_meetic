<?php
require_once("controllers/Controller.php");
class Msg extends Controller
{
	public function display($bdd)//si la session est active -> page profil / sinon -> page sign up
	{
    require_once('./back/back.php');
		$contact = new contact ($_SESSION['mail']);
		$contactFetch = $contact -> getContact($bdd);
		return $this -> view("message",["contactFetch" => $contactFetch]
    );
	}
  public function showMsg($bdd){
    if(isset($_POST['msg'])){
      $_SESSION['msg'] = $_POST['msg'];
      require_once('./back/back.php');
		  $msg = new contact ($_POST['msg']);
		  $msgFetch = $msg -> getMsg($bdd);
      $contact = new contact ($_SESSION['mail']);
  		$contactFetch = $contact -> getContact($bdd);
      if(empty($msgFetch)){
        return $this -> view("message",[
          "msgFetch" => $msgFetch,
          "contactFetch" => $contactFetch,
          "sendTo" => $_POST['msg'],
          "first_msg" => "first_msg"
          ]);
      }
      else{
		  return $this -> view("message",[
        "msgFetch" => $msgFetch,
        "contactFetch" => $contactFetch,
        "sendTo" => $_POST['msg']
        ]);
      }
    }
    else {
      header('Location: index.php?controller=Msg&action=display');
    }
  }
  public function sendMsg($bdd){
    if(isset($_POST['text']) && isset($_POST['id'])){
      require_once('./back/back.php');
		  $msg = new send($_SESSION['mail'],$_POST['text'],$_POST['id']);
		  $msgFetch = $msg -> sendMsg($bdd);
      $msg = new contact ($_POST['msg']);
		  $msgFetch = $msg -> getMsg($bdd);
      $contact = new contact ($_SESSION['mail']);
  		$contactFetch = $contact -> getContact($bdd);
      $msg = new contact ($_POST['msg']);
		  $msgFetch = $msg -> getMsg($bdd);
      $contact = new contact ($_SESSION['mail']);
  		$contactFetch = $contact -> getContact($bdd);
		  return $this -> view("message",[
        "msgFetch" => $msgFetch,
        "contactFetch" => $contactFetch,
        "sendTo" => $_SESSION['msg']

        ]);
    }
    else {
      header('Location: index.php?controller=Msg&action=display');
    }
  }

  public function instantMsg($bdd){
    var_dump($_POST['msg']);
  }
}
?>
