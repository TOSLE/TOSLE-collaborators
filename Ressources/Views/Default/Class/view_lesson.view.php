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
        <div class="row">
            <div class="col-12">
                <div>
                    <h3>Commentaires</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div>
                    <?php if(isset($lastComments)):?>
                        <?php foreach($lastComments as $comment):?>
                            <p>
                                <span>
                                    Ecrit par : <?php echo $comment->getUser()->getFirstname();?> <?php echo $comment->getUser()->getLastname();?>
                                </span>
                            </p>
                            <p>Contenu : <?php echo $comment->getContent();?></p>
                        <?php endforeach;?>
                    <?php else:?>
                        <p>Aucun commentaire pour le moment</p>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php if(isset($this->Auth)):?>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div>
                        <?php $this->addModal("form", $formAddComment, $errors); ?>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </section>
<?php endif;?>
