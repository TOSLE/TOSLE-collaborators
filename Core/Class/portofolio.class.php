<?php

require_once 'CoreSql.class.php';
 
if(isset($_FILES['fichier']))
{ $req = mysql_query('INSERT INTO infos (fichier) VALUES ("' . mysql_real_escape_string($fichier) . '"');

	 //définition du fichier
     $fichier = basename($_FILES['fichier']['name']);
 
	 //copie du fichier uploader dans le répertoire définie précedemment 
     if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $fichier)) 
 
	  $req = mysql_query("INSERT INTO infos VALUES ('dossier')");
	 {
          echo 'Upload effectué avec succès !';	
 
 
		// on affiche l' image
          echo $fichier;
          echo "Affiche image : <img src=upload/$fichier>";
 
 
          echo '<img src="$fichier" border="0" /> ';
 
 
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
	
	if(!in_array($extension, $extensions)) 
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
*/
}
?>
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>
 
    <body>
    <form action="CoreSql.class.php" method="post" enctype="multipart/form-data">
        <p>
                Formulaire d'envoi de fichier :<br />
                <input type="file" name="fichier" /><br />
                <input type="submit" value="Envoyer le fichier" />
        </p>
</form>
 
 
</body>
</html>

