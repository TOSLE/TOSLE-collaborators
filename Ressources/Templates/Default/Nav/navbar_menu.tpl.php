<li <?php echo($controller == "ClassController" || $controller == "ChapterController")?" class='current'":"";?>>
    <a href="<?php echo $this->slugs["homepage"];?>"><i class="material-icons">&#xE80C;</i><p><?php echo NAVBAR_HOMEPAGE; ?></p></a>
</li>
<li <?php echo($controller == "ProfileController")?" class='current'":"";?>>
    <a href="<?php echo $this->slugs["profilehome"];?>"><i class="material-icons">&#xE853;</i><p><?php echo NAVBAR_PROFILE; ?></p></a>
</li>
<li <?php echo($controller == "BlogController")?" class='current'":"";?>>
    <a href="<?php echo $this->slugs["bloghome"];?>"><i class="material-icons">&#xE02F;</i><p><?php echo NAVBAR_BLOG; ?></p></a>
</li>
<li <?php echo($controller == "ChatController")?" class='current'":"";?>>
    <a href="<?php echo $this->slugs["chathome"];?>"><i class="material-icons">&#xE0B7;</i><p><?php echo NAVBAR_MESSAGING; ?></p></a>
</li>