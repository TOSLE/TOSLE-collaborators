<section class="container">
    <div class="row">
        <div class="col-6">
            <div class="bg-white">
                <section class="login-bloc">
                    <h2>Log in</h2>
                    <section>
                        <?php $this->addModal("form", $configConnect, $errorsConnect); ?>
                    </section>
                </section>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-white">
                <section class="login-bloc">
                    <h2>No account ?</h2>
                    <section>
                        <?php $this->addModal("form", $configInscrip, $errorsInscrip); ?>
                    </section>
                </section>
            </div>
        </div>
    </div>
</section>