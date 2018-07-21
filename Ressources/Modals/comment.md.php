<?php if(!empty($errors)): ?>
    <div class="errors-message">
        <?php foreach($errors as $name => $value):?>
            <p>
                <span class="error-type">*<?php echo $name; ?></span> <span class="error-content"><?php echo $value;?></span>
            </p>
        <?php endforeach; ?>
    </div>
<?php endif;?>
<div class="comment-bloc">
    <?php foreach($config as $comment):?>
        <div class="autor-infos">
            <span>
                Ecrit par : <?php echo $comment->getUser()->getFirstname();?> <?php echo $comment->getUser()->getLastname();?>
            </span>
            <span>
                at : <?php echo $comment->getDatecreate();?>
            </span>
        </div>
        <div class="content-infos">
            <?php echo $comment->getContent();?>
        </div>
        <div class="option">
            <a href="<?php echo $this->slugs['comment_signalement'].'/'.$comment->getId();?>" >Signaler</a>
            <?php if(isset($this->Auth) && ($this->Auth->getStatus() > 1 ||($this->Auth->getId() == $comment->getUser()->getId()))):?>
                <a href="<?php echo $this->slugs['index/deletecom'].'/'.$comment->getId();?>" >Supprimer</a>
            <?php endif;?>
        </div>
    <?php endforeach;?>
</div>
