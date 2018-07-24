<section class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2>
                    <?php if(isset($this->Auth) && $this->Auth->getStatus() > 1):?>
                        <a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"]; ?>">Dashboard</a>
                    <?php else:?>
                        <a class="btn-sm btn-dark" href="<?php echo $this->slugs["profilehome"]; ?>">My Profil</a>
                    <?php endif;?>
                    <span class="additional-message-title">
                        / Edit my profil
                    </span>
                </h2>
            </div>
        </section>
    </div>
</section>
<?php $this->addModal("dashboard_form", $config, $errors); ?>