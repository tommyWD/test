(function(){
"use strict"
var options = {
    "main_page":"#main",
}
var f = {
    everything:function(){
        f.run('.topnav-links','click', function(childElement){
            f.ajax(event,'normal');
        });
         f.run('.bsk-opener','click', function(childElement){
            f.bsk(event);
        });
        f.addEventForChild(parent, 'click', '.sulfaen', function(childElement){
            f.add_bskt(event);
        }); 
        f.addEventForChild(parent, 'click', '.closex', function(childElement){
            f.includeLoader(event, 'remove_all');
        });
        f.addEventForChild(parent, 'click', '.add-bskt-now', function(childElement){
            f.includeLoader(event, 'add');
        });
        f.addEventForChild(parent, 'click', '.rmv-bskt-now', function(childElement){
            f.includeLoader(event, 'set');
        });
        f.addEventForChild(parent, 'click', '.rmv-bskt-now_2', function(childElement){
            f.includeLoader(event, 'set');
        });
        f.addEventForChild(parent, 'click', '.closex', function(childElement){
            f.includeLoader(event, 'remove');
        });
        f.addEventForChild(parent, 'click', '.sul391', function(childElement){
            f.remove_bskt(event);
        });
        window.onclick = function(event) {
            if (!event.target.matches('.nothing') && !event.target.matches('.nothing2')) {
                //here something
            }
        } 
        window.onpopstate = function(e){
            (function(){
                f.ajax(document.getElementById(f.links()[0].value), 'bf');
            })();
        }; 
    },
    after:function(){
        f.run('.id-button','click', function(childElement){;
            f.butt(event);
        });
        f.run('.img','load', function(childElement){;
            f.image_normalize(event);
        });
        f.run('.adding-m','click', function(childElement){;
            f.add_bskt(event);
        });
        f.run('.insert_db','click', function(childElement){;
            f.includeLoaderGet(event);
        });
        f.run('.remove-m','click', function(childElement){;
            f.remove_bskt(event);
        });
        f.run('.add_profit','change', function(childElement){;
            f.lst_insert(event, 'add_profit');
        });
        f.run('.html','click', function(childElement){;
            f.lst_insert(event, 'add_profit');
        });
        f.run('.del_group','click', function(childElement){;
            f.lst_insert(event, 'del_group');
        });
        f.run('.chng_usr_prf','click', function(childElement){;
            f.lst_insert(event, 'cng_usr_prft');
        });
        f.run('.addns','click', function(childElement){;
            f.lst_insert(event, 'addns');
        });
        
        window.onclick = function(event) {
            if (!event.target.matches('.bsk-con-all')) {
                var bsk_con = document.querySelector('#basket-content');
                bsk_con.classList.add('bsk-hide');
            }
        } 
    },
    addEventForChild:function(parent, eventName, childSelector, cb){      
      parent.addEventListener(eventName, function(event){
        var clickedElement = event.target,
        matchingChild = clickedElement.closest(childSelector);
        if (matchingChild){
          cb(matchingChild);  
        } 
      })
    },
    first_page:function(start){
        document.querySelector(start).click();
    },
    butt:function(event){
        var x;
        x = event.target;
        document.querySelector('#id-div').innerHTML = x.className;
    },
    bsk:function(event){
        var bsk_con = document.querySelector('#basket-content');
        if(bsk_con.classList.contains('bsk-hide')){
            bsk_con.classList.remove('bsk-hide');
        }else{
            bsk_con.classList.add('bsk-hide');
        }
    },
    add_bskt:function(event){        
        var id, price,discount, element, input, input_chr,inp_count,bskcounterx, h, img, title, empty,totallypricex, bsk2_x,loop_value;
        h = document.getElementById("basket-content");
        empty = document.getElementById("empty");
        totallypricex = document.getElementById("totallypricex");
        bskcounterx = document.querySelectorAll('.bskcounterx')[0];
        element = event.target;
        id = element.dataset.id;
        price = element.dataset.price;
        discount = element.dataset.discount;
        title = element.dataset.title;
        img = element.dataset.img;
        input = document.querySelector('#product_quantity_'+id);
        bsk2_x = document.querySelector('#bsk2_x'+id);
        input_chr = document.querySelectorAll('.input_chr');
        if(input.value >= 0){
            input.value = ++input.value;
        }
        inp_count = 0;
        loop_value = 0;
        var all_discount_id = [];
        for(var i=0;i<input_chr.length;i++){
            if(input_chr[i].dataset.discount > 0){
                all_discount_id.push(input_chr[i].dataset.id);
            }
            
            if(input_chr[i].value > 0){
                inp_count = inp_count + 1;
            }
    
        }
        
        

        
        bskcounterx.innerHTML = inp_count;
        if(input.value == 1){
            if(id > 5){
                var sds = 5;
            }else{
                sds = id;
            }
            var lst = '<div id="basketline_'+id+'" class="bsk-con-all relative"><span data-id="'+id+'" class="bsk-con-all closex" id="close_'+id+'">remove</span><div class="basket-line bsk-con-all"><img src="img/minus.svg" data-id="'+id+'" data-price="'+price+'" data-discount="'+discount+'" data-img="img/prd1.jpg" data-title="'+title+'" class="minus-x rmv-bskt-now_2 sul391 z-x bsk-con-all"><img src="img/prd'+sds+'.jpg" class="img-x2 bsk-con-all"> <img src="img/add.svg" class="add-bskt-now add-bskt-now_2 add-x z-x sulfaen bsk-con-all" data-id="'+id+'" data-price="'+price+'" data-discount="'+discount+'" data-img="img/prd1.jpg" data-title="'+title+'"><span class="bsk-con-all">'+title+'</span><span class="bsk-con-all">'+price+' GEL</span><span class="bsk-con-all" id="bsk2_x'+id+'">'+input.value+'</span></div></div>';
            h.insertAdjacentHTML("beforeend", lst);
            
        }else{
            bsk2_x.innerHTML = input.value;
        }
        empty.style.display = "none";
        f.totallyPrice();
    },
    includeLoader:function(event, type){
        var data, token, response, evt, i, input_chr, add_product_id, json_add_product_id;
        var input_chr = document.querySelectorAll('.input_chr');
        json_add_product_id = new Object();
        data = new FormData();
        token = document.querySelector('#token');
        data.append('token', token.value);
        data.append('type', type);
        
        
        add_product_id = [];
        evt = event.target;
        if(type == 'add'){
            var add_id = evt.dataset.id;
            data.append('addProductInCart', add_id);
        }else if(type == 'set'){
            var set_id = evt.dataset.id;
            data.append('setCartProductQuantity', set_id);
        }else if(type == 'remove'){
            var remove_id = evt.dataset.id;
            f.remove_fullitem(remove_id);
            data.append('removeProductFromCart', remove_id);
        }
        var request = new XMLHttpRequest();
        request.addEventListener('load', function(e) {
            if(request.readyState == 4 && request.status == 200){
                response = JSON.parse(this.responseText);
            }
        });
        request.open('post', 'phppath/ajax/post.php'); 
        request.send(data);  
    },
    lst_insert:function(event, type){
        var data, token, response, evt, i, input_chr, add_product_id, json_add_product_id;
        var add_profit = document.querySelectorAll('.add_profit')[0].value;
        json_add_product_id = new Object();
        data = new FormData();
        token = document.querySelector('#token');
        data.append('token', token.value);
        data.append('type', type);
        if(type == 'add_profit'){
            if(add_profit > 0){
                data.append('type', type);
                data.append('add_profit', add_profit);
            }else{
                return;
            }
        }else if(type == 'cng_usr_prft'){
            var trgt = event.target;
            var ss = document.querySelectorAll('.usr'+trgt.dataset.id)[0].value;
            data.append('type', type);
            data.append('cng_usr_prft', trgt.dataset.id);
            data.append('usr_profit', ss);
        }else if(type == 'del_group'){
            var trgt = event.target;
            var del_group = trgt.dataset.id;
            data.append('type', type);
            data.append('del_group', del_group);
        }else if(type == 'addns'){
            var a_title = document.querySelector('#a_title').value;
            var a_price = document.querySelector('#a_price').value;
            data.append('type', type);
            data.append('a_title', a_title);
            data.append('a_price', a_price);
        }else{
            return;
        }
        
        var request = new XMLHttpRequest();
        request.addEventListener('load', function(e) {
            if(request.readyState == 4 && request.status == 200){
                response = JSON.parse(this.responseText);
                
                document.querySelector('#settings').click();
            }
        });
        request.open('post', 'phppath/ajax/adding.php'); 
        request.send(data);  
    },
    includeLoaderGet:function(event){
       var data, token, response, evt, i, input_chr, add_product_id, json_add_product_id;
        token = document.querySelector('#token');
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                response = JSON.parse(this.responseText);
                document.querySelector('#full_response').innerHTML = response.content;
                document.querySelector('#response').style.display = 'block';
                
            }
        };
        xhttp.open("GET", "phppath/ajax/get.php?token="+token.value+"&", true);
        xhttp.send();
    },
    remove_bskt:function(event){
         var id, price,discount, element, input, input_chr,inp_count,bskcounterx, h, img, title, empty,totallypricex, bsk2_x,loop_value;
        h = document.getElementById("basket-content");
        empty = document.getElementById("empty");
        totallypricex = document.getElementById("totallypricex");
        bskcounterx = document.querySelectorAll('.bskcounterx')[0];
        element = event.target;
        id = element.dataset.id;
        price = element.dataset.price;
        discount = element.dataset.discount;
        title = element.dataset.title;
        img = element.dataset.img;
        input = document.querySelector('#product_quantity_'+id);
        bsk2_x = document.querySelector('#bsk2_x'+id);
        input_chr = document.querySelectorAll('.input_chr');
        if(input.value > 0){
            input.value = --input.value;
        }
        inp_count = 0;
        loop_value = 0;
        var all_discount_id = [];
        for(var i=0;i<input_chr.length;i++){
            if(input_chr[i].dataset.discount > 0){
                all_discount_id.push(input_chr[i].dataset.id);
            }
            if(input_chr[i].value > 0){
                inp_count = inp_count + 1;
            }
        }
        bskcounterx.innerHTML = inp_count;
        if(input.value == 0){
            try{document.querySelector('#basketline_'+id).remove();}catch(e){}
        }else{
            try{bsk2_x.innerHTML = input.value;}catch(e){}
        }
        f.totallyPrice();
    },
    counter_basket_tsk:function(){
        var input_chr = document.querySelectorAll('.input_chr');
        var bskcounterx = document.querySelectorAll('.bskcounterx')[0];
        var z = 0;
        for(var i=0;i<input_chr.length;i++){
          if(input_chr[i].value > 0){
              ++z;
          }
        }
        bskcounterx.innerHTML = z;
    },
    remove_fullitem:function(id){
        var basketline = document.querySelector('#basketline_'+id);
        var product_quantity = document.querySelector('#product_quantity_'+id);
        var bskcounterx = document.querySelectorAll('.bskcounterx')[0];
        var input_chr = document.querySelectorAll('.input_chr');
        basketline.remove();
        product_quantity.value = 0;
        f.totallyPrice();
        var inp_count = 0;
        for(var i=0;i<input_chr.length;i++){
            if(input_chr[i].value > 0){
                inp_count = inp_count + 1;
            }
        }
        bskcounterx.innerHTML = inp_count;
    },
    totallyPrice:function(){
        var x_id, x_product_quantity, x_discount, x_price, fulldisc;
        var discount_array = [];
        var minarray = [];
        var q_arr = [];
        var disc_arr = [];
        var totallypricex = document.querySelector('#totallypricex');
        var input_chr = document.querySelectorAll('.input_chr');
        totallypricex.value = 0;
        for(var i =0;i < input_chr.length;i++){
            var price = input_chr[i].dataset.price;
            var id = input_chr[i].dataset.id;
            var product_quantity = document.querySelector('#product_quantity_'+id);
            var discount = input_chr[i].dataset.discount;
            if(discount > 0){
                discount_array.push([id, product_quantity.value, discount, price]);
            }
            totallypricex.value = parseFloat(totallypricex.value) + parseFloat(price) * parseFloat(product_quantity.value);
        }
        var identificer = 1;
        if(discount_array.length > 0){
            for(var i=0;i<discount_array.length;i++){
                x_id = discount_array[i][0];
                x_product_quantity = discount_array[i][1];
                x_discount = discount_array[i][2];
                x_price = discount_array[i][3];
                minarray.push([x_product_quantity]);
                q_arr.push([x_price]);
                disc_arr.push([x_discount]);
                if(x_product_quantity == 0){
                    identificer = 0;
                    break;
                }
            }
        }
        if(identificer > 0){
            fulldisc = 0;
            var discount_quantity = Math.min.apply(null, minarray);
            discount_quantity = discount_quantity * 2;
            var p = 0;
            for(var i=0;i<discount_quantity;i++){
                if(discount_quantity >= i){
                    fulldisc = parseFloat(fulldisc) + ((parseFloat(q_arr[p]) * parseFloat(disc_arr[p])) / 100);   
                    ++p;
                    if(p >= q_arr.length){
                       p = 0;
                    }
                }
            }
        }else{
            fulldisc = 0;
        }
        totallypricex.value = parseFloat(totallypricex.value) - parseFloat(fulldisc);
        
        if(totallypricex.value == 0){
            empty.style.display = "block";   
        }
        
    },
    links:function(){
        var a,b,c,d,i,obj;
        a = window.location.href;
        b = a.split('#?');
        c = b[1].split('&');
        obj = {};
        for (i = 0; i < c.length; i++) {
            d = c[i].split('=');
            obj[i] = {name: d[0], value:d[1]};
        }
        return obj;
    },
    run:function(element,event,func){
        var i, b;
        b = document.querySelectorAll(element);
        for(i=0;i<b.length;i++){
            b[i].addEventListener(event, func);
        }
    },
    ObjectSize:function(obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }
        return size;
    },
    load_:function(action){
        var loader, body , html;
        body = document.querySelector('#body');
        html = document.querySelector('#html');
        loader = document.getElementById('loader');
        if(action == 'start'){
            loader.classList.add('block');
            loader.classList.remove('none');
        }else if(action == 'end'){
            loader.classList.remove('block');
            loader.classList.add('none');
            body.style.overflow = 'auto';
            html.style.overflow = 'auto';   
        }   
    },
    ajax:function(elem,side){
        //f.load_('start');
        //loader line
        f.loader60();
        var element, content ,xhttp,dir,filename,content,helper,obj,inner,link,token,response;
        token = document.querySelector('#token');
        if(side == 'bf'){
            element = elem;
        }else{
            element = elem.target;   
        }
        
        inner = document.querySelector('#'+element.dataset.inner);
        obj = {"0":'content',"1":'other',"2":'year',"3":'version',4:"amp"};
        dir = element.dataset.dir;
        content = element.dataset.filename;
        link = f.link_generator(obj,elem,side);
        
        if(side == 'normal'){
            window.history.pushState('null', 'null', 'index#?'+link);
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                try{
                    response = JSON.parse(this.responseText);
                    if(response.result == true){
                        inner.innerHTML = response.content;
                        token.value = response.token;
                    }else{
                        inner.innerHTML = response.result;
                    }
                    //f.load_('end');
                    //loader line
                    f.loader100();
                    f.after();
                    if(content == 'main'){
                        f.totallyPrice();
                        document.getElementsByClassName('bsk-opener')[0].style.display = 'block';
                    }else{
                         document.getElementsByClassName('bsk-opener')[0].style.display = 'none';
                    }
                    f.counter_basket_tsk();
                }catch(e){
                    console.log(e);
                }
            }
        };
        xhttp.open("POST", dir+content, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('token='+token.value);
    },
    link_generator:function(obj,elem,side){
        var permalink,dir,content,year,element,len,i,version,other,amp;
        if(side == 'bf'){
            element = elem;
        }else if(side == 'normal'){
            element = elem.target;   
        }
        permalink = '';
        len = f.ObjectSize(obj);
        try{
            for(i=0;i<len;i++){
                eval(obj[i] + ' = ' + "element.dataset."+obj[i])
            }
            for(i=0;i<len;i++){
                if(eval(obj[i]) !== undefined){
                    permalink += obj[i] + "=" + eval(obj[i]) + "&";
                }
            }
        }catch(e){
            console.log(e);
        }
        permalink = permalink.substring(0, permalink.length - 1);
        return permalink;
    },
    loader60:function(){
        var loader_line = document.getElementsByClassName('loader_line')[0];
        loader_line.style.transition = 'all .3s';
        loader_line.style.width = '60%';
    },
    loader100:function(){
        var loader_line = document.getElementsByClassName('loader_line')[0];
        loader_line.style.width = '100%';
        setTimeout(function(){
            loader_line.style.transition = 'all 0s';
            loader_line.style.width = '0';
        },350);
    },
    image_normalize:function(event){
        if(event.target.complete == true){
            setTimeout(function(){
                document.querySelector('#'+event.target.dataset.id).style.display = 'none';
            },300);
        }
    }
}
f.everything();try{f.first_page('#'+f.links()[0].value);}catch(e){f.first_page(options.main_page)}
})();