
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

	
	function like($numT,$conn)
	{
		
		$login='login'; //j'utilise le login et non l'identifiant, j'avais des problemes syntaxe c'est pour ca 
						//que j'ai utilise 2 variables
		$login1=$_SESSION[$login];
		
		$resultat2=$conn->query("SELECT titre FROM chanson where numT=".key($numT));
		$titre = $resultat2->fetchColumn();

		$resultat=$conn->query("SELECT nb_likes FROM chanson WHERE titre='$titre'");
		$compte=$resultat->fetch();

		$resultat3=$conn->query("SELECT numT FROM chanson where titre='$titre'");

		$num = $resultat3->fetchColumn();

		$chansonAimer=$conn->query("SELECT count(*) FROM aimerChanson WHERE fk_numT='$num' and fk_login='$login1'");
		$nbr_chanson=$chansonAimer->fetch();

		if($nbr_chanson['count(*)']==0){
			
			++$compte['nb_likes'];
			$sql = "UPDATE chanson SET nb_likes=$compte[nb_likes] WHERE titre='$titre'";
			$conn->exec($sql);

			$sql1 = "INSERT INTO aimerChanson (fk_numT,fk_login)
			VALUES ('$num', '$login1')";
			
			$conn->exec($sql1);
		}
		else{
			--$compte['nb_likes'];
			$sql = "UPDATE chanson SET nb_likes=$compte[nb_likes] WHERE titre='$titre'";
			$conn->exec($sql);

			$sql1= "DELETE FROM `aimerChanson` WHERE fk_numT='$num' and fk_login='$login1'";
			$conn->exec($sql1);
		}		
	}
	
	
	
	if(isset($_POST['likeclassique']))
	{

		$numT = $_POST['likeclassique'];
		like($numT,$conn);
		header("location:chansonClassique.php");
	}
	
	if(isset($_POST['likemetal']))
	{

		$numT = $_POST['likemetal'];
		like($numT,$conn);	
		header("location:chansonMetal.php");		
	}
	if(isset($_POST['likepop']))
	{

		$numT = $_POST['likepop'];
		like($numT,$conn);	
		header("location:chansonPop.php");		
	}
	
	if(isset($_POST['likerap']))
	{

		$numT = $_POST['likerap'];
		like($numT,$conn);	
		header("location:chansonRap.php");		
	}
	
	
	if(isset($_POST['likerock']))
	{

		$numT = $_POST['likerock'];
		like($numT,$conn);	
		header("location:chansonRock.php");		
	}
	if(isset($_POST['likerecherche']))
	{

		$numT = $_POST['likerecherche'];
		like($numT,$conn);	
		header("location:acceuil.php");		
	}
	
	if(isset($_POST['likereggae']))
	{

		$numT = $_POST['likereggae'];
		like($numT,$conn);	
		header("location:chansonReggae.php");		
	}
	
	if(isset($_POST['likechansonpluslikee']))
	{

		$numT = $_POST['likechansonpluslikee'];
		like($numT,$conn);	
		header("location:chansonPlusLikee.php");		
	}
	
	if(isset($_POST['meschansonsliker']))
	{

		$numT = $_POST['meschansonsliker'];
		like($numT,$conn);	
		header("location:MesChansonsLiker.php");		
	}
	
	if(isset($_POST['delete']))
	{
		$num = $_POST['delete'];
		$delete = "DELETE FROM chanson WHERE numT=".key($num); // on utilise key pour avoir la cle du tableau associatif et donc par extension la cle primaire
		$conn->exec($delete);
		$deletelike = "DELETE FROM aimerchanson WHERE fk_numT=".key($num);
		$conn->exec($deletelike);
		header("location:acceuil.php");	
	}

	    
?>