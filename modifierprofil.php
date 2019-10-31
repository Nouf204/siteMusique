<?php

	session_start();
	if(!isset($_SESSION['login'])) header('acceuil.html');


	$servername = "localhost"; 
	$username = "root"; 
	$password = "root";

	try 
	{
		$conn = new PDO("mysql:host=$servername;dbname=musique",
		$username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,
		PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}

	$login=$_SESSION['login'];
$requette=$conn->query("SELECT nom,prenom FROM utilisateur WHERE login='$login'");
$nomPrenom=$requette->fetch();

if(isset($_SESSION['login'])){ echo " 
	<ul>
		<li class='gauche'><img src='image/menu.png' height='30PX'></li>
		<li class='gauche'><a href='acceuil.php'>Acceuil</a></li>
		<li class='gauche'><a href='ajoute_titre.php'>Ajouter une chanson</a></li>
	";
	
if($_SESSION['grade']=='admin'){echo "<li class='gauche'><a href='liste_membre.php'>Liste des membres</a></li>";}

echo 	"<a href='modifierprofil.php'><li class='droite'><img src='image/profil1.png' height='30px'></li></a>
		<li class='droite'>".$nomPrenom['prenom']." ".$nomPrenom['nom']."</li>
		<a href='logout.php'><li class='droite'><img src='image/deconnexion.png' width='20px' height=20px'></li></a>
		</ul>"
		;}


	if (isset($_POST['modifier'])) 
	{
		try
		{
			$new_mdp=$_POST['new_mdp'];
			$login='login';
			if($_POST['confirme_mdp']==$_POST['new_mdp'])
			{
				$sql = "UPDATE utilisateur SET mdp='$new_mdp' WHERE login='$_SESSION[$login]'";
				$conn->exec($sql);
			}
			else
			{ 
				echo "<div>";
				echo "Attention! Mots de passe non identiques.";
				echo "</div> <br><br>";
			}
			
			
		}

		catch(PDOException $e)
    	{
    		echo $sql . "<br>" . $e->getMessage();
    	}
	}
?>

<html>
<head>
	<meta charset="UTF-8">
	<title>Modifiez votre profil</title>
	<link rel="stylesheet" type="text/css" href="stylemusique.css">
</head>
<body>

	<h1>Votre profil</h1>
	<form method="post" action="modifierprofil.php"> 
	<p>
		<b>Prenom:</b> <?php echo $_SESSION['prenom']; ?><br><br>
		
		<b>Nom:</b> <?php echo $_SESSION['nom']; ?><br><br>
		
		<b>Login:</b> <?php echo $_SESSION['login']; ?><br><br>
		
		<b>Date de naissance:</b> <?php echo $_SESSION['ddn']; ?><br><br>
		
		<b>Email:</b> <?php echo $_SESSION['email']; ?><br><br>
		
		<b>Nombre de chanson ajoutee:</b> <?php echo $_SESSION['nb_insertion']; ?><br><br>
		
		<b>Statut:</b> <?php echo $_SESSION['grade']; ?>
		
		<br><br><br><br><br><br>
		<b>Nouveau mot de passe :</b>
		<input class="a"type="password" name="new_mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}" title="Mot de Passe Invalide">
		
		<b>Confirmer mot de passe:</b>
		<input class="a"type="password" name="confirme_mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}" title="Mot de Passe Invalide" required>
		
		<i>Votre mot de passe doit &ecirc;tre entre 4 et 8 caract&egrave;res, et doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.</i>

		<br><br><br>
		<input class="bouton" type="submit" name="modifier" value="Sauvegarder">
	</p>
	</form>
</body>
</html>