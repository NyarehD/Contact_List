<?php require "template/head.php" ?>
  <div class="container" id="newContact">
    <div class="row">
      <div class="col-12 col-md-10">
        <div class="my-5">
          <div class="card">
            <div class="card-body">
                <?php
                if (isset($_POST['add'])) {
                    if (validate()) {
                      contactAdd();
                    }
                }
                ?>
              <form method="POST" enctype="multipart/form-data" class="w-100">
                <div class="form-group mb-3">
                  <label for="contact_name" class="text-primary font-weight-bold">Name</label>
                  <input type="text" id="contact_name" name="contact_name" class="form-control"
                         value="<?php echo old('contact_name') ?> ">
                    <?php if (getError('contact_name')) { ?>
                      <small class="text-danger font-weight-bolder"><?php echo getError('contact_name'); ?></small>
                    <?php }; ?>
                </div>
                <div class="form-group mb-3">
                  <label for="phone_number" class="text-primary font-weight-bold">Phone Number</label>
                  <input type="number" id="phone_number" name="phone_number" class="form-control"
                         value="<?php echo old('phone_number') ?>">
                    <?php if (getError("phone_number")) { ?>
                      <small class="text-danger font-weight-bolder"><?php echo getError("phone_number"); ?></small>
                    <?php }; ?>
                </div>
                <div class="form-group mb-3">
                  <label for="contact_photo" class="text-primary font-weight-bold">Contact Photo</label>
                  <input type="file" class="custom-file" placeholder="Username" aria-label="Username"
                         aria-describedby="basic-addon1" id="contact_photo" name="contact_photo"
                         accept="image/jpeg,image/png">
                    <?php if (getError("contact_photo")) { ?>
                      <small class="text-danger font-weight-bolder"><?php echo getError("contact_photo"); ?></small>
                    <?php }; ?>
                </div>
                <div class="form-inline d-flex justify-content-end align-items-center">
                  <button name="add" class="btn btn-primary text-right">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include "template/footer.php" ?>