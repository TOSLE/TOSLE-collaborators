<!DOCTYPE html>
<html>
    <head>
        <title>TOSLE - HOME</title>
        <link href="<?php echo DIRNAME;?>Public/Libraries/Framework/ospaf/css/ospaf.css" rel="stylesheet">
        <link href="<?php echo DIRNAME;?>Public/Styles/Default/css/template_default.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <section>
                <div>
                    <p>
                        TOSLE
                    </p>
                </div>
                <div>
                    <i class="material-icons">&#xE003;</i>
                    <div id="profil-icon" class="profil_icon">
                        <div class="avatar_icon">
                            <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
                        </div>
                        <i class="material-icons">&#xE313;</i>
                        <div id="window-menu-profil" class="profil_menu">
                            <?php include "Ressources/Templates/Default/default/headerMenu.php"; ?>
                        </div>
                    </div>
                </div>
            </section>
        </header>
        <nav>
            <section>
                <div <?php echo($controller == "IndexController")?" class='current'":"";?>>
                    <a href="<?php echo ($language=="en-EN")?DIRNAME:DIRNAME.substr($language,0,2);?>">
                        <i class="material-icons">&#xE8D1;</i>
                        <p><?php echo HOMEPAGE_NAME; ?></p>
                    </a>
                </div>
                <div <?php echo($controller == "BlogController")?"class='current'":"";?>>
                    <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>blog">
                        <i class="material-icons">&#xE02F;</i>
                        <p><?php echo BLOGPAGE_NAME; ?></p>
                    </a>
                </div>
                <div <?php echo($controller == "ClassController")?"class='current'":"";?>>
                    <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>class">
                        <i class="material-icons">&#xE80C;</i>
                        <p><?php echo TOSLEPAGE_NAME; ?></p>
                    </a>
                </div>
                <div <?php echo($controller == "ChatController")?"class='current'":"";?>>
                    <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>chat">
                        <i class="material-icons">&#xE0C9;</i>
                        <p><?php echo MESSAGINGPAGE_NAME;?></p>
                    </a>
                </div>
            </section>
        </nav>
        <main>
            <?php include $this->view;?>
        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo DIRNAME;?>Public/Javascripts/Default/menuprofil.js"></script>
    </body>
</html>