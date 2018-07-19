<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ <a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboard_student"];?>">Student</a></span> <span class="additional-message-title">/ Manage group</span></h2>
            </div>
        </section>
    </div>
</div>

<section class="container">
    <div class="row">
        <?php if(isset($config)):?>
            <?php $this->addModal("dashboard_table", $config);?>
        <?php endif;?>
    </div>
</section>