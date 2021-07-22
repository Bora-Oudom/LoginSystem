<?php 
    class Cruds extends Controller{
        public function __construct() {
            $this->crudModel = $this->model('Crud');
        }


        public function index()
        {
            $pros = $this->crudModel->readAllProduct();
            $data = [
                'pros'=> $pros
            ];
            $this->view('cruds/index', $data);
        }

        public function creade()
        {
            $data = [
                'name' => '',
                'price' => '',
                'qty' => '',
                'nameError' => '',
                'priceError' => '',
                'qtyError' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                
                $data = [
                    'name' => trim($_POST['name']),
                    'price' => trim($_POST['price']),
                    'qty' => trim($_POST['qty']),
                    'nameError' => '',
                    'priceError' => '',
                    'qtyError' => ''
                ];

                //allow only character from A-Z and 0-9
                $nameValidation = "/^[a-zA-Z0-9]*$/";

                $priceValidation = "/^(0|[1-9]\d*)(\.\d{2})?$/";

                //validate name
                if(empty($data['name'])){
                    $data['nameError'] = 'Please enter the product name.';
                }elseif(!preg_match($nameValidation, $data['name'])){
                    $data['nameError'] = 'Name must be latters or number.';
                }

                //validate price
                if(empty($data['price'])){
                    $data['priceError'] = 'Please enter the product price.';
                }elseif (!preg_match($priceValidation, $data['price'])) {
                    $data['priceError'] = 'Price must be number.';
                }
                
                //validate Quantity
                if(empty($data['qty'])){
                    $data['qtyError'] = 'Please enter the amount of the product.';
                }

                //make sure all errors are emty
                if(empty($data['nameError']) && empty($data['priceError']) && 
                    empty($data['qtyError'])){

                        //Insert all the data from model function 
                        if($this->crudModel->creadeProduct($data)){
                            header('location:' . URLROOT . '/cruds/index');
                        }else{
                            die('Something went wrong');
                        }
                    }
            }
            $this->view('cruds/creade', $data);
        }

        
        public function update($id)
        {

            $pro = $this->crudModel->readSingleProduct($id);
            
            $data = [
                'id' => $id,
                'pro' => $pro,
                'name' => '',
                'price' => '',
                'qty' => '',
                'nameError' => '',
                'priceError' => '',
                'qtyError' => ''
            ];
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                 
                //sanitize Post data
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                
                $data = [
                    'id' => $id,
                    'pro' => $pro,
                    'name' => trim($_POST['name']),
                    'price' => trim($_POST['price']),
                    'qty' => trim($_POST['qty']),
                    'nameError' => '',
                    'priceError' => '',
                    'qtyError' => ''
                    
                ];
                //allow only character from A-Z and 0-9
                $nameValidation = "/^[a-zA-Z0-9]*$/";

                $priceValidation = "/^(0|[1-9]\d*)(\.\d{2})?$/";

                //validate name
                if(empty($data['name'])){
                    $data['nameError'] = 'Please enter the new product name.';
                }elseif(!preg_match($nameValidation, $data['name'])){
                    $data['nameError'] = 'Name must be latters or number.';
                }

                //validate price
                if(empty($data['price'])){
                    $data['priceError'] = 'Please enter the new product price.';
                }elseif (!preg_match($priceValidation, $data['price'])) {
                    $data['priceError'] = 'Price must be number.';
                }
                
                //validate Quantity
                if(empty($data['qty'])){
                    $data['qtyError'] = 'Please enter the new amount of the product.';
                }

                //make sure all errors are emty
                if(empty($data['nameError']) && empty($data['priceError']) && 
                    empty($data['qtyError'])){   
                         
                     $this->crudModel->updateProduct($data);
                    
                     header('location:' . URLROOT . '/cruds/index');
                     
                    
                }else{
                    $this->view('cruds/update', $data);
                }
            }
             $this->view('cruds/update', $data);
         }
            

        public function delete($id)
        {
            $pro = $this->crudModel->readSingleProduct($id);
            var_dump($pro);
            $data = [
                'id' => $id
            ];
            $this->crudModel->deleteProduct($data);
                header('location:' . URLROOT . '/cruds/index');
                
            
        }
    }
