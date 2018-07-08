<?php if(!$Auth):?>
    <a href="<?php echo $this->slugs["signin"];?>" class="btn btn-tosle-outline tosle-btn"><?php echo HEADER_MENU_SIGNIN;?></a>
    <a href="<?php echo $this->slugs["signup"];?>" class="btn btn-default-outline tosle-btn"><?php echo HEADER_MENU_SIGNUP;?></a>
<?php else: ?>
    <i class="material-icons">&#xE003;</i>
    <div id="profil-icon" class="profil-icon">
        <div class="avatar-profil">
            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
        </div>
        <i id="arrow-menu" class="material-icons">&#xE313;</i>
    </div>
<?php endif;?>