<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="style/mystyle.css"/>
		<script src="../alertify.min.js"></script>
		<link rel="stylesheet" href="../css/alertify.min.css"/>
		<link rel="stylesheet" href="../css/themes/default.min.css"/>
		<title>Modification</title>
	</head>
	<body>
		<div class="header">
		<?php
			require_once 'views/menu.php';
		?>
		</div>
		<div class="body-log">
			<div class="all-c">
				<div class="all">
					<div class="content">
						<div class="addAMember">
						 	<form method="POST" class="inscription" action="index.php?controller=Account&action=sendModification">
								 <label for="mail">Nouvelle addresse mail:   </label>
									<input type="email" name="mail" id="mail" class="form-control membersadded" value=<?php if(isset($mail))echo $mail; else echo "Email déjà utilisé";?> required/><br/>
									<br/><label for="mdp">Nouveau mot de passe:   </label>
									<input type="password" name="mdp" id="mdp" class="form-control membersadded" required/><br/>
									<input type="submit" name="sendMofification" value="Send" class="btn addButMem"/>
							</form>
				 		</div>
				 	</div>
				</div>
			</div>
		</div>
		<!------------------------------------------ Notifications // JS --------------------------------------->
		<?php
		if(isset($mailFalse))
		{
		?>
						<script type="text/javascript">
						let delay = alertify.get('notifier','delay');
						alertify.set('notifier','delay', 6);
						alertify.set('notifier','position', 'top-center');
					 	alertify.error('Ce mail est déjà utilisé');
						</script>
		<?php
		}
		?>
	</body>
</html>
