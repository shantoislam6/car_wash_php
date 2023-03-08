<?php view_include("inc/header", $data) ?>
<section class="content-section">

    <div class="container p-4 rounded bg-white mt-5 mb-5">
        <a type="button" href="/user/edit_profile" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>
        <div class="row justify-content-center">
            <div class="col-md-5 p-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="avater-container">
                        <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                            <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                        </span>
                    </div>
                    <span class="font-weight-bold"><?= $data['user']['first_name'] ?> <?= $data['user']['last_name'] ?></span><span class="text-black-50"><?= $data['user']['email'] ?></span><span></span>
                </div>
            </div>
            <div class="col-md-5 p-3">
                <div class="p-3 py-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Change Your Email</h4>
                    </div>
                    <form action="/user/change_email" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <div class="input-group">
                                    <input type="text" name="email" value="<?= isset($data['form_data']['email']) ? $data['form_data']['email'] : $data['user']['email'] ?>" class="form-control <?= isset($data['errors']['email']) ? 'is-invalid' : '' ?>" id="email_new">
                                    <div class="input-group-append ">
                                        @
                                    </div>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <span><?= isset($data['errors']['email']) ? $data['errors']['email'] : '' ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class=" text-center">
                            <button type="submit" name="change_email_request" value="submit_email" class="btn btn-dark profile-button" type="button">Change Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

</section>


<?php view_include("inc/footer", $data) ?>