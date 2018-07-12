<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/07/2018
 * Time: 17:09
 */

class GroupController extends CoreController
{
    /**
     * @param $params
     * Permet de supprimer un groupe et les jointures qui lui sont liées
     */
    public function deleteAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Group = new GroupRepository($params['URI'][0]);
            $UserGroup = new UserGroup();
            $LessonGroup = new LessonGroup();
            $parameterJoin = [
                'LIKE' => [
                    'groupid' => $Group->getId()
                ]
            ];
            $UserGroup->setWhereParameter($parameterJoin);
            $LessonGroup->setWhereParameter($parameterJoin);
            $UserGroup->delete();
            $LessonGroup->delete();
            $Group->deleteGroup();
        }
        header('Location:'.$this->Routes['dashboard_student']);
    }

    /**
     * @param $params
     * Cette fonction permet d'édité un profile
     */
    public function editAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Group = new GroupRepository($params['URI'][0]);
            $View = new View("dashboard", "Dashboard/add_group");
            $configForm = $Group->configFormAdd();
            $file_img = null;
            if(!empty($Group->getFileid())){
                $file_img = $Group->getFileid()->getPath().'/'.$Group->getFileid()->getName();
            }
            $configForm['data_content'] = [
                "name" => $Group->getName(),
                "selectedOption" => $Group->getUserForSelect($Group->getId()),
                "file_img" => $file_img
            ];
            $errors = "";
            if(isset($params['POST']) && !empty($params['POST'])){
                $errors = $Group->addGroup($_FILES, $params["POST"], $Group->getId());
                if($errors === 1){
                    header('Location:'.$this->Routes['dashboard_student']);
                }
            }
            $View->setData("errors", $errors);
            $View->setData("configForm", $configForm);
        }
    }
}