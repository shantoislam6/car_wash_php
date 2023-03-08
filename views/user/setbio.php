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
                        <h4 class="text-right">Set You Bio</h4>
                    </div>
                    <form method="POST" action="/user/set_bio" class="signup" enctype="application/x-www-form-urlencoded">
                        <div class="form-group ">
                            <textarea name="bio" value="<?= isset($data['form_data']['bio']) ? $data['form_data']['bio'] : $data['user']['bio'] ?>" class="form-control <?= isset($data['errors']['bio']) ? 'is-invalid' : '' ?>" rows="4" ><?= isset($data['form_data']['bio']) ? $data['form_data']['bio'] : $data['user']['bio'] ?></textarea>
                            <small class="muted">Describe yourself in 140 characters</small>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <span><?= isset($data['errors']['bio']) ? $data['errors']['bio'] : '' ?></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark"><b>Set</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<?php view_include("inc/footer", $data) ?>