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
                        <div class="content-article" style="background-image: url('<?php echo $value['image']->getPath().$value['image']->getName();?>')">
                            <div class="fade-background-article">
                                <h2><?php echo $value["blog_title"];?></h2>
                                <p class="resume"><?php echo $value["blog_content"];?></p>
                                <?php if(isset($value["category"])):?>
                                    <ul class="tag-list category-list-homeblog">
                                        <?php foreach ($value["category"] as $category):?>
                                            <li class="item tosle">
                                                <?php echo $category;?>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif;?>
                                <p class="info-comment-homeblog"><?php echo $value["blog_numberComment"];?> <i class="material-icons">comment</i></p>
                                <a href="<?php echo $this->slugs["view_blog_article"]."/".$value["blog_url"];?>" class="btn btn-tosle"><?php echo BLOG_BUTTON_READMORE;?></a>
                                <p class="datecreate"><?php echo $value["blog_datecreate"];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endforeach;?>
    </div>
</section>
<?php if(isset($pagination) && !empty($pagination)):?>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <ul class="pagination tosle justify-center">
                    <?php foreach($pagination as $key => $href):?>
                        <li class="item <?php echo ($page == $key)?"active":"";?>">
                            <a href="<?php echo $href;?>" class="link-page <?php echo ($key == "first_page" || $key == "last_page")?"material-icons":"";?>"><?php echo $key;?></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </section>
<?php endif;?>