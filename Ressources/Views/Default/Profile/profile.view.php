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
                            <h2>My Class</h2>
                        </div>
                    </section>
                    <section><h2>My Homework</h2></section>
                    <section class="comment">
                        <h2>My Last Comment</h2>
                        <div class="container">
                            <ul class="title-tab">
                                <li>Content</li>
                                <li>Type</li>
                                <li>Date</li>
                            </ul>
                            <?php if (isset($comments_user)): ?>
                                <?php foreach ($comments_user as $comment): ?>
                                    <ul>
                                        <li><?php echo $comment['content']; ?></li>
                                        <li><?php echo $comment['type'];  ?></li>
                                        <li><?php echo $comment['date']; ?></li>
                                    </ul>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                    </section>

                </section>

            </div>
        </div>
    </div>
</section>