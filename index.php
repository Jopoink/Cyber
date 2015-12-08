<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title>CBS Index Page</title>
	<link rel="icon" type="image/jpg" href="http://localhost/CYBER/logomini.jpg" />
  </head>

  <body bgcolor="#FFFFFF" topmargin="5">

    <!--
    Ceci est un commentaires ;-)
    Visible que via la source !
    -->


    <!-- Début Top Menu -->
        <a name="top"></a>
    <table border="0" cellpadding="0" cellspacing="0" width="60" align="center">
      <tr>
        <td width="0" align="center">
          <CENTER><a  href="index.php" title="CBS"><img src="http://localhost/CYBER/logo1.jpg" width="400" height="50" border="0" alt="localhost" align "center"></a><CENTER>
        <br></td>
        <td width=571 valign="bottom">
		<div align="middle">
        </td>
      </tr>
    </table>
    <!-- Fin Top Menu -->
    
    <!-- 
    Break...
    -->
    
    <!-- Début Main Table -->
    <table border="20" cellpadding="0" cellspacing="0" width="1000" align="center">

      <tr>
        
			
			
        <!-- Début Main Body -->
        <td width="600" align ="center" > <br><h3>FICHE DE PRESENCE</h3><br>
          <!-- Début Mini Tableau ;-) -->
          <table align="center" width="400" border="10" cellpadding="0" cellspacing="0" bgcolor="#NNNNNN">
            <tr>
              <td bgcolor="#FFFFF9">
					
		<h3 align="center">
			<?php
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {

	$base = mysql_connect ('localhost', 'root', '');
	mysql_select_db ('cyber', $base);

	// on teste si une entrée de la base contient ce couple login / pass
	$sql = 'SELECT count(*) FROM membre WHERE login="'.mysql_escape_string($_POST['login']).'" AND psw="'.mysql_escape_string(($_POST['pass'])).'"';
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
	$data = mysql_fetch_array($req);

	mysql_free_result($req);
	mysql_close();

	// si on obtient une réponse, alors l'utilisateur est un membre
	if ($data[0] == 1) {
		session_start();
		$_SESSION['login'] = $_POST['login'];
		
				try
					{
						// On se connecte à MySQL
						$bdd = new PDO('mysql:host=localhost;dbname=cyber', 'root', '');
					}
					catch(Exception $e)
					{
						// En cas d'erreur, on affiche un message et on arrête tout
							die('Erreur : '.$e->getMessage());
					}

				
		$sql = $bdd->query('SELECT * FROM membre WHERE login="'.mysql_escape_string($_SESSION['login']).'"');
		
		$data = $sql->fetch(PDO::FETCH_BOTH);
				if($data['droit'] == 1)
				{
					header('Location: fiche.php');
					exit();
				}
				else 
				{
				if($data['droit'] == 2)
					{
					
						header('Location: membre.php');
						exit();
						
					}
					
				else 
				 {
				 
					header('Location: membre2.php');
					exit();
					
				 }
				}
	}
	// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
	elseif ($data[0] == 0) {
		$erreur = 'Compte non reconnu.';
	}
	// sinon, alors la, il y a un gros problème :)
	else {
		$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
	}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}
?>
<html>
<head>
<title>Accueil</title>
</head>
<font align="center">
<body>
<br>

Connexion à l'espace membre :<br><br>
<?php 
//echo $_SERVER['REMOTE_ADDR'];
?>
<form action="index.php" method="post">
Login : <input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"><br />
MDP : <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"><br />
<input type="submit" name="connexion" value="Connexion">
</form>
<a href="inscription.php">Inscription</a> <br>
<a href="mdpoublie.php">Mot de passe oublié ?</a><br>
<a href="ndcoublie.php">Identifiant oublié ?</a><br>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</h3>
</body>
</font>
</html>
 




                  <br />
                  
              
              </td>
            </tr>
          </table>  
          <!-- Fin Mini Tableau -->
          
          
          <br /><br /><br />
          <div align="right">
		  <a href="http://localhost/CYBER/assistance.php"><font size="+1">Assistance</font></a> <br>
            <!-- HAUT DE PAGE ------------------  <a href="#top"  title="Retourner en Haut"><i>Haut de page</i></a> ------------------------- -->
          </div>
          
        </td>
        <!-- Fin Main Body -->
      </tr>

    </table>
    <!-- Fin Main Table -->

  </body>
</html>
