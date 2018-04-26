<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"];?>">Dashboard</a> <span class="additional-message-title">/ Blog</span></h2>
            </div>
        </section>
    </div>
</div>
<section id="right-column" class="container">
    <div class="row">
        <div class="col-6">
            <div>
                <section class="content-backoffice">
                    <div class="header-content">
                        <h4>Dernières poublications</h4>
                        <a href="#" class="active"><i class="material-icons">&#xE145;</i></a>
                    </div>
                    <div class="main-content">
                        <table>
                            <thead>
                            <tr>
                                <td>Titre</td>
                                <td>Date publication</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($lastsPublication as $key => $value): ?>
                                <tr>
                                    <td class="td-content-text"><?php echo $value["blog_title"];?></td>
                                    <td class="td-content-date"><?php echo $value["blog_datecreate"];?></td>
                                    <td class="td-content-action">
                                        <a href="#" class="btn-sm btn-tosle">View</a>
                                        <a href="#" class="btn-sm btn-yellow">Edit</a>
                                        <?php if($value["blog_status"]==1): ?>
                                            <a href="<?php echo $hrefBlogStatus."/".$value["blog_id"];?>" class="btn-sm btn-red">Depublier</a></td>
                                        <?php else: ?>
                                            <a href="<?php echo $hrefBlogStatus."/".$value["blog_id"];?>" class="btn-sm btn-green">Publier</a></td>
                                        <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        <div class="col-6">
            <div>
                <section class="content-backoffice">
                    <div class="header-content">
                        <h4>Pas encore fait</h4>
                        <a href="#" class="desactive"><i class="material-icons">&#xE145;</i></a>
                    </div>
                    <div class="main-content">
                        <table>
                            <thead>
                            <tr>
                                <td>Data type</td>
                                <td>Value</td>
                                <td>Date</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="td-content-text">Number of message</td>
                                <td class="td-content-number">45</td>
                                <td class="td-content-date">19/03/2018</td>
                            </tr>
                            <tr>
                                <td class="td-content-text">Number of conversation</td>
                                <td class="td-content-number">5</td>
                                <td class="td-content-date">19/03/2018</td>
                            </tr>
                            <tr>
                                <td class="td-content-text">Number owner message</td>
                                <td class="td-content-number">20</td>
                                <td class="td-content-date">19/03/2018</td>
                            </tr>
                            <tr>
                                <td class="td-content-text">Number user message</td>
                                <td class="td-content-number">25</td>
                                <td class="td-content-date">19/03/2018</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        <?php $this->addModal("dashboard_bloc", $configLastsPost);?>
    </div>
</section>