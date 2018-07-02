<?php if(isset($error_search)):?>
    <?php echo $error_search;?>
<?php else:?>
    <!--
        Ce qui va suivre est l'affichage du tableau descriptif des cours
    -->
    <section class="container header-section-lesson">
        <div class="row">
            <div class="col-12">
                <div>
                    <h1><?php echo $lesson->getTitle();?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div>
                    <h2>Descriptif du cours</h2>
                    <p>
                        <?php echo $lesson->getDescription();?>
                    </p>
                </div>
            </div>
            <div class="col-6">
                <div>
                    <h2>Liste des chapitres</h2>
                    <ul>
                        <?php foreach($lesson->getChapter() as $chapter):?>
                            <a href="<?php echo $this->slugs['view_lesson'].'/'.$lesson->getUrl().'/'.$chapter->getUrl();?>"><li><?php echo $chapter->getTitle();?></li></a>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--
        Ce qui va suivre est l'affichage du chapitre
    -->
    <section class="container main-section-lesson">
        <div class="row">
            <div class="col-12">
                <div>
                    <h2><?php echo $readChapter->getTitle();?></h2>
                    <div class="content-chapter">
                        <?php echo $readChapter->getContent();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>
