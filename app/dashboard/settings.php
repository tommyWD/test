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
        
        function full_list($c, $id){
            $group_list = array();
            $q1 = "SELECT * FROM `product_group_items`";
            $r1 = mysqli_query($c, $q1);
            $bro = 0;
            if(mysqli_num_rows($r1) > 0){
                while($row = mysqli_fetch_array($r1, MYSQLI_ASSOC)){
                    $group_product_id = $row['product_id'];
                    $group_list[$bro] = $group_product_id;
                    ++$bro;
                }
            }
            
            $user_lists = '';
            $usrs = '';
            $user_q = "SELECT * FROM `user_product_groups` WHERE user_id = '$id'";
            $user_r = mysqli_query($c, $user_q);
            if(mysqli_num_rows($user_r) > 0){
                $user_row = mysqli_fetch_array($user_r, MYSQLI_ASSOC);
                $user_discount = $user_row['discount'];
                $user_lists = '<tr>
                          <td>'.$id.'</td>
                          <td><input type="text" class="usr'.$id.'" value="'.$user_discount.'" style="width:50px"></td>
                          <td><input type="button" value="change" class="chng_usr_prf" data-id="'.$id.'"></td>
                         </tr>';
                
                $usrs .= '<option>'.$id.'</option>';
                
            }
            
            $full = '';
            $q = "SELECT * FROM `products`";
            $list_basket = '';
            $opshens ='';
            $opens ='';
            $r = mysqli_query($c, $q);
            if(mysqli_num_rows($r) > 0){
                while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                    $product_id = $row['product_id'];
                    $user_id = $row['user_id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    
                    if (in_array($product_id, $group_list)){
                          $opens .= '<tr>
                          <td>'.$title.'</td>
                          <td class="del_group" data-id="'."$product_id".'" style="cursor:pointer">x</td>
                         </tr>';
                    }else{
                        $opshens .= '<option value="'.$product_id.'">'.$title.'</option>';
                    }
                }
            }
            $list = array($opens, $opshens, $user_lists,$usrs);
            return $list;
        }
        $group_list = full_list($c, $usr_id);
        $opens = $group_list[0];
        $opshens = $group_list[1];
        $usr_lst = $group_list[2];
        $usrs = $group_list[3];
        $content = '
        <div class="f-row">

            <div class="f-col s12 m4 l3">
            <b><p>ფასდაკლების დამატება პროდუქტზე</p></b>
            
                <form method="posts">
                <select class="add_profit">
                    '.$opshens.'
                </select>
                <input type="button" value="დამატება" class="html">
            </form>
                <div style="overflow-x:auto;">
                <table>
                  <tr>
                  <th>product name</th>
                  <th>Delete</th>
                 </tr>
                 
                 '.$opens.'
                 
                </table>
                </div> 
            </div>
            
            
            <div class="f-col s12 m4 l3">
            <b><p>ფასდაკლების შეცვლა იუზერზე</p></b>
                <div style="overflow-x:auto;">
                <table>
                  <tr>
                  
                      <th>user</th>
                      <th>% 1 - 100</th>
                      <th>change</th>
                  
                  
                 </tr>
                 <form method="post">
                 '.$usr_lst.'
                 </form>
                </table>
                </div> 
            </div>
            
            <div class="f-col s12 m4 l3">
            <b><p>პროდუქტის დამატება</p></b>
                <div style="overflow-x:auto;">
                <table>
                  <tr>

                      <th>title</th>
                      <th>price</th>
                      <th>add</th>
                 </tr>
                 <form method="post">
                 <tr>

                  <td><input type="text" id="a_title" value="" style="width:50px" placeholder="title"></td>
                  <td><input type="text" id="a_price" value="" style="width:50px" placeholder="price"></td>
                  <td><input type="submit"  value="damateba" class="addns" style="cursor:pointer"></td>
                 </tr>
                 </form>
                </table>
                </div> 
            </div>
            
        </div>';
        
        include('../../phppath/includes/create_token.php');
        $new = token();
        $list = array(
        'token'=>"$new",
        'content'=>'<section id="image">
        <div class="f-row">
            '.$content.'  
            <div id="basket-content" class="bsk-hide bsk-con-all" style="padding:10px;padding-bottom:50px;">
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
