<?php
/**
 * Created by PhpStorm.
 * User: Najla
 * Date: 19/06/2018
 * Time: 15:38
 */

class PortfolioRepository extends Portfolio
{
    /**
     * @param int $_colsize
     * @return array object
     * Permet de récupérer la configuration d'une modal pour les ajouts concernant les s
     * Le paramètre permet de définir la taille du bloc
     */
    public function getModalAdd($_colsize = 6)
    {
        $BlocGeneral = new PortfolioBlocModal();

        $routes = Access::getSlugsById();

        $BlocGeneral->setColSizeBloc($_colsize);
        $BlocGeneral->setTitle("Menu général");
        $BlocGeneral->setTableHeader([
            1 => "Name of action",
            2 => "Action"
        ]);
        $BlocGeneral->setTableBodyClass([
            1 => "td-content-text",
            2 => "td-content-action"
        ]);
        $BlocGeneral->setColSizeBloc(6);
        $BlocGeneral->setTableBodyContent([
            0 => [
                1 => "Créer un nouveau cours",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["portfolio-view/add/add"] . "/block1",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ],
            1 => [
                1 => "Créer un chapitre",
                "button_action" => [
                    "type" => "href",
                    "target" => $routes["portfolio-view/add"] . "/block",
                    "color" => "tosle",
                    "text" => "New post"
                ]
            ]
        ]);
        return $BlocGeneral->getArrayData();
    }

    /**
     * @param array $_post
     * @param int|null $_idPortfolio
     * @return array|int
     */
    public function addPortfolio($_post, $_idPortfolio = null)
    {

        $errors = Form::checkForm($this->configFormAddPortfolio(), $_post);
        if (empty($errors)) {
            $tmpPostArray = $_post;
            if (isset($_idPortfolio)) {
                $this->setId($_idPortfolio);
            }
            $this->setTitle($tmpPostArray["title"]);
            $this->setDescription($tmpPostArray["textarea_Portfolio"]);
            (isset($tmpPostArray["publish"])) ? $this->setStatus(1) : $this->setStatus(0);
            $this->setUrl(Access::constructUrl($this->getTitle()));
            $this->save();

            $this->getPortfolioByUrl($this->getUrl());
            if (isset($tmpPostArray["category_select"]) && !empty($tmpPostArray["category_select"])) {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryBySelect($tmpPostArray["category_select"], 'Portfolio', $this->getId());
            }
            if (isset($tmpPostArray["category_input"]) && !empty($tmpPostArray["category_input"])) {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryByInput($tmpPostArray["category_input"], 'Portfolio', $this->getId());
                if (!is_numeric($arrayCategory)) {
                    if (array_key_exists('CODE_ERROR', $arrayCategory)) {
                        return $arrayCategory;
                    }
                }

            }
            return 1;
        } else {
            return $errors;
        }
    }

    public function getPortfolioByUrl($_url)
    {
        $parameter = [
            "LIKE" => [
                "url" => $_url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["id", "title", "description", "status", "url", "datecreate"]);
        if (!isset($this->id)) {
            return false;
        } else {
            return true;
        }
    }
}