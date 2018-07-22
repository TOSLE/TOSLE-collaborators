<div class="container">
    <div class="row">
        <div class="col-12">
            <div>
                <section class="title-page">
                    <h2>Dashboard</h2>
                </section>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-2 large-menu">
            <div>
                <section id="left-side">
                    <section id="nav-dashboard">
                        <nav>
                            <ul>
                                <li><a href="<?php echo $this->slugs["dashboardhome"]; ?>">
                                        <p>Dashboard</p>
                                        <i class="material-icons blue">dashboard</i>

                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs["dashboard_lesson"] ?>">
                                        <p>Class</p>
                                        <i class="material-icons blue">school</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs['dashboard_student']; ?>">
                                        <p>Students</p>
                                        <i class="material-icons blue">group</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs["dashboard_blog"] ?>">
                                        <p>Blog</p>
                                        <i class="material-icons blue">library_books</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo DIRNAME . substr($language, 0, 2) . "/dashboard/"; ?>">
                                        <p>Portofolio</p>
                                        <i class="material-icons blue">image</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs["dashboard_stat"] ?>">
                                        <p>Statistics</p>
                                        <i class="material-icons blue">insert_chart_outlined</i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>
            </div>
        </div>
        <div class="col-12 responsive-menu">
            <div>
                <section id="left-side">
                    <section id="nav-dashboard">
                        <nav>
                            <ul>
                                <li><a href="<?php echo $this->slugs["dashboardhome"]; ?>">
                                        <p>Dashboard</p>
                                        <i class="material-icons blue">dashboard</i>

                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs["dashboard_lesson"] ?>">
                                        <p>Class</p>
                                        <i class="material-icons blue">school</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs['dashboard_student']; ?>">
                                        <p>Students</p>
                                        <i class="material-icons blue">group</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs["dashboard_blog"] ?>">
                                        <p>Blog</p>
                                        <i class="material-icons blue">library_books</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo DIRNAME . substr($language, 0, 2) . "/dashboard/"; ?>">
                                        <p>Portofolio</p>
                                        <i class="material-icons blue">image</i>
                                    </a>
                                </li>
                                <li><a href="<?php echo $this->slugs["dashboard_stat"] ?>">
                                        <p>Statistics</p>
                                        <i class="material-icons blue">insert_chart_outlined</i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </section>
            </div>
        </div>
        <div class="col-10">
            <div>
                <section class="right-side">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div>
                                    <section id="stat-cms" class="block-dash">
                                        <div class="title">
                                            <h4>Statistics cms</h4>
                                            <a href="<?php echo $this->slugs["dashboard_stat"] ?>">
                                                <i class="material-icons blue">arrow_forward</i>
                                            </a>
                                        </div>
                                        <div class="container">
                                            <ul>
                                                <li><p>User register</p>
                                                    <p class="blue stat-register"><?php if (isset($totalUser)) echo $totalUser; else echo '0'; ?></p>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li><p>Lesson post</p>
                                                    <p class="blue stat-register"><?php if (isset($totalLesson)) echo $totalLesson; else echo '0'; ?></p>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li><p>Comments post</p>
                                                    <p class="blue stat-register"><?php if (isset($totalComment)) echo $totalComment; else echo '0'; ?></p>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li><p>Message send</p>
                                                    <p class="blue stat-register"><?php if (isset($totalMessage)) echo $totalMessage; else echo '0'; ?></p>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li><p>Number of article in the blog</p>
                                                    <p class="blue stat-register"><?php if (isset($totalArticle)) echo $totalArticle; else echo '0'; ?></p>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li><p>Number of groups</p>
                                                    <p class="blue stat-register"><?php if (isset($totalGroup)) echo $totalGroup; else echo '0'; ?></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php $this->addModal("dashboard_bloc", $configTableLesson);?>
                            <?php $this->addModal("dashboard_bloc", $configTableBlog);?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
</div>