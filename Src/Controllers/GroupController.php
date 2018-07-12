<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 12/07/2018
 * Time: 17:09
 */

class GroupController extends CoreController
{
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
}