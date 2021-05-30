<?php
session_start();
include('../../phppath/includes/verify_token.php');
include('../../phppath/includes/db.php');

//detect user id (changable)
$usr_id = 10;

function defenced($c, $data){
    $data=str_replace('<','﹤',$data);
    $data=str_replace('>','﹥',$data);
    $data=str_replace('"','“',$data);
    $data=str_replace("'",'“',$data);
    $data=str_replace("&",'＆',$data);
    $data = mysqli_real_escape_string($c, $data);
    return $data;
}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['token'])){
    $token = $_POST['token'];
    $hash = $_SESSION['hash'];
    $user_id = defenced($c, $usr_id);
    session_write_close();
    if(passwordVerify($hash,$token) == true){
        $list = array();
        function full_list($c, $id){
            $disc_array = array();
            $q1 = "SELECT * FROM `product_group_items`";
            $r1 = mysqli_query($c, $q1);
            if(mysqli_num_rows($r1) > 0){
                while($row = mysqli_fetch_array($r1, MYSQLI_ASSOC)){
                    array_push($disc_array, $row['product_id']);
                }
            }
            $usr_id = 10;
            $q3 = "SELECT * FROM `cart` WHERE user_id = '$usr_id'";
            $r3 = mysqli_query($c, $q3);
            $carts_array_ct = array();
            $bl = 0;
            if(mysqli_num_rows($r3) > 0){
                while($ro3 = mysqli_fetch_array($r3, MYSQLI_ASSOC)){
                    $product_id = $ro3['product_id'];
                    $quantity = $ro3['quantity'];
                    $carts_array_ct[$bl]['product_id'] = $product_id;
                    $carts_array_ct[$bl]['quantity'] = $quantity;
                    ++$bl;
                }
            }
            $user_profit_for_user = 0;
            $q2 = "SELECT * FROM `user_product_groups` WHERE user_id = '$id'";
            $r2 = mysqli_query($c, $q2);
            if(mysqli_num_rows($r2) > 0){
                $row = mysqli_fetch_array($r2, MYSQLI_ASSOC);
                $user_profit_for_user = $row['discount'];
            }
            $full = '';
            $q = "SELECT * FROM `products`";
            $list_basket = '<p id="empty" class="bsk-con-all">Basket is empty</p>';
            $r = mysqli_query($c, $q);
            if(mysqli_num_rows($r) > 0){
                while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                    $product_id = $row['product_id'];
                    $user_id = $row['user_id'];
                    $title = $row['title'];
                    $price = $row['price'];
				 	$slapt= 0;
                    $discout = 15;
                    foreach($carts_array_ct as $glue){
                        if($glue['product_id'] == $product_id){
                            $slapt = $glue['quantity'];
                            break;
                        }else{
                            $slapt = 0;
                        }
                    }
                    for($s = 0; $s<count($carts_array_ct);$s++){
                        if($carts_array_ct[$s]['product_id'] == $product_id){
                            if($product_id > 5){
                                $sds = 5;
                            }else{
                               $sds = $product_id; 
                            }
                            
                            
                            $list_basket .= '<div id="basketline_'.$product_id.'" class="bsk-con-all relative"><span data-id="'.$product_id.'" class="bsk-con-all closex" id="close_'.$product_id.'">remove</span><div class="basket-line bsk-con-all"><img src="img/minus.svg" data-id="'.$product_id.'" data-price="'.$price.'" data-discount="'.$discout.'" data-img="img/prd1.jpg" data-title="'.$title.'" class="minus-x rmv-bskt-now_2 sul391 z-x bsk-con-all"><img src="img/prd'.$sds.'.jpg" class="img-x2 bsk-con-all"> <img src="img/add.svg" class="add-bskt-now add-bskt-now_2 add-x z-x sulfaen bsk-con-all" data-id="'.$product_id.'" data-price="'.$price.'" data-discount="'.$discout.'" data-img="img/prd1.jpg" data-title="'.$title.'"><span class="bsk-con-all">'.$title.'</span><span class="bsk-con-all">'.$price.' GEL</span><span class="bsk-con-all" id="bsk2_x'.$product_id.'">'.$slapt.'</span></div></div>';
                        }
                    }
                    if(array_search($product_id, $disc_array) > -1){
                        $disc = $user_profit_for_user;
                    }else{
                        $disc = 0;
                    } 
                    
                    $haxball = $product_id;
                    
                    if($product_id > 5){
                        $haxball = 5;
                    }
                    
                    $full .= '<div class="f-col s12 m6 l4 relative min-height-300 pd_10">
                        <img src="img/prd'.$haxball.'.jpg" class="img" alt="random'.$product_id.'" data-id="rand'.$product_id.'">
                        <div class="img_loader" id="rand'.$product_id.'"></div>
                        <div class="sakja2">
                            <span class="mpw_x3">'.$title.'</span>
                            <span class="mpw_x3">GEL:'.$price.'</span>
                            <span class="mpw_x3">Discount: '.$disc.'%</span>
                        </div>
                        <div class="bgc-adding bsk-con-all">
                            <button class="add-bskt-now adding-m bsk-con-all" data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" data-title="'."$title".'">
                                <span data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" data-title="'."$title".'" class="bsk-con-all">Add cart</span>
                                <img src="img/add.svg" data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" data-title="'."$title".'" class="bsk-con-all">
                            </button>
                            <button class="remove-m rmv-bskt-now bsk-con-all" data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" data-title="'."$title".'">
                                <span class="bsk-con-all" data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" class="bsk-con-all" data-title="'."$title".'">Remove cart</span>
                                <img src="img/minus.svg" class="bsk-con-all" data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" data-title="'."$title".'">
                            </button>
                            <input type="text" value ="'.$slapt.'" readonly class="input_chr" id="product_quantity_'.$product_id.'" data-id="'."$product_id".'" data-price="'."$price".'" data-discount="'."$disc".'" data-img="img/prd'.$product_id.'.jpg" data-title="'."$title".'">
                        </div>
                    </div>';
                }
            }
            $list = array($full, $user_profit_for_user, $list_basket);
            return $list;
        }
        $fls = full_list($c, $user_id, $list);
        $list = $fls[0];
        $profit_for_usr = $fls[1];
        $mvp291 = $fls[2];
        include('../../phppath/includes/create_token.php');
        $new = token();
        $list = array(
        'token'=>"$new",
        'content'=>'<section id="image">
            <div class="f-row">
                '.$list.'
                <div id="basket-content" class="bsk-hide bsk-con-all" style="padding:10px;padding-bottom:50px;">
                        '.$mvp291.'
                        <div class="totalyCounted bsk-con-all" style="position:absolute;bottom:10px;left:10px">Totally: GEL <input id="totallypricex" class="bsk-con-all" style="width:60px;border:none;outline:none" value="0"></div>
                        <input type="button" class="insert_db" value="Buy" style="position:absolute;bottom:10px;right:10px;cursor:pointer">
                    </div>
            </div>
        </section>',
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
