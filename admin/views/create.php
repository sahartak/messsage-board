<?php require '_header.php'; ?>


<form action="/admin/?action=create" method="post">
    <div class="form-group">
        <p style="color:  red"><?= $message ?? ''?></p>
        <label for="message">Message</label>
        <textarea required name="message" class="form-control" id="message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>



<?php
    $script = '
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script>
        CKEDITOR.replace( "message" );
  </script>

';
    require '_footer.php'
?>
