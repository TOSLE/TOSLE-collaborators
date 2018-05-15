<?php if(!empty($errors)): ?>
    <?php foreach($errors as $name => $value):?>
        <?php echo $name. " ".$value;?>
    <?php endforeach; ?>
<?php endif;?>

<form method="<?php echo $config['config']['method'];?>" action="<?php echo $config['config']['action'];?>">
    <div class="form-group-base">
        <?php foreach ($config["input"] as $name => $attributs):?>
            <?php if(isset($attributs["label"])):?>
                <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
            <?php endif;?>
            <?php if($attributs["type"]=="text" || $attributs["type"]=="email" || $attributs["type"]=="number" || $attributs["type"]=="password"):?>
                <input id="<?php echo $name;?>" type="<?php echo $attributs["type"];?>" placeholder="<?php echo $attributs["placeholder"];?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]))?"required='required'":"";?>><br>
            <?php endif;?>
        <?php endforeach;?>
    </div>
    <?php if(isset($config["ckeditor"])):?>
        <label for="textArea_article">Edition de votre article</label>
        <div id="alerts">
            <noscript>
                <p>
                    <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript support, like yours, you should still see the contents (HTML data) and you should be able to edit it normally, without a rich editor interface.
                </p>
            </noscript>
        </div>
        <textarea id="textAreaArticle" class="ckeditor" name ="textArea_article" placeholder="Vous n'avez aucune limite de caractère pour votre article." style="margin-bottom: 15px; min-width: 100%; max-width: 100%; min-height: 700px; max-height: 1000px;" class="form-control"></textarea>
        <script type="text/javascript" src="<?php echo DIRNAME;?>Public/Libraries/CKEditor/ckeditor.js"></script>
    <?php endif;?>
    <div>
        Voici les différentes options du formulaire
    </div>
    <?php if(isset($config["exit"])):?>
        <a href="<?php echo $config["exit"];?>" class="btn btn-red">Exit</a>
    <?php endif;?>
    <?php if(isset($config["config"]["save"])):?>
        <input type="submit" class="btn btn-orange" name="save-draft" value="<?php echo $config["config"]["save"];?>">
    <?php endif;?>
    <input type="submit" class="btn btn-green" name="publish" value="<?php echo $config["config"]["submit"];?>">
</form>