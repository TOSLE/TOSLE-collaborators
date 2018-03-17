<html>
    <head>
        <title><?php echo $PageName;?></title>
        <meta charset="utf-8">
        <link href="<?php echo DIRNAME;?>Public/Libraries/Framework/ospaf/css/ospaf.css" rel="stylesheet">
        <link href="<?php echo DIRNAME;?>Public/Styles/Default/css/template_messaging.css" rel="stylesheet">

        <script src="<?php echo DIRNAME;?>Public/Libraries/jquery/test/data/jquery-1.9.1.js"></script>
    </head>
    <body>
        <header>
            <section>
                <div>
                    <div class="left-block">
                        <p>TOSLE</p>
                    </div>
                    <div class="right-block">
                        <i class="material-icons">&#xE003;</i>
                        <div id="profil-icon" class="profil-icon">
                            <div class="avatar-profil">
                                <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                            </div>
                            <i id="arrow-menu" class="material-icons">&#xE313;</i>
                        </div>
                    </div>
                </div>
            </section>
            <nav>
                <ul>
                    <li class="burgermenu">
                        <a href="#"><i class="material-icons">&#xE5D2;</i><p><?php echo NAVBAR_MENU; ?></p></a>
                    </li>
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
                </ul>
            </nav>
        </header>

        <div id="positionning-box-tosle">
            <div class="section-size-body">
                <div class="content-box">
                    <?php include "Messaging/header_menu.tpl.php";?>
                </div>
            </div>
        </div>

        <!-- INCLUDE SCRIPT -->
        <script src="<?php echo DIRNAME;?>Public/Javascripts/Default/menuprofil.js"></script>
        <!-- INCLUDE SCRIPT -->
    </body>
</html>