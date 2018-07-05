<section class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["profilehome"]; ?>">My Profil</a></h2>
            </div>
        </section>
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-4">
            <div>
                <section class="profile">
                    <div class="profile-container">
                        <section class="picture">
                            <div class="profil-picture">
                                <img src="<?php echo DIRNAME; ?>Tosle/Users/Images/475899654133.jpg">
                            </div>
                        </section>
                        <section class="info">
                            <section class="name">
                                <span><?php echo $profile_info['firstname'] . ' ' . $profile_info['lastname']; ?></span>
                            </section>
                            <section class="edit-action">
                                <button class="btn btn-tosle">Edit my profile</button>
                            </section>
                            <section class="email">
                                <span>Contact mail :</span>
                                <span><?php echo $profile_info['email']; ?></span>
                            </section>
                            <section class="group">
                                <span>Group:</span>
                                <span>3IW2</span>
                            </section>
                            <section class="newsletter">
                                <span>Newsletter :</span>
                                <span><?php if (is_null($profile_info['newsletter']))
                                            echo 'You\'re not suscribing to the Newsletter';
                                        else
                                            echo 'You\'re suscribing to the Newsletter.';
                                      ?>
                                </span>
                            </section>
                        </section>
                    </div>
                </section>
            </div>
        </div>
        <div class="col-8">
            <div>
                <section class="container-content-profile">
                    <section class="lessons">
                        <div class="title">
                            <span>My Class</span>
                        </div>
                    </section>
                    <section><span>My Homework</span></section>
                    <section><span>My last comments</span></section>
                </section>

            </div>
        </div>
    </div>
</section>