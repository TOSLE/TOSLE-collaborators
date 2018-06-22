<section class="container">
    <div class="row">
        <div class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ <a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboard_lesson"];?>">Lesson</a></span> <span class="additional-message-title">/ Add lesson</span></h2>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="col-12">
            <div>
                <?php $this->addModal("dashboard_form", $configForm, $errors); ?>
            </div>
        </div>
    </div>
</section>