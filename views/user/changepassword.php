<?php view_include("inc/header", $data) ?>
<section class="content-section">

    <div class="container p-4 rounded bg-white mt-5 mb-5">

        <a type="button" href="/user/edit_profile" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>

        <div class="row justify-content-center">
            <div class="col-md-5 p-3 ">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="avater-container">
                        <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                            <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                        </span>
                    </div>
                    <span class="font-weight-bold"><?= $data['user']['first_name'] ?> <?= $data['user']['last_name'] ?></span><span class="text-black-50"><?= $data['user']['email'] ?></span><span></span>
                </div>

            </div>


            <div class="col-md-5 p-3 ">
                <div class="p-3 py-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Change Your Password</h4>
                    </div>
                    <form action="/user/change_password" method="POST" enctype="application/x-www-form-urlencoded">
                        <div class="row">

                            <div class="form-group col-md-12 ">
                                <label for="exampleInputPassword1">Old password</label>
                                <div class="input-group">
                                    <input type="password" id="old_password" name="old_password" value="<?= isset($data['form_data']['old_password']) ? $data['form_data']['old_password'] : '' ?>" class="form-control <?= isset($data['errors']['old_password']) ? 'is-invalid' : '' ?>" id="pass">
                                    <div class="input-group-append show_hide_password">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>

                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <span><?= isset($data['errors']['old_password']) ? $data['errors']['old_password'] : '' ?></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group col-md-12 ">
                                <label for="exampleInputPassword1">New password</label>

                                <div class="input-group">
                                    <input type="password" id="new_password" name="new_password" value="<?= isset($data['form_data']['new_password']) ? $data['form_data']['new_password'] : '' ?>" class="form-control <?= isset($data['errors']['new_password']) ? 'is-invalid' : '' ?>" id="pass">
                                    <div class="input-group-append show_hide_password">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <span><?= isset($data['errors']['new_password']) ? $data['errors']['new_password'] : '' ?></span>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group col-md-12 ">
                                <label for="exampleInputPassword1">Repeat new password</label>

                                <div class="input-group">
                                    <input type="password" id="re_new_password" name="re_new_password" value="<?= isset($data['form_data']['re_new_password']) ? $data['form_data']['re_new_password'] : '' ?>" class="form-control <?= isset($data['errors']['re_new_password']) ? 'is-invalid' : '' ?>" id="pass">
                                    <div class="input-group-append show_hide_password">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                        <span><?= isset($data['errors']['re_new_password']) ? $data['errors']['re_new_password'] : '' ?></span>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <div class="mt-2 text-center">
                            <button type="submit" value="submit" class="btn btn-dark profile-button" type="button">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<?php view_include("inc/footer", $data) ?>