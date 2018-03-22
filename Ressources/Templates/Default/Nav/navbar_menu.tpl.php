<li <?php echo($controller == "IndexController")?" class='current'":"";?>>
    <a href="<?php echo ($language=="en-EN")?DIRNAME:DIRNAME.substr($language,0,2);?>"><i class="material-icons">&#xE80C;</i><p><?php echo NAVBAR_HOMEPAGE; ?></p></a>
</li>
<li <?php echo($controller == "ProfileController")?" class='current'":"";?>>
    <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>profile"><i class="material-icons">&#xE853;</i><p><?php echo NAVBAR_PROFILE; ?></p></a>
</li>
<li <?php echo($controller == "BlogController")?" class='current'":"";?>>
    <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>blog"><i class="material-icons">&#xE02F;</i><p><?php echo NAVBAR_BLOG; ?></p></a>
</li>
<li <?php echo($controller == "ChatController")?" class='current'":"";?>>
    <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>chat"><i class="material-icons">&#xE0B7;</i><p><?php echo NAVBAR_MESSAGING; ?></p></a>
</li>