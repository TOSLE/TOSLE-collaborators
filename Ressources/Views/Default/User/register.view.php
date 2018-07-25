<div class="container bloc-signup-container">
    <div class="row">
        <div class="col-12">
            <div class="">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class=" bg-white">
                <section class="login-bloc">
                    <h2>Registration Form</h2>
                    <article>
                        <p>
                            Please enter your registration information below.
                        </p>
                    </article>
                    <section class="info-signup">
                        <span><?php echo $infoSignup ?></span>
                    </section>
                    <section class="input-login-bloc">
                        <?php $this->addModal("form", $config, $errors); ?>
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
                            <a href="<?php echo DIRNAME;?>" class="btn btn-blue">Back to the Home</a>
                            <a href="<?php echo $this->slugs['signin'];?>" class="btn btn-tosle-outline">Already registered ? Log in here.</a>
                        </p>
                    </article>
                </section>
            </div>

        </div>
    </div>
</div>

