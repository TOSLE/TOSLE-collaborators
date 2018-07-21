<?php if(isset($error_search)):?>
    <?php echo $error_search;?>
<?php else:?>
    <div class="container">
        <div class="row">
            <section class="title-page col-12">
                <div class="marg-container">
                    <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["homepage"]; ?>">All class</a>
                        <span class="additional-message-title"> / <?php echo $lesson->getTitle(); ?></span></h2>
                </div>
            </section>
        </div>
    </div>
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
                    <?php if(isset($this->Auth)):?>
                        <?php if(isset($subscribe)):?>
                            <a href="<?php echo $this->slugs['class/follow'].'/'.$lesson->getId();?>" class="btn btn-red-outline"><i class="material-icons">notifications_off</i><span>Unsubscribe</span></a>
                        <?php else:?>
                            <a href="<?php echo $this->slugs['class/follow'].'/'.$lesson->getId();?>" class="btn btn-tosle-outline"><i class="material-icons">notifications</i><span>Subscribe</span></a>
                        <?php endif;?>
                    <?php endif;?>
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
                    <?php if(!empty($readChapter->getFileid())):?>
                        <div class="content-file--chapter">
                            <p>Pour télécharger le fichier joint à ce chapitre : <a target="_blank" href="<?php echo $readChapter->getFileid()->getPath().'/'.$readChapter->getFileid()->getName();?>" class="btn btn-tosle">Cliquez-ici</a></p>
                        </div>
                    <?php endif;?>
                    <div class="content-chapter">
                        <?php echo $readChapter->getContent();?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container footer-section-lesson">
        <?php if(isset($this->Auth)):?>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <h3>Commentaires</h3>
                        <?php if(isset($comments)):?>
                            <?php $this->addModal("comment", $comments); ?>
                        <?php else:?>
                            <p>Aucun commentaire pour le moment</p>
                        <?php endif;?>
                        <?php $this->addModal("form", $formAddComment, $errors); ?>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </section>
<?php endif;?>
