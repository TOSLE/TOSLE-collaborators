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
                                <img src="<?php echo (!empty($this->Auth->getFileid()))?$this->Auth->getAvatar()->getPath().'/'.$this->Auth->getAvatar()->getName():DIRNAME.'Tosle/Users/Images/475899654133.jpg';?>">
                            </div>
                        </section>
                        <section class="info">
                            <section class="name">
                                <span><?php echo $profile_info['firstname'] . ' ' . $profile_info['lastname']; ?></span>
                            </section>
                            <section class="edit-action">
                                <a href="<?php echo $this->slugs["edit_profile"];?>" class="btn btn-tosle">Edit my profile</a>
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
                        <div class="title-tab">
                            <h2>My Lesson</h2>
                            <div class="container">
                                <ul class="title-tab">
                                    <li><span>Title</span></li>
                                    <li><span>Date</span></li>
                                    <li><span>link</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <section class="homework">
                        <h2>My Homework</h2>
                        <div class="container">
                            <ul class="title-tab">
                                <li><span>Title</span></li>
                                <li><span>Chapter Lesson</span></li>
                                <li><span>Title Lesson</span></li>
                                <li><span>Date</span></li>
                            </ul>
                        </div>

                    </section>
                    <section class="comment">
                        <h2>My Last Comment</h2>
                        <div class="container">
                            <ul class="title-tab">
                                <li><span>Content</span></li>
                                <li><span>Type</span></li>
                                <li><span>Date</span></li>
                            </ul>
                            <?php if (isset($comments_user)): ?>
                                <?php foreach ($comments_user as $comment): ?>
                                    <ul>
                                        <li><span><?php echo $comment['content']; ?></span></li>
                                        <li><span><?php echo $comment['type']; ?></span></li>
                                        <li><span><?php echo $comment['date']; ?></span></li>
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