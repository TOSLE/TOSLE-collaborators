<?php if(!empty($errors)): ?>
    <?php foreach($errors as $name => $value):?>
        <?php echo $name. " ".$value;?>
    <?php endforeach; ?>
<?php endif;?>

<form method="<?php echo $config['config']['method'];?>" action="<?php echo $config['config']['action'];?>">
    <div class="form-group-base">
        <?php foreach ($config["input"] as $name => $attributs):?>
            <?php if($attributs["type"]=="text" || $attributs["type"]=="email" || $attributs["type"]=="number" || $attributs["type"]=="password"):?>
                <input type="<?php echo $attributs["type"];?>" placeholder="<?php echo $attributs["placeholder"];?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]))?"required='required'":"";?>><br>
            <?php endif;?>
        <?php endforeach;?>
        <?php if(isset($config["captcha"])):?>
            <label for="captcha" class="captcha img">
                <img src="<?php echo DIRNAME;?>Public/Libraries//TosleCaptcha/GenerateCaptcha.php">
            </label>
            <input id="captcha" type="text" name="captcha" placeholder="Veuillez saisir le captcha présent ci-dessus">
            <div class="small-precision-input">Vous pouvez recharger la page pour générer un nouveau captcha</div>
        <?php endif;?>
        <input type="submit" class="btn btn-tosle" value="<?php echo $config["config"]["submit"];?>">
    </div>
</form>