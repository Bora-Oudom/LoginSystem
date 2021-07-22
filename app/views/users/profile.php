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
        <h2>Profile</h2>

        <form action="<?php echo URLROOT; ?>/users/profile" method ="POST">
            <h3>Username:</h3><h4><?php echo $_SESSION['username']; ?></h4>
            <h3>Email:</h3> <h4><?php echo $_SESSION['email']; ?></h4>

            <a class="btn btn-primary" href="<?php echo URLROOT; ?>/users/editprofile">Edit Profile</a> 
            
            <a class="btn btn-success" href="<?php echo URLROOT; ?>/users/changepassword">Change Password</a> <br>
            

            <button 
            id="submit" 
            type="submit" 
            value="delete"
            class="btn btn-dark">Delete Account</button>
        </form>
    </div>
</div>


<?php 
   require APPROOT . '/views/elements/footer.php';
?>