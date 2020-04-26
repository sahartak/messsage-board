<?php require '_header.php'; ?>
<p style="color: red"><?=$message?></p>
<form method="post">
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" required class="form-control" name="login" id="login">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" required class="form-control" id="pwd" name="password">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>

<?php
require '_footer.php'
?>
