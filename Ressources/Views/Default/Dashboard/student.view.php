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
                                <?php foreach($configBlocUsers['table']['body'] as $row):?>
                                    <tr>
                                        <?php foreach($row as $col):?>
                                                <?php foreach($col as $class => $content):?>
                                                    <?php if($class == "button"):?>
                                                        <?php foreach($content as $action => $value):?>
                                                            <td class="action"><a class="btn btn-red" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur');" href="<?php echo $action;?>"><?php echo $value;?></a></td>
                                                        <?php endforeach;?>
                                                    <?php else:?>
                                                        <td class="<?php echo $class;?>"><?php echo $content;?></td>
                                                    <?php endif;?>
                                                <?php endforeach;?>
                                        <?php endforeach;?>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</section>