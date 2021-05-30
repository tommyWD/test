<?php
function defenced($c, $data){
    $data=str_replace('<','&lt;',$data);
    $data=str_replace('>','&gt;',$data);
    $data=str_replace('"','&quot;',$data);
    $data=str_replace("'",'&#39;',$data);
    $data=str_replace("&",'&amp;',$data);
    $data=trim($data);
    $data = mysqli_real_escape_string($c, $data);
    return $data;
}
?>