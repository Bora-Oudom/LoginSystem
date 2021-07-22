<?php
   require APPROOT . '/views/elements/head.php';
?>
<div id="section-landing">
   <?php 
   require APPROOT . '/views/elements/navigation.php';
   ?>
   <?php if (isLoggedIn()): ?>
      <div class="wrapper-landing">
   
         <h1>Wellcome to my webside.</h1>
         <h2>My name is Bora Oudom.</h2>
      
      </div>
    <?php else : ?>
      <div class="wrapper-landing">
   
         <h1>You are not login yet.</h1>
   
      </div>
    <?php endif; ?> 
   
</div>
<?php 
   require APPROOT . '/views/elements/footer.php';
?>
   