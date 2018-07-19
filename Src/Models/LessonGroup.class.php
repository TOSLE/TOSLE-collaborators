<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 04/07/2018
 * Time: 21:50
 */

class LessonGroup extends CoreSql
{
    protected $id;
    protected $lessonid;
    protected $groupid;

    /**
     * LessonGroup constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getLessonid()
    {
        return $this->lessonid;
    }

    /**
     * @param int $lessonid
     */
    public function setLessonid($lessonid)
    {
        $this->lessonid = $lessonid;
    }

    /**
     * @return int
     */
    public function getGroupid()
    {
        return $this->groupid;
    }

    /**
     * @param int $groupid
     */
    public function setGroupid($groupid)
    {
        $this->groupid = $groupid;
    }

    /**
     * @param $_idLesson
     * @param $_idGroup
     * Ajoute une entrée dans la table en fonction des jointures
     */
    public function addLessonGroup($_idLesson, $_idGroup)
    {
        if(isset($_idLesson) && isset($_idGroup) && is_numeric($_idLesson) && is_numeric($_idGroup)){
            $this->setGroupid($_idGroup);
            $this->setLessonid($_idLesson);
            $this->save();
        }
    }

    /**
     * @param int $_idLesson
     * @return array|null
     * Renvoie un tableau contenant les id des groupes d'une leçon
     * Le foo s'explique pour faire du remplissage, les selects utilisent la Clef pour identifier les options "selected"
     * Afin de ne pas avoir à tout réadapter, on a simplement rajouter une valeur de type string pour du remplissage.
     */
    public function getGroupsLesson($_idLesson)
    {
        if(isset($_idLesson) && is_numeric($_idLesson)) {
            $parameter = [
                'LIKE' => [
                    'lessonid' => $_idLesson
                ]
            ];
            $this->setWhereParameter($parameter);
            $groups = $this->getData(['groupid']);
            if(sizeof($groups) > 0 ){
                $arrayReturn = [];
                foreach($groups as $group){
                    $arrayReturn[$group->getGroupid()] = "foo";
                }
                return $arrayReturn;
            }
            return null;
        }
        return null;
    }

}