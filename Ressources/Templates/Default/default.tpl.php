<html>
<head>
    <title>TOSLE</title>
    <meta charset="utf-8">
    <link href="<?php echo DIRNAME;?>Public/Libraries/Framework/ospaf/css/ospaf.css" rel="stylesheet">
    <link href="<?php echo DIRNAME;?>Public/Styles/Default/css/template_default.css" rel="stylesheet">

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
                <?php include "Header/right_header.tpl.php"; ?>
            </div>
        </div>
    </section>
    <nav>
        <ul>
            <?php include"Nav/navbar_menu.tpl.php"; ?>
        </ul>
    </nav>
</header>
<main>
    <?php include $this->view;?>
</main>
<footer>
    <?php include "Footer/footer_default.tpl.php";?>
</footer>
<div id="positionning-box-tosle">
    <div class="section-size-body">
        <div class="content-box">
            <?php include "Header/header_menu.tpl.php";?>
        </div>
    </div>
</div>
<!-- INCLUDE SCRIPT -->
<script src="<?php echo DIRNAME;?>Public/Javascripts/Default/menuprofil.js"></script>
<script src="<?php echo DIRNAME;?>Public/Javascripts/Default/Messaging/burgermenu.js"></script>
<!-- INCLUDE SCRIPT -->
</body>
</html>