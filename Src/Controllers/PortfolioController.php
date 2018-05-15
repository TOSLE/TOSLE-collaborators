<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 27/03/2018
 * Time: 22:44
 */

class PortfolioController
{
    /**
     * @Route("/en/portfolio(/index)")
     * @param array $params
     * Default action of PortfolioController
     */
    function indexAction($params)
    {
        $View = new View("default","portfolio/portfolio");


    }

    /**
     * @Route("/en/portfolio/edit")
     * @param array $params
     * Edit portfolio action
     */
    function editAction($params)
    {
        $View = new View("default");


    }
    /**
     * @Route("/en/portfolio/add")
     * @param array $params
     * Edit portfolio action
     */
    function addfileAction($params)
    {

        $View = new view("default","portfolio/portfolio");
        $fileaddportfolio->setId('Id');
        $fileaddportfolio->setName('Name');
        $fileaddportfolio->setValue("Value");
        $fileaddportfolio->save();

 
if(isset($_POST['Id'])&& isset($_POST['Name']) && isset($_POST['Value'])) {
 
 
   if(isset($fileaddportofolio['photo1']) && $fileaddportofolio['photo1']['error']==0) { 
    move_uploaded_file($fileaddportofio['photo1']['Name'],
    'tosle.fr/en/portofolio/portofolio'.basename($fileaddportfolio['photo1']['Name']));
    echo 'L\'envoi a bien été effectué';
 
 
 
    } 
 
 
          try{ // Connexion à la BDD
          $bdd=new PDO('mysql:host=root;dbname=tosle_database', 'tosle_file','file_path');
 
          }
 
          catch(Exception $e){
          die ('Erreur:'.$e->getMessage());
 
          }
 
 
 
            
        $stockage='tosle.fr/en/portofolio/portofolio'.$_['photo1']['Name'].'';
        $insertion=$bdd->prepare('INSERT INTO () VALUES ()');       
        $insertion->execute(array(
 'Id' => $_POST['Id'],
 'Name' => $_POST['Name'],
 'Value' => $_POST['Value'],

));                          
            if($insertion==true) {
            echo '<p> Les données ont bien été enregistrées</p>';
            }
            else {
            echo 'Erreur dans l\'enregistrement des données </p>';
                } 
 
 
 
 
 
            $insertion->closeCursor(); // déconnexion
 
}
?>



);

}