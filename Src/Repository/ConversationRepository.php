<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 15/07/2018
 * Time: 22:41
 */

class ConversationRepository extends Conversation
{
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
}