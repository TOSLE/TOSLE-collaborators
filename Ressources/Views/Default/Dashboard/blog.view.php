<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"]; ?>">Dashboard</a> <span
                            class="additional-message-title">/ Blog</span></h2>
            </div>
        </section>
    </div>
</div>
<section id="right-column" class="container">
    <div class="row">
            <?php $this->addModal("dashboard_bloc", $blocGeneral);?>
            <div class="col-3"></div>
            <?php $this->addModal("dashboard_bloc", $statsBlog);?>
            <?php $this->addModal("dashboard_bloc", $latestBlogArticle);?>
    </div>
</section>