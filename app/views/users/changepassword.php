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
        <h2>Change Password</h2>

        <form action="<?php echo URLROOT; ?>/users/changepassword" method ="POST">
            <input type="password" placeholder="Current Password" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="New Password" name="newPassword">
            <span class="invalidFeedback">
                <?php echo $data['newPasswordError']; ?>
            </span>

            <input type="password" placeholder="Re-type new Password" name="repassword">
            <span class="invalidFeedback">
                <?php echo $data['repasswordError']; ?>
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