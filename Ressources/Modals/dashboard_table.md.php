<div class="col-<?php echo $config['config']['col']?>">
    <div>
        <div class="dashboard-bloc blocUsers">
            <?php if(isset($config['config']['action']['add'])):?>
                <a class="target-modal icons-dashboard" data-type="open-modal" data-target="<?php echo $config['config']['action']['add'];?>">
                    <i class="material-icons">arrow_forward</i>
                </a>
            <?php endif;?>
            <h2><?php echo $config['config']['title']?></h2>
            <table id="<?php echo $config['config']['idBloc']?>" class="table-dashboard">
                <thead>
                <tr>
                    <?php foreach($config['table']['header'] as $row):?>
                        <?php foreach($row as $class => $content):?>
                            <td class="<?php echo $class;?>"><?php echo $content;?></td>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($config['table']['body'])):?>
                    <?php foreach($config['table']['body'] as $row):?>
                        <tr>
                            <?php foreach($row as $col):?>
                                <?php foreach($col as $class => $content):?>
                                    <?php if($class == "button"):?>
                                        <td class="action">
                                            <?php foreach($content as $button):?>
                                                <a class="btn btn-<?php echo $button['color'];?>" <?php echo (isset($button['confirm']) && !empty($button['confirm']))?'onclick="return confirm(\''.$button['confirm'].'\');"':'';?> href="<?php echo $button['action'];?>"><?php echo $button['value'];?></a>
                                            <?php endforeach;?>
                                        </td>
                                    <?php elseif($class == "avatar"):?>
                                        <?php if(!empty($content)):?>
                                            <td class="avatar"><img src="<?php echo $content;?>"/></td>
                                        <?php else:?>
                                            <td class="avatar">Aucun avatar</td>
                                        <?php endif;?>
                                    <?php else:?>
                                        <td class="<?php echo $class;?>"><?php echo $content;?></td>
                                    <?php endif;?>
                                <?php endforeach;?>
                            <?php endforeach;?>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan="<?php echo sizeof($config['table']['header']);?>">Aucun groupe pour le moment</td>
                    </tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>