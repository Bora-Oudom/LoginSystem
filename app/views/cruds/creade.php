<?php
   require APPROOT . '/views/elements/head.php';
?>
    <div class="navbar dark" >
        <?php 
        require APPROOT . '/views/elements/navigation.php';
        ?>
   </div>
<div class="container-login">
    <div class="wrapper-login" >
        <h2>Add New Product</h2> 
        <form action="<?php echo URLROOT; ?>/cruds/creade" 
        method ="POST">
            <h3>Product Name</h3>
            <input type="text" 
                placeholder="Name" 
                name="name">
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>

            <h3>Product Price</h3>
            <input type="text" 
            placeholder="Price" 
            name="price">
            <span class="invalidFeedback">
                <?php echo $data['priceError']; ?>
            </span>

            <h3>Product Quantity</h3>
            <input type="text" 
            placeholder="Quantity" 
            name="qty">
            <span class="invalidFeedback">
                <?php echo $data['qtyError']; ?>
            </span>
            
            <button 
            id="submit"
            type="submit" 
            value="submit"
            class="btn btn-dark">Creade</button>
        </form>
    </div>
</div>        

<?php 
   require APPROOT . '/views/elements/footer.php';
?>