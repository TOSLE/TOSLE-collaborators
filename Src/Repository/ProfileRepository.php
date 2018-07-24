<?php
/**
 * Created by PhpStorm.
 * User: Mehdi ABKHOUKH
 * Date: 03/07/2018
 * Time: 18:11
 */

class ProfileRepository extends User
{
    /**
     * @param $token token de la session en cours
     * @param $email email de la session en cours
     * @return array des informations utilisateurs
     */
    public function getInfoUser($token, $email) {
        $User = new UserRepository();
        $User->getUserBySession($token, $email);
        return [
            "firstname" => $User->getFirstName(),
            "lastname" => $User->getLastName(),
            "email" => $User->getEmail(),
            "newsletter" => $User->getNewsletter(),
        ];
    }

    public function getCommentUser($_idUser)
    {
        $Comment = new CommentRepository();

        $objectsCommentUserBlog = $Comment->getCommentByUserId('blog', $_idUser);
        $objectsCommentUserChapter = $Comment->getCommentByUserId('chapter', $_idUser);

        $commentaires = null;

        foreach ($objectsCommentUserBlog as $comments) {
            $commentaires[] = [
                "id" => $comments->getId(),
                "content" => $comments->getContent(),
                "date" => $comments->getDatecreate(),
                "type" => 'Blog',
            ];
        }

        foreach ($objectsCommentUserChapter as $comments) {
            $commentaires[] = [
                "id" => $comments->getId(),
                "content" => $comments->getContent(),
                "date" => $comments->getDatecreate(),
                "type" => 'Chapter',
            ];
        }

        /**
         * Tri le tableau par date
         */
        if (isset($commentaires)) {
            foreach ($commentaires as $key => $part) {
                $sort[$key] = strtotime($part['date']);
            }
            array_multisort($sort, SORT_DESC, $commentaires);

            return $commentaires;
        }
        else {
            $commentaires[] = [
                "content" => "No comment at the moment",
                "date" => " ",
                "type" => " ",
            ];

            return $commentaires;
        }
    }
    public function editProfile($_idProfile)
    {
        $User = new UserRepository($_idProfile);
        $configForm = $User->configFormEdit();
        $file = null;
        if(!empty($User->getFileid())){
            $file = "".$User->getAvatar()->getPath().'/'.$User->getAvatar()->getName();
        }
        $configForm["data_content"] = [
            "firstname" => $User->getFirstName(),
            "lastname" => $User->getLastName(),
            "email" => $User->getEmail(),
            "file_img" => $file,
        ];
        return $configForm;
    }

}