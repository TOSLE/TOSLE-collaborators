<section id="left-column" class="left-column">
    <div class="content-box-left">
        <button id="close-burgermenu" class="btn-tosle btn-close-window btn-dark"><i class="material-icons">&#xE5CD;</i><p><?php echo LEFT_COLUMN_MESSAGING_CLOSEMENU;?></p></button>
        <a href="#" class="btn-tosle new-message"><i class="material-icons">&#xE158;</i> <p><?php echo LEFT_COLUMN_MESSAGING_NEWMESSAGE;?></p></a>
        <ul>
            <li><a href="#"><i class="material-icons">&#xE0CB;</i><p><?php echo LEFT_COLUMN_MESSAGING_MENU_INBOX;?></p><span class="notif-active">3</span></a></li>
            <li><a href="#"><i class="material-icons">&#xE254;</i><p><?php echo LEFT_COLUMN_MESSAGING_MENU_DRAFTS;?></p></a></li>
            <li><a href="#"><i class="material-icons">&#xE152;</i><p><?php echo LEFT_COLUMN_MESSAGING_MENU_FILTER;?></p></a></li>
        </ul>
    </div>
    <div class="content-box-left">
        <div class="profil-info">
            <p class="identity"><?php echo $this->Auth->getFirstname().' '.$this->Auth->getLastname();?></p>
            <p class="contact"><?php echo $this->Auth->getEmail();?></p>
        </div>
        <div class="profil-stats">
            <div class="conversation">
                <p class="number">5</p>
                <p class="description"><?php echo LEFT_COLUMN_MESSAGING_PROFILINFOS_NUMBERCHAT;?></p>
            </div>
            <div class="number-message">
                <p class="number">150</p>
                <p class="description"><?php echo LEFT_COLUMN_MESSAGING_PROFILINFOS_NUMBERMESSAGE;?></p>
            </div>
            <div class="number-user">
                <p class="number">33</p>
                <p class="description"><?php echo LEFT_COLUMN_MESSAGING_PROFILINFOS_NUMBERSTUDENT;?></p>
            </div>
        </div>
    </div>
    <div class="footer-infos">
        <div class="more-infos">
            <a href="#"><?php echo GLOBAL_FOOTER_LEGAL;?></a> - <a href="#"><?php echo GLOBAL_FOOTER_PRIVACY;?></a>
        </div>
        <div class="global-infos">
            <p>TOSLE <i class="material-icons">&#xE90C;</i> 2018</p>
        </div>
    </div>
</section>
<section class="middle-column">
    <div class="content-actually-filter">
        <p><i class="material-icons">&#xE152;</i> <?php echo MIDDLE_COLUMN_MESSAGING_HEADER_FILTER;?> <strong>Newest</strong></p>
    </div>
    <div class="content-message">
        <a href="#" class="message-info active">
            <div class="parameter-message">
                <i class="material-icons">&#xE8B8;</i>
            </div>
            <div class="header-message">
                <div class="logo-header-message">
                    J
                </div>
                <div class="id-header-message">
                    Julien Domange
                </div>
            </div>
            <div class="main-message">
                <p>Mais ça me fais plaisir ! C'est noté !</p>
            </div>
            <div class="footer-message">
                <p>3 <?php echo MIDDLE_COLUMN_MESSAGING_MESSAGE_MIN_AGO;?></p>
            </div>
        </a>
        <a href="#" class="message-info notification">
            <div class="parameter-message">
                <i class="material-icons">&#xE8B8;</i>
            </div>
            <div class="header-message">
                <div class="logo-header-message">
                    J
                </div>
                <div class="id-header-message">
                    Julien Domange
                </div>
            </div>
            <div class="main-message">
                <p>Bonjour monsieur, j'aurais aimé avoir des rens...</p>
            </div>
            <div class="footer-message">
                <p>3 <?php echo MIDDLE_COLUMN_MESSAGING_MESSAGE_HOUR_AGO;?></p>
            </div>
        </a>
        <a href="#" class="message-info">
            <div class="parameter-message">
                <i class="material-icons">&#xE8B8;</i>
            </div>
            <div class="header-message">
                <div class="logo-header-message">
                    J
                </div>
                <div class="id-header-message">
                    Julien Domange
                </div>
            </div>
            <div class="main-message">
                <p>Bonjour monsieur, j'aurais aimé avoir des rens...</p>
            </div>
            <div class="footer-message">
                <p>3 <?php echo MIDDLE_COLUMN_MESSAGING_MESSAGE_MONTH_AGO;?></p>
            </div>
        </a>
        <?php if(isset($conversations)):?>
            <?php foreach($conversations as $key => $conversation):?>
                <a href="<?php echo $this->slugs['chathome'].'/'.$conversation->getId();?>" class="message-info <?php echo ($key == 0)?'':'';?>">
                    <div class="parameter-message">
                        <i class="material-icons">&#xE8B8;</i>
                    </div>
                    <div class="header-message">
                        <div class="logo-header-message">
                            <?php echo $conversation->getDestination()->getFirstname()[0];?>
                        </div>
                        <div class="id-header-message">
                            <?php echo $conversation->getDestination()->getFirstname().' '.$conversation->getDestination()->getLastname();?>
                        </div>
                    </div>
                    <div class="main-message">
                        <p><?php echo $conversation->getMessages()[0]->getContent();?></p>
                    </div>
                    <div class="footer-message">
                        <p><?php echo $conversation->getMessages()[0]->getDatecreate();?></p>
                    </div>
                </a>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</section>
