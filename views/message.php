<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style/mystyle.css"/>
		<script src="../alertify.min.js"></script>
		<link rel="stylesheet" href="../css/alertify.min.css"/>
		<link rel="stylesheet" href="../css/themes/default.min.css"/>
		<title>Messages</title>
	</head>
	<body style="overflow-y:hidden">
		<div class="header">
		<?php
			require_once 'views/menu.php';
		?>
		</div>
		<div class="body-log">
			<div class="content_msg">
				<div class="contact">
        <?php
        if(isset($contactFetch)) {
          //var_dump($contactFetch);
          $o = 0;
          $id = 0;
          $tab = [];
          for ($i=0; $i < count($contactFetch); $i++) {
            if(!in_array($contactFetch[$i]['msg_from'],$tab)){
              array_push($tab,$contactFetch[$i]['msg_from']);

        ?>
          <div class="new_contact">
          <?php echo $tab[$o];?>
          <form class="" action="index.php?controller=Msg&action=showMsg" method="post">
            <input  type="submit" value="Voir">
            <input id="submitMsg" name="msg" value="<?php echo $contactFetch[$i][0] ?>">
          </form>
	        </div>

        <?php
            $o++;
            }
          }
        }
        ?>
        </div>
          <?php
          if(isset($first_msg)){
          ?>
          <script type="text/javascript">
          alertify.alert('Alerte premier message', 'Hello tu contacte cette personne pour la premiere fois, celle-ci devra te répondre pour avoir la conversation dans ton historique, cordialement la direction', function(){ alertify.success('Merci bien'); });
          </script>
          <?php } ?>
          <?php
          if(isset($sendTo)){
          ?>
          <div class="display_msg" id="frame_1">
          <?php
          }
          if(isset($msgFetch)) {
            for ($i=0; $i < count($msgFetch); $i++) {
              if($msgFetch[$i]['msg_to'] == $_SESSION['mail']){
          ?>
            <span style="margin-left:50px;"><?php echo $msgFetch[$i]['date']?></span>&nbsp;----&nbsp;<span><?php echo $msgFetch[$i]['msg_from'] ?></span>&nbsp;&nbsp; a dit : <div class="msg_left"><p style="margin-left:30px;"><?php echo $msgFetch[$i]['message'];?></p></div>
          <?php
                }
                else{
            ?>
              <span style="margin-left:720px"><?php echo $msgFetch[$i]['date']?></span><div class="msg_right"><p style="margin-right:30px;"><?php echo $msgFetch[$i]['message'];?></p></div>
            <?php
              }
              }
            ?>
            <form class="send_msg" action="index.php?controller=Msg&action=sendMsg" method="post">
              <input id="text_area" type="text" name="text" id="name" required>
              <input id="sendtest" type="submit" value="Envoyer">
              <input id="sendid" name="id" value="<?php echo $sendTo ?>">
            </form>
            <script type="text/javascript">//scroll tout en bas pour avoir les nouveau msgs directement
              document.getElementById('frame_1').scrollTop = document.getElementById('frame_1').scrollHeight;
            </script>
            <?php
            }
          ?>

        </div>
			</div>
		</div>
	</body>
</html>
