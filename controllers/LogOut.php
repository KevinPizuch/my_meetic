<?php
require_once("controllers/Controller.php");
class LogOut extends Controller // detruit la session -> page sign up + popup
{
  public function logOut(){
    session_start();
    session_unset ();
    session_destroy ();
    return $this -> view("signUp",["logout" =>  "succes"]);
  }
}
?>
