<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2>Dashboard</h2>
            </div>
        </section>
    </div>
    <div class="row">
        <section id="left-side" class="col-2">
            <div class="marg-container">
                <section id="nav-dashboard">
                    <nav>
                        <ul>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>dashboard">
                                    <p>Dashboard</p>
                                    <i class="material-icons blue">assessment</i>

                                </a>
                            </li>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>lessons">
                                    <p>Lessons</p>
                                    <i class="material-icons blue">keyboard_arrow_right</i>
                                </a>
                            </li>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>homework">
                                    <p>Homework</p>
                                    <i class="material-icons blue">keyboard_arrow_right</i>
                                </a>
                            </li>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>students">
                                    <p>Students</p>
                                    <i class="material-icons blue">keyboard_arrow_right</i>
                                </a>
                            </li>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>blog">
                                    <p>Blog</p>
                                    <i class="material-icons blue">keyboard_arrow_right</i>
                                </a>
                            </li>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>portofolio">
                                    <p>Portofolio</p>
                                    <i class="material-icons blue">keyboard_arrow_right</i>
                                </a>
                            </li>
                            <li><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>chat">
                                    <p>Chat</p>
                                    <i class="material-icons blue">keyboard_arrow_right</i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </section>
            </div>
            <section id="stat-left-side" class="col-2">
                <div class="marg-container">
                    <section class="stat-small block-dash">
                        <div class="title">
                            <h4>Portofolio</h4>
                            <a href="#">
                                <i class="material-icons blue">add</i>
                            </a>
                        </div>
                        <div class="container">
                            INFO
                            <select id="select-portofolio">
                                <option value="day">per day</option>
                                <option value="month" selected>per month</option>
                                <option value="year">per year</option>
                            </select>
                        </div>
                    </section>
                    <section class="stat-small block-dash">
                        <div class="title">
                            <h4>Chat</h4>
                            <a href="#">
                                <i class="material-icons blue">add</i>
                            </a>
                        </div>
                        <div class="container">
                            INFO
                            <select id="select-chat">
                                <option value="day">per day</option>
                                <option value="month" selected>per month</option>
                                <option value="year">per year</option>
                            </select>
                        </div>
                    </section>
                </div>
            </section>
        </section>
        <section class="right-side col-10">
            <div class="marg-container">
                <div class="container">
                    <div class="row">
                        <section id="stat-cms" class="col-4 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Statistiques cms</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
                                    </a>
                                </div>
                                <div class="container">
                                    <ul>
                                        <li><p>Nombre d'inscrits</p>
                                            <p id="stat-register" class="blue">12</p></li>
                                    </ul>
                                    <ul>
                                        <li><p>Nombre de cours</p>
                                            <p id="stat-register" class="blue">22</p></li>
                                    </ul>
                                    <ul>
                                        <li><p>Nombre de commentaires</p>
                                            <p id="stat-register" class="blue">62</p></li>
                                    </ul>
                                    <ul>
                                        <li><p>Nombre de messages envoyés</p>
                                            <p id="stat-register" class="blue">150</p></li>
                                    </ul>
                                    <ul>
                                        <li><p>Nombre de participation à un cours</p>
                                            <p id="stat-register" class="blue">7</p></li>
                                    </ul>
                                    <ul>
                                        <li><p>Nombre de ?</p>
                                            <p id="stat-register" class="blue">2</p></li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                        <section id="stat-visit" class="col-8 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Nombre de visiteur du CMS</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
                                    </a>
                                </div>
                                <div class="container">
                                    <div class="filter" id="filter-view-cms">
                                        <select id="select-view-cms">
                                            <option value="day">per day</option>
                                            <option value="month" selected>per month</option>
                                            <option value="year">per year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <section id="last-lessons" class="col-6 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Last Lessons</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
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
                                            <li><span>Tutoriel pour la création de maquette sous invasion</span></li>
                                            <li><span>24/11/2018</span></li>
                                            <li><span>12</span></li>
                                            <li><span>30</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="homeworks" class="col-6 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Homeworks</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
                                    </a>
                                </div>
                                <div class="container">
                                    <div class="column-col-5">
                                        <ul>
                                            <li><span>Title homework</span></li>
                                            <li><span>Date</span></li>
                                            <li><span>Participant number </span></li>
                                            <li><span>Lesson Link</span></li>
                                        </ul>
                                    </div>
                                    <div class="row-col-5">
                                        <ul>
                                            <li><span class="blue">Rédaction</span></li>
                                            <li><span>24/11/2018</span></li>
                                            <li><span>12</span></li>
                                            <li><span><i class="material-icons blue">attachment</i></span></li>
                                        </ul>
                                    </div>
                                    <div class="row-col-5">
                                        <ul>
                                            <li><span class="blue">Rédaction</span></li>
                                            <li><span>24/11/2018</span></li>
                                            <li><span>12</span></li>
                                            <li><span><i class="material-icons blue">attachment</i></span></li>
                                        </ul>
                                    </div>
                                    <div class="row-col-5">
                                        <ul>
                                            <li><span class="blue">Rédaction</span></li>
                                            <li><span>24/11/2018</span></li>
                                            <li><span>12</span></li>
                                            <li><span><i class="material-icons blue">attachment</i></span></li>
                                        </ul>
                                    </div>
                                    <div class="row-col-5">
                                        <ul>
                                            <li><span class="blue">Rédaction</span></li>
                                            <li><span>24/11/2018</span></li>
                                            <li><span>12</span></li>
                                            <li><span><i class="material-icons blue">attachment</i></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <section id="Last register" class="col-6 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Last Register</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
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
                            </div>
                        </section>
                        <section id="last-blog-post" class="col-6 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Last blog post</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
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
                            </div>
                        </section>
                    </div>
                    <div class="row">
                        <section id="last-chat-message" class="col-6 block-dash">
                            <div class="marg-container">
                                <div class="title">
                                    <h4>Last chat message</h4>
                                    <a href="#">
                                        <i class="material-icons blue">add</i>
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
                            </div>
                        </section>
                    </div>
                </div>
        </section>
    </div>
</div>
</div>
</section>
</div>
</div>