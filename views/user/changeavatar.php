<?php view_include("inc/header", $data) ?>
<section class="content-section">
    <div class="container p-4 rounded bg-white mt-5 mb-5">

        <a type="button" href="/user/edit_profile" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>

        <div class="row justify-content-center">
            <div class="col-md-5 p-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <div class="avater-container">
                        <span id="avater-container-img" class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>');">
                            <img src="<?= URLROOT . '/static/avatar/' . $data['user']['avatar_path'] ?>" hidden>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-5 p-3">
                <div class="p-3 py-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Change Your Avater</h4>
                    </div>
                    <form id="avater-upload-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="file" data-maxsize="<?= MAX_AVTAR_SIZE ?>" id="avater-file" name="avatar" class="form-control-file <?= isset($data['errors']['avatar']) ? 'is-invalid' : '' ?>" id="" placeholder="" aria-describedby="fileHelpId">
                            <div id="validationServer03Feedback" class="invalid-feedback mt-2">
                                <span><?= isset($data['errors']['avatar']) ? $data['errors']['avatar'] : '' ?></span>
                            </div>
                            <br>
                            <small class="form-text text-muted">Requirements</small>
                            <small class="form-text text-muted">File type : image/jpg, image/png, image/jpeg </small>
                            <small class="form-text text-muted">File size : Maximum size <?= MAX_AVTAR_SIZE / 1000 ?> kilobytes</small>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-dark">Change Avatar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php view_include("inc/footer", $data) ?>