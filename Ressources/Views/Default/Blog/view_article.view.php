<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["bloghome"]; ?>">Blog</a><span
                            class="additional-message-title"> / <?php echo $article_content['title']; ?></span></h2>
            </div>
        </section>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <div class="article">
                    <div class="content-article">
                        <div class="container">
                            <div class="row">
                                <div class="col-10">
                                    <div>
                                        <section class="media-content">
                                        </section>
                                        <section class="text-content">
                                            <div class="title-article">
                                                <h1><?php echo $article_content['title']; ?></h1>
                                            </div>
                                            <div class="text-article">
                                                <p><?php echo $article_content['content'] ?></p>
                                            </div>
                                        </section>
                                        <section class="info-article">
                                            <div>
                                                <span>Created <?php echo $article_content['datecreate'] ?></span>
                                            </div>
                                        </section>
                                        <section class="action-article">
                                            <nav>
                                                <div class="action">
                                                    <div class="container">
                                                        <div class="svg-action">
                                                            <i class="material-icons">
                                                                comment
                                                            </i>
                                                        </div>
                                                        <span><?php echo count($commentaires); ?></span>
                                                        <div class="name-action">comments</div>
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <div class="container">
                                                        <div class="svg-action">
                                                            <i class="material-icons">
                                                                share
                                                            </i>
                                                        </div>
                                                        <div class="name-action">share</div>
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <div class="container">
                                                        <div class="svg-action">
                                                            <i class="material-icons">
                                                                code
                                                            </i>
                                                        </div>
                                                        <div class="name-action">integrate</div>
                                                    </div>
                                                </div>
                                                <div class="action">
                                                    <div class="container">
                                                        <div class="svg-action">
                                                            <i class="material-icons">
                                                                create
                                                            </i>
                                                        </div>
                                                        <div class="name-action">write a comment</div>
                                                    </div>
                                                </div>
                                            </nav>
                                        </section>
                                        <section class="comments-article">
                                            <h5>Last comments</h5>
                                            <div class="container">
                                                <?php foreach($commentaires as $row => $comment):?>
                                                <div class="comment">
                                                    <div class="picture-user">
                                                        <span></span>
                                                    </div>
                                                    <div>
                                                        <div class="name-user">
                                                            <? echo $comment["firstname"].' '.$comment["lastname"]; ?>
                                                        </div>
                                                        <div class="content">
                                                            <span><?php echo $comment["content"]; ?></span>
                                                        </div>
                                                        <div class="info">
                                                            <span>February 28 at 6:33pm</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach;?>
                                                <div class="comment">
                                                    <div class="picture-user">
                                                        <span></span>
                                                    </div>
                                                    <div>
                                                        <div class="name-user">
                                                            Julien Domange
                                                        </div>
                                                        <div class="content">
                                                            <span>Whaou ! C’est impressionnant comme article, merci pour celui-ci ! Maintenant, les maquettes !</span>
                                                        </div>
                                                        <div class="info">
                                                            <span>February 28 at 6:33pm</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="container-editor">
                                            <?php $this->addModal("form", $formAddComment);?>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
