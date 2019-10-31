<?php
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

	if (isset($_POST['inscription'])) 
	{
			
		try
		{
			$prenom=$_POST['prenom'];
			$nom=$_POST['nom'];
			$jour_naissance=$_POST['jour_naissance'];
			$mois_naissance=$_POST['mois_naissance'];
			$annee_naissance=$_POST['annee_naissance'];
			$email=$_POST['email'];
			$login=$_POST['login'];
			$mdp=$_POST['mdp'];
			$confirme_mdp=$_POST['confirme_mdp'];

			$resultat=$conn->query("SELECT count(*) FROM utilisateur WHERE login='$login' or email='$email'");
			$compte=$resultat->fetch();

			if($compte['count(*)']==0)
			{
				if ($mdp==$confirme_mdp) 
				{
					$sql = "INSERT INTO utilisateur (login, mdp, nom, prenom, ddn, email,grade)
    				VALUES ('$login', '$mdp', '$nom', '$prenom', '$annee_naissance$mois_naissance$jour_naissance', '$email','membre')";
    				$conn->exec($sql);
					header('Location: connexion.php');
				}

				else
				{
					echo "<div>";
					echo "Attention! Mots de passe non identiques.";
					echo "</div> <br><br>";
				}
			}

			else
			{
				echo "<h4>
						Attention ! <br>
						Le login et/ou l'email est déjà utilisé. <br>
						Vérifiez que vous n'avez pas déjà de compte avec et email, sinon choisissez un autre login.
						</h4>";
			}

		
    	}

		catch(PDOException $e)
    	{
    		echo $sql . "<br>" . $e->getMessage();
    	}

    }

    //var_dump($photo);
?>


<!DOCTYPE html>

<html>
<head>
	<title>Devenez Membre</title>
	<LINK rel="STYLESHEET" href="stylemusique.css" 	type="text/css">
</head>
<body>
	<img id="notemusique" src="image/note_musique.png">
	<h1>Devenez membre!</h1>
			
	<form action="inscription.php" method="post" enctype="multipart/form-data">
	<p>
		<b>Pr&eacute;nom :</b>
		<input class="a"type="text" name="prenom" autocomplete="on" required>
		<br><br>
					
		<b>Nom :</b>
		<input class="a"type="text" name="nom" autocomplete="on" required>
		<br><br>
		
		<b>Date de naissance :</b>
		<select name="jour_naissance">
			<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>					
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
			<option value="13">13</option>
			<option value="14">14</option>
			<option value="15">15</option>
			<option value="16">16</option>
			<option value="17">17</option>
			<option value="18">18</option>
			<option value="19">19</option>
			<option value="20">20</option>
			<option value="21">21</option>
			<option value="22">22</option>
			<option value="23">23</option>
			<option value="24">24</option>
			<option value="25">25</option>
			<option value="26">26</option>
			<option value="27">27</option>
			<option value="28">28</option>
			<option value="29">29</option>
			<option value="30">30</option>
			<option value="31">31</option>
		</select>

		<select name="mois_naissance">
			<option value="01">Janvier</option>
			<option value="02">Février</option>
			<option value="03">Mars</option>
			<option value="04">Avril</option>
			<option value="05">Mai</option>
			<option value="06">Juin</option>
			<option value="07">Juillet</option>
			<option value="08">Août</option>
			<option value="09">Septembre</option>
			<option value="10">Octobre</option>
			<option value="11">Novembre</option>
			<option value="12">Décembre</option>
		</select>

		<select name="annee_naissance">
			<option value="1990">1990</option>
			<option value="1991">1991</option>
			<option value="1992">1992</option>
			<option value="1993">1993</option>
			<option value="1994">1994</option>
			<option value="1995">1995</option>
			<option value="1996">1996</option>
			<option value="1997">1997</option>
			<option value="1998">1998</option>
			<option value="1999">1999</option>
			<option value="2000">2000</option>
		</select>
		<br><br>
		
		<b>Email :</b>
		<input class="a"type="text" name="email" required>
		<br><br>
					
		<b>Login :</b>
		<input class="a"type="text" name="login" pattern="[A-Z]{1}[A-Za-z]{0,}" title="Identifiant Invalide" autofocus required>
		<i>Votre identifiant doit commencer par une lettre majusucule</i>
		<br><br>
					
		<b>Mot de passe :</b>
		<input class="a"type="password" name="mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}" title="Mot de Passe Invalide" required>

		<b>Confirmer mot de passe:</b>
		<input class="a"type="password" name="confirme_mdp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}" title="Mot de Passe Invalide" required>

		<i>Votre mot de passe doit &ecirc;tre entre 4 et 8 caract&egrave;res, et doit contenir au moins une lettre majuscule, une lettre minuscule et un chiffre.</i>
		<br><br>
		
		<input type="submit" name="inscription" value="INSCRIPTION" class="bouton">
		<br><br>
					
		<img id="notemusique" src="image/note_musique.png">
		<br><br>

		<b>Déjà inscrit ? </b><a href="connexion.php"><b>Connectez-vous</b></a>
	</p>
	</form>
</body>
</html>

