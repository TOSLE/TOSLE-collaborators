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
    <?php foreach($data as $row => $value):?>
            <div class="col-<?php echo $col;?>">
                <div>
                    <div class="blog-article article-content-text">
                        <div class="content-article">
                            <h2><?php echo $value["blog_title"];?></h2>
                            <p class="resume"><?php echo $value["blog_content"];?></p>
                            <a href="<?php echo DIRNAME.substr($language,0,2)."/blog/view/".$value["blog_id"];?>" class="btn btn-tosle"><?php echo BLOG_BUTTON_READMORE;?></a>
                            <p class="datecreate"><?php echo $value["blog_datecreate"];?></p>
                        </div>
                    </div>
                </div>
            </div>
    <?php endforeach;?>
    </div>
</section>