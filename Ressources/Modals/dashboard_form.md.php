<?php if(!empty($errors)): ?>
    <?php if(isset($errors['CODE_ERROR'])):?>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <h2>Une erreur est détectée sur votre fichier</h2>
                    <p> Message d'erreur : <?php echo $errors['MESSAGE'];?></p>
                    <p>Code d'erreur : <?php echo $errors['CODE_ERROR'];?></p>
                </div>
            </div>
        </div>
    </section>
    <?php else:?>
        <?php foreach($errors as $name => $value):?>
            <?php echo $name. " ".$value;?>
        <?php endforeach; ?>
    <?php endif;?>
<?php endif;?>
<form method="<?php echo $config['config']['method'];?>" action="<?php echo $config['config']['action'];?>" <?php echo (isset($config['config']['form_file']) && $config['config']['form_file'])?"enctype='multipart/form-data'":"";?>>
    <div class="form-group-base">
        <?php if(isset($config['input'])):?>
            <?php foreach ($config["input"] as $name => $attributs):?>
                <?php if(isset($attributs["label"])):?>
                    <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
                <?php endif;?>
                <?php if($attributs["type"]=="text" || $attributs["type"]=="email" || $attributs["type"]=="number" || $attributs["type"]=="password"):?>
                    <input id="<?php echo $name;?>" type="<?php echo $attributs["type"];?>" placeholder="<?php echo $attributs["placeholder"];?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]))?"required='required'":"";?> value="<?php echo (isset($config["data_content"][$name]))?$config["data_content"][$name]:"";?>">
                <?php endif;?>
                <?php if($attributs["type"]=="file"):?>
                    <?php if(isset($config["data_content"]["file_img"])):?>
                        <img src="<?php echo $config["data_content"]["file_img"];?>" width="200" height="100">
                    <?php endif;?>
                    <input id="<?php echo $name;?>" type="<?php echo $attributs["type"];?>" name="<?php echo $name;?>[]" <?php echo (isset($attributs["required"]) && $attributs["required"])?"required='required'":"";?> <?php echo (isset($attributs["multiple"]) && $attributs["multiple"])?"multiple":"";?>>
                    <?php if(isset($config["data_content"]["file_path"])):?>
                        <div class="small-precision-input">
                            <a href="<?php echo $config["data_content"]["file_path"];?>" class="btn-sm btn-tosle">Télécharger le fichier</a>
                        </div>
                    <?php endif;?>
                <?php endif;?>
                <?php if(isset($attributs["description"])):?>
                    <div class="small-precision-input">
                        <?php echo $attributs["description"];?>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
        <?php if(isset($config["select_multiple"])): ?>
            <?php foreach ($config["select_multiple"] as $select):?>
                <?php foreach($select as $name => $attributs):?>
                    <?php if($name == "category_select"):?>
                        <?php if(isset($attributs["label"])):?>
                            <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
                        <?php endif;?>
                        <select <?php echo (isset($attributs["multiple"]))?"multiple='multiple'":"";?> size="8" id="<?php echo $name;?>" name="<?php echo $name;?>[]">
                            <?php foreach($attributs["options"] as $value => $text):?>
                                <option value="<?php echo $value;?>" <?php echo (isset($config['data_content']['selectedOption'][$name][$value]))?"selected":"";?>><?php echo $text;?></option>
                            <?php endforeach;?>
                        </select>
                        <?php if(isset($attributs["description"])):?>
                            <div class="small-precision-input"><?php echo $attributs["description"];?></div>
                        <?php endif;?>
                    <?php endif;?>
                    <?php if($name == "group_select"):?>
                        <?php if(isset($attributs["label"])):?>
                            <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
                        <?php endif;?>
                        <select <?php echo (isset($attributs["multiple"]))?"multiple='multiple'":"";?> size="8" id="<?php echo $name;?>" name="<?php echo $name;?>[]">
                            <?php foreach($attributs["options"] as $value => $text):?>
                                <option value="<?php echo $value;?>" <?php echo (isset($config['data_content']['selectedOption'][$value]))?"selected":"";?>><?php echo $text;?></option>
                            <?php endforeach;?>
                        </select>
                        <?php if(isset($attributs["description"])):?>
                            <div class="small-precision-input"><?php echo $attributs["description"];?></div>
                        <?php endif;?>
                    <?php endif;?>
                    <?php if($name == "category_input"):?>
                        <?php if(isset($attributs["label"])):?>
                            <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
                        <?php endif;?>
                        <input id="<?php echo $name;?>" type="<?php echo $attributs["type"];?>" placeholder="<?php echo $attributs["placeholder"];?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]) && $attributs["required"]==true )?"required='required'":"";?> value="<?php echo (isset($config["data_content"][$name]))?$config["data_content"][$name]:"";?>">
                        <?php if(isset($attributs["description"])):?>
                            <div class="small-precision-input"><?php echo $attributs["description"];?></div>
                        <?php endif;?>
                    <?php endif;?>
                <?php endforeach;?>
            <?php endforeach;?>
        <?php endif; ?>
        <?php if(isset($config["select"])): ?>
            <?php foreach($config["select"] as $name => $attributs):?>
                <?php if(isset($attributs["label"])):?>
                    <label for="<?php echo $name;?>"><?php echo $attributs["label"];?></label>
                <?php endif;?>
                <select id="<?php echo $name;?>" name="<?php echo $name;?>" <?php echo (isset($attributs["required"]))?"required='required'":"";?>>
                    <?php foreach($attributs["options"] as $value => $text):?>
                        <option value="<?php echo $value;?>" <?php echo (isset($config['data_content'][$name]) && $config['data_content'][$name]==$value)?"selected":"";?>><?php echo $text;?></option>
                    <?php endforeach;?>
                </select>
                <?php if(isset($attributs["description"])):?>
                    <div class="small-precision-input"><?php echo $attributs["description"];?></div>
                <?php endif;?>
            <?php endforeach;?>
        <?php endif; ?>
        <?php if(isset($config["ckeditor"])):?>
            <label for="<?php echo (isset($config["ckeditor"]["name"]))?$config["ckeditor"]["name"]:"No_name_found";?>"><?php echo ($attributs == "label")?$value:"Enter your article";?></label>
            <?php if(isset($config["ckeditor"]["name"])):?>
                <div id="alerts">
                    <noscript>
                        <p>
                            <strong>CKEditor requires JavaScript to run</strong>. In a browser with no JavaScript support, like yours, you should still see the contents (HTML data) and you should be able to edit it normally, without a rich editor interface.
                        </p>
                    </noscript>
                </div>
                <textarea id="<?php echo $config["ckeditor"]["name"];?>" class="ckeditor" name ="<?php echo $config["ckeditor"]["name"];?>" placeholder="<?php echo (isset($config["ckeditor"]["placeholder"]))?$config["ckeditor"]["placeholder"]:"";?>" style="min-width: 100%; max-width: 100%; min-height: 700px; max-height: 1000px;" class="form-control">
                    <?php if(isset($config["data_content"]["content"])):?>
                        <?php echo $config["data_content"]["content"];?>
                    <?php endif;?>
                </textarea>
                <script>var globalDirname = '<?php echo DIRNAME;?>Public/Libraries/ckeditor/';
                </script>
                <script type="text/javascript" src="<?php echo DIRNAME;?>Public/Libraries/ckeditor/ckeditor.js"></script>
            <?php endif;?>
            <?php if(isset($config["ckeditor"]["description"])):?>
                <div class="small-precision-input"><?php echo $config["ckeditor"]["description"];?></div>
            <?php endif;?>
        <?php endif;?>
        <?php if(isset($config["textarea"])):?>
            <?php if(isset($config["textarea"]["label"])):?>
                <label for="textArea_exampleBase"><?php echo $config["textarea"]["label"];?></label>
            <?php endif;?>
            <?php if(isset($config["textarea"]["name"])):?>
                <textarea id="<?php echo $config["textarea"]["name"];?>" name="<?php echo $config["textarea"]["name"];?>" class="textarea-col-12" placeholder="<?php echo (isset($config["textarea"]["placeholder"])?$config["textarea"]["placeholder"]:"");?>"><?php if(isset($config["data_content"]["content"])):?><?php echo $config["data_content"]["content"];?><?php endif;?></textarea>
            <?php endif;?>
            <?php if(isset($config["textarea"]["description"])):?>
                <div class="small-precision-input"><?php echo $config["textarea"]["description"];?></div>
            <?php endif;?>
        <?php endif;?>
        <div>
            Voici les différentes options du formulaire
        </div>
        <?php if(isset($config["exit"])):?>
            <a href="<?php echo $config["exit"];?>" class="btn btn-red">Exit</a>
        <?php endif;?>
        <?php if(isset($config["config"]["save"])):?>
            <button type="submit" class="btn btn-orange" name="save-draft"><?php echo $config["config"]["save"];?></button>
        <?php endif;?>
        <button type="submit" class="btn btn-green" name="publish"><?php echo $config["config"]["submit"];?></button>
    </div>
</form>