<?php
require_once("inc/init.inc.php");
if(!utilisateurEstConnecte())
{
	header("location:connexion.php");
	exit();
}
if($_POST)
{
	if(!empty($_POST['mdp']))
	{
		executeRequete("update membre SET mdp='$_POST[mdp]', nom='$_POST[nom]', prenom='$_POST[prenom]', email='$_POST[email]', sexe='$_POST[sexe]', ville='$_POST[ville]', cp='$_POST[cp]', adresse='$_POST[adresse]' where id_membre='".$_SESSION['utilisateur']['id_membre']."'");
		unset($_SESSION['utilisateur']);		
		foreach($membre as $indice => $element)
		{
			if($indice != 'mdp')
			{
				$_SESSION['utilisateur'][$indice] = $element;
			}
			else
			{
				$_SESSION['utilisateur'][$indice] = $_POST['mdp'];
			}
		}
		header("Location:membres.php?action=modif");
	}
	else
	{
		$msg .= "le nouveau mot de passe doit être renseigné !";
	}
}
if(isset($_GET['action']) && $_GET['action'] == 'modif')
{
	$msg .= "la modification à bien été prise en compte";
}

require_once("inc/haut_de_site.inc.php");
require_once("inc/menu.inc.php");
echo $msg;
?>
		<h2> Modification de vos informations </h2>
		<?php
			print "vous êtes connecté sous le pseudo: " . $_SESSION['utilisateur']['pseudo'];
		?><br /><br />
		<form method="post" enctype="multipart/form-data" action="membres.php">
		<input type="hidden" id="id_membre" name="id_membre" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['id_membre']; ?>" />
			<label for="pseudo">Pseudo</label>
				<input disabled type="text" id="pseudo" name="pseudo" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['pseudo']; ?>"/><br />
				<input type="hidden" id="pseudo" name="pseudo" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['pseudo']; ?>"/>
			
			<label for="mdp">Nouv. Mot de passe</label>
				<input type="text" id="mdp" name="mdp" value="<?php if(isset($mdp)) print $mdp; ?>"/><br /><br />
			
			<label for="nom">Nom</label>
				<input type="text" id="nom" name="nom" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['nom']; ?>"/><br />
			
			<label for="prenom">Prénom</label>
				<input type="text" id="prenom" name="prenom" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['prenom']; ?>"/><br />

			<label for="email">Email</label>
				<input type="text" id="email" name="email" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['email']; ?>"/><br />
			
			<label for="sexe">Sexe</label>
					<select id="sexe" name="sexe">
						<option value="m" <?php if(isset($_SESSION['utilisateur']['sexe']) && $_SESSION['utilisateur']['sexe'] == "m") print "selected"; ?>>Homme</option>
						<option value="f" <?php if(isset($_SESSION['utilisateur']['sexe']) && $_SESSION['utilisateur']['sexe'] == "f") print "selected"; ?>>Femme</option>
					</select><br />
					
			<label for="ville">Ville</label>
				<input type="text" id="ville" name="ville" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['ville']; ?>"/><br />
			
		<label for="cp">Cp</label>
			<input type="text" id="cp" name="cp" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['cp']; ?>"/><br />
			
		<label for="adresse">Adresse</label>
					<textarea id="adresse" name="adresse"><?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['adresse']; ?></textarea>
					<input type="hidden" name="statut" value="<?php if(isset($_SESSION['utilisateur'])) print $_SESSION['utilisateur']['statut']; ?>"/><br />
			<br /><br />
			<input type="submit" class="submit" name="modification" value="modification"/>
	</form><br />
</div>