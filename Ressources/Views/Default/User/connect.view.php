<div class="container">
    <div class="row">
        <div class="col-12">
        </div>
    </div>
    <div class="row">
        <div class="col-6 bg-white">
            <div>
                <section class="login-bloc">
                    <h4>Bienvenue sur le CMS Tosle</h4>
                    <article>
                        <p>
                            Veuillez entrer vos informations de connexion ci-dessous
                        </p></article>
                    <section class="input-login-bloc">
                        <?php $this->addModal("form", $config, $errors); ?>
                    </section>
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 bg-white">
            <section class="login-bloc">
                <article class="register-info">
                    <p>Pas encore de compte ?
                        <a href="<?php echo DIRNAME . substr($language, 0, 2) . "/user/register"; ?>">
                            Inscrivez-vous ici.</a>
                    </p>
                </article>
            </section>
        </div>
    </div>
</div>




