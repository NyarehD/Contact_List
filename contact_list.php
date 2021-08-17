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