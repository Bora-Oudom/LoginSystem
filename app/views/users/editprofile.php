<?php
   require APPROOT . '/views/elements/head.php';
?>
    <div class="navbar dark" >
        <?php 
        require APPROOT . '/views/elements/navigation.php';
        ?>
   </div> 
<div class="container-login">
    <div class="wrapper-login">
        <h2>Edit your Profile</h2>

        <form action="<?php echo URLROOT; ?>/users/editprofile" method ="POST">
            <input type="text"  placeholder="New Username" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="email" placeholder="New Email" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>

            <button 
            id="submit" 
            type="submit"
            value="delete"
            class="btn btn-dark">Submit</button>

        </form>
    </div>
</div>


<?php 
   require APPROOT . '/views/elements/footer.php';
?>