<section class="right-column">
    <div class="content-right-column">
        <div class="content-infos-message">
            <h2>Julien Domange</h2>
            <div class="more-infos">
                <i class="material-icons">&#xE88E;</i>
                <p>Group 1 - Group 3IW2</p>
            </div>
        </div>
        <div class="edit-new-message">
            <div class="content-input">
                <textarea type="text" placeholder="<?php echo RIGHT_COLUMN_MESSAGING_NEWMESSAGE_PLACEHOLDER;?>..."></textarea>
            </div>
            <div class="content-button">
                <button class="btn btn-dark"><?php echo RIGHT_COLUMN_MESSAGING_NEWMESSAGE_BUTTON;?></button>
            </div>
        </div>
        <div class="container-message">
            <div class="message-owner">
                <p>
                    Bonjour ! Je suis votre intervenant et j'aurais aimé vous poser quelques questions au sujet de votre devoir. <br>
                    Seriez vous disponible ?
                </p>
                <p class="date-message">
                    1 h
                </p>
            </div>
            <div class="message-other default-message-other">
                <p>
                    Bonjour monsieur, je suis disponible pour répondre à vos question !
                </p>
                <p class="date-message">
                    41 min
                </p>
            </div>
            <div class="message-owner">
                <p>
                    Super, merci ! Voici mes questions : <br>
                    - Comment avez vous trouvé le cours "découverte du web" ?<br>
                    - Avez vous des propositions pour améliorer son contenu ?<br>
                    <br>
                    D'autres questions d'ordre plus général : <br>
                    - Comment avous vous trouvé mon site ?<br>
                    <br>
                    En vous remerciant !
                </p>
                <p class="date-message">
                    36 min
                </p>
            </div>
            <div class="message-other default-message-other">
                <p>
                    Alors, afin de vous répondre au mieux ! Je vais tenter d'être le plus clair et honnête possible : <br>
                    - J'ai réellement apprécié ce cours, car il explique de manière assez radicale les avantages, les inconvénients, les subtilités sont vraiments intéressante et cela me pousse à poursuivre la lecture de votre cours !<br>
                    J'espère par ailleurs qu'il y aura la suite sous peu.<br>
                    - Le contenu est assez intéressant, quoi que, je pense qu'il pourrait être judicieux de travailler un peu l'humour, l'ironie ! <br>
                    <br>
                    - Enfin, la dernière question reste assez simple ! J'ai fais une recherche approfondis sur internet pour lister les sites proposant un cours de découverte, et sur un forum j'ai trouvé le votre !<br>
                    <br>
                    J'espère vous avoir été utile.
                </p>
                <p class="date-message">
                    25 min
                </p>
            </div>
            <div class="message-owner">
                <p>
                    Super merci pour vos réponses, je prendrais en considération vos remarques ! N'hésitez pas à me contacter grâce à cette messagerie !
                </p>
                <p class="date-message">
                    15 min
                </p>
            </div>
            <div class="message-other default-message-other">
                <p>
                    Mais ça me fais plaisir ! <br>C'est noté !
                </p>
                <p class="date-message">
                    4 min
                </p>
            </div>
        </div>
    </div>
</section>