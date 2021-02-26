
<ul class="navigation">
  <?php
    if(isset($_SESSION['mail'])){
  ?>
  <li class="toggleSubMenu"><a id="toggle" href=""><span>Menu</span></a>
    <ul class="subMenu">
      <li><a class="link" href="index.php?controller=Account&action=display">Compte</a></li>
      <li><a class="link" href="index.php?controller=Profil&action=show">Rechercher un profil</a></li>
			<li><a class="link" href="index.php?controller=Msg&action=display">Messages</a></li>
      <li><a class="link" href="index.php?controller=LogOut&action=logOut">Se deconnecter</a></li>
    </ul>
  </li>
	<?php
		}
	?>
	<script type="text/javascript">

	$(document).ready( function () {
			$(".navigation ul.subMenu").hide();
			$("#toggle").click( function () {
					// Si le sous-menu était déjà ouvert, on le referme :
					if ($(this).next("ul.subMenu:visible").length != 0) {
							$(this).next("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") });
					}
					// Si le sous-menu est caché, on ferme les autres et on l'affiche :
					else {
							$(".navigation ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") });
							$(this).next("ul.subMenu").slideDown("normal", function () { $(this).parent().addClass("open") });
					}
					return false;
			});
	} ) ;

	</script>
</ul>
