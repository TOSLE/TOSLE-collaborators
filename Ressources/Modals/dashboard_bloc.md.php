<div class="col-<?php echo (empty($config["global"]["col"]))?"6":$config["global"]["col"];?>">
    <div>
        <section class="content-backoffice">
            <div class="header-content">
                <h4><?php echo (empty($config["global"]["title"]))?"No title in config array, please insert title":$config["global"]["title"];?></h4>
                <?php if(!empty($config["global"]["icon_header"])):?>
                    <?php foreach($config["global"]["icon_header"] as $key => $value): ?>
                        <?php if($key == "modal"):?>
                            <a href="#" class="target-modal active" data-type="open-modal" data-target="<?php echo $value["target"];?>"><i class="material-icons">&#xE145;</i></a>
                        <?php elseif($key == "href"): ?>
                            <a href="<?php echo $value["location"];?>" class="active"><i class="material-icons">&#xE145;</i></a>
                        <?php elseif($key == "access"): ?>
                            <a href="<?php echo $this->slugs[$value] ?>" class="active">
                                <i class="material-icons blue">arrow_forward</i>
                            </a>
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
                        <?php if(!empty($config["data"]["database"])):?>
                            <?php foreach($config["data"]["array_data"] as $key => $arrayValue):?>
                                <tr>
                                    <?php foreach($config["global"]["table_body_class"] as $className):?>
                                        <?php if($className == "td-content-order"):?>
                                        <?php if(isset($config["global"]["column_action_button"]["actionButtonOrder"])):?>
                                            <td class="<?php echo $className;?>">
                                                <a href="<?php echo $config["global"]["column_action_button"]["actionButtonOrder"].'/down/'.$arrayValue['data_id'];?>" class="btn-sm btn-tosle material-icons ordered-button">
                                                    arrow_downward
                                                </a>
                                                <?php echo ($arrayValue["data_order"]) ?>
                                                <a href="<?php echo $config["global"]["column_action_button"]["actionButtonOrder"].'/up/'.$arrayValue['data_id'];?>" class="btn-sm btn-tosle material-icons ordered-button">
                                                    arrow_upward                                                </a>
                                            </td>
                                        <?php else: ?>
                                            <td class="<?php echo $className;?>"><?php echo $key; ?></td>
                                        <?php endif;?>
                                        <?php endif;?>
                                        <?php if($className == "td-content-text"):?>
                                            <td class="<?php echo $className;?>"><?php echo $arrayValue["data_title"];?></td>
                                        <?php endif;?>
                                        <?php if($className == "td-content-date"):?>
                                            <td class="<?php echo $className;?>"><?php echo $arrayValue["data_datecreate"];?></td>
                                        <?php endif;?>
                                        <?php if($className == "td-content-action"):?>
                                            <td class="<?php echo $className;?>">
                                                <?php foreach($config["global"]["column_action_button"] as $typeButton => $content):?>
                                                    <?php if($typeButton == "actionButtonEdit"):?>
                                                        <?php if(isset($content)):?>
                                                            <a href="<?php echo $config["data"]["data_href"]["edit"]."/".$arrayValue["data_id"];?>" class="btn-sm btn-orange"><?php echo $content;?></a>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                    <?php if($typeButton == "actionButtonView"):?>
                                                        <?php if(isset($content)):?>
                                                            <a href="<?php echo $config["data"]["data_href"]["view"]."/".Access::constructUrl($arrayValue["data_title"]);?>" class="btn-sm btn-tosle"><?php echo $content;?></a>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                    <?php if($typeButton == "actionButtonTarget"):?>
                                                        <?php if(isset($content)):?>
                                                            <a href="<?php echo $content["target"]."/".Access::constructUrl($arrayValue["data_title"]);?>" class="btn-sm btn-tosle"><?php echo $content['name'];?></a>
                                                        <?php endif;?>
                                                    <?php endif;?>
                                                    <?php if($typeButton == "actionButtonStatus"):?>
                                                        <?php if(isset($content)):?>
                                                            <?php if($content[$arrayValue["data_status"]]["type"]=="href"):?>
                                                                <a href="<?php echo $content[$arrayValue["data_status"]]["target"].$arrayValue["data_id"];?>" class="btn-sm btn-<?php echo $content[$arrayValue["data_status"]]["color"];?>"><?php echo $content[$arrayValue["data_status"]]["text"];?></a>
                                                            <?php else:?>
                                                                <button class="target-modal btn-sm btn-<?php echo $content[$arrayValue["data_status"]]["color"];?>" data-type="open-modal" data-target="<?php echo $content[$arrayValue["data_status"]]["target"];?>"><?php echo $content[$arrayValue["data_status"]]["text"];?></button>
                                                            <?php endif;?>

                                                        <?php endif;?>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                            </td>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </tr>
                            <?php endforeach;?>
                        <?php else:?>
                            <?php foreach($config["data"]["array_data"] as $arrayValue):?>
                                <tr>
                                    <?php foreach($arrayValue as $key => $value):?>
                                        <?php if($key == "button_action"):?>
                                            <?php if($value["type"]=="href"):?>
                                                <td class="td-content-action"><a href="<?php echo $value["target"];?>" class="btn-sm btn-<?php echo $value["color"];?>"><?php echo $value["text"];?></a></td>
                                            <?php else:?>
                                                <td class="td-content-action"><button class="target-modal" data-type="open-modal" data-target="<?php echo $value["target"];?>"><?php echo $value["text"];?></button></td>
                                            <?php endif;?>
                                        <?php else: ?>
                                            <td class="<?php echo $config["global"]["table_body_class"][$key];?>"><?php echo $value;?></td>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>