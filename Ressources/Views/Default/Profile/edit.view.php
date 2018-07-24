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
<section class="container">
    <div class="row">
        <div class="col-4">
            <div>
                <h2><?php echo USER_PROFILE_EDIT_PASSWORD;?></h2>
            </div>
        </div>
        <div class="col-6">
            <div>
                <?php $this->addModal("dashboard_form", $configEditPassword, $errors); ?>
            </div>
        </div>
    </div>
</section>