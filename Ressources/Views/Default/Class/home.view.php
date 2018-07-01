<section class="main-header container">
    <div class="row">
        <div class="col-6">
            <div>
                <p>Option en attente</p>
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>Option en attente</p>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <?php foreach($lessons as $lesson):?>
            <div class="col-<?php echo $col;?>">
                <div>
                    <div class="lesson-bloc">
                        <div class="fade-background-lesson">
                            <div class="title-lesson" style="border-color: <?php echo $lesson->getColor();?>;">
                                <h2>
                                    <?php echo $lesson->getTitle();?>
                                </h2>
                                <p class="info-datecreate"><?php echo $lesson->getDatecreate();?></p>
                            </div>
                            <div class="description-lesson">
                                <p>
                                    <?php echo $lesson->getDescription();?>
                                </p>
                            </div>
                            <?php if(!empty($lesson->getCategorylesson())):?>
                                <ul class="tag-list category-list-lesson" style="border-color: <?php echo $lesson->getColor();?>;">
                                <?php foreach($lesson->getCategorylesson() as $category):?>
                                        <li class="item tosle">
                                            <?php echo $category->getName();?>
                                        </li>
                                <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                            <div class="more-infos" style="background-color: <?php echo $lesson->getColor();?>">
                                <p class="info-comment-lesson">25 <i class="material-icons">comment</i></p>
                                <a href="<?php echo $this->slugs["view_blog_article"]."/".$lesson->getUrl();?>" class="btn btn-white-outline info-btn-readmore"><?php echo BLOG_BUTTON_READMORE;?></a>
                                <?php if(!empty($lesson->getChapter())):?>
                                    <p class="info-chapter">
                                        <?php echo count($lesson->getChapter());?> <i class="material-icons">import_contacts</i>
                                    </p>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</section>