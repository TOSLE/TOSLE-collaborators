<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 30/05/2018
 * Time: 10:47
 */

class CommentRepository extends Comment
{
    public function getComment($identifier, $value)
    {
        $target = [
            "id",
            "content",
            "tag"
        ];
        if($identifier === "tag"){
            $parameter = [
                "LIKE" => [
                    "tag" => $value
                ]
            ];
        }
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    public function getAll($identifier, $value)
    {
        if($identifier == "blog"){
            $target = ["id", "content", "tag"];
            $joinParameter = [
                "blogcomment" => [
                        "comment_id"
                ]
            ];
            $whereParameter = [
                "blogcomment" => [
                    "blog_id" => $value
                ]
            ];
            $this->setLeftJoin($joinParameter, $whereParameter);
            return $this->getData($target);
        }
    }
}