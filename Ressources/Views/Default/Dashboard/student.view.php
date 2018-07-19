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
            <?php $this->addModal("dashboard_table", $configBlocGroups);?>
        <?php endif;?>
        <?php if(isset($configBlocUsers)):?>
            <?php $this->addModal("dashboard_table", $configBlocUsers);?>
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