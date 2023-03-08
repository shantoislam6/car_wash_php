<?php view_include("inc/header", $data) ?>
<section class="content-section">

    <div class="container p-4 rounded bg-white mt-5 mb-5">

        <a type="button" href="/user/edit_profile" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>

        <div class="row justify-content-center">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="avater-container">
                        <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                            <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                        </span>
                    </div>
                    <span class="font-weight-bold"> <?= $_SESSION['role'] == 3 ? '<span class="text-danger">★ Owner ★</span>' : ($_SESSION['role'] == 2 ? '<span class="text-info">☆ Admin ☆</span>' : '<span class="text-secondary">♡ Customer ♡</span>')  ?></span>
                    <span class="font-weight-bold"><?= $data['user']['first_name'] ?> <?= $data['user']['last_name'] ?></span>
                    <span class="text-black-50"><?= $data['user']['email'] ?></span><span></span>


                </div>
            </div>

            <div class="col-md-5 ">
                <div class="p-3 py-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Add Social Links</h4>
                    </div>
                    <form method="POST" action="/user/add_social" class="signup" enctype="application/x-www-form-urlencoded">
                        <div class="row mt-2">

                            <?php
                            $social_link = json_decode($data['user']['social_links'], true);
                            ?>

                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text facebook" id="basic-addon1">
                                            <i class="fa fa-facebook"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Facebook Username" aria-label="Username" aria-describedby="basic-addon1" name="facebook_username" value="<?= isset($social_link['facebook_username']) ? $social_link['facebook_username'] : '' ?>">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text twitter" id="basic-addon1">
                                            <i class="fa fa-twitter"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Twitter Username" aria-label="Username" aria-describedby="basic-addon1" name="twitter_username" value="<?= isset($social_link['twitter_username']) ? $social_link['twitter_username'] : '' ?>">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text linkedin" id="basic-addon1">
                                            <i class="fa fa-linkedin">
                                            </i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="LinkedIn Username" aria-label="Username" aria-describedby="basic-addon1" name="linkedin_username" value="<?= isset($social_link['linkedin_username']) ? $social_link['linkedin_username'] : '' ?>">
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text website" id="basic-addon1">
                                            <i class="fa fa-globe fa-lg"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Your Website Link" aria-label="Username" aria-describedby="basic-addon1" name="user_website" value="<?= isset($social_link['user_website']) ? $social_link['user_website'] : '' ?>">
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-dark"><b>SAVE</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<?php view_include("inc/footer", $data) ?>