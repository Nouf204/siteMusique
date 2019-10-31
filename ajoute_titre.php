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
	
	if(isset($_SESSION['login']))
	{
	 echo " 
		<ul>
			<li class='gauche'><img src='image/menu.png' height='30PX'></li>
			<li class='gauche'><a href='acceuil.php'>Acceuil</a></li>		
			<li class='gauche'><a href='chansonPlusLikee.php'>Chansons les plus likées</a></li>
			<li class='gauche'><a href='topThree.php'>Meilleurs utilisateurs</a></li>
			
	";
	
	if($_SESSION['grade']=='admin'){echo "<li class='gauche'><a href='liste_membre.php'>Liste des membres</a></li>";}

	echo 	"<a href='modifierprofil.php'><li class='droite'><img src='image/	profil1.png' height='30px'></li></a>
			<li class='droite'>".$nomPrenom['prenom']." ".$nomPrenom['nom']."</li>
			<a href='logout.php'><li class='droite'><img src='image/deconnexion.png' width='20px' height=20px'></li></a>
			<li class='droite'><form method='post' action='recherche.php'>
			<input type='text' name='recherche' autocomplete='on' placeholder='titre,chanteur'>
			<input type='submit' value='Recherche'></form></li>
		</ul>";}

	if(isset($_POST['inserer']) and isset($_SESSION['login']))
	{
	try
	{
	
		$theme=$_POST['theme'];
		$titre=$_POST['titre'];
		$interprete=$_POST['interprete'];
		$duree=$_POST['duree'];
		$lien=$_POST['lien'];
		
		$like = 0;
		$login=$_SESSION['login'];
		$log = $_SESSION['id'];
		$image=$_POST['image'];
		

		$sql = "INSERT INTO chanson (titre,interprete,duree,lien,image,nb_likes,fk_num,fk_idTheme)
				VALUES ('$titre', '$interprete', '$duree','$lien','$image','$like','$log','$theme')";
		

		

		$conn->exec($sql);	
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
	<title>Ajout de titre</title>
	<link rel="stylesheet" type="text/css" href="stylemusique.css">
</head>
<body>
	<h1> Insérez votre chanson! </h1><br>

	<img id="notemusique" src="image/note_musique.png">
	<form method="post">
	<p>
		<b>Thème:</b><br>
		<select name="theme" action="ajoute_titre.php">
			<option value=1>Pop</option>
			<option value=2>Rap</option>
			<option value=3>Rock</option>
			<option value=4>Metal</option>
			<option value=5>Classique</option>
			<option value=6>Reggae</option>
			
			<!Les value correspondent aux clés primaires de la table theme>
		</select>
		<br><br>
					
		<b>Titre:</b> 
		<input class="a" type="text" name="titre" autocomplete="on" required>
		<br><br>
					
		<b>Interprète:</b> 
		<input class="a"type="text" name="interprete" required><br><br>
					
		<b>Durée:</b><br> 
		<input class="a"type="time" name="duree" step=1 required><br><br>
		
		<b>Lien:</b> 
		<input class="a"type="text" name="lien" ><br><br>
		
		<b>Image:</b><br>
		<input type="file" name="image"><br><br>    
		<! required a mettre plus tard>
		
		<input class="bouton" type="submit" name="inserer" value="Inserer la chanson">
		<br><br><br>

		<img id="notemusique" src="image/note_musique.png">
	</p>
	</form>
</body>