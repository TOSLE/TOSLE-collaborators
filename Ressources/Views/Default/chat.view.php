<section id="left-column" class="left-column">
    <div class="content-box-left">
        <button id="close-burgermenu" class="btn-tosle btn-close-window btn-dark"><i class="material-icons">&#xE5CD;</i><p><?php echo MESSAGING_CLOSE_MENU;?></p></button>
        <a href="#" class="btn-tosle new-message target-modal" data-type="open-modal" data-target="newConversation"><i class="material-icons">&#xE158;</i> <p><?php echo MESSAGING_NEW_MESSAGE;?></p></a>
        <ul>
            <li class="<?php echo (isset($page) && $page == "index")?'active':'';?>"><a href="<?php echo $this->slugs['chathome'];?>"><i class="material-icons">&#xE0CB;</i><p><?php echo MESSAGING_INBOX;?></p><span class="notif-active"><?php echo (isset($inBoxNumber))?$inBoxNumber:'';?></span></a></li>
            <li class="<?php echo (isset($page) && $page == "draft")?'active':'';?>"><a href="<?php echo $this->slugs['chatdraft'];?>"><i class="material-icons">&#xE254;</i><p><?php echo MESSAGING_DRAFT;?></p><span class="notif-active"><?php echo (isset($draftNumber))?$draftNumber:'';?></span></a></li>
            <?php if($this->Auth->getStatus() > 1):?>
            <li class="<?php echo (isset($page) && $page == "trash")?'active':'';?>"><a href="<?php echo $this->slugs['chattrash'];?>"><i class="material-icons">delete</i><p><?php echo MESSAGING_TRASH;?></p><span class="notif-active"><?php echo (isset($tashNumber))?$tashNumber:'';?></span></a></li>
            <?php endif;?>
        </ul>
    </div>
    <div class="content-box-left">
        <div class="profil-info">
            <p class="identity"><?php echo $this->Auth->getFirstname().' '.$this->Auth->getLastname();?></p>
            <p class="contact"><?php echo $this->Auth->getEmail();?></p>
        </div>
        <div class="profil-stats">
            <div class="conversation">
                <p class="number"><?php echo (isset($totalConv))?$totalConv:'';?></p>
                <p class="description"><?php echo MESSAGING_STATS_CONV;?></p>
            </div>
            <div class="number-message">
                <p class="number"><?php echo $numberMessage;?></p>
                <p class="description"><?php echo MESSAGING_STATS_MESSAGE;?></p>
            </div>
            <div class="number-user">
                <p class="number"><?php echo $numberStudent;?></p>
                <p class="description"><?php echo MESSAGING_STATS_STUDENT;?></p>
            </div>
        </div>
    </div>
    <div class="footer-infos">
        <div class="more-infos">
            <a href="<?php echo $this->slugs["legal_notice"]; ?>"><?php echo MESSAGING_FOOTER_LEGAL;?></a>
        </div>
        <div class="global-infos">
            <p>TOSLE <i class="material-icons">&#xE90C;</i> 2018</p>
        </div>
    </div>
</section>
<section class="middle-column">
    <div class="content-actually-filter">
        <p><i class="material-icons">&#xE152;</i> <?php echo MESSAGING_FILTER_NEWEST;?></p>
    </div>
    <div class="content-message">
        <?php if(isset($conversations)):?>
            <?php foreach($conversations as $key => $conversation):?>
                <a href="<?php echo $routeChat.'/'.$conversation->getId();?>" class="message-info <?php echo (isset($conversationView) && $conversation->getId() == $conversationView->getId())?'active':'';?> <?php echo ($conversation->getMessages()[count($conversation->getMessages())-1]->getStatus() == 2)?'notification':'';?>">
                    <div class="header-message">
                        <div class="logo-header-message">
                            <?php echo $conversation->getDestination()->getFirstname()[0];?>
                        </div>
                        <div class="id-header-message">
                            <?php echo $conversation->getDestination()->getFirstname().' '.$conversation->getDestination()->getLastname();?>
                        </div>
                    </div>
                    <div class="main-message">
                        <p><?php echo $conversation->getMessages()[count($conversation->getMessages())-1]->getContent();?></p>
                    </div>
                    <div class="footer-message">
                        <p><?php echo $conversation->getMessages()[count($conversation->getMessages())-1]->getDatecreate();?></p>
                    </div>
                </a>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</section>
