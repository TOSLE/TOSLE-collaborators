<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <section class="title-page">
                    <h2>Connexion</h2>
                </section>
            </div>
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
                        <label for="login">Adresse mail :</label>
                        <input type="email" name="input-username" id="login" class="input-login"
                               placeholder="Veuillez entrer votre adresse mail de connexion">
                    </section>
                    <section class="input-login-bloc">
                        <label for="password">Mot de passe:</label>
                        <input type="password" name="input-password" id="password" class="input-login"
                               placeholder="Veuillez entrer votre mot de passe">
                    </section>
                </section>
            </div>
        </div>
    </div>
</div>

<?php $this->addModal("form", $config, $errors); ?>


