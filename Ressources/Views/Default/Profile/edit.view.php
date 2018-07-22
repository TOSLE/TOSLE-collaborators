<section class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["profilehome"]; ?>">My Profil</a> <span
                        class="additional-message-title"> / Edit my profil </span></h2>
            </div>
        </section>
    </div>
</section>
<?php $this->addModal("dashboard_form", $config, $errors); ?>