<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 15/07/2018
 * Time: 22:41
 */

class ConversationRepository extends Conversation
{
    /**
     * @param null $_filter
     * @param int|null $_status
     * @return array Conversation
     * Cette fonction va chercher toutes les conversations et récupérer toutes les informations de la conversation
     */
    public function getConversations($_Auth, $_status = 1, $_filter = null)
    {
        if($_Auth->getStatus() < 2){
            if(!isset($_filter)){
                $parameter = [
                    'LIKE' => [
                        'type' => 1,
                        'status' => $_status
                    ]
                ];
                $this->setWhereParameter($parameter);
                $array = $this->getData();
                $arrayKey = [];
                foreach($array as $key => $conversation){
                    if(!($conversation->getIdowner() == $_Auth->getId() || $conversation->getIddest() == $_Auth->getId())){
                        unset($array[$key]);
                    }
                }
                foreach($array as $conversation){
                    $destination = ($conversation->getIddest() == $_Auth->getId())?$conversation->getIdowner():$conversation->getIddest();
                    $conversation->setDestination($destination);
                    $MessageConversation = new MessageConversation();
                    $arrayMessageId = $MessageConversation->getMessageConversation('conversation', $conversation->getId());
                    $conversation->setMessages($arrayMessageId);
                }

                return $array;
            }
        }
        if(!isset($_filter)){
            $parameter = [
                'LIKE' => [
                    'type' => 1,
                    'status' => $_status
                ]
            ];
            $this->setWhereParameter($parameter);
            $array = $this->getData();
            foreach($array as $conversation){
                $conversation->setDestination($conversation->getIddest());
                $MessageConversation = new MessageConversation();
                $arrayMessageId = $MessageConversation->getMessageConversation('conversation', $conversation->getId());
                $conversation->setMessages($arrayMessageId);
            }

            return $array;
        }
    }

    /**
     * @param $_idConv
     * @param $_idUser
     * @param $_post
     * @return array|string
     */
    public function addConversationMessage($_idConv, $_idUser, $_post)
    {
        $Conversation = new Conversation($_idConv);
        if(!empty($Conversation->getId())) {
            $_post = Form::secureData($_post);
            if(isset($_post['message']) && !empty($_post['message'])){
                $message = htmlspecialchars($_post['message']);
                $Message = new MessageRepository();
                $Message->addMessage($_idUser, $message);
                $Message->getMessageByTag($Message->getTag());
                $MessageConversation = new MessageConversation();
                $MessageConversation->setMessageid($Message->getId());
                $MessageConversation->setConversationid($Conversation->getId());
                $MessageConversation->save();
                return "";
            }
            return ['Erreur Message' => 'Message vide'];
        }
        return ['Erreur Conversation' => 'Conversation non trouvée'];
    }

    /**
     * @param $_auth
     * @param $_post
     */
    public function startConversation($_auth, $_post)
    {
        $errors = Form::checkForm($this->configFormAdd($_auth), $_post);
        if(empty($errors)){
            $_post = Form::secureData($_post);
            if($this->checkIdDestConversation($_post['select_user'], 1) && !empty($_post['message'])) {
                $Message = new MessageRepository();
                $MessageConversation = new MessageConversation();
                $Message->addMessage($_auth->getId(), $_post['message']);
                $Message->getMessageByTag($Message->getTag());

                (isset($_post["publish"]))?$this->setStatus(1):$this->setStatus(0);
                $this->setType(1);
                $this->setIddest($_post['select_user']);
                $this->setTag();
                $this->setIdowner($_auth->getId());
                $this->save();
                $this->getConversationByTag($this->getTag());
                $MessageConversation->setConversationid($this->getId());
                $MessageConversation->setMessageid($Message->getId());
                $MessageConversation->save();
            }
        }
    }

    public function checkIdDestConversation($_iddest, $_type)
    {
        $parameter = [
            'LIKE' => [
                'iddest' => $_iddest,
                'type' => $_type,
            ]
        ];
        $this->setWhereParameter($parameter);
        if($this->countData() > 0){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $_tag
     * Récupère une conversation en fonction du tag
     */
    public function getConversationByTag($_tag)
    {
        $parameter = [
            'LIKE' => [
                'tag' => $_tag
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData();
    }

    public function getNumberConversation($_identifier, $_value)
    {
        $parameter = [
            'LIKE' => [
                $_identifier => $_value
            ]
        ];
        $this->setWhereParameter($parameter);
        return $this->countData(['id']);
    }

    public function editConversationMessage($_idConv, $_idUser, $_post)
    {
        $Conversation = new Conversation($_idConv);
        if(!empty($Conversation->getId())) {
            $_post = Form::secureData($_post);
            if(isset($_post['message']) && !empty($_post['message'])){
                $message = htmlspecialchars($_post['message']);
                $Message = new MessageRepository();
                $MessageConversation = new MessageConversation();
                $arrayMessageId = $MessageConversation->getMessageConversation('conversation', $Conversation->getId());
                $Conversation->setMessages($arrayMessageId);
                $Conversation->getMessages()[0]->setContent($message);
                $Conversation->getMessages()[0]->save();

                $Conversation->setStatus(1);
                $Conversation->save();
                return "";
            }
            return ['Erreur Message' => 'Message vide'];
        }
        return ['Erreur Conversation' => 'Conversation non trouvée'];
    }
}