<?php
include('phppath/includes/create_token.php');
$token = token();
$user_id = '10';
$time = time();
?>
<!DOCTYPE html>
<html lang="en" id="html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    
    <!--seo-->
    <meta name="description" content="something"/>
    <meta name="robots" content="noindex"/>
    <meta name="googlebot" content="noindex"/>
    
    <meta name="description" content="{{description}}"/>
    <meta name="keywords" content="{{keywords}}"/>
    <link rel="author" href="https://plus.google.com/{{googlePlusId}}" />
    <link rel="canonical" href="{{pageUrl}}" />
    
    <meta itemprop="name" content="{{pageTitle}}">
    <meta itemprop="description" content="{{description}}">
    <meta itemprop="image" content="{{imageUrl}}">
    
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="TITLE OF YOUR POST OR PAGE"/>
    <meta property="og:description" content="DESCRIPTION OF PAGE CONTENT"/>
    <meta property="og:image" content="LINK TO THE IMAGE FILE"/>
    <meta property="og:url" content="PERMALINK"/>
    <meta property="og:site_name" content="SITE NAME"/> 
    <!--end seo-->
    
    <title>test</title>
    <style>
    .basket-line{height:50px;position:relative;width:100%;padding-left:20px;padding-top:4px;border-bottom:1px solid #000}.minus-x{left:-5px;width:20px;height:auto}.add-x{right:5px}.relative{position:relative}tr:nth-child(even){background-color:#f2f2f2}.closex{position:absolute;top:32px;cursor:pointer!important;z-index:1234;font-size:11px;color:#fff;background:red;padding:0 3px;right:6px}.img-x2{position:absolute;width:40px;height:40px}#response{min-width:200px;background:#3eb595;position:fixed;bottom:30px;right:30px;padding:10px}#response span{color:#fff;float:right;font-size:20px;position:relative;top:-10px;cursor:pointer}#response pre{color:#fff}.z-x{width:20px;height:auto;position:absolute;top:11px;cursor:pointer;padding:5px}.basket-line span{display:block;width:85%;padding-left:51px;font-size:11px;position:relative;top:-5px;line-height:1}.basket-line input{width:50px;position:absolute;right:10px;top:5px;text-align:center;background:gray;color:#fff;border:1px solid #000;font-size:12px}.z-x:hover{background:gray!important;color:red;z-index:1234}.topnav{background-color:#333;overflow:hidden}#basket-content{position:absolute;width:250px;min-height:300px;background:#fff;right:0;border:1px solid #000;top:54px;z-index:123}.pd_10{padding:10px}.bgc-adding{position:absolute;left:10px;top:10px;z-index:12312421;height:calc(((100vw - 60px)/ 3)/ 2);background:gray;width:70px}.bgc-adding button span{display:block;width:100%;font-size:11px;line-height:1}.bgc-adding input{width:50px;position:relative;left:10px;top:5px;text-align:center;background:gray;color:#fff;border:1px solid #000;font-size:12px}.bgc-adding button{max-width:60px;padding:0;margin:0;margin-left:5px;margin-top:5px;cursor:pointer}.bgc-adding button img{position:relative;top:-5px;width:10px}.bsk-hide{display:none}.topnav a{float:left;color:#f2f2f2;text-align:center;padding:14px 16px;text-decoration:none;font-size:17px;cursor:pointer}.topnav a:hover{background-color:#ddd;color:#000}.bskcounterx{position:absolute;margin-left:8px;margin-top:-13px;border-radius:50%;background:red;width:20px;height:20px;font-size:11px}.topnav a.active{background-color:#4caf50;color:#fff}#loader{z-index:100}#loader_line{z-index:101}.loader_line{z-index:101}.loader_line{width:0%;background:red;position:fixed;top:0;height:3px;transition:all .3s;z-index:1}.img_loader{animation:img_loader 2s infinite;top:0;left:0;bottom:0;right:0;position:absolute}@keyframes img_loader{0%{background-color:#bfbfbf}25%{background-color:#a6a6a6}50%{background-color:#bfbfbf}75%{background-color:#a6a6a6}100%{background-color:#bfbfbf}}#loader{position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,.8)}.absolute-center{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%)}.lds-ellipsis{display:inline-block;position:relative;width:80px;height:80px}.lds-ellipsis div{position:absolute;top:33px;width:13px;height:13px;border-radius:50%;background:#fff;animation-timing-function:cubic-bezier(0,1,1,0)}.lds-ellipsis div:nth-child(1){left:8px;animation:lds-ellipsis1 .6s infinite}.lds-ellipsis div:nth-child(2){left:8px;animation:lds-ellipsis2 .6s infinite}.lds-ellipsis div:nth-child(3){left:32px;animation:lds-ellipsis2 .6s infinite}
    .lds-ellipsis div:nth-child(4){left:56px;animation:lds-ellipsis3 .6s infinite}@keyframes lds-ellipsis1{0%{transform:scale(0)}100%{transform:scale(1)}}@keyframes lds-ellipsis3{0%{transform:scale(1)}100%{transform:scale(0)}}@keyframes lds-ellipsis2{0%{transform:translate(0,0)}100%{transform:translate(24px,0)}}.mpw_x3{width:100%;display:block;font-size:11px}.sakja2{position:absolute;right:20px;top:12px;background:#fff;padding:12px}.img_loader{left:10px;top:10px;width:calc((100vw - 60px)/ 3);height:calc(((100vw - 60px)/ 3)/ 2);z-index:1232141412}@media (max-width:992px){.img_loader{width:calc((100vw - 40px)/ 2);height:calc(((100vw - 40px)/ 2)/ 2)}.bgc-adding{height:calc(((100vw - 40px)/ 2)/ 2)}}@media (max-width:600px){.img_loader{width:calc((100vw - 20px));height:calc(((100vw - 20px))/ 2)}.img_loader{width:calc(100vw - 20px);height:calc((100vw - 20px)/ 2)}.bgc-adding{height:calc((100vw - 20px)/ 2)}}html{box-sizing:border-box}*,:after,:before{box-sizing:inherit}html{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block}progress{vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent;-webkit-text-decoration-skip:objects}a:active,a:hover{outline-width:0}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}dfn{font-style:italic}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}figure{margin:1em 40px}img{border-style:none}svg:not(:root){overflow:hidden}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}hr{box-sizing:content-box;height:0;overflow:visible}button,input,select,textarea{font:inherit;margin:0}optgroup{font-weight:700}button,input{overflow:visible}button,select{text-transform:none}[type=reset],[type=submit],button,html [type=button]{-webkit-appearance:button}[type=button]::-moz-focus-inner,[type=reset]::-moz-focus-inner,[type=submit]::-moz-focus-inner,button::-moz-focus-inner{border-style:none;padding:0}[type=button]:-moz-focusring,[type=reset]:-moz-focusring,[type=submit]:-moz-focusring,button:-moz-focusring{outline:1px dotted ButtonText}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}legend{color:inherit;display:table;max-width:100%;padding:0;white-space:normal}textarea{overflow:auto}[type=checkbox],[type=radio]{padding:0}[type=number]::-webkit-inner-spin-button,[type=number]::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}[type=search]::-webkit-search-cancel-button,[type=search]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-input-placeholder{color:inherit;opacity:.54}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}body,html{font-family:Verdana,sans-serif;font-size:15px;line-height:1.5}
    html{overflow-x:hidden}h1{font-size:36px}h2{font-size:30px}h3{font-size:24px}h4{font-size:20px}h5{font-size:18px}h6{font-size:16px}.f-serif{font-family:serif}h1,h2,h3,h4,h5,h6{font-family:"Segoe UI",Arial,sans-serif;font-weight:400;margin:10px 0}.f-wide{letter-spacing:4px}hr{border:0;border-top:1px solid #eee;margin:20px 0}.image{max-width:100%;height:auto}img{margin-bottom:-5px}a{color:inherit}.f-container:after,.f-container:before,.f-row:after,.f-row:before{content:"";display:table;clear:both}.f-col{float:left;width:100%}.f-col.s1{width:8.33333%}.f-col.s2{width:16.66666%}.f-col.s3{width:24.99999%}.f-col.s4{width:33.33333%}.f-col.s5{width:41.66666%}.f-col.s6{width:49.99999%}.f-col.s7{width:58.33333%}.f-col.s8{width:66.66666%}.f-col.s9{width:74.99999%}.f-col.s10{width:83.33333%}.f-col.s11{width:91.66666%}.f-col.s12{width:99.99999%}.none{display:none!important}.block{display:block!important}.img{width:100%;opacity:1}.relative{position:relative}.absolute{position:absolute}@media (min-width:601px){.f-col.m1{width:8.33333%}.f-col.m2{width:16.66666%}.f-col.m3,.f-quarter{width:24.99999%}.f-col.m4,.f-third{width:33.33333%}.f-col.m5{width:41.66666%}.f-col.m6,.f-half{width:49.99999%}.f-col.m7{width:58.33333%}.f-col.m8,.f-twothird{width:66.66666%}.f-col.m9,.f-threequarter{width:74.99999%}.f-col.m10{width:83.33333%}.f-col.m11{width:91.66666%}.f-col.m12{width:99.99999%}}@media (min-width:993px){.f-col.l1{width:8.33333%}.f-col.l2{width:16.66666%}.f-col.l3{width:24.99999%}.f-col.l4{width:33.33333%}.f-col.l5{width:41.66666%}.f-col.l6{width:49.99999%}.f-col.l7{width:58.33333%}.f-col.l8{width:66.66666%}.f-col.l9{width:74.99999%}.f-col.l10{width:83.33333%}.f-col.l11{width:91.66666%}.f-col.l12{width:99.99999%}}.f-content{max-width:980px;margin:auto}.f-rest{overflow:hidden}@media (max-width:600px){.f-hide-small{display:none!important}.f-mobile{display:block;width:100%!important;text-align:center}}@media (min-width:993px){.f-hide-large{display:none!important}}@media (max-width:992px) and (min-width:601px){.f-hide-medium{display:none!important}}.circle{border-radius:50%}.f-container{padding:.01em 16px}.f-panel{margin-top:16px;margin-bottom:16px}.f-tiny{font-size:10px!important}.f-small{font-size:12px!important}.f-medium{font-size:15px!important}.f-large{font-size:18px!important}.f-xlarge{font-size:24px!important}.f-xxlarge{font-size:36px!important}.f-xxxlarge{font-size:48px!important}.f-jumbo{font-size:64px!important}
    </style>
    <link rel="icon" type="image/png" href="img/icon_99.ico"/>
</head>
<body id="body">
    <section id="defenced">
        <input type="hidden" id="token" value="<?php echo $token?>">
    </section>
    <section id="loader_line">
        <div class="loader_line"></div>
    </section>
    <section id="loader" style="display:none">
        <div class="absolute-center">
            <img src="img/avatar.png" style="width:75px;">
            <br>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>    
    </section>
    <section id="header">
        <div class="topnav">
            <a id="main" class="topnav-links" data-inner="content" data-content="main" data-dir="app/dashboard/" data-filename="main">Online shop</a>
            <a id="settings" class="topnav-links" data-inner="content" data-content="settings" data-dir="app/dashboard/" data-filename="settings">ფასდაკლების მართვა</a>
            <a>User id : <?php echo $user_id;?></a>
            <a style="float:right" class="bsk-opener bsk-con-all">
                <span class="bskcounterx bsk-con-all">0</span>
                <img src="img/basket.svg" class="bsk-con-all" alt="basket" style="width:25px;height:25px">
            </a>
        </div>
    </section>
    <section id="content">
        <!--content callback-->
    </section>
    <section id="footer">
        <div id="response" style="display:none;max-width:600px;">
            <span onclick="document.getElementById('response').style.display='none';">x</span>
            <p id="full_response">
            </p>
        </div>
    </section>
<script src="js/c.js<?php echo "?v=".$time?>"></script>
</body>
</html>
