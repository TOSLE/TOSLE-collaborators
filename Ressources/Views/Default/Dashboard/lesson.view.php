<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ Lesson</span></h2>
            </div>
        </section>
    </div>
</div>
<section id="right-column" class="container">
    <div class="row">
        <?php $this->addModal("dashboard_bloc", $modalAddOption);?>
        <?php $this->addModal("dashboard_bloc", $modalStats);?>
        <?php $this->addModal("dashboard_bloc", $modalLastLesson);?>
    </div>
</section>