<?php
/* @var  array $messages*/
require '_header.php'
?>


<div id="app">
  <div id="messages">
    <div class="alert alert-success" v-for="message in messages">
      <div v-html="message.message"></div>
    </div>
  </div>
</div>
<?php

require '_footer.php';
?>