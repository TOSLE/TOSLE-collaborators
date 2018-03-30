<html>
    <head>
        <title><?php echo $PageName;?></title>
        <meta charset="utf-8">
        <link href="<?php echo DIRNAME;?>Public/Libraries/Framework/ospaf/css/ospaf.css" rel="stylesheet">
        <link href="<?php echo DIRNAME;?>Public/Styles/Default/css/template_messaging.css" rel="stylesheet">

        <script src="<?php echo DIRNAME;?>Public/Libraries/jQuery/jquery-3.3.1.js"></script>
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
                    <li id="open-burgermenu" class="burgermenu">
                        <a href="#"><i class="material-icons">&#xE5D2;</i><p><?php echo NAVBAR_MENU; ?></p></a>
                    </li>
                    <?php include"Nav/navbar_menu.tpl.php"; ?>
                </ul>
            </nav>
        </header>
        <main>
            <?php include $this->view;?>
        </main>
        <div id="positionning-box-tosle">
            <div class="section-size-body">
                <div class="content-box">
                    <?php include "Header/header_menu.tpl.php";?>
                </div>
            </div>
        </div>
        <div id="fade-background-burgermenu" class="fade-background-burgermenu"></div>
        <!-- INCLUDE SCRIPT -->
        <script src="<?php echo DIRNAME;?>Public/Javascripts/Default/menuprofil.js"></script>
        <script src="<?php echo DIRNAME;?>Public/Javascripts/Default/Messaging/burgermenu.js"></script>
        <!-- INCLUDE SCRIPT -->
    </body>
</html>