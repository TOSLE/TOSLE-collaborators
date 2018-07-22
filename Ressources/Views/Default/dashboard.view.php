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
                                <li><a href="<?php echo DIRNAME . substr($language, 0, 2) . "/dashboard"; ?>">
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
                                <li><a href="<?php echo DIRNAME . substr($language, 0, 2) . "/dashboard/"; ?>">
                                        <p>Chat</p>
                                        <i class="material-icons blue">message</i>
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
                                <li><a href="<?php echo DIRNAME . substr($language, 0, 2) . "/dashboard"; ?>">
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
                                <li><a href="<?php echo DIRNAME . substr($language, 0, 2) . "/dashboard/"; ?>">
                                        <p>Chat</p>
                                        <i class="material-icons blue">message</i>
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
                            <div class="col-8">
                                <div>
                                    <section id="stat-visit" class="block-dash">
                                        <div class="title">
                                            <h4>Number of visitor</h4>
                                        </div>
                                        <div class="container">
                                            <canvas id="myChart" width="600" height="220"></canvas>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <section id="last-lessons" class="block-dash">
                                        <div class="title">
                                            <h4>Last Lessons</h4>
                                            <a href="<?php echo $this->slugs["dashboard_lesson"] ?>">
                                                <i class="material-icons blue">arrow_forward</i>
                                            </a>
                                        </div>
                                        <div class="container">
                                            <div class="column-col-5">
                                                <ul>
                                                    <li><span>Title lesson</span></li>
                                                    <li><span>Date</span></li>
                                                    <li><span>Participant number </span></li>
                                                    <li><span>Comment number</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span class="blue">Tutoriel pour la création de maquette sous invasion</span>
                                                    </li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                    <li><span>30</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span class="blue">Tutoriel pour la création de maquette sous invasion</span>
                                                    </li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                    <li><span>30</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span class="blue">Tutoriel pour la création de maquette sous invasion</span>
                                                    </li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                    <li><span>30</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li><span>Tutoriel pour la création de maquette sous invasion</span>
                                                    </li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                    <li><span>30</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <section id="Last register" class="block-dash">
                                        <div class="title">
                                            <h4>Last Register</h4>
                                            <a href="<?php echo $this->slugs['dashboard_student']; ?>">
                                                <i class="material-icons blue">arrow_forward</i>
                                            </a>
                                        </div>
                                        <div class="container">
                                            <div class="column-col-5">
                                                <ul>
                                                    <li></li>
                                                    <li><span>First Name Last Name</span></li>
                                                    <li><span>Type</span></li>
                                                    <li><span>Date</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span>Najla Chelly</span></li>
                                                    <li><span>Groupe 1</span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span>Najla Chelly</span></li>
                                                    <li><span>Groupe 1</span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span>Najla Chelly</span></li>
                                                    <li><span>Groupe 1</span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span>Najla Chelly</span></li>
                                                    <li><span>Groupe 1</span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <section id="last-blog-post" class="block-dash">
                                        <div class="title">
                                            <h4>Last blog post</h4>
                                            <a href="<?php echo $this->slugs["dashboard_blog"] ?>">
                                                <i class="material-icons blue">arrow_forward</i>
                                            </a>
                                        </div>
                                        <div class="container">
                                            <div class="column-col-5">
                                                <ul>
                                                    <li><span>Post name</span></li>
                                                    <li><span>Date </span></li>
                                                    <li><span>View</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li><span class="blue">Mon expérience en tant que prof</span></li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li><span class="blue">Mon expérience en tant que prof</span></li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li><span class="blue">Mon expérience en tant que prof</span></li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li><span class="blue">Mon expérience en tant que prof</span></li>
                                                    <li><span>24/11/2018</span></li>
                                                    <li><span>12</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <section id="last-chat-message" class="block-dash">
                                        <div class="title">
                                            <h4>Last chat message</h4>
                                            <a href="#">
                                                <i class="material-icons blue">arrow_forward</i>
                                            </a>
                                        </div>
                                        <div class="container">
                                            <div class="column-col-5">
                                                <ul>
                                                    <li></li>
                                                    <li><span>Sender / Recipient</span></li>
                                                    <li><span>Link</span></li>
                                                    <li><span>Date</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span><b>Najla C.</b> to <b>Samy I.</b></span></li>
                                                    <li><span><i class="material-icons blue">message</i></span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span><b>Najla C.</b> to <b>Samy I.</b></span></li>
                                                    <li><span><i class="material-icons blue">message</i></span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span><b>Najla C.</b> to <b>Samy I.</b></span></li>
                                                    <li><span><i class="material-icons blue">message</i></span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                            <div class="row-col-5">
                                                <ul>
                                                    <li>
                                                        <span>photo profil</span>
                                                    </li>
                                                    <li><span><b>Najla C.</b> to <b>Samy I.</b></span></li>
                                                    <li><span><i class="material-icons blue">message</i></span></li>
                                                    <li><span>19/03/2017</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
</div>