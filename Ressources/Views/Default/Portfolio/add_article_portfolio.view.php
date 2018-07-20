<section class="container">
    <div class="row">
        <div class="title-page col-12">
            <div class="marg-container">
                <h1>Portfolio Test</h1>
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["Portfolio"];?>">Portfolio</a> <span class="additional-message-title">/ <a class="btn-sm btn-dark" href="<?php echo $this->slugs["portfolio/add"];?>">Portfolio</a></span> <span class="additional-message-title"></span></h2>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="col-12">
            <div>
                <?php $this->addModal("form", $config, $errors); ?>
            </div>
        </div>
    </div>
</section>


