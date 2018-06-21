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
                    return $errors;
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
                $Lesson = new LessonRepository();
                $Lesson->addChapter($tmpPostArray['select_lesson'], $this->getId());
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
            'id',
            'fileid',
            'title',
            'content',
            'datecreate',
            'status',
            'url',
        ];
        $parameter = [
            'LIKE' => [
                'url' => $_url
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }
}