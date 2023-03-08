<?php function yield_head()
{ ?>

<?php } ?>

<?php view_include("inc/header", $data) ?>



<section class="content-section">

  <div class="container ">
    <br>
    <a type="button" href="<?php echo prev_url(); ?>" class="btn text-dark btn-sm font-weight-bold"><i class="fa fa-angle-left" aria-hidden="true"></i> BACK</a>
    <br>
    <br>
    <h4 class="px-3 text-secondary">Customers</h4>

    <?php if (count($data['customers']) == 0) { ?>

        <h4 class="display-4 d-flex justify-content-center align-items-center" style="height:500px;color:#818181;">EMPTY</h4>

    <?php } else { ?>

      <?php if (count($data['customers']) > 6) { ?>
        <div class="snippets bootdey ">

          <div class="row my-4">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-body p-t-0">
                  <form action="">

                    <div class="input-group">
                      <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-effect-ripple btn-dark"><i class="fa fa-search"></i></button>
                      </span>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

        <div class="row">

          <?php
          foreach ($data['customers'] as $customer) :



          ?>
            <div class="col-md-6 customer-card">
              <div class="panel">
                <div class="panel-body p-t-10">
                  <div class="media-main">
                    <a class="pull-left" href="#">
                      <div class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $customer['avatar_path'] ?>');">
                        <img src="<?= URLROOT . '/static/avatar/' . $customer['avatar_path'] ?>" hidden>
                      </div>
                    </a>
                    <div class="pull-right btn-group-sm">
                      <a href="/customers/delete_customer/<?= $customer['id'] ?>" class="btn btn-danger tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                        <i class="fa fa-close"></i> Delete
                      </a>
                    </div>
                    <div class="info">
                      <h4><a href="<?= URLROOT . '/user/profile/' . $customer['id'] ?>"><?= $customer['first_name'] . ' ' . $customer['last_name'] ?></a></h4>
                      <p class="text-muted">♡ Customer ♡</p>
                    </div>
                    <div class="profle-data  text-center mt-3">
                      <div class="row">
                        <div class="col-4">
                          <small class="text-small text-muted">Booked</small>
                          <h6>947</h6>

                        </div>
                        <div class="col-4">
                          <small class="text-small text-muted">Completed</small>

                          <h6>583</h6>
                        </div>
                        <div class="col-4">
                          <small class="text-small text-muted">Pending</small>

                          <h6>48</h6>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          <?php endforeach ?>


        </div>
        </div>

      <?php } ?>

  </div>

  <?php if (count($data['customers']) > 6) { ?>
    <div class="container my-3">
      <nav aria-label="Page navigation example ">
        <ul class="pagination m-0 justify-content-center ">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>
    </div>

  <?php } ?>

</section>

<?php view_include("inc/footer", $data) ?>



<?php function yield_footer()
{ ?>



<?php } ?>