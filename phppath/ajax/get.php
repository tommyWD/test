<?php
session_start();
include('../../phppath/includes/verify_token.php');
include('../../phppath/includes/db.php');
function defenced($c, $data){
    $data=str_replace('<','﹤',$data);
    $data=str_replace('>','﹥',$data);
    $data=str_replace('"','“',$data);
    $data=str_replace("'",'“',$data);
    $data=str_replace("&",'＆',$data);
    $data = mysqli_real_escape_string($c, $data);
    return $data;
}
$user_id = 10;


if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['token'])){
    $result = 'none';
    $token = $_GET['token'];
    $hash = $_SESSION['hash'];
    $user_id = defenced($c, 10);
    session_write_close();
    if(passwordVerify($hash,$token) == true){
        
        
        function last_task($c, $user_id){
            $list_array = array();
            $user_q = "SELECT * FROM `user_product_groups` WHERE user_id = '$user_id'";
            $user_r = mysqli_query($c, $user_q);
            if(mysqli_num_rows($user_r) > 0){
                $user_row = mysqli_fetch_array($user_r, MYSQLI_ASSOC);
                $user_discount = $user_row['discount'];
            }
            
            
            $product_group_items_cart = "SELECT * FROM `product_group_items`";
            $product_group_items_run = mysqli_query($c, $product_group_items_cart);
            if(mysqli_num_rows($product_group_items_run) > 0){
                $a=0;
                while($product_group_items_row = mysqli_fetch_array($product_group_items_run, MYSQLI_ASSOC)){	
                    $discount_product_id = $product_group_items_row['product_id'];
                    $list_array['discount_product_id'][$a] = $discount_product_id;
                    ++$a;   
                }
            }
            
            $check_cart = "SELECT * FROM `cart`";
            $check_run = mysqli_query($c, $check_cart);
            if(mysqli_num_rows($check_run) > 0){
                $b=0;
                while($check_row = mysqli_fetch_array($check_run, MYSQLI_ASSOC)){	
                    $cart_user_id = $check_row['user_id'];
                    $cart_product_id = $check_row['product_id'];
                    $cart_quantity = $check_row['quantity'];
                    $prd = "SELECT * FROM `products` WHERE product_id = '$cart_product_id'";
                    if(mysqli_num_rows(mysqli_query($c, $prd))> 0){
                        $prd_row = mysqli_fetch_array(mysqli_query($c, $prd), MYSQLI_ASSOC);
                        $title = $prd_row['title'];
                        $user_id = $prd_row['user_id'];
                        $price = $prd_row['price'];
                        
                        $list_array['sold'][$b]['product_id'] = $cart_product_id;			 	
                        $list_array['sold'][$b]['quantity'] = $cart_quantity;			 	
                        $list_array['sold'][$b]['title'] = $title;			 	
                        $list_array['sold'][$b]['price'] = $price;			 	
                        $list_array['sold'][$b]['user_id'] = $user_id;
                        
                        
                        $count_x = count($list_array['discount_product_id']);
                        for($i=0;$i <$count_x; $i++){
                            if($list_array['discount_product_id'][$i] == $cart_product_id){
                                $list_array['discount_incart'][$b] = $cart_product_id;
                                $list_array['minimal_disc'][] = $cart_quantity;
                                $list_array['discount_product_prices'][] = $price;
                                $list_array['user_discount'][] = $user_discount;
                            }
                        }
                        
                        ++$b;
                    }
                }
            }
            return $list_array;
        }
        
        $result = last_task($c, $user_id);
        
        
        function lastCounter($result){
            
            if(isset($result['discount_product_id']) && isset($result['discount_incart'])){
                if(count($result['discount_product_id']) == count($result['discount_incart'])){
                    $discount = 'yes';
                }else{
                    $discount = 'none';
                }
            }else{
                $discount = 'none';
            }
            
            
            if(isset($result['minimal_disc'])){
                $discount_minimal = min($result['minimal_disc']); //discount min array
            }
            
            $totallyPrice = 0;
            $big = 0;
            $list_fast_array = array();
            foreach($result['sold'] as $values){
                $product_id = $values['product_id'];
                $quantity = $values['quantity'];
                $title = $values['title'];
                $price = $values['price'];
                $user_id = $values['user_id'];
                
                
                $list_fast_array['products'][$big]['product_id'] = $product_id;
                $list_fast_array['products'][$big]['quantity'] = $quantity;
                $list_fast_array['products'][$big]['price'] = $price;
                ++$big;
                $totallyPrice = $totallyPrice + (floatval($price) * floatval($quantity));
            }
            $disc_m = 0;
            if($discount == 'yes'){
                for($i =0; $i < count($result['discount_product_prices']); $i++){
                    $disc_m = ((floatval($result['discount_product_prices'][$i]) * floatval($discount_minimal) * floatval($result['user_discount'][0])) / 100) + $disc_m;
                }
            }else{
                $disc_m = 0;
            }

            $list_fast_array['discount'][0] = $disc_m;
            
            $totallyPrice = floatval($totallyPrice) - floatval($disc_m);
            
            return $list_fast_array;
        }
              
        $last_result = lastCounter($result);
        $lst = json_encode($last_result);
        
        $list = array(
        'content'=>"$lst",
        'result'=>true
        );
    }else{
        $list = array(
            'result'=>'2'
        );
    }
}else{
    $list = array(
        'result'=>'1'
    );
}
mysqli_close($c);
echo json_encode($list);
?>
