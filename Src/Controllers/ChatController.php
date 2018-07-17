<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 11/02/2018
 * Time: 23:44
 */

class ChatController extends CoreController
{
    /**
     * @Route("/en/chat(/index)")
     * @param array $params
     * Default action of ChatController
     */
    function indexAction($params)
    {
        if(isset($this->Auth)){
            $View = new View("messaging", "chat");
            $View->setData("PageName", NAVBAR_MESSAGING." ".GLOBAL_HOME_TEXT);
            $conversationView = false;
            $errorsAdd = null;

            $Conversation = new ConversationRepository();
            $conversations = $Conversation->getConversations();
            if(isset($params['POST']) && !empty($params['POST'])){
                $idConv = (isset($params['URI'][0]) && is_numeric($params['URI'][0]))?$params['URI'][0]:$conversations[0]->getId();
                $errorsAdd = $Conversation->addConversationMessage($idConv, $this->Auth->getId(), $params['POST']);
                if(empty($errorsAdd)){
                    header('Location:'.$this->Routes['chathome'].'/'.$params['URI'][0]);
                }
            }
            if(isset($conversations)){
                $conversationView = $conversations[0];
                if(isset($params['URI'][0]) && is_numeric($params['URI'][0])) {
                    foreach ($conversations as $conversation){
                        if($conversation->getId() == $params['URI'][0]) {
                            $conversationView = $conversation;
                            foreach($conversation->getMessages() as $message){
                                if($this->Auth->getId() != $message->getUserid()){
                                    $message->setStatus(1);
                                    $message->save();
                                }
                            }
                        }
                    }
                }
            }
            $View->setData('errorsAdd', $errorsAdd);
            $View->setData('conversations', $conversations);
            $View->setData('conversationView', $conversationView);
        } else {
            $User = new UserRepository();
            $View = new View("default", "Chat/connect");
            $configConnect = $User->configFormConnect($this->Routes['signin']);
            $configInscrip = $User->configFormAdd($this->Routes['signup']);
            $errorsConnect = '';
            $errorsInscrip = '';
            $View->setData('configConnect', $configConnect);
            $View->setData('errorsConnect', $errorsConnect);
            $View->setData('errorsInscrip', $errorsInscrip);
            $View->setData('configInscrip', $configInscrip);
        }
    }

    /**
     * @Route("/en/chat/view/{idMessage}")
     * @param array $params
     * View message action
     */
    function viewAction($params)
    {
        $View = new View("messaging", "chat");
        $View->setData("PageName", NAVBAR_MESSAGING." ".HEAD_TITLE_MESSAGING_VIEWACTION);
    }

    /**
     * @Route("/en/chat/new")
     * @param array $params
     * Edit new message action
     */
    function newAction($params)
    {
        $View = new View("messaging", "chat");
        $View->setData("PageName", NAVBAR_MESSAGING." ".HEAD_TITLE_MESSAGING_NEWACTION);
    }

    /**
     * @Route("/en/chat/search/{params}")
     * @param array $params
     * View message filtered
     */
    function searchAction($params)
    {
        $View = new View("messaging", "chat");
        $View->setData("PageName", NAVBAR_MESSAGING." ".HEAD_TITLE_MESSAGING_NEWACTION);
    }
}