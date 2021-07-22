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
        <h2>Update Product</h2> 
        <form 
        action="<?php echo URLROOT; ?>/cruds/update/<?php echo $data['pro']->pro_id?>" 
        method ="POST">
        
            <h3>New Product Name</h3>
            <input 
            type="text" 
            value="<?php echo $data['pro']->name; ?>"  
            placeholder="New Product Name" 
            name="name">
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>

            <h3>New Product Price</h3>
            <input 
            type="text" 
            value="<?php echo $data['pro']->price; ?>" 
            placeholder="New Product Price" 
            name="price">
            <span class="invalidFeedback">
                <?php echo $data['priceError']; ?>
            </span>

            <h3>New Product Quantity</h3>
            <input 
            type="text" 
            value="<?php echo $data['pro']->qty; ?>" 
            placeholder="New Product Quantity" 
            name="qty">
            <span class="invalidFeedback">
                <?php echo $data['qtyError']; ?>
            </span>
            
            <button 
            id="submit" 
            type="submit"
            value="delete"
            class="btn btn-dark">Update</button>
        </form>
    
    </div>
    
</div>
   
<?php 
   require APPROOT . '/views/elements/footer.php';
?>