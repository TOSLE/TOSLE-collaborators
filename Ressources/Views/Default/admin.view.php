<h1><?php echo ADMIN_TITLE_PAGE;?></h1>
<section id="admin-section" class="container">
    <div class="row">
        <div class="col-4">
            <div class="article-bloc article-bloc-green">
                <a href="#">
                    <i class="material-icons">&#xE871;</i>
                    <h1><?php echo ADMIN_HOME_BLOC_TITLE_DASHBOARD;?></h1>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="article-bloc article-bloc-orange">
                <a href="<?php echo DIRNAME.substr($language,0,2)."/";?>admin/lessons">
                    <i class="material-icons">&#xE54B;</i>
                    <h1><?php echo ADMIN_HOME_BLOC_TITLE_LESSONS;?></h1>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="article-bloc article-bloc-sweetblue">
                <a href="#">
                    <i class="material-icons">&#xE560;</i>
                    <h1><?php echo ADMIN_HOME_BLOC_TITLE_MARK;?></h1>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="article-bloc article-bloc-pink">
                <a href="#">
                    <i class="material-icons">&#xE416;</i>
                    <h1><?php echo ADMIN_HOME_BLOC_TITLE_STUDENT;?></h1>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="article-bloc article-bloc-skyblue">
                <a href="#">
                    <i class="material-icons">&#xE02F;</i>
                    <h1><?php echo ADMIN_HOME_BLOC_TITLE_BLOG;?></h1>
                </a>
            </div>
        </div>
        <div class="col-4">
            <div class="article-bloc article-bloc-salmon">
                <a href="#">
                    <i class="material-icons">&#xE8D1;</i>
                    <h1><?php echo ADMIN_HOME_BLOC_TITLE_HOMEPAGE;?></h1>
                </a>
            </div>
        </div>
    </div>
</section>