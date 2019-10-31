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
    <li class='gauche'><a href='modifierprofil.php'>Profil</a></li>
  ";
  
  if($_SESSION['login']=='Admin'){echo "<li class='gauche'><a href='liste_membre.php'>Liste des membres</a></li>";}

  echo  "<li class='droite'><img src='image/profil1.png' height='30px'></li>
    <li class='droite'>".$nomPrenom['nom']." ".$nomPrenom['prenom']."</li>
    <li class='droite'><form method='post' action='recherche.php'>
    <input type='text' name='recherche' autocomplete='on' placeholder='titre,chanteur'>
    <input type='submit' value='Recherche'></form></li>
  </ul>";}
      $titre=$_POST['recherche'];
      $resultat=$conn->query("SELECT * FROM utilisateur,chanson where chanson.fk_num=utilisateur.num and (chanson.titre='$titre' or chanson.interprete='$titre')");
      
      
      echo "<br>";
      echo "<table align='center'><form method='post' action='like.php'>";
      echo"<tr align='center'>";
      $i=0;
      while($donnee=$resultat->fetch())
      {
        $likes=$donnee['nb_likes']."j'aime";//je definis une variable likes qui contiendra le nbr de like et la chaine j'aime
        $i+=1; //cette variable va me permettre d'aller a la ligne une fois que j'ai affiché 5 chansons sur la meme ligne

        $id =$donnee['numT'];
      
        echo "<td align='center' color='white'>";


        if(isset($donnee['image'])) 
          {
            if(isset($donnee['lien']))
            {
              echo "<a href=".$donnee['lien']."><img height=130px src=image/".
              $donnee['image']."></a>";
            }
            else 
            {
              echo "<img height=130px src=image/".$donnee['image'].">";
            }
          }
        echo "<font color='white'> <br><b>".$donnee['titre']."</b><br>  ".$donnee['interprete']."<br>Durée : ".$donnee['duree']."<br> <i>ajouté par:".$donnee['prenom']
        ." ".$donnee['nom']."</i><br><input type='submit' name='likerecherche[$id]' value=$likes required></td></font>"; // on utilise required pour empecher un like a chaque actualisation de la page
        if($i%5==0){
          echo"</tr>";
        }   

      }
      echo "</tr>";

      echo "</form></table>";

    
?>



<html>
<head>
<title>Chanson Rap</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="styleAcceuil.css">
</head>
<body >
</body>
</html>