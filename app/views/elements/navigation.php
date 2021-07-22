<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/index">Home</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/about">About</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/projects">Projects</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/blog">Blog</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/cruds/index">CRUD</a>
        </li>

        <?php if(isset($_SESSION['id'])) : ?>

        <li class="btn btn-primary">
            <a href="<?php echo URLROOT; ?>/users/profile">Profile</a> 
        </li>
        <li class="btn btn-danger">
            <a href="<?php echo URLROOT; ?>/users/logout" php>Log Out</a>
        </li>

        <?php else : ?>

        <li class="btn btn-success">
            <a href="<?php echo URLROOT; ?>/users/login">Login</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>