<section class="container header-lesson-container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2>Liens et recherche avancée</h2>
                <div class="icons-list">
                    <?php if(isset($urlClassFeed)):?>
                        <a href="<?php echo $urlClassFeed;?>" class="lesson-link-icon">
                            <i class="material-icons">
                                rss_feed
                            </i>
                            <p>Flux RSS</p>
                        </a>
                    <?php endif;?>
                    <a href="#" class="lesson-link-icon target-modal" data-type="open-modal" data-target="filter-modal">
                        <i class="material-icons">
                            filter_list
                        </i>
                        <p>Modifier l'affichage</p>
                    </a>
                    <!--
                    <?php if(isset($newsletter)):?>
                        <?php if($newsletter):?>
                            <a href="<?php echo $this->slugs['subscribe_lesson'];?>" class="lesson-link-icon newsletter-off">
                                <i class="material-icons">
                                    mail
                                </i>
                                <p>Se désinscrire de la newsletter</p>
                            </a>
                        <?php else:?>
                            <a href="<?php echo $this->slugs['subscribe_lesson'];?>" class="lesson-link-icon">
                                <i class="material-icons">
                                    mail
                                </i>
                                <p>S'inscrire à la newsletter</p>
                            </a>
                        <?php endif;?>
                    <?php endif;?>
                    -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <?php if(isset($lessons)):?>
            <?php foreach($lessons as $lesson):?>
                <?php if(!empty($lesson->getChapter())):?>
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
                                <div class="difficult">
                                    <div class="arrow-difficult" style="border-left-color: <?php echo $lesson->getColor();?>;"></div>
                                    <p><?php echo LESSON_DIFFICULTY;?></p>
                                    <?php for($i = 0; $i < $lesson->getLevel(); $i++):?>
                                        <span class="material-icons">star_rate</span>
                                    <?php endfor;?>
                                </div>
                                <?php if(!empty($lesson->getCategorylesson())):?>
                                    <ul class="tag-list category-list-lesson" style="border-color: <?php echo $lesson->getColor();?>;">
                                    <?php foreach($lesson->getCategorylesson() as $category):?>
                                            <li class="item" style="background-color: <?php echo $lesson->getColor();?>">
                                                <?php echo $category->getName();?>
                                            </li>
                                    <?php endforeach;?>
                                    </ul>
                                <?php endif;?>
                                <div class="more-infos" style="background-color: <?php echo $lesson->getColor();?>">
                                    <p class="info-comment-lesson"><?php echo $lesson->getNumbercomment();?> <i class="material-icons">comment</i></p>
                                    <a href="<?php echo $this->slugs["view_lesson"]."/".$lesson->getUrl();?>" class="btn btn-white info-btn-readmore"><?php echo READ_MORE;?></a>
                                    <p class="info-chapter">
                                        <?php echo count($lesson->getChapter());?> <i class="material-icons">import_contacts</i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            <?php endforeach;?>
        <?php else:?>
            <div class="col-12">
                <div>
                    <p>Aucun cours pour le moment</p>
                </div>
            </div>
        <?php endif;?>
    </div>
</section>


<?php if(isset($pagination) && !empty($pagination)):?>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <ul class="pagination tosle justify-center">
                    <?php foreach($pagination as $key => $href):?>
                        <li class="item <?php echo ($page == $key)?"active":"";?>">
                            <a href="<?php echo $href;?>" class="link-page <?php echo ($key == "first_page" || $key == "last_page")?"material-icons":"";?>"><?php echo $key;?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </section>
<?php endif;?>

<div id="filter-modal" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>Modify the display filter of lessons</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <form action="" method="get">
                                <div class="form-group-base">
                                    <label for="colsize">Number of lesson per line</label>
                                    <select id="colsize" name="colsize">
                                        <option value="default">Your choice</option>
                                        <option value="4">3</option>
                                        <option value="6">2</option>
                                        <option value="12">1</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-green">Submit</button>
                                <button type="reset" class="btn btn-default">Reset form</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-red" data-type="close-modal">Close modal</button>
        </div>
    </div>
</div>

