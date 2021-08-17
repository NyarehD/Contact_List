<?php require "template/head.php" ?>

  <div class="container">
    <div class="row my-5">
      <div class="col-10">
        <h1 class="font-weight-bold text-primary">Contact List</h1>
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
      <div class="container">
          <?php require "contact_list.php" ?>
      </div>
    </div>
  </div>
<?php require "template/footer.php" ?>