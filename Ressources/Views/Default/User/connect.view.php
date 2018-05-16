<div class="container bloc-login-container">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="bg-white">
                <section class="login-bloc">
                    <h2>Bienvenue sur le CMS Tosle</h2>
                    <article class="register-login">
                        <p>
                            Veuillez entrer vos informations de connexion ci-dessous
                        </p></article>
                    <section>
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
                        <p>Pas encore de compte ?
                            <a href="<?php echo $this->slugs['signup'];?>">
                                Inscrivez-vous ici.</a>
                        </p>
                    </article>
                </section>
            </div>

        </div>
    </div>
</div>




