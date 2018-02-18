<h1><?php echo PROFILE_TITLE_PAGE;?></h1>
<section id="profile-section" class="container">
    <div class="row">
        <div class="col-6">
            <article>
                <div class="title-article">
                    <h2><?php echo PROFILE_HOME_CONTENT_TEXT_MY_NEWS;?></h2>
                    <a href="#" class="target-modal icon-title-article" data-type="open-modal" data-target="my-news-feed"><i class="material-icons">&#xE145;</i></a href="#">
                </div>
                <div class="main-article">
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>5 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>30 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>4 h</strong>.</p>
                    </a>
                </div>
            </article>
        </div>
        <div class="col-6">
            <article>
                <div class="title-article">
                    <h2><?php echo PROFILE_HOME_CONTENT_TEXT_NEWS_FEED;?></h2>
                    <a href="#" class="target-modal icon-title-article" data-type="open-modal" data-target="global-news-feed"><i class="material-icons">&#xE145;</i></a>
                </div>
                <div class="main-article">
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mehdi</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>5 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Najla</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>30 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mike</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_LESSONS_OTHER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>4 h</strong>.</p>
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-4">
            <div class="article-bloc article-bloc-orange">
                <a href="#">
                    <i class="material-icons">&#xE54B;</i>
                    <h1><?php echo PROFILE_HOME_BLOC_TITLE_LESSONS;?></h1>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="article-bloc article-bloc-sweetblue">
                <a href="#">
                    <i class="material-icons">&#xE560;</i>
                    <h1><?php echo PROFILE_HOME_BLOC_TITLE_MARK;?></h1>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="article-bloc article-bloc-pink">
                <a href="#">
                    <i class="material-icons">&#xE572;</i>
                    <h1><?php echo PROFILE_HOME_BLOC_TITLE_ABSENCES;?></h1>
                </a>
            </div>
        </div>
    </div>
</section>


<div id="my-news-feed" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2><?php echo PROFILE_HOME_CONTENT_TEXT_MY_NEWS;?></h2>
        </div>
        <div class="modal-main">
            <h3><?php echo PROFILE_HOME_CONTENT_TEXT_MODAL_MY_NEWS;?></h3>
            <article>
                <div class="main-article">
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>5 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>30 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>4 h</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>30 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong><?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER_NAME;?></strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OWNER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>4 h</strong>.</p>
                    </a>
                </div>
            </article>
        </div>
        <div class="modal-footer">
            <button class="btn btn-md btn-red" data-type="close-modal">Fermer la fenêtre</button>
        </div>
    </div>
</div>
<div id="global-news-feed" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2><?php echo PROFILE_HOME_CONTENT_TEXT_MY_NEWS;?></h2>
        </div>
        <div class="modal-main">
            <h3><?php echo PROFILE_HOME_CONTENT_TEXT_MODAL_NEWS_FEED;?></h3>
            <article>
                <div class="main-article">
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mehdi</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>5 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Najla</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>30 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mike</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_LESSONS_OTHER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>4 h</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mehdi</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>6 h</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Najla</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>5 j</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mike</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_LESSONS_OTHER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>10 j</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mehdi</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>5 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Najla</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>30 min</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mike</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_LESSONS_OTHER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>4 h</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mehdi</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"les maquettes c'est cool"</strong></p>
                        <p>Il y a <strong>6 h</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Najla</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_COMMENT_OTHER;?> <strong>"le titre de l'article"</strong></p>
                        <p>Il y a <strong>5 j</strong>.</p>
                    </a>
                    <a href="#" class="news-profile-article">
                        <div>
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <p><strong>Mike</strong> <?php echo PROFILE_HOME_CONTENT_TEXT_ARTICLE_NEW_LESSONS_OTHER;?> <strong>"Le responsive pour les nuls"</strong></p>
                        <p>Il y a <strong>10 j</strong>.</p>
                    </a>
                </div>
            </article>
        </div>
        <div class="modal-footer">
            <button class="btn btn-md btn-red" data-type="close-modal">Fermer la fenêtre</button>
        </div>
    </div>
</div>