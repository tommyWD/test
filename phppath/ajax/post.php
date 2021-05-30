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
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['token'])){
    $result = 'none';
    function insert_basket($c, $id, $user_id){
        $checkq = "SELECT * FROM `cart` WHERE product_id = '$id'";
        $checkr = mysqli_query($c, $checkq);
        if(mysqli_num_rows($checkr) > 0){
            $checkrow = mysqli_fetch_array($checkr, MYSQLI_ASSOC);
            $checkquantity = $checkrow['quantity'];
            ++$checkquantity;
            $editq = "UPDATE `cart` SET `quantity` = '$checkquantity' WHERE `cart`.`product_id` = '$id'";
            if(mysqli_query($c, $editq)){
                $result = 'increase in basket one item';
            }
        }else {
            $insq = "INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES (NULL, '$user_id', '$id', '1')";
            if(mysqli_query($c, $insq)){
                $result = 'insert in basket one item';
            }
        }
        return $result;
    }
    function remove_basket($c, $id, $user_id){
        $checkq = "SELECT * FROM `cart` WHERE product_id = '$id'";
        $checkr = mysqli_query($c, $checkq);
        if(mysqli_num_rows($checkr) > 0){
            $checkrow = mysqli_fetch_array($checkr, MYSQLI_ASSOC);
            $checkquantity = $checkrow['quantity'];
            --$checkquantity;
            
            if($checkquantity == 0){
                $del_q = "DELETE FROM `cart` WHERE `cart`.`product_id` = '$id'";
                if(mysqli_query($c, $del_q)){
                    $result = 'remove item basket';   
                }
            }else{
                $editq = "UPDATE `cart` SET `quantity` = '$checkquantity' WHERE `cart`.`product_id` = '$id'";
                if(mysqli_query($c, $editq)){
                    $result = 'decrease in basket one item';
                }
            }
        }else {
            $result = 'error in basket one item remover';
        }
        return $result;
    }
    function remove_basket_all($c, $id, $user_id){
        $checkq = "SELECT * FROM `cart` WHERE product_id = '$id'";
        $checkr = mysqli_query($c, $checkq);
        if(mysqli_num_rows($checkr) > 0){
            $checkrow = mysqli_fetch_array($checkr, MYSQLI_ASSOC);
            $checkquantity = $checkrow['quantity'];
            
            if($checkquantity > 0){
                $del_q = "DELETE FROM `cart` WHERE `cart`.`product_id` = '$id'";
                if(mysqli_query($c, $del_q)){
                    $result = 'remove item basket';   
                }
            }else{
                $result = 'error in basket one item remover 2';
            }
        }else {
            $result = 'error in basket one item remover';
        }
        return $result;
    }
    $token = $_POST['token'];
    $hash = $_SESSION['hash'];
    $user_id = defenced($c, 10);
    $type = defenced($c, $_POST['type']);
    session_write_close();
    if(passwordVerify($hash,$token) == true){
        if($type == 'add'){
            $addProductInCart = defenced($c, $_POST['addProductInCart']);
            $result = insert_basket($c, $addProductInCart, $user_id);
        }else if($type == 'set'){
            $setCartProductQuantity = defenced($c, $_POST['setCartProductQuantity']);
            $result = remove_basket($c, $setCartProductQuantity, $user_id);   
        }else if($type == 'remove'){
            $removeProductFromCart = defenced($c, $_POST['removeProductFromCart']);
            $result = remove_basket_all($c, $removeProductFromCart, $user_id);   
        }
        $list = array(
        'content'=>"$result",
        'result'=>true
        );
    }else{
        $list = array(
            'result'=>false
        );
    }
}else{
    $list = array(
        'result'=>false
    );
}
mysqli_close($c);
echo json_encode($list);
?>
