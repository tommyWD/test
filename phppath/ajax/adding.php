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
    $token = $_POST['token'];
    $hash = $_SESSION['hash'];
    $user_id = defenced($c, 10);
    $type = defenced($c, $_POST['type']);
    session_write_close();
    if(passwordVerify($hash,$token) == true){
        
        function everything($c, $type){
            $checkarray = array();
            $checkq = "SELECT * FROM `products`";
            $checkr = mysqli_query($c, $checkq);
            $bro = 0;
            if(mysqli_num_rows($checkr) > 0){
                while($row = mysqli_fetch_array($checkr, MYSQLI_ASSOC)){
                    $check_title = $row['product_id'];
                    $checkarray[$bro] = $check_title;
                    ++$bro;
                }
            }
            
            
            $mvp = 'false';
            if($type == 'add_profit'){
                $add_profit = defenced($c, $_POST['add_profit']);
                if(in_array($add_profit, $checkarray)){
                    $cc_q = "SELECT * FROM `product_group_items` WHERE product_id = '$add_profit'";
                    $rr_q = mysqli_query($c, $cc_q);
                    if(mysqli_num_rows($rr_q) > 0){
                        $insq = "UPDATE `product_group_items` SET `group_id` = '1' WHERE `product_group_items`.`product_id` = '$add_profit'";
                        if(mysqli_query($c, $insq)){
                            $mvp = 'true';
                        }
                    }else{
                        $upq = "INSERT INTO `product_group_items` (`item_id`, `group_id`, `product_id`) VALUES (NULL, '1', '$add_profit')";
                        if(mysqli_query($c, $upq)){
                            $mvp = 'true';
                        }
                    }
                }
            }
            
            
            if($type == 'del_group'){
                $del_group = defenced($c, $_POST['del_group']);
                if(in_array($del_group, $checkarray)){
                    $cc_q = "SELECT * FROM `product_group_items` WHERE product_id = '$del_group'";
                    $rr_q = mysqli_query($c, $cc_q);
                    if(mysqli_num_rows($rr_q) > 0){
                        $delq = "DELETE FROM `product_group_items` WHERE `product_group_items`.`product_id` = '$del_group'";
                        if(mysqli_query($c, $delq)){
                            $mvp = 'true';
                        }
                    }else{
                        $mvp = 'false';
                    }
                }
            }
            
            if($type == 'cng_usr_prft'){
                $cng_usr_prft = defenced($c, $_POST['cng_usr_prft']);
                $usr_profit = defenced($c, $_POST['usr_profit']);

                $cc_q = "SELECT * FROM `user_product_groups` WHERE user_id = '$cng_usr_prft'";
                $rr_q = mysqli_query($c, $cc_q);
                if($usr_profit > 0 && $usr_profit < 101){
                    if(mysqli_num_rows($rr_q) > 0){
                        $edq = "UPDATE `user_product_groups` SET `discount` = '$usr_profit' WHERE `user_product_groups`.`user_id` = '$cng_usr_prft'";
                        if(mysqli_query($c, $edq)){
                            $mvp = 'true';
                        }
                    }else{
                        $mvp = 'false';
                    }
                }else{
                    $mvp = 'false';
                }
            }
            
            if($type == 'addns'){
                $a_title = defenced($c, $_POST['a_title']);
                $a_price = defenced($c, $_POST['a_price']);
                if(is_numeric($a_price)){
                    $insq = "INSERT INTO `products` (`product_id`, `user_id`, `title`, `price`) VALUES (NULL, '10', '$a_title', '$a_price')";
                    if(mysqli_query($c, $insq)){
                        $mvp = 'true';
                    }else{
                        $mvp = 'false';
                    }
                }else{
                    $mvp = 'false';
                }
                
            }
            
            return $a_title; 
        }
        
        $res = everything($c, $type);
//        print_r($res);
        $result = '1';
        
        
        $list = array(
        'content'=>"$res",
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
