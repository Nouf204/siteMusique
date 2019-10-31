<?php
	try
	{
		$conn=new PDO('mysql:host=localhost;dbname=musique;charest=utf8','root','root');
	}

	catch(Exception $erreur)
	{
		die('erreur : '.$erreur->getMessage());
	}

	if (isset($_POST['envoyer'])) 
	{
		try
		{
			$email=$_POST['email'];

			$resultat=$conn->query("SELECT count(*) from utilisateur WHERE email='$email'");
			$compte=$resultat->fetch();

			if ($compte['count(*)']==0) 
			{
				echo "<h4>
						Aucun compte n'est associé à l'e-mail que vous avez saisi. Vérifiez que n'ayez pas fait de faute de frappe, sinon créez vous un compte.
						</h4>";
			}

			else
			{
				$resultat2=$conn->query("SELECT email from utilisateur WHERE email='$email'");
				$compte2=$resultat2->fetch();

				//var_dump($compte2['email']);

				$resultat3=$conn->query("SELECT mdp from utilisateur WHERE email='$email'");
				$compte3=$resultat3->fetch();

				echo "<div>Votre mot de passe est : ";
				echo $compte3['mdp'];
				echo "</div> <br><br>";

				//var_dump($compte3['mdp']);


				/*$send_to=$compte2['email'];
				var_dump($send_to);

				$subject_mail="Votre Mot de Passe";
				
				$message_mail='<html>';
				$message_mail.='<body>';
				$message_mail.=$compte3['mdp'];
				$message_mail.='</body>';
				$message_mail.='</html>';
				var_dump($message_mail);

				//$headers='MIME-Version: 1.0' . "\r\n";
				//$headers.='Content-type: text/html; charset=UTF-8' . "\r\n";

				mail($send_to, $subject_mail, $message_mail);

				//var_dump(mail);
				*/
			}


		}

		catch(PDOException $e)
    	{
    		echo $sql . "<br>" . $e->getMessage();
    	}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Mot de passe oublié</title>
	<LINK rel="STYLESHEET" href="stylemusique.css" 	type="text/css">
</head>
<body>
	<a href="connexion.php">Retour</a>
	<img id="notemusique" src="image/note_musique.png">
	
	<h1>Retrouvez votre mot de passe!</h1>

<h4>
	Veuillez entrer votre adresse e-mail. <br>
</h4>

	<form method="post" action="mdp_oublie.php">
	<p>
		<b>E-mail :</b><br>
		<input class="a"type="text" name="email" required>
		<br><br>

		<input type="submit" name="envoyer" value="Envoyer" class="bouton" required>
		<br><br>

		<img id="notemusique" src="image/note_musique.png">
	</p>
	</form>
</body>
</html>