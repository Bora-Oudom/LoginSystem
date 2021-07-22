<?php if (isLoggedIn()): ?>
<?php
   require APPROOT . '/views/elements/head.php';
?>

   <div class="navbar dark" >
      <?php 
      require APPROOT . '/views/elements/navigation.php';
      ?>
   </div>  
   <div class="container"> 
         <h2>Product List</h2> 
            <table class="table table-striped">
               <thead>
                  <tr >
                     <th scope="col">Product ID</th>
                     <th scope="col">Product Name</th>
                     <th scope="col">Product Price</th>
                     <th scope="col">Product Quantity</th>
                     <th scope="col">Actions</th>
                  </tr>
               <tbody>
               </thead>
               <?php 
               foreach ($data['pros'] as $pro){
               ?>
               <tr>
                  <td><?php echo $pro->pro_id; ?></td>
                  <td><?php echo $pro->name; ?></td>
                  <td><?php echo $pro->price; ?></td>
                  <td><?php echo $pro->qty; ?></td>
                  <td>
                     <a class="btn btn-danger" href="<?php echo URLROOT ."/cruds/delete/" . $pro->pro_id ?>">Delete</a>
                     <a class="btn btn-success" href="<?php echo URLROOT ."/cruds/update/" . $pro->pro_id ?>">Update</a>
                  </td>
               </tr>   
         
               <?php
               }
               ?>
            </table>
         <a class="btn btn-primary" href="<?php echo URLROOT; ?>/cruds/creade">Creade</a>
      
      

         <?php else: ?>
            <div class="wrapper-landing">
            <h1>Sorry, you can't view this.</h1>
            </div>
         <?php endif; ?> 
   </div>

<?php 
   require APPROOT . '/views/elements/footer.php';
?>
   