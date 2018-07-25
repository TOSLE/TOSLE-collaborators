<section class="container header-blog-container">
    <div class="row">
        <div class="col-12">
            <div>
                <h2>Links and advanced search</h2>
                <div class="icons-list">
                    <a href="<?php echo $urlBlogfeed;?>" class="blog-link-icon">
                        <i class="material-icons">
                            rss_feed
                        </i>
                        <p>Flux RSS</p>
                    </a>
                    <a href="#" class="blog-link-icon target-modal" data-type="open-modal" data-target="filter-modal">
                        <i class="material-icons">
                            filter_list
                        </i>
                        <p>Modify display</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <?php if(isset($data)):?>
            <?php foreach ($data as $row => $value): ?>
                <div class="col-<?php echo $col; ?>">
                    <div>
                        <div class="blog-article article-content-text">
                            <div class="content-article"
                                 style="background-image: url('<?php echo $value['image']->getPath() . $value['image']->getName(); ?>')">
                                <div class="fade-background-article">
                                    <h2><?php echo $value["blog_title"]; ?></h2>
                                    <p class="resume"><?php echo $value["blog_content"]; ?></p>
                                    <?php if (isset($value["category"])): ?>
                                        <ul class="tag-list category-list-homeblog">
                                            <?php foreach ($value["category"] as $category): ?>
                                                <li class="item tosle">
                                                    <?php echo $category; ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                    <p class="info-comment-homeblog"><?php echo $value["blog_numberComment"]; ?> <i
                                                class="material-icons">comment</i></p>
                                    <a href="<?php echo $this->slugs["view_blog_article"] . "/" . $value["blog_url"]; ?>"
                                       class="btn btn-tosle"><?php echo READ_MORE; ?></a>
                                    <p class="datecreate"><?php echo $value["blog_datecreate"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-10">
                <div>
                    <p>Aucun article pour le moment</p>
                </div>
            </div>
        <?php endif; ?>
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

<div id="filter-modal" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>Modify the display filter of article</h2>
            <h2>Modifier le filtre d'affichage des blogs</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <form action="" method="get">
                                <div class="form-group-base">
                                <label for="colsize">Number of blog per line</label>
                                <select id="colsize" name="colsize">
                                    <option value="default">Your choice</option>
                                    <option value="4">3</option>
                                    <option value="6">2</option>
                                    <option value="12">1</option>
                                </select>
                                </div>
                                <button type="submit" class="btn btn-green">Submit</button>
                                <button type="reset" class="btn btn-default">Reset form</button>
                            </form>
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
