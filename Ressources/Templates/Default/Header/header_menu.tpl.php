<?php if(isset($this->Auth)):?>
    <div id="menu-header-section">
        <div class="arrow-top-menu"></div>
        <div class="content-menu-header">
            <ul>
                <?php if($this->Auth->getStatus() > 1):?>
                    <li><a href="<?php echo $this->slugs["edit_profile"];?>"><?php echo HEADER_MENU_PROFILE;?></a></li>
                    <li class="separator"></li>
                    <li><a href="<?php echo $this->slugs["dashboardhome"];?>"><?php echo HEADER_MENU_BACKOFFICE;?></a></li>
                    <li><a href="<?php echo $this->slugs["dashboard_lesson"];?>"><?php echo "Dashboard cours";?></a></li>
                    <li><a href="<?php echo $this->slugs["dashboard_blog"];?>"><?php echo "Dashboard blog";?></a></li>
                    <li><a href="<?php echo $this->slugs["dashboard_student"];?>"><?php echo "Dashboard student";?></a></li>
                <?php else:?>
                    <li><a href="<?php echo $this->slugs["edit_profile"];?>"><?php echo HEADER_MENU_PROFILE;?></a></li>
                <?php endif;?>
                <li class="separator"></li>
                <li><a href="<?php echo $this->slugs["signout"];?>"><?php echo HEADER_MENU_LOGOUT;?></a></li>
            </ul>
        </div>
    </div>
<?php endif;?>