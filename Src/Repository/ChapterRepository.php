<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 21/06/2018
 * Time: 11:01
 */

class ChapterRepository extends Chapter
{
    /**
     * @param array $_file
     * @param array $_post
     * @param int|null $_idArticle
     * @return array|int
     * Permet d'ajouter et de gérer les erreurs pour l'insertion d'un chapitre
     */
    public function addChapter($_file, $_post, $_idArticle = null)
    {
        $configForm = $this->configFormAdd();
        $errors = Form::checkForm($configForm, $_post);
        $_post = Form::secureData($_post);
        if(empty($errors)){
            $file = null;
            if(isset($_file)){
                $errors = Form::checkFiles($_file);
                if(empty($errors) || is_numeric($errors)){
                    if( $errors != 1) {
                        $File = new FileRepository();
                        $arrayFile = $File->addFile($_FILES, $configForm, "Lesson/Chapter", "File attach to chapter");
                        if(!is_numeric($arrayFile)){
                            if(array_key_exists('CODE_ERROR', $arrayFile)){
                                return $arrayFile;
                            }
                            foreach ($arrayFile as $fileId) {
                                $file = $fileId;
                            }
                        }
                    }
                } else {
                    if(!array_key_exists('EXCEPT_ERROR', $errors)){
                        return $errors;
                    }
                }
            }
            $tmpPostArray = $_post;
            if(isset($_idArticle)) {
                $this->setId($_idArticle);
            }

            $this->setTitle($tmpPostArray["title"]);
            $this->setContent($tmpPostArray["ckeditor_chapter"]);
            (isset($tmpPostArray["publish"]))?$this->setStatus(1):$this->setStatus(0);
            $this->setType(1);
            $this->setUrl(Access::constructUrl($this->getTitle()));
            $this->setFileid($file);
            $this->save();

            $this->getChapterByUrl($this->getUrl());
            if($tmpPostArray['select_lesson'] != 'default'){
                if($tmpPostArray['select_lesson'] != $this->getLessonchapter()->getLessonId()){
                    $LessonChapter = new LessonChapter();
                    $LessonChapter->deleteJoin('id', $this->getLessonchapter()->getId());
                    $Lesson = new LessonRepository();
                    $Lesson->generateXml();
                    $Lesson->addChapter($tmpPostArray['select_lesson'], $this->getId());
                }
            } else {
                return ['Lesson' => 'Lesson not found'];
            }
            return 1;
        } else {
            return $errors;
        }
    }

    public function getChapterByUrl($_url)
    {
        $target = [
            'id'
        ];
        $parameter = [
            'LIKE' => [
                'url' => $_url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
        $this->getChapterById($this->id);
    }

    /**
     * @param $_id
     * Retourne les informations d'un chapitre par rapport à un id
     */
    public function getChapterById($_id)
    {
        $target = [
            'id',
            'title',
            'content',
            'datecreate',
            'status',
            'type',
            'url',
            "fileid",
            '_lessonchapter_id'
        ];
        $joinParameter = [
            "lessonchapter" => [
                "chapter_id"
            ]
        ];
        $parameter = [
            'LIKE' => [
                'id' => $_id
            ]
        ];
        $whereParameter = [
            "lessonchapter" => [
                "chapter_id" => $_id
            ]
        ];
        $this->setLeftJoin($joinParameter, $whereParameter);
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    /**
     * @param $_idChapter
     * @return array|int
     * Cette fonction retourne les éléments nécessaires à l'affichage des formulaires pour editer un article
     */
    public function editChapter($_idChapter)
    {
        $this->getChapterById($_idChapter);
        if(!empty($this->id)){
            $File = null;
            if(!empty($this->getFileid())){
                $File = $this->getFileid();
            }
            return $arrayObject = [
                "chapter" => $this,
                "file" => $File,
                "configForm" => $this->configFormAdd()
            ];
        } else {
            return 0;
        }
    }


    /**
     * @param string $type
     * @param int $_chapterId
     * @return int
     * En fonction du paramètre type, l'ordre va être incrémenter ou décrémenter
     * Ne peut pas descendre en dessous de 1
     */
    public function orderUpdate($type, $_chapterId)
    {
        $this->getChapterById($_chapterId);
        $order = $this->getLessonchapter()->getOrder();
        switch ($type){
            case "up":
                $this->getLessonchapter()->setOrder($order+1);
                break;
            case "down":
                if($order > 1){
                    $this->getLessonchapter()->setOrder($order-1);
                }
                break;
            default:
                return 0;
                break;
        }
        $this->getLessonchapter()->save();
        return 1;
    }


    /**
     * @param null $_id
     * @return array|int
     * Récupère les commentaires du chapitres
     */
    public function getComments($_id = null)
    {
        if(isset($_id)){
            $idChapter = $_id;
        } else {
            $idChapter = $this->getId();
        }
        $Comment = new CommentRepository();
        $allComments = $Comment->getAll('chapter', $idChapter);
        return $allComments;
    }
}