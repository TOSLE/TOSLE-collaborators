<section class="main-header container">
    <div class="row">
        <div class="col-6">
            <div>
                <p>Option en attente</p>
            </div>
        </div>
        <div class="col-6">
            <div>
                <p>Option en attente</p>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <?php foreach($lessons as $lesson):?>
            <div class="col-<?php echo $col;?>">
                <div>
                    <div class="lesson-bloc">

                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</section>