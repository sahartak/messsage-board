<?php
/* @var  array $messages*/
require '_header.php'
?>


<div class="row">
  <div class="col-md-12">
    <a class="btn btn-success" href="/admin/?action=create">Create New Message</a>
    <br>
  </div>

</div>

<div class="row" style="margin-top: 10px">
  <div class="col-md-12">
    <table class="table data_table">
      <thead>
      <tr>
        <th>Id</th>
        <th>Message</th>
        <th>Created at</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($messages as $message):?>
        <tr>
          <td><?= $message->id?></td>
          <td><?= $message->message?></td>
          <td><?= date('Y-m-d H:i', $message->created_at)?></td>
        </tr>
      <?php endforeach;?>

      </tbody>
    </table>
  </div>

</div>

<?php

$script = '
<script>
  $(".data_table").dataTable();
</script>
';
require '_footer.php';
?>