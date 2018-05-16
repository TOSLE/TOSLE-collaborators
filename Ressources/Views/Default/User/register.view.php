<div class="container bloc-signup-container">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class=" bg-white">
                <section class="login-bloc">
                    <h2>Bienvenue sur le CMS Tosle</h2>
                    <article>
                        <p>
                            Veuillez entrer vos informations pour l'inscription ci-dessous
                        </p></article>
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
                        <p>Déjà inscrit ?
                            <a href="<?php echo $this->slugs['signin'];?>">Connectez-vous ici.</a>
                        </p>
                    </article>
                </section>
            </div>

        </div>
    </div>
</div>

