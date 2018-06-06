<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 07/06/2018
 * Time: 00:14
 */

class FileRepository extends File
{
    public function addFile($file, $authorisedFormat, $destination)
    {
        $content_dir = DIRNAME.'/TOSLE/'.ucfirst(strtolower($destination)).'/';
        $arrayExtensionAccept = explode(' ', strtolower($authorisedFormat));
        array_push($arrayExtensionAccept, explode(' ', strtoupper($authorisedFormat));

        // Chemin de l'image
        $tmp_file = $_FILES['inputFile']['tmp_name'];
        echo $tmp_file;

        // Vérification si le fichier est trouvé
        if( !is_uploaded_file($tmp_file) ){
            exit("Le fichier est introuvable");
        }

       /*// Création d'un nom unique par images
        $name_file = uniqid('img_',false);

        //1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension_upload = strtolower(  substr(  strrchr($_FILES['inputFile']['name'], '.')  ,1)  );
        // On ajoute l'extension au nom
        $name_file .= ".".$extension_upload;
        if ( in_array($extension_upload, $arrayExtensionAccept) ) {
            if( !move_uploaded_file($tmp_file, $content_dir . $name_file) ){
                exit("Impossible de copier le fichier dans $content_dir");
            }
            echo "Le fichier a bien été uploadé <br>";

            // Fichier : OK -> On passe à la BDD
            $imgheader_dateAjout = date("d-m-y"); echo $imgheader_dateAjout;
            $imgheader_nom = htmlspecialchars($_POST['inputNameFile']);
            $imgheader_url = $content_dir.$name_file;
            $imgheader_taille = $_FILES['inputFile']['size'];
            $imgheader_nomImage = $name_file;

            echo '<br>';
            echo $imgheader_nom.'<br>'.$imgheader_url.'<br>'.$imgheader_taille;

            $req = $bdd->prepare('INSERT INTO data_image_header (imgheader_nom, imgheader_url, imgheader_taille, imgheader_dateAjout, imgheader_nomImage) VALUES(:imgheader_nom, :imgheader_url, :imgheader_taille, :imgheader_dateAjout, :imgheader_nomImage)');
            $req->execute(array(
                'imgheader_nom' => $imgheader_nom,
                'imgheader_url' => $imgheader_url,
                'imgheader_taille' => $imgheader_taille,
                'imgheader_nomImage' => $imgheader_nomImage,
                'imgheader_dateAjout' => $imgheader_dateAjout));
            ?><script type="text/javascript">document.location.href="../configSite.php?addFile=1";</script><?php
        }*/
    }
}