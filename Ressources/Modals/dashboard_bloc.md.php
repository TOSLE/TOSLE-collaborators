<div class="col-<?php echo (empty($config["global"]["col"]))?"6":$config["global"]["col"];?>">
    <div>
        <section class="content-backoffice">
            <div class="header-content">
                <h4><?php echo (empty($config["global"]["title"]))?"No title in config array, please insert title":$config["global"]["title"];?></h4>
                <?php if($config["global"]["icon_header"]):?>
                    <?php foreach($config["global"]["icon_header"] as $key => $value): ?>
                        <?php if($key == "modal"):?>
                            <a href="#" class="target-modal active" data-type="open-modal" data-target="<?php echo $value["target"];?>"><i class="material-icons">&#xE145;</i></a>
                        <?php elseif($key == "href"): ?>
                            <a href="<?php echo $value["location"];?>" class="active"><i class="material-icons">&#xE145;</i></a>
                        <?php else: ?>
                            <a href="#" class="desactive"><i class="material-icons">&#xE145;</i></a>
                        <?php endif; ?>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="main-content">
                <table>
                    <thead>
                        <tr>
                            <?php foreach($config["data"]["table_header"] as $value):?>
                                <td><?php echo $value; ?></td>
                            <?php endforeach;?>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <?php
                echo "<pre>";
                print_r($config);
                echo "</pre>";
                ?>
            </div>
        </section>
    </div>
</div>