<div class="container bloc-login-container">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
    <?php if(isset($textConfirm) && !empty($textConfirm)):?>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="bg-message-blog">
                    <section class="message-bloc">
                        <article class="login-message">
                            <p>
                                <?php echo $textConfirm;?>
                            </p>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    <?php endif;?>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="bg-white">
                <section class="login-bloc">
                    <h2>Welcome to CMS Tosle</h2>
                    <article class="register-login">
                        <p>
                            Enter your new password.
                        </p>
                    </article>
                    <section>
                        <?php $this->addModal("password_form", $configSetPassword, $errors); ?>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="bg-white">
                <section class="login-bloc">
                    <article class="register-info">
                        <p>
                            <a href="<?php echo DIRNAME;?>" class="btn btn-blue">Back to the home</a>
                            <a href="<?php echo $this->slugs['signup'];?>" class="btn btn-tosle-outline">Click here to register</a>
                        </p>
                    </article>
                </section>
            </div>
        </div>
    </div>
</div>




