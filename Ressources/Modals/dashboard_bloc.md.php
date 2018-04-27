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
                        <?php foreach($config["data"] as $value):?>
                            <tr>
                                <td class="<?php echo $config["global"]["table_body_class"][1];?>"><?php echo $value["data_title"];?></td>
                                <td class="<?php echo $config["global"]["table_body_class"][2];?>"><?php echo $value["data_post_date"];?></td>
                                <td class="<?php echo $config["global"]["table_body_class"][3];?>">
                                    <a href="#" class="btn-sm btn-tosle">View</a>
                                    <a href="#" class="btn-sm btn-yellow">Edit</a>
                                    <?php if($value["data_status"]==1): ?>
                                        <a href="<?php echo $config["data_href_blog_status"]."/".$value["data_id"];?>" class="btn-sm btn-red">Depublier</a></td>
                                    <?php else: ?>
                                        <a href="<?php echo $config["data_href_blog_status"]."/".$value["data_id"];?>" class="btn-sm btn-green">Publier</a></td>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>