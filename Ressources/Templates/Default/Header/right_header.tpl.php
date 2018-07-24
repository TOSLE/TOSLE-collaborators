<?php if(!$this->Auth):?>
    <?php
        $User = new User();
        $config = $User->configFormConnect($this->slugs['signin']);
    ?>
    <a href="#" class="btn btn-tosle-outline tosle-btn target-modal" data-type="open-modal" data-target="modal-signin"><?php echo SIGN_IN_BUTTON;?></a>
    <a href="<?php echo $this->slugs["signup"];?>" class="btn btn-default-outline tosle-btn"><?php echo SIGN_UP_BUTTON;?></a>

    <div id="modal-signin" class="fade-background" data-type="parent-modal">
        <div class="modal-window">
            <div class="modal-header">
                <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
                <h2><?php echo MODAL_SIGNIN_TITLE;?></h2>
            </div>
            <div class="modal-main">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="bg-white">
                                <section class="login-bloc">
                                    <article class="register-login">
                                        <p>
                                            <?php echo MODAL_SIGNIN_MESSAGE_FORM;?>
                                        </p>
                                    </article>
                                    <section>
                                        <?php $this->addModal("form", $config); ?>
                                    </section>
                                    <div>
                                        <p>
                                            <?php echo MODAL_SIGNIN_FORGET_PASSWORD;?> <a href="<?php echo $this->slugs['view-newpassword'];?>" class="btn-sm btn-tosle-outline"><?php echo MODAL_SIGNIN_FORGET_PASSWORD_BUTTON;?></a>
                                        </p>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-red" data-type="close-modal"><?php echo MODAL_CLOSE_MODAL;?></button>
            </div>
        </div>
    </div>
<?php else: ?>
    <i class="material-icons">&#xE003;</i>
    <div id="profil-icon" class="profil-icon">
        <div class="avatar-profil">
            <img src="<?php echo (!empty($this->Auth->getFileid()))?$this->Auth->getAvatar()->getPath().'/'.$this->Auth->getAvatar()->getName():DIRNAME.'Tosle/Users/Images/475899654133.jpg';?>">
        </div>
        <i id="arrow-menu" class="material-icons">&#xE313;</i>
    </div>
<?php endif;?>