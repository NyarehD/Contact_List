<?php require "template/head.php"; ?>
<div class="container">
  <div class="row mt-2">
    <div class="col-12">
      <button class="btn btn-primary" id="toHome"><i class="feather-arrow-left"></i> Home</button>
      <h2 class="text-primary font-weight-bold my-3">Search results for : <?php echo $_GET['search_contact'] ?> </h2>
    </div>
  </div>
  <div class="row">
    <div class="container">
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
        foreach (searchContacts($_GET["search_contact"]) as $contact) {
            ?>
          <tr>
            <td><img class="contact_photo mr-3" src="<?php echo $contact['contact_photo']; ?>"
                     alt=""><?php echo $contact['contact_name']; ?></td>
            <td><?php echo $contact["phone_number"] ?></td>
            <td>
              <a href="contact_edit.php?id=<?php echo $contact['id']; ?>" class="btn btn-outline-warning btn-sm">
                <i class="feather-edit"></i>
              </a>
              <a href="contact_delete.php?id=<?php echo $contact['id']; ?>" class="btn btn-outline-danger btn-sm"
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
<?php require "template/footer.php"; ?>
<script>
  $("#toHome").on('click', function () {
    location.href = "index.php";
  })
</script>