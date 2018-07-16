<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 06/04/2018
 * Time: 20:24
 */

class MessageConversation extends CoreSql
{
    protected $id;
    protected $messageid;
    protected $conversationid;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMessageid()
    {
        return $this->messageid;
    }

    /**
     * @param mixed $messageid
     */
    public function setMessageid($messageid)
    {
        $this->messageid = $messageid;
    }

    /**
     * @return mixed
     */
    public function getConversationid()
    {
        return $this->conversationid;
    }

    /**
     * @param mixed $conversationid
     */
    public function setConversationid($conversationid)
    {
        $this->conversationid = $conversationid;
    }

    public function getMessageConversation($_origin, $_value)
    {
        switch($_origin){
            case 'conversation':
                $opposite = 'messageid';
                break;
            case 'message':
                $opposite = 'conversationid';
                break;
        }
        $parameter = [
            'LIKE' => [
                $_origin.'id' => $_value
            ]
        ];
        $array = [];
        $this->setWhereParameter($parameter);
        foreach($this->getData() as $messageconversation){
            $tmpString = 'get'.ucfirst(strtolower($opposite));
            $array[] = $messageconversation->$tmpString();
        }
        return $array;
    }

    
}