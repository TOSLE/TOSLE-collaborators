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
<section class="container">
    <div class="row">
        <div class="col-4">
            <div>
                <h2><?php echo USER_PROFILE_EDIT_ACCOUNT;?></h2>
            </div>
        </div>
        <div class="col-6">
            <div>
                <div>
                    <?php if(isset($errorsFormEditAccount)):?>
                        <h3><?php echo $errorsFormEditAccount;?></h3>
                    <?php endif;?>
                </div>
                <?php $this->addModal("dashboard_form", $config); ?>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-4">
            <div>
                <h2><?php echo USER_PROFILE_EDIT_PASSWORD;?></h2>
            </div>
        </div>
        <div class="col-6">
            <div>
                <div>
                    <?php if(isset($errorsFormEditPassword)):?>
                        <h3><?php echo $errorsFormEditPassword;?></h3>
                    <?php endif;?>
                </div>
                <?php $this->addModal("dashboard_form", $configEditPassword); ?>
            </div>
        </div>
    </div>
</section>