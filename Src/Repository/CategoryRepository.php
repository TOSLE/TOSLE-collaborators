<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 14/06/2018
 * Time: 15:57
 */

class CategoryRepository extends Category
{
    /**
     * @param int $_type
     * @return array
     * Retourne le tableau à fournir aux config forms de nos formulaires. Il faut juste fournir le type de catégorie
     */
    public function configFormCategory($_type = 1)
    {
        $option = [];
        foreach($this->categoryByType($_type) as $category) {
            $option[$category->getId()] = $category->getName();
        }
        return [
                "category_input" => [
                    "type"=>"text",
                    "placeholder"=>"Ajouts de catégories",
                    "required"=>false,
                    "label"=>"Ajouter des catégories",
                    "description"=>"Format attendu : [category 1; category 2; category 3]"
                ],
                "category_select" => [
                    "label" => "Select tag",
                    "description" => "Vous avez le droit à plusieurs choix",
                    "multiple" => true,
                    "options" => $option
                ]
            ];
    }

    /**
     * @param int $_type
     * @return array Category
     * Retourne la liste des catégory en fonction d'un status. Par défaut à 1
     * Identifiant des types :
     *  1->Blog
     *  2->Lesson
     */
    public function categoryByType($_type = 1)
    {
        $target = [
           "id",
           "name",
           "type"
        ];
        $parameter = [
            "LIKE" => [
                "type" => $_type
            ]
        ];
        $this->setWhereParameter($parameter);
        return $this->getData($target);
    }
}