<section class="right-column">
    <div class="content-right-column">
        <?php if(isset($errorsAdd)):?>
            <div class="error-add-message">
                <?php foreach($errorsAdd as $type => $content):?>
                    <h3 class="type-error">
                        <?php echo $type;?>
                    </h3>
                    <p class="content-error">
                        <?php echo $content;?>
                    </p>
                <?php endforeach;?>
            </div>
        <?php endif;?>
        <?php if(isset($conversationView)):?>
            <div class="content-infos-message">
                <?php if($this->Auth->getStatus() > 1):?>
                    <a href="<?php echo ($page == 'trash')?$this->slugs['chat/delete'].'/'.$conversationView->getId():$this->slugs['chat/trash'].'/'.$conversationView->getId();?>" class="trash-icon">
                        <i class="material-icons">delete</i>
                    </a>
                <?php endif;?>
                <h2><?php echo $conversationView->getDestination()->getFirstname().' '.$conversationView->getDestination()->getLastname();?></h2>
                <?php if(!empty($conversationView->getDestination()->getGroups())):?>
                    <div class="more-infos">
                        <i class="material-icons">&#xE88E;</i>
                        <p>
                            <?php foreach($conversationView->getDestination()->getGroups() as $key => $group):?>
                                <?php echo ($key > 0)?'-':'';?>
                                <?php echo $group->getName();?>
                            <?php endforeach;?>
                        </p>
                    </div>
                <?php else:?>
                    <div class="more-infos">
                        <i class="material-icons">&#xE88E;</i>
                        <p>User has no group</p>
                    </div>
                <?php endif;?>
            </div>
            <div class="edit-new-message">
                <?php if($page == 'trash'):?>
                    <a href="<?php echo $this->slugs['chat/untrash'].'/'.$conversationView->getId();?>" class="btn btn-green">Reactive the conversation</a>
                <?php else:?>
                    <form action="" method="post">
                        <div class="content-input">
                            <?php if($page == 'draft'):?>
                            <textarea name="message" placeholder="<?php echo MESSAGING_PLACEHOLDER;?>..."><?php echo $conversationView->getMessages()[0]->getContent();?></textarea>
                            <?php else:?>
                                <textarea name="message" placeholder="<?php echo MESSAGING_PLACEHOLDER;?>..."></textarea>
                            <?php endif;?>
                        </div>
                        <div class="content-button">
                            <input type="submit" class="btn btn-dark" name="submitMessage" value="<?php echo MESSAGING_SEND;?>">
                        </div>
                    </form>
                <?php endif;?>
            </div>
            <div class="container-message">
                <?php if(!empty($conversationView->getMessages())):?>
                    <?php foreach($conversationView->getMessages() as $message):?>
                        <div class="<?php echo ($this->Auth->getId() == $message->getUserId())?'message-owner':'message-other default-message-other';?>">
                            <p>
                                <?php echo $message->getContent();?>
                            </p>
                            <p class="date-message">
                                <?php echo $message->getDateCreate();?>
                            </p>
                        </div>
                    <?php endforeach;?>
                <?php else:?>

                <?php endif;?>
            </div>
        </div>
    <?php else:?>
        <?php if($page == 'index'):?>
            <div class="content-infos-message">
                <div class="more-infos">
                    <p>
                        There are no messages for the moment
                    </p>
                </div>
            </div>
            <div class="container-message no-conversation">
                <button class="btn btn-tosle target-modal" data-type="open-modal" data-target="newConversation">Start a conversation</button>
            </div>
        <?php else:?>
            <div class="content-infos-message">
                <div class="more-infos">
                    <p>
                        No conversation in the category
                    </p>
                </div>
            </div>
        <?php endif;?>
    <?php endif;?>
</section>

<div id="newConversation" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>New conversation</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <?php $this->addModal("dashboard_form", $configFormNew);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-red" data-type="close-modal">Close modal</button>
        </div>
    </div>
</div>