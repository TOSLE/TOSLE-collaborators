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
        <?php if(isset($configBlocUsers)):?>
            <div class="col-<?php echo $configBlocUsers['config']['col']?>">
                <div>
                    <div class="dashboard-bloc blocUsers">
                        <h2><?php echo $configBlocUsers['config']['title']?></h2>
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