<html>
    <head>
        <title>TOSLE - Login</title>
        <meta charset="utf-8">
        <link href="<?php echo DIRNAME; ?>Public/Libraries/Framework/ospaf/css/ospaf.css" rel="stylesheet">
        <link href="<?php echo DIRNAME; ?>Public/Styles/Default/css/template_installer.css" rel="stylesheet">
        <script src="<?php echo DIRNAME; ?>Public/Libraries/jQuery/jquery-3.3.1.js"></script>
    </head>
    <body>
        <main>
            <section class="container container-info-installer">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <h2><?php echo INSTALL_FORM_TITLE;?></h2>
                            <p><?php echo INSTALL_FORM_STEP;?> <?php echo (isset($stepInstall))?$stepInstall:"1";?> / 2</p>
                        </div>
                    </div>
                </div>
            </section>
            <?php if(isset($errorsParameter) && !empty($errorsParameter)):?>
            <section class="container container-info-installer">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <h2><?php echo INSTALL_FORM_WARNING;?></h2>
                            <?php foreach ($errorsParameter as $type => $content):?>
                                <h3 class="error-type"><?php echo INSTALL_FORM_WARNING_TYPE;?><?php echo $type;?></h3>
                                <p class="error-message"><?php echo INSTALL_FORM_WARNING_TYPE;?><?php echo $content;?></p>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif;?>
            <?php include $this->view; ?>
        </main>
    </body>
</html>