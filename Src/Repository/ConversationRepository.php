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
     * @return array Conversation
     * Cette fonction va chercher toutes les conversations et récupérer toutes les informations de la conversation
     */
    public function getConversations($_filter = null)
    {
        if(!isset($_filter)){
            $parameter = [
                'LIKE' => [
                    'type' => 1
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
}