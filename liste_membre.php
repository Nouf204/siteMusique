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
		<li class='gauche'><a href='chansonPlusLikee.php'>Chansons les plus likées</a></li>
		<li class='gauche'><a href='topThree.php'>Meilleurs utilisateurs</a></li>
		<li class='gauche'><a href='MesChansonsLiker.php'>Mes chansons likées</a></li>
	";
	
//if($_SESSION['grade']=='admin'){echo "<li class='gauche'><a href='liste_membre.php'>Liste des membres</a></li>";}

echo 	"<a href='modifierprofil.php'><li class='droite'><img src='image/profil1.png' height='30px'></li></a>
		<li class='droite'>".$nomPrenom['prenom']." ".$nomPrenom['nom']."</li>
		<a href='logout.php'><li class='droite'><img src='image/deconnexion.png' width='20px' height=20px'></li></a>
		
	</ul>";}
		


			
	$resultat=$conn->query("SELECT * FROM utilisateur");

	echo "<table class='lmembre'><form method='post' action='deletemembre.php'>"; 	// on commence un form qui va cibler une page pour supprimer un membre
	
	echo "<tr><th>Prenom</th><th>Nom</th><th>Mail</th><th>Naissance</th><th>Grade</th><th>Nombre d'ajout</th></tr>";
	
	while($donnee=$resultat->fetch())
	{
		$id =$donnee['num'];  // on enregistre la cle primaire de la table utilisateur a chaque iteration
		$chanson = $conn->query("SELECT count(*) FROM chanson where fk_num = $id ");
		$nombre = $chanson->fetch();
		
		echo "<tr>";
		echo "<td>".$donnee['prenom']."</td><td>".$donnee['nom']."</td><td>".$donnee['email']."</td><td>" // on affiche des donnee a chaque iteration
			.$donnee['ddn']."</td><td>".$donnee['grade']."</td><td>".$nombre['count(*)'].
			"</td></tr><tr><td><input type='submit' name='delete[$id]' value='Supprimer'></td>"; // a chaque iteration on affiche un bouton avec name = tableau associatif avec comme cle la cle primaire de la chanson
		echo "<td><select name='grade[$id]'>
					<option value='membre'>Membre</option>
					<option value='admin'>Admin</option>
			  </select></td>";
		echo "<td><input type='submit' name='confirme[$id]' value='Valider'></td>";
		echo "</tr>";		
	}
	echo "</table></form>";
			
			
?>

<html>
<head>
<title>Liste des membres</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="stylemusique.css">
</head>
<body>
</body>
</html>