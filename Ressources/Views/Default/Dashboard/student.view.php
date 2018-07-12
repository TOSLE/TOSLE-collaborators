<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ Students</span></h2>
            </div>
        </section>
    </div>
</div>

<section class="container">
    <div class="row">
        <?php if(isset($configBlocGroups)):?>
            <?php if(isset($errors_group_add) && !empty($errors_group_add)):?>
                <div class="col-12">
                    <div>
                        <?php foreach($errors_group_add as $type => $value):?>
                            <div>
                                <h3><?php echo $type;?></h3>
                                <p><?php echo $value;?></p>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif;?>
            <div class="col-<?php echo $configBlocGroups['config']['col']?>">
                <div>
                    <div class="dashboard-bloc blocUsers">
                        <?php if(isset($configBlocGroups['config']['action']['add'])):?>
                            <a class="target-modal icons-dashboard" data-type="open-modal" data-target="<?php echo $configBlocGroups['config']['action']['add'];?>">
                                <i class="material-icons">add</i>
                            </a>
                        <?php endif;?>
                        <h2><?php echo $configBlocGroups['config']['title']?></h2>
                        <table id="<?php echo $configBlocGroups['config']['idBloc']?>" class="table-dashboard">
                            <thead>
                            <tr>
                                <?php foreach($configBlocGroups['table']['header'] as $row):?>
                                    <?php foreach($row as $class => $content):?>
                                        <td class="<?php echo $class;?>"><?php echo $content;?></td>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($configBlocGroups['table']['body'])):?>
                                <?php foreach($configBlocGroups['table']['body'] as $row):?>
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
                                    <td colspan="<?php echo sizeof($configBlocGroups['table']['header']);?>">Aucun groupe pour le moment</td>
                                </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <?php if(isset($configBlocUsers)):?>
            <div class="col-<?php echo $configBlocUsers['config']['col']?>">
                <div>
                    <div class="dashboard-bloc blocUsers">
                        <h2><?php echo $configBlocUsers['config']['title']?></h2>
                        <?php if(isset($configBlocUsers['config']['action']['add'])):?>
                            <p>Test</p>
                        <?php endif;?>
                        <table id="<?php echo $configBlocUsers['config']['idBloc']?>" class="table-dashboard">
                            <thead>
                                <tr>
                                    <?php foreach($configBlocUsers['table']['header'] as $row):?>
                                        <?php foreach($row as $class => $content):?>
                                            <td class="<?php echo $class;?>"><?php echo $content;?></td>
                                        <?php endforeach;?>
                                    <?php endforeach;?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($configBlocUsers['table']['body'])):?>
                                <?php foreach($configBlocUsers['table']['body'] as $row):?>
                                    <tr>
                                        <?php foreach($row as $col):?>
                                                <?php foreach($col as $class => $content):?>
                                                    <?php if($class == "button"):?>
                                                        <td class="action">
                                                            <?php foreach($content as $button):?>
                                                                <a class="btn btn-<?php echo $button['color'];?>" <?php echo (isset($button['confirm']) && $button['confirm'])?'onclick="return confirm(\'Voulez-vous vraiment supprimer cet utilisateur\');"':'';?> href="<?php echo $button['action'];?>"><?php echo $button['value'];?></a>
                                                            <?php endforeach;?>
                                                        </td>
                                                    <?php else:?>
                                                        <td class="<?php echo $class;?>"><?php echo $content;?></td>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                        <?php endforeach;?>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="<?php echo sizeof($configBlocUsers['table']['header']);?>">Aucun utilisateur pour le moment</td>
                                </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</section>

<div id="addGroupModal" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>Ajout d'un groupe</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <?php $this->addModal("dashboard_form", $configFormGroupAdd); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-red" data-type="close-modal">Close modal</button>
        </div>
    </div>
</div>