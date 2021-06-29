<?php
   require APPROOT . '/views/elements/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/elements/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Signup</h2>

            <form
                id="register-form"
                method="POST"
                action="<?php echo URLROOT; ?>/users/signup"
                >
            <input type="text" placeholder="Username" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="email" placeholder="Email" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>

            <input type="password" placeholder="Password" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="Re-Password" name="repassword">
            <span class="invalidFeedback">
                <?php echo $data['repasswordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Already have account.<a href="<?php echo URLROOT; ?>/users/login">login</a></p>
        </form>
    </div>
</div>
