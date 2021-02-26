<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style/mystyle.css"/>
		<script src="../alertify.min.js"></script>
		<link rel="stylesheet" href="../css/alertify.min.css"/>
		<link rel="stylesheet" href="../css/themes/default.min.css"/>
		<title>Recherche de profil</title>
	</head>
	<body style="overflow-y:hidden">
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
						 	<form method="POST" class="inscription" action="index.php?controller=Profil&action=showProfil" onsubmit="hiddenfunc()">
								  <h3 class="legend">Recherche</h3>
									<select name="genre" class="genre form-control membersadded" required>
								 		<option value="" disabled selected hidden>Sélectionner votre sexe</option>
								        <option value="homme">Homme</option>
								        <option value="femme">Femme</option>
								 	</select><br/>
								 	<select name="age" class="age form-control membersadded" required>
								 		<option value="" disabled selected hidden>Sélectionner une tranche d’âge</option>
								        <option value="18">entre 18 et 25 ans</option>
								        <option value="25">entre 25 et 35 ans</option>
								        <option value="35">entre 35 et 45 ans</option>
								        <option value="45">plus de 45 ans</option>
								 	</select><br/>
								 	<br/><label for="ville">*Ville:   </label>
									<input type="text" name="ville" id="ville" class="form-control membersadded"/><br>
									<div class="city_content_input"></div>
									<input type="submit" name="account" value="Rechercher" class="btn addButMem"/>
							</form>
				 		</div>
				 	</div>
				 	<div class="profil-container">
				 		<?php
				 		if(isset($profil_found))
				 		{
				 		?>
					 	<button class="w3-button w3-black w3-display-left left-slide" onclick="plusDivs(-1)">imagine c une fleche</button>
				 		<?php
				 		foreach ($profil_found as $value) {
				 			?>
				 			<div class="card-c">
							   	<img src='image/<?php echo $value[2] ?>.png' alt="<?php echo $value[2] ?>" class="<?php echo $value[2] ?>">
							   	<div class="card">
							        <p>
							            <?php echo $value[0] ?>
							        </p>
							        <p>
							            <?php echo $value[1] ?>
							        </p>
							        <p>
							            <?php echo $value[3]." ans"?>
							        </p>
							        <p>
							            <?php echo $value[4] ?>
							        </p>
							        <p>
							            <?php echo $value[5] ?>
							        </p>
											<form   action="index.php?controller=Msg&action=showMsg" method="post">

					              <input id="send_instant_msg" style="display:block;margin:auto" type="submit" value="Envoyer un message">
					              <input id="sendid" name="msg" value="<?php echo $value[5] ?>">
					            </form>

							    </div>
						    </div>
						    <?php
				 		}
				 		?>
		  				<button class="w3-button w3-black w3-display-right right-slide" onclick="plusDivs(1)">imagine c une fleche</button><!--&#10095;-->
		  				<?php
				 		}
				 		elseif (isset($not_found)) {
				 		?>
				 			<p class="nothing"> <?php echo $not_found?>	</p>
				 		<?php
				 		}
				 		?>
				 	</div>
				</div>
			</div>
		</div>
		<!------------------------------------------ Notifications // JS --------------------------------------->
		<?php
		if(isset($welcome))
		{
		?>
						<script type="text/javascript">
						let delay = alertify.get('notifier','delay');
						alertify.set('notifier','delay', 4);
						alertify.set('notifier','position', 'top-center');
					 	alertify.success('Connexion réussi !');
						</script>
		<?php
		}
		?>
		<form id="msg_instant" action="">
    <fieldset>
        <label> Username </label><br/>
        <input type="text_area" value=""/>
				<br/>
        <input type="submit" value=""/>
    </fieldset>
		</form>
		<script type="text/javascript" src="script/my_script.js"></script>
		<script type="text/javascript">
			$('#msg_direct').click(function(){
				alertify.prompt( 'Message direct', 'Message :', 'Ton msg ici'
               , function(evt, value) { alertify.success('Message envoyer avec succes!') }//value = text
               , function() { alertify.error('Cancel') });
			});
		</script>
	</body>
</html>
