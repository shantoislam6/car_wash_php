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
                        <h4 class="text-right">Edit Your Details</h4>
                    </div>
                    <form method="POST" action="/user/edit_details" class="signup" enctype="application/x-www-form-urlencoded">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">First Name</label>
                                <input type="text" name="first_name" value="<?= isset($data['form_data']['first_name']) ? $data['form_data']['first_name'] : $data['user']['first_name'] ?>" class="form-control <?= isset($data['errors']['first_name']) ? 'is-invalid' : '' ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['first_name']) ? $data['errors']['first_name'] : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Last Name</label>
                                <input type="text" class="form-control <?= isset($data['errors']['last_name']) ? 'is-invalid' : '' ?>" name="last_name" value="<?= isset($data['form_data']['last_name']) ? $data['form_data']['last_name'] : $data['user']['last_name'] ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['last_name']) ? $data['errors']['last_name'] : '' ?></span>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">

                            <div class="col-md-12 mb-4">
                                <label class="labels">Mobile Number</label>
                                <input type="text" name="mobile_number" value="<?= isset($data['form_data']['mobile_number']) ? $data['form_data']['mobile_number'] : $data['user']['mobile_number'] ?>" class="form-control <?= isset($data['errors']['mobile_number']) ? 'is-invalid' : '' ?>" placeholder="Example : 01712-345678">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['mobile_number']) ? $data['errors']['mobile_number'] : '' ?></span>
                                </div>
                            </div>


                            <div class="col-md-12 form-group mb-4">
                                <label class="labels">Choose gender</label>
                                <div class="custom-radio-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gender_male" name="gender" value="male" class="custom-control-input" <?= isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'male' ? 'checked' : (($data['user']['gender'] == 'male') ? 'checked' : '') ?>>
                                        <label class="custom-control-label" for="gender_male">Male</label>
                                    </div>
                                    <div class="custom-control  custom-radio">
                                        <input type="radio" id="gender_female" value="female" name="gender" class="custom-control-input" <?= isset($data['form_data']['gender']) && $data['form_data']['gender'] == 'female' ? 'checked' : (($data['user']['gender'] == 'female') ? 'checked' : '') ?>>
                                        <label class="custom-control-label" for="gender_female">Female</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 mb-4">
                                <label class="labels">Address Line 1</label>
                                <input type="text" name="address_line_1" value="<?= isset($data['form_data']['address_line_1']) ? $data['form_data']['address_line_1'] : $data['user']['address_line_1'] ?>" class="form-control <?= isset($data['errors']['address_line_1']) ? 'is-invalid' : '' ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['address_line_1']) ? $data['errors']['address_line_1'] : '' ?></span>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="labels">Address Line 2 <span class="text-secondary">(optional)</span></label>
                                <input type="text" name="address_line_2" value="<?= isset($data['form_data']['address_line_2']) ? $data['form_data']['address_line_2'] : $data['user']['address_line_2'] ?>" class="form-control <?= isset($data['errors']['address_line_2']) ? 'is-invalid' : '' ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['address_line_2']) ? $data['errors']['address_line_2'] : '' ?></span>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="labels">Postcode</label>
                                <input type="number" name="postcode" value="<?= isset($data['form_data']['postcode']) ? $data['form_data']['postcode'] : $data['user']['postcode'] ?>" class="form-control <?= isset($data['errors']['postcode']) ? 'is-invalid' : '' ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['postcode']) ? $data['errors']['postcode'] : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="labels">Current location</label>
                                <input type="text" name="current_location" value="<?= isset($data['form_data']['current_location']) ? $data['form_data']['current_location'] : $data['user']['current_location'] ?>" class="form-control <?= isset($data['errors']['current_location']) ? 'is-invalid' : '' ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['current_location']) ? $data['errors']['current_location'] : '' ?></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="labels">State/Region</label>
                                <input type="text" name="state" value="<?= isset($data['form_data']['state']) ? $data['form_data']['state'] : $data['user']['state'] ?>" class="form-control <?= isset($data['errors']['state']) ? 'is-invalid' : '' ?>">
                                <div id="validationServer03Feedback" class="invalid-feedback">
                                    <span><?= isset($data['errors']['state']) ? $data['errors']['state'] : '' ?></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>


<?php view_include("inc/footer", $data) ?>