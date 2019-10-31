<?php
	session_start();
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
		<li class='gauche'><a href='ajoute_titre.php'>Ajouter une chanson</a></li>
		<li class='gauche'><a href='chansonPlusLikee.php'>Chansons les plus likées</a></li>
	";
	
if($_SESSION['grade']=='admin'){echo "<li class='gauche'><a href='liste_membre.php'>Liste des membres</a></li>";}

echo 	"<a href='modifierprofil.php'><li class='droite'><img src='image/	profil1.png' height='30px'></li></a>
		<li class='droite'>".$nomPrenom['prenom']." ".$nomPrenom['nom']."</li>
		<a href='logout.php'><li class='droite'><img src='image/deconnexion.png' width='20px' height=20px'></li></a>
		<li class='droite'><form method='post' action='recherche.php'>
		<input type='text' name='recherche' autocomplete='on' placeholder='titre,chanteur'>
		<input type='submit' value='Recherche'></form></li>
	</ul>";}
	
			$resultat=$conn->query("SELECT * FROM chanson,utilisateur where chanson.fk_num=utilisateur.num ORDER BY  nb_likes DESC limit 3
				");
			
			echo "<h1 align='center'> Les 3 utilisateurs qui ont inséré les chansons les plus aimées</h1>";
			echo "<p >";

			$i=0;
			while($donnee=$resultat->fetch())
			{
				$i+=1;
				if(isset($donnee['nom'])) 
					{echo $i." ".$donnee['prenom']." ".$donnee['nom']."<br><br>";}
			}


			echo "</p>";

    
?>



<html>
<head>
<title>Top Three</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="styleAcceuil.css">
</head>
<body >
</body>
</html>