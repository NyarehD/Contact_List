<?php require "base.php";
require "function.php" ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="vendor/feather-icons-web/feather.css">
  <link rel="stylesheet" href="vendor/data_table/jquery.dataTables.min.css">
  <link rel="stylesheet" href="vendor/data_table/dataTables.bootstrap4.min.css">
  <title>Document</title>
  <style>
    #newContact {
      background-color: rgba(194, 194, 194, 0.28);
      inset: 0;
      z-index: 10000;
    }

    .contact_photo {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }
  </style>
</head>
<body>
<div class="container-fluid vw-100 vh-100 position-absolute d-none justify-content-center align-items-center"
     id="newContact">
  <div class="row justify-content-center align-items-center w-75">
    <div class="col-12 col-md-6">
      <div class="my-5">
        <div class="card shadow-lg">
          <div class="card-body">
              <?php
              if (isset($_POST['add'])) {
                  validate();
              }
              ?>
            <form method="post" enctype="multipart/form-data" class="w-100">
              <div class="form-group mb-3">
                <label for="contact_name" class="text-primary font-weight-bold">Your Name</label>
                <input type="text" id="contact_name" name="contact_name" class="form-control"
                       value="<?php echo old('contact_name') ?> ">
                  <?php if (getError('contact_name')) { ?>
                    <small class="text-danger font-weight-bolder"><?php echo getError('contact_name'); ?></small>
                  <?php }; ?>
              </div>
              <div class="form-group mb-3">
                <label for="phone_number" class="text-primary font-weight-bold">Your Phone</label>
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
                       accept="image/jpeg,image/png" value="<?php echo old('contact_photo') ?>">
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
<div class="container">
  <div class="row my-5">
    <div class="col-10">
      <h1>Contact List</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-10 d-flex justify-content-between">
      <button class="btn btn-primary" id="addContact"><i class="feather-plus"></i> ADD Contact</button>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
               name="search_key">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-10">
      <table class="table-hover table-borderless table mt-3">
        <thead>
        <tr>
          <th>Name</th>
          <th>Phone</th>
          <th>Option</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach (contacts() as $contact) {
            ?>
          <tr>
            <td><img class="contact_photo mr-3" src="<?php echo $contact['contact_photo']; ?>"
                     alt=""><?php echo $contact['contact_name']; ?></td>
            <td><?php echo $contact["phone_number"] ?></td>
            <td>
              <a href="category_edit.php?id=<?php echo $c['id']; ?>" class="btn btn-outline-warning btn-sm">
                <i class="feather-edit"></i>
              </a>
              <a href="category_delete.php?id=<?php echo $c['id']; ?>" class="btn btn-outline-danger btn-sm"
                 onclick="return confirm('Are you sure to Delete 🤔?')">
                <i class="feather-trash-2"></i>
              </a>
            </td>
          </tr>
        <?php }; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="vendor/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="vendor/data_table/dataTables.bootstrap4.min.js"></script>
<script src="vendor/data_table/jquery.dataTables.min.js"></script>
<script>
  $("#addContact").on("click", function () {
    $("#newContact").removeClass("d-none").addClass("d-flex");
    console.log(";alskdfj;lkasdf");
  });
</script>
</body>
</html>