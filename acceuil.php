<html>
	<head>
		<meta charset="UTF-8">
		<title>Accueil </title>
		<link rel="stylesheet" type="text/css" href="styleAcceuil.css">
	</head>
	<body>
<?php 
	
	session_start(); 

	if(!isset($_SESSION['login'])){ header('acceuil.html');}
	$servername = "localhost";
	$username = "root";
	$password = "root";

try 
{
	$conn = new PDO("mysql:host=$servername;dbname=musique",
	$username, $password);	
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
		<li class='gauche'><a href='topThree.php'>Meilleurs utilisateurs</a></li>
		<li class='gauche'><a href='MesChansonsLiker.php'>Mes chansons likées</a></li>
	";
	
if($_SESSION['grade']=='admin'){echo "<li class='gauche'><a href='liste_membre.php'>Liste des membres</a></li>";}

echo 	"<a href='modifierprofil.php'><li class='droite'><img src='image/	profil1.png' height='30px'></li></a>
		<li class='droite'>".$nomPrenom['prenom']." ".$nomPrenom['nom']."</li>
		<a href='logout.php'><li class='droite'><img src='image/deconnexion.png' width='20px' height=20px'></li></a>
		<li class='droite'><form method='post' action='recherche.php'>
		<input type='text' name='recherche' autocomplete='on' placeholder='titre,chanteur'>
		<input type='submit' value='Recherche'></form></li>
	</ul>";}

?>


<br><br><br>
<table>
 	<tr>
       <td><a href="chansonRock.php"><img class='imageTheme' src="image/rock.jpg"></a></td>
       <td><a href="chansonPop.php"><img class='imageTheme' src="image/pop.jpg"></a></td>
       <td><a href="chansonRap.php"><img class='imageTheme' src="image/rap.png"></a></td>
   </tr>
   <tr>
       <td align="center"><h1 class="theme">ROCK</h1></td>
       <td align="center"><h1 class="theme"> POP</h1></td>
       <td align="center"><h1 class="theme"> RAP</h1></td>
   </tr>
   <tr>
       <td><a href="chansonMetal.php"><img class='imageTheme' src="image/metal.png"></a></td>
       <td><a href="chansonClassique.php"><img class='imageTheme' src="image/classique.png"></a></td>
       <td><a href="chansonReggae.php"><img class='imageTheme' src="image/reggae.jpg"></td>
   </tr>
   <tr>
       <td align="center"><h1 class="theme">METAL</h1></td>
       <td align="center"><h1 class="theme"> CLASSIQUE</h1></td>
       <td align="center"><h1 class="theme"> REGGAE</h1></td>
   </tr>
</table>


</body>
</html>