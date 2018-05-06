<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ Blog</span></h2>
            </div>
        </section>
    </div>
</div>
<section id="right-column" class="container">
    <div class="row">
            <?php $this->addModal("dashboard_bloc", $latestBlogArticle);?>
            <?php $this->addModal("dashboard_bloc", $statsBlog);?>
</section>

<div id="<?php echo $idModalViewAllPosts;?>" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>Visualisation de tous les articles</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-red" data-type="close-modal">Close modal</button>
        </div>
    </div>
</div>