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
                            <?php foreach($config["global"]["table_header"] as $value):?>
                                <td><?php echo $value; ?></td>
                            <?php endforeach;?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($config["data"]["array_data"] as $value):?>
                            <tr>
                                <?php if($config["data"]["type"]== "latest_post"):?>
                                    <?php if(isset($value[1])):?>
                                        <td class="<?php echo $config["global"]["table_body_class"][1];?>"><?php echo (strlen($value[1]) > 30 )?substr($value[1], 0, 30)."...":$value[1];?></td>
                                    <?php endif;?>
                                    <?php if(isset($value[2])): ?>
                                        <td class="<?php echo $config["global"]["table_body_class"][2];?>"><?php echo $value[2];?></td>
                                    <?php endif;?>
                                    <td class="<?php echo $config["global"]["table_body_class"][3];?>">
                                        <a href="#" class="btn-sm btn-<?php echo $config["global"]["color_button"][1];?>">View</a>
                                        <a href="#" class="btn-sm btn-<?php echo $config["global"]["color_button"][2];?>">Edit</a>
                                        <?php if(isset($value[3])): ?>
                                            <?php if($value[3]):?>
                                                <a href="<?php echo $config["data_href_blog_status"]."/".$value["data_id"];?>" class="btn-sm btn-<?php echo $config["global"]["color_button"][3];?>">Depublier</a></td>
                                            <?php else: ?>
                                                <a href="<?php echo $config["data_href_blog_status"]."/".$value["data_id"];?>" class="btn-sm btn-<?php echo $config["global"]["color_button"][4];?>">Publier</a></td>
                                            <?php endif;?>
                                        <?php endif;?>
                                    </td>
                                <?php elseif($config["data"]["type"]== "stats"):?>
                                <?php else: ?>
                                <?php endif;?>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>