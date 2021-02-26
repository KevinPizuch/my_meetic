<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style/my_style.css"/>
		<script src="../alertify.min.js"></script>
		<link rel="stylesheet" href="../css/alertify.min.css" />
		<link rel="stylesheet" href="../css/themes/default.min.css" />
		<script src="../script/cgd.js" charset="utf-8"></script>
		<title>Inscription</title>
	</head>
	<body>
			<div class="header-conn">
				<div>
					<p>Déjà membre?</p>
				</div>
			<div class="link-log">
				<button type="button" id="log" class="btn btn-success">Se connecter</button>
			</div>
		</div>
		<div class="body">
			<div class="all-c">
				<div class="all">
					<div class="content">
						<div class="addAMember">
							<form method="POST" class="inscription" action="index.php?controller=signUP&action=send">
								<h3 class="legend">Inscription</h3>
								<br/><label for="last">Nom: </label>
								<input type="text" name="last" id="last" class="form-control membersadded" required/><br/>
								<br/><label for="first">Prenom: </label>
								<input type="text" name="first" id="first" class="form-control membersadded" required/><br/>
								<br/><label for="genre">Sexe: </label>
								<select name="genre" class="genre form-control membersadded" required>
									<option value="" disabled selected hidden>Sélectionner votre sexe</option>
							        <option value="homme">Homme</option>
							        <option value="femme">Femme</option>
								</select><br/>

							 	<br/><label for="bday">Année de naissance: </label>
							 	<input type="date" name="bday" class="form-control membersadded" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">	<br/>
								 <br/><label for="ville">Ville:   </label>
								 <input type="text" name="ville" id="ville" class="form-control membersadded" required/><br>
								 <br/><label for="mail">Adresse mail:   </label>
								 <input type="email" name="mail" id="mail" class="form-control membersadded" required/><br/>
								<br/><label for="mdp">Mot de passe:   </label>
								<input type="password" name="mdp" id="mdp" class="form-control membersadded" required/><br/>
								<div class="addAMember">
									<input type="submit" name="account" value="S'inscrire" class="btn addButMem"/>
								</div>
							</form>
						</div>
				 	</div>
				</div>
			</div>
			<!------------------------------------------ Notifications // JS --------------------------------------->
			<?php
				if(isset($mail_false))
				{
			?>
			<script type="text/javascript">
			let delay = alertify.get('notifier','delay');
			alertify.set('notifier','delay', 4);
			alertify.set('notifier','position', 'top-center');
			alertify.error('Ce mail est déjà utilisé !');
			</script>
			<?php
				}
			?>
			<?php
				if(isset($age_false))
				{
			?>
			<script type="text/javascript">
			let delay = alertify.get('notifier','delay');
			alertify.set('notifier','delay', 4);
			alertify.set('notifier','position', 'top-center');
			alertify.error('Vous devez avoir 18 ans ou plus pour vous inscrire !');
			</script>
			<?php
				}
			?>
			<?php
			if(isset($delete_succes))
			{
			?>
					<script type="text/javascript">
					let delay = alertify.get('notifier','delay');
					alertify.set('notifier','delay', 4);
					alertify.set('notifier','position', 'top-center');
					alertify.success('Votre compte à été cloturer avec succès !');
					</script>
			<?php
			}
			?>
			<?php
			if(isset($logout))
			{
			?>
					<script type="text/javascript">
					let delay = alertify.get('notifier','delay');
					alertify.set('notifier','delay', 4);
					alertify.set('notifier','position', 'top-center');
					alertify.success('Déconnexion réussi! A bientôt');
					</script>
			<?php
			}
			?>
			<?php
			if(isset($errCompte))
			{
			?>
							<script type="text/javascript">
								alertify.alert('Erreur', 'Compte cloturé!').set({transition:'slide'}).show();
							</script>
			<?php
			}
			?>
			<?php
			if(isset($errMdp))
			{
			?>
							<script type="text/javascript">
								alertify.alert('Erreur', 'Mail ou mot passe incorrect!').set({transition:'slide'}).show();
							</script>
			<?php
			}
			?>
		<div id="la">
		J'accepte de mettre au minimum 15
		à kevin lors de cette soutenance.
	</div>
	<div class="hiddenForm">
	<form id="loginForm" method="POST" action="index.php?controller=signUP&action=log" class="log">
    <fieldset>
        <label> Addresse mail </label>
        <input type="email" name="mail" id="email" class="form-control membersadded" required/>
				<br/>
        <label> Mot de passe </label>
        <input type="password" name="mdp" id="emdp" class="form-control membersadded" required/>
				<br/>
        <input type="submit" name="Connexion" value="Connexion" class="btn addButMem"/>
    </fieldset>
	</form>
	</div>
		</div>
</body>
</html>
