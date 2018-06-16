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
                "category_select" => [
                    "label" => "Selection des catégories",
                    "description" => "Vous avez le droit à plusieurs choix",
                    "multiple" => true,
                    "options" => $option
                ],
                "category_input" => [
                    "type"=>"text",
                    "placeholder"=>"Ajouts de catégories",
                    "required"=>false,
                    "label"=>"Ajouter des catégories",
                    "description"=>"Format attendu : [category 1; category 2; category 3]. Il seront automatiquement ajoutés."
                ],
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

    /**
     * @param string $_input
     * @return array|int Category
     *
     */
    public function addCategory($_input, $_type, $_targetId)
    {
        if(is_string($_input)){
            $inputExploded = explode(';', $_input);
            switch($_type){
                case 'blog': $type = 1; break;
                case 'lesson': $type = 2; break;
                default: return ['CODE_ERROR' => '1'];
            }
            $arrayTag = [];
            foreach($inputExploded as $categoryName){
                $this->setName($categoryName);
                $this->setType($type);
                $this->setTag();
                $arrayTag[] = $this->getTag();
                $this->save();
            }
            $categoryBlog = new CategoryBlog();
            foreach($arrayTag as $tag){
                $this->getCategoryByTag($tag);
                $categoryBlog->setBlogId($_targetId);
                $categoryBlog->setCategoryId($this->getId());
                $categoryBlog->save();
            }
            return 1;
        }
        return ['CODE_ERROR' => '0'];
    }

    /**
     * @param string $_tag
     * Trouve une catégorie par son tag
     */
    public function getCategoryByTag($_tag)
    {
        $target = [
            'id',
            'name',
            'type',
            'tag',
        ];
        $parameter = [
            'LIKE' => [
                'tag' => $_tag
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    /**
     * @param string $_identifier
     * @param int $_id
     * @return array|int category
     *
     */
    public function getCategoryByIdentifier($_identifier, $_id)
    {
        $target = ["id", "name"];
        $joinParameter = [
            "categoryblog" => [
                "category_id"
            ]
        ];
        $whereParameter = [
            "categoryblog" => [
                $_identifier."_id" => $_id
            ]
        ];
        $this->setLeftJoin($joinParameter, $whereParameter);
        $array = $this->getData($target);
        $returnArrayId= [];
        foreach($array as $category) {
            $returnArrayId[$category->getId()] = $category->getName();
        }
        return $returnArrayId;
    }
}