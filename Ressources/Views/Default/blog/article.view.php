<h2><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>blog"><?php echo BLOG_TITLE_PAGE;?></a> <span>/ Titre Article</span></h2>

<section id="article-view-section">
    <div id="image-article">
        <img src="<?php echo DIRNAME;?>Tosle/Blog/Media/Images/image-exemple-03.jpg">
    </div>
    <article>
        <h1>Titre article</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse
            sit amet ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.</br><br>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet
            ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus
            condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
            aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.</br><br>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet
            ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus. </p>
    </article>
</section>

<section id="article-options-section">
    <ul>
        <li><a href="#"><i class="material-icons">comment</i><p>6 <?php echo BLOG_ARTICLE_BTN_COMMENTS; ?></p></a></li>
        <li><a href="#"><i class="material-icons">share</i><p>8 <?php echo BLOG_ARTICLE_BTN_SHARE; ?></p></a></li>
        <li><a href="#"><i class="material-icons">code</i><p><?php echo BLOG_ARTICLE_BTN_EMBED; ?></p></a></li>
        <li><a href="#"><i class="material-icons">create</i><p><?php echo BLOG_ARTICLE_BTN_REACT; ?></p></a></li>
    </ul>
</section>

<section id="article-lastcom-section">
    <h3>Derniers commentaires</h3>
    <div class="lastcom-article">
        <div class="com-user">
            <div>
                <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
            </div>
            <div>
                <p class="title-com">Julien Domange</p>
                <p class="content-com">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse
                    sit amet ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.</br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet
                    ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus
                    condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas
                    aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.</br><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas aliquet interdum placerat. Ut cursus, mi non pretium convallis, libero tellus condimentum nisl, sit amet imperdiet nulla sapien ac odio. Suspendisse sit amet
                    ultrices ipsum. Vivamus id turpis vitae massa tempor viverra nec vel purus.
                </p>
                <p class="date-create">February 28 at 6:33pm</p>
            </div>
        </div>
        <div class="com-user">
            <div>
                <img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg">
            </div>
            <div>
                <p class="title-com">Julien Domange</p>
                <p class="content-com">Whaou ! C’est impressionnant comme article, merci pour celui-ci ! Maintenant, les maquettes !</p>
                <p class="date-create">February 28 at 6:33pm</p>
            </div>
        </div>
    </div>
</section>