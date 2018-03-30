<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a href="<?php echo DIRNAME.substr($language,0,2)."/dashboard";?>">Dashboard</a> / Chat</h2>
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
                        <h4>Last chat message</h4>
                        <a href="#" class="desactive"><i class="material-icons">&#xE145;</i></a>
                    </div>
                    <div class="main-content">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Sender to recipient</td>
                                    <td>Link</td>
                                    <td>Date</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-content-avatar"><img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg"></td>
                                    <td class="td-content-text"><span class="bold-text">Najla CHELLY reply</span></td>
                                    <td class="td-content-icone"><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>chat"><i class="material-icons">&#xE157;</i></a></td>
                                    <td class="td-content-date">19/03/2018</td>
                                </tr>
                                <tr>
                                    <td class="td-content-avatar"><img src="<?php echo DIRNAME;?>Tosle/Users/Images/475899654133.jpg"></td>
                                    <td class="td-content-text"><span class="bold-text">You</span> write to Julien DOMANGE</td>
                                    <td class="td-content-icone"><a href="<?php echo DIRNAME.substr($language,0,2)."/";?>chat"><i class="material-icons">&#xE157;</i></a></td>
                                    <td class="td-content-date">19/03/2018</td>
                                </tr>
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
                        <h4>View stats</h4>
                        <a href="#" class="active"><i class="material-icons">&#xE145;</i></a>
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