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
		echo "<br>";
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}

	if(isset($_POST['delete']))
	{
		$num = $_POST['delete']; //on enregistre le tableau associatif du bouton clique
		$resultat=$conn->query("SELECT numT FROM chanson WHERE fk_num=".key($num));
		$numT=$resultat->fetch();
		$delete = "DELETE FROM utilisateur WHERE num=".key($num); // on utilise key pour avoir la cle du tableau associatif et donc par extension la cle primaire
		$conn->exec($delete);
		$deletechanson = "DELETE FROM chanson WHERE fk_num=".key($num);
		$conn->exec($deletechanson);
		$deleteaimerchanson = "DELETE FROM aimerchanson WHERE fk_numT=".(int)$numT['numT'];
		$conn->exec($deleteaimerchanson);
		
		
		header("location:liste_membre.php");
	}
	
	if(isset($_POST['confirme']))
	{
		
		$grade = $_POST['grade'];
		$num2 = $_POST['confirme'];
		$newgrade = $grade[key($num2)];
		
		$statut = "UPDATE utilisateur set grade = '$newgrade' where num = ".key($num2);
		$conn->exec($statut);
		if($_SESSION['id']==key($num2)) $_SESSION['grade']= $newgrade;
	
		
		
		header("location:liste_membre.php");
		
		
		
	}
	else echo 'erreur';

	
?>