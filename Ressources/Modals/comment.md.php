<?php if(!empty($errors)): ?>
    <div class="errors-message">
        <?php foreach($errors as $name => $value):?>
            <p>
                <span class="error-type">*<?php echo $name; ?></span> <span class="error-content"><?php echo $value;?></span>
            </p>
        <?php endforeach; ?>
    </div>
<?php endif;?>
<div class="encaps-comment container">
    <?php foreach($config as $comment):?>
        <div class="content-comment">
            <div class="fade-comment">
                <div class="comment-content-infos">
                    <?php echo $comment->getContent();?>
                </div>
                <div class="comment-autor-infos">
                <span>
                    Ecrit par : <?php echo $comment->getUser()->getFirstname();?> <?php echo $comment->getUser()->getLastname();?>
                </span>
                    <span>
                    le <?php echo $comment->getDatecreate();?>
                </span>
                </div>
                <div class="comment-content-option">
                    <a href="<?php echo $this->slugs['comment_signalement'].'/'.$comment->getId();?>">Signaler</a>
                    <?php if(isset($this->Auth) && ($this->Auth->getStatus() > 1 ||($this->Auth->getId() == $comment->getUser()->getId()))):?>
                        - <a href="<?php echo $this->slugs['comment_delete'].'/'.$comment->getId();?>">Supprimer</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
