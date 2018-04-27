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
        <?php $this->addModal("dashboard_bloc", $configLastsPost);?>
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
</section>

<div id="<?php echo $idModalViewAllPosts;?>" class="fade-background" data-type="parent-modal">
    <div class="modal-window">
        <div class="modal-header">
            <i class="modal-header-icon material-icons" data-type="close-modal">close</i>
            <h2>Visualisation de tous les articles</h2>
        </div>
        <div class="modal-main">
            <div class="container">
                <div class="row">
                    <?php $this->addModal("dashboard_bloc", $configAllPosts);?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-red" data-type="close-modal">Close modal</button>
        </div>
    </div>
</div>