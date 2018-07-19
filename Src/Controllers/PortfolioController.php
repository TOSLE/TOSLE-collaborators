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
     * @Route("/en/portfolio-view")
     * @param array $params
     * Default action of PortfolioController
     */
    function indexAction($params)
    {
        $View = new View("Portfolio", "portfolio/portfolio");
        $View->setData("PageName", NAV_DASHBOARD . " " . GLOBAL_HOME_TEXT);
    }


    /**
     * @Route("/en/portfolio/add/{params}")
     * @param array $params
     * Add Block
     */


    function addAction($params)
    {
        $routes = Access::getSlugsById();
        $portfolio=New PortfolioRepository();
        $form=$portfolio->configFormAddPortfolio();
        if(!empty($params["POST"])) {
            $errors = Form::checkForm($form,$params["POST"]);
        }
        $View = new View("portfolio", "Portfolio/add_article_portfolio");
        $View ->setData("config",$form);
        $View->setData("errors","");


        /* if (isset($params["URI"][0])) {
             $getTypeURI = $params["URI"][0];
             /*
             $View->setData("errors", "");
             if ((isset($params["POST"]) && !empty($params["POST"]))) {
                 $resultAdd = $portfolio->addportfolio($params["POST"]);
                 if ($resultAdd === 1) {
                     header('Location:' . $routes['portfolio-view/add']);
                 } else {
                     $View->setData("errors", $resultAdd);
                 }
             }

             if ($getTypeURI == "lesson") {
                 $View->setData("configForm", $portfolio->configFormAddPortfolio());
             } else {
                 header('Location:' . $routes['portfolio-view/add'] . '/error');
             }
         } else {
             header('Location:' . $routes['portfolio_add']);
         } */
    }


    public function editAction($params)
    {
        $routes = Access::getSlugsById();
        if(isset($params["URI"][0])){
            if(is_numeric($params["URI"][0])) {
                $File= new FileRepository();
                $View = new View("portfolio", "portfolio-view");
                $arrayReturn = $File->editFile($params["URI"][0]);
                $arrayFile = $arrayReturn["portfolio"];
                $configForm = $arrayReturn["configForm"];
                $configForm["data_content"] = [
                    "title" => $arrayFile->getTitle(),
                    "content" => $arrayFile->getDescription(),
                    "select_color" => $arrayFile->getColor(),
                    "selectedOption" => $arrayReturn['selectedOption'],
                    "select_type" => $arrayFile->getType(),

                ];
                if(isset($params["POST"]) && !empty($params["POST"])){
                    $resultAdd = $File->addFile($params["POST"], $params["URI"][0]);
                    if($resultAdd == 1){
                        header('Location:'.$routes['portfolio-view']);
                    }
                }
                $View->setData("errors", "");
                $View->setData("configForm", $configForm);
            }
        } else {
            header('Location:'.$routes['portfolio-view']);
        }

    }}

    /*  function statusAction($params)
      {
          $routes = Access::getSlugsById();
          $Portfolio = new Portfolio();

          $target = [
              "id",
              "status"
          ];
          $parameter = [
              "LIKE" => [
                  "id" => $params["URI"][0]
              ]
          ];
          $Portfolio->setWhereParameter($parameter);
          $Portfolio->getOneData($target);
          if ($Portfolio->getId()) {
              if ($Portfolio->getStatus() > 0) {
                  $Portfolio->setStatus(0);
              } else {
                  $Portfolio->setStatus(1);
              }
              $Portfolio->save();
          }

          header('Location:' . $routes["dashboard_portfolio"]);
      }
  */

