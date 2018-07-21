<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 17/07/2018
 * Time: 23:04
 */

class MessageRepository extends Message
{
    public function addMessage($_userid, $_message)
    {
        $this->setUserid($_userid);
        $this->setContent($_message);
        $this->setStatus(1);
        $this->setTag();
        $this->save();
    }

    public function getMessageByTag($_tag)
    {
        $parameter = [
            'LIKE' => [
                'tag' => $_tag
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData();
    }

    public static function countMessage()
    {
        $Message = new Message();
        $paramater = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $Message->setWhereParameter($paramater);
        return $Message->countData(['id']);
    }
}