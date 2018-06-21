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
                        $arrayFile = $File->addFile($_FILES, $configForm, "Blog/Article", "Background image");
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

            $this->getArticleByUrl($this->getUrl());

            if(isset($tmpPostArray["category_select"]) && !empty($tmpPostArray["category_select"]))
            {
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryBySelect($tmpPostArray["category_select"], 'blog', $this->getId());
            }
            if(isset($tmpPostArray["category_input"]) && !empty($tmpPostArray["category_input"])){
                $category = new CategoryRepository();
                $arrayCategory = $category->addCategoryByInput($tmpPostArray["category_input"], 'blog', $this->getId());
                if(!is_numeric($arrayCategory)){
                    if(array_key_exists('CODE_ERROR', $arrayCategory)){
                        return $arrayCategory;
                    }
                }

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
        ];
    }
}