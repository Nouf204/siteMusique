<?php

session_start();


try{
	$conn=new PDO('mysql:host=localhost;dbname=musique;charest=utf8','root','root');
}

catch(Exception $erreur){
	die('erreur : '.$erreur->getMessage());
}


if(isset($_POST['connexion'])) // verifie que l'on a bien submit 
{
	$login=$_POST['login'];
	$motDePasse=$_POST['motDePasse'];
	$_SESSION['login']=$login;	

	$resultat=$conn->query("SELECT count(*) FROM utilisateur WHERE login='$login' and mdp='$motDePasse'"); 
	$compte=$resultat->fetch();

	if($compte['count(*)']==1)
	{
		$resultat1=$conn->query("SELECT nom,prenom,ddn,email,grade FROM utilisateur where login='$login'");
		$profil = $resultat1->fetch();
		
		$resultID=$conn->query("SELECT num FROM utilisateur WHERE login='$login'");  
		$id = $resultID->fetchColumn(); 
		
		$resultat2= $conn->query("SELECT count(*) FROM chanson WHERE fk_num=$id");
		$nb_insertion = $resultat2->fetchColumn();
		

		$_SESSION['nb_insertion'] = $nb_insertion;
		$_SESSION['id'] = $id;
		$_SESSION['nom'] = $profil[0];
		$_SESSION['prenom'] = $profil[1];
		$_SESSION['ddn'] = $profil[2];
		$_SESSION['email'] = $profil[3];
		$_SESSION['grade'] = $profil[4];
		

		header('Location: acceuil.php');
	}
		
	else
	{
		echo "<div>";
		echo "Mot de passe ou login incorrect.";
		echo "</div><br><br>";
	}

}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Connexion </title>
		<link rel="stylesheet" type="text/css" href="stylemusique.css">
	</head>
	
	<body >
		<img id="notemusique" src="image/note_musique.png"  ><h1>Connectez-vous</h1>
		<form method="post" action="connexion.php">
			<p>
				<b>Login</b><br>
				<input class="a"type="text" name="login"  title="Veuillez entrer votre Login" autofocus required >
				<br><br>
				
				<b>Mot de passe</b><br>
				<input class="a"width="150px" type="password" name="motDePasse" required>
				<a href="mdp_oublie.php">Mot de passe oublié ?</a>
				<br><br><br>
				<input name="connexion" type="submit" value="CONNEXION" class="bouton"><BR><br><br>
				<img id="notemusique" src="image/note_musique.png"  ><br><br><br><br>
				<b >Pas encore membre ? </b><a href="inscription.php"><b>Inscrivez-vous gratuitement</b></a>
			</p>
		</form>
	</body>
</html>