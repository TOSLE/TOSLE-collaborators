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
            $Conversation = new ConversationRepository();
            $View = new View("messaging", "chat");
            $View->setData("PageName", NAVBAR_MESSAGING." ".GLOBAL_HOME_TEXT);
            $conversationView = null;
            $errorsAdd = null;
            $page = "index";
            $numberStudent = UserRepository::countUser();
            $numberMessage = MessageRepository::countMessage();
            $routeChat = $this->Routes['chathome'];
            $configFormNew = $Conversation->configFormAdd($this->Auth);
            $inBoxNumber = $Conversation->getNumberConversation('status', 1, $this->Auth);
            $draftNumber = $Conversation->getNumberConversation('status', 0, $this->Auth);
            $tashNumber = $Conversation->getNumberConversation('status', -1, $this->Auth);
            $totalConv = $inBoxNumber + $draftNumber + $tashNumber;

            $conversations = $Conversation->getConversations($this->Auth, 1);
            if(isset($params['POST']) && !empty($params['POST'])){
                $idConv = (isset($params['URI'][0]) && is_numeric($params['URI'][0]))?$params['URI'][0]:$conversations[0]->getId();
                $errorsAdd = $Conversation->addConversationMessage($idConv, $this->Auth->getId(), $params['POST']);
                if(empty($errorsAdd)){
                    $tmpString = (isset($params['URI'][0]))?$params['URI'][0]:'';
                    header('Location:'.$this->Routes['chathome'].'/'.$tmpString);
                }
            }
            if(isset($conversations) && !empty($conversations)){
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
            $View->setData('routeChat', $routeChat);
            $View->setData('numberStudent', $numberStudent);
            $View->setData('numberMessage', $numberMessage);
            $View->setData('inBoxNumber', $inBoxNumber);
            $View->setData('draftNumber', $draftNumber);
            $View->setData('tashNumber', $tashNumber);
            $View->setData('totalConv', $totalConv);
            $View->setData('errorsAdd', $errorsAdd);
            $View->setData('configFormNew', $configFormNew);
            $View->setData('conversations', $conversations);
            $View->setData('conversationView', $conversationView);
            $View->setData('page', $page);
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

    /**
     * @param $params
     * Fonction qui ajoute une nouvelle conversation puis redirrige vers la page home
     */
    function addconvAction($params)
    {
        if(isset($params['POST']) && !empty($params['POST'])){
            $Conversation = new ConversationRepository();
            $Conversation->startConversation($this->Auth, $params['POST']);
        }
        header('Location:'.$this->Routes['chathome']);
    }

    /**
     * @param $params
     * Fonction qui ajoute une nouvelle conversation puis redirrige vers la page home
     */
    function trashAction($params)
    {
        if(isset($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Conversation = new ConversationRepository($params['URI'][0]);
            $Conversation->setStatus(-1);
            $Conversation->save();
        }
        header('Location:'.$this->Routes['chathome']);
    }

    /**
     * @param $params
     * Fonction qui ajoute une nouvelle conversation puis redirrige vers la page home
     */
    function untrashAction($params)
    {
        if(isset($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Conversation = new ConversationRepository($params['URI'][0]);
            $Conversation->setStatus(1);
            $Conversation->save();
        }
        header('Location:'.$this->Routes['chathome']);
    }

    /**
     * @Route("/en/chat(/index)")
     * @param array $params
     * Default action of ChatController
     */
    function draftAction($params)
    {
        if(isset($this->Auth)){
            $Conversation = new ConversationRepository();
            $View = new View("messaging", "chat");
            $View->setData("PageName", NAVBAR_MESSAGING." ".GLOBAL_HOME_TEXT);
            $conversationView = null;
            $errorsAdd = null;
            $page = "draft";
            $numberStudent = UserRepository::countUser();
            $numberMessage = MessageRepository::countMessage();
            $routeChat = $this->Routes['chatdraft'];
            $configFormNew = $Conversation->configFormAdd($this->Auth);
            $inBoxNumber = $Conversation->getNumberConversation('status', 1);
            $draftNumber = $Conversation->getNumberConversation('status', 0);
            $tashNumber = $Conversation->getNumberConversation('status', -1);
            $totalConv = $inBoxNumber + $draftNumber + $tashNumber;

            $conversations = $Conversation->getConversations($this->Auth, 0);
            if(isset($params['POST']) && !empty($params['POST'])){
                $idConv = (isset($params['URI'][0]) && is_numeric($params['URI'][0]))?$params['URI'][0]:$conversations[0]->getId();
                $errorsAdd = $Conversation->editConversationMessage($idConv, $this->Auth->getId(), $params['POST']);
                if(empty($errorsAdd)){
                    header('Location:'.$this->Routes['chathome']);
                }
            }
            if(isset($conversations) && !empty($conversations)){
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
            $View->setData('routeChat', $routeChat);
            $View->setData('numberStudent', $numberStudent);
            $View->setData('numberMessage', $numberMessage);
            $View->setData('inBoxNumber', $inBoxNumber);
            $View->setData('draftNumber', $draftNumber);
            $View->setData('tashNumber', $tashNumber);
            $View->setData('totalConv', $totalConv);
            $View->setData('errorsAdd', $errorsAdd);
            $View->setData('configFormNew', $configFormNew);
            $View->setData('conversations', $conversations);
            $View->setData('conversationView', $conversationView);
            $View->setData('page', $page);
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
     * @Route("/en/chat(/index)")
     * @param array $params
     * Default action of ChatController
     */
    function viewtrashAction($params)
    {
        if(isset($this->Auth)){
            $Conversation = new ConversationRepository();
            $View = new View("messaging", "chat");
            $View->setData("PageName", NAVBAR_MESSAGING." ".GLOBAL_HOME_TEXT);
            $conversationView = null;
            $errorsAdd = null;
            $page = "trash";
            $numberStudent = UserRepository::countUser();
            $numberMessage = MessageRepository::countMessage();
            $routeChat = $this->Routes['chattrash'];
            $configFormNew = $Conversation->configFormAdd($this->Auth);
            $inBoxNumber = $Conversation->getNumberConversation('status', 1);
            $draftNumber = $Conversation->getNumberConversation('status', 0);
            $tashNumber = $Conversation->getNumberConversation('status', -1);
            $totalConv = $inBoxNumber + $draftNumber + $tashNumber;

            $conversations = $Conversation->getConversations($this->Auth, -1);
            if(isset($params['POST']) && !empty($params['POST'])){
                $idConv = (isset($params['URI'][0]) && is_numeric($params['URI'][0]))?$params['URI'][0]:$conversations[0]->getId();
                $errorsAdd = $Conversation->editConversationMessage($idConv, $this->Auth->getId(), $params['POST']);
                if(empty($errorsAdd)){
                    header('Location:'.$this->Routes['chathome'].'/'.$params['URI'][0]);
                }
            }
            if(isset($conversations) && !empty($conversations)){
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
            $View->setData('routeChat', $routeChat);
            $View->setData('numberStudent', $numberStudent);
            $View->setData('numberMessage', $numberMessage);
            $View->setData('inBoxNumber', $inBoxNumber);
            $View->setData('draftNumber', $draftNumber);
            $View->setData('tashNumber', $tashNumber);
            $View->setData('totalConv', $totalConv);
            $View->setData('errorsAdd', $errorsAdd);
            $View->setData('configFormNew', $configFormNew);
            $View->setData('conversations', $conversations);
            $View->setData('conversationView', $conversationView);
            $View->setData('page', $page);
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

    public function deleteAction($params)
    {
        if(isset($params['URI'][0]) && is_numeric($params['URI'][0])){
            $Conversation = new ConversationRepository($params['URI'][0]);
            $MessageConversation = new MessageConversation();
            $arrayIdMessage = $MessageConversation->getMessageConversation('conversation', $Conversation->getId());
            $Message = new MessageRepository();
            $paramater = [
                'LIKE' => [
                    'conversationid' => $Conversation->getId()
                ]
            ];
            $MessageConversation->setWhereParameter($paramater);
            $MessageConversation->delete();
            foreach($arrayIdMessage as $id){
                $paramater = [
                    'LIKE' => [
                        'id' => $id
                    ]
                ];
                $Message->setWhereParameter($paramater);
                $Message->delete();
            }
            $paramater = [
                'LIKE' => [
                    'id' => $Conversation->getId()
                ]
            ];
            $Conversation->setWhereParameter($paramater);
            $Conversation->delete();
        }
        header('Location:'.$this->Routes['chathome']);
    }
}