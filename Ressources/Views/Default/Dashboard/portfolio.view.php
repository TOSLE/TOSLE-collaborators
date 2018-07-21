<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["portfoliohome"]; ?>">Dashboard</a> <span
                        class="additional-message-title">/ portfolio</span></h2>
            </div>
        </section>
    </div>
</div>
<section id="right-column" class="container">
    <div class="row">
        <?php $this->addModal("portfolio_bloc", $blocGeneral);?>
        <?php $this->addModal("portfolio_bloc", $statsPortfolio);?>
        <?php $this->addModal("portfolio_bloc", $latestPortfolioArticle);?>
    </div>
</section>

<div id="<?php echo $idModalViewAllPosts; ?>" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>Visualisation de tous les articles</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                    <?php $this->addModal("portfolio_bloc", $modalAllPublishPost); ?>
                </div>
                <div class="row">
                    <?php $this->addModal("portfolio_bloc", $modalAllUnpublishPost); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-red" data-type="close-modal">Close modal</button>
        </div>
    </div>
</div>