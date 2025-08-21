@extends('managements.products')

@section('content2')
<script> 
    function addBtnEnable($isimage,$pic_no) {  
        const btn_add = document.getElementById('btn_add');
        if(document.getElementById("name").value.trim().length !== 0){
            btn_add.removeAttribute('disabled');
            btn_add.setAttribute("class","box_btn b_b color_g") 
        }else{
            btn_add.setAttribute('disabled',true);
            btn_add.setAttribute("class","box_btn");
        }        
        
        if($isimage){
            $img_input_id = "image_p"+$pic_no;
            const preview_img = document.getElementById('preview_img_p'+$pic_no);
            if(document.getElementById($img_input_id).value.trim().length !== 0){
                preview_img.src=URL.createObjectURL(event.target.files[0]);
            }else{
                if($pic_no==100){
                    preview_img.src="/default_image/image_upload_product_bg.png"; 
                }else if($pic_no==200){
                    preview_img.src="/default_image/image_upload_card_bg.png"; 
                }else{
                    preview_img.src="/default_image/image_upload.png"; 

                }
                
            }         
        } 
    }
</script>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js">
    CKEDITOR.replace('content');
</script>
<div class="display_show">
    <h1>新增商品詳細</h1>
    <form method='POST' action="{{ route('products_store') }}" enctype="multipart/form-data">
        @csrf
        <div class="management_motify">
            <div>
                <div class="text_input_box">
                    <label for="name">名稱</label>
                    <input name='name' type="text" class="form-control" id="name" placeholder="" value="" oninput="addBtnEnable(false,0)"/>
                </div>
                <div class="text_input_box">
                    <label for="content">詳細</label>
                    <textarea id="content" name='content' class="form-control" rows="10"></textarea>
                </div>
                <div class="text_input_box">
                    <label for="type_id">種類</label>
                    <select id="type_id" name='type_id'>
                        <option value=0 selected>未分類</option>
                        @if($products_types_count>0)
                            @foreach($products_types AS $products_type)                     
                                <option value={{$products_type['id']}}>{{$products_type['name']}}</option>
                            @endforeach
                        @endif
                    </select>                                 
                </div>

                <div class="text_input_box">
                    <label for="retail_price">零售價</label>
                    <input name='retail_price' type="number" class="form-control" id="retail_price" min="0" value="0" placeholder="0" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')"/>
                </div>

                <div class="text_input_box">
                    <label for="factory_price">出廠價</label>
                    <input name='factory_price' type="number" class="form-control" id="factory_price" min="0" value="0" placeholder="0" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')"/>
                </div>

                <div class="text_input_box">
                    <label for="special_price">特價</label>
                    <input name='special_price' type="number" class="form-control" id="special_price" min="0" value="0" placeholder="0" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')"/>
                </div>

                <div class="text_input_box">
                    <label for="discount">折扣(打折) % </label>
                    <input name='discount' type="number" class="form-control" id="discount" min="1" max="100" value="100" placeholder="1" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')"/>
                </div>

                <div class="text_input_box">
                    <label for="stores_num">庫存量</label>
                    <input name='stores_num' type="number" class="form-control" id="stores_num" min="0" value="0" placeholder="0" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')"/>
                </div>

                <div class="text_input_box">
                    <label for="sales_num">銷售量</label>
                    <input name='sales_num' type="number" class="form-control" id="sales_num" min="0" value="0" placeholder="0" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')"/>
                </div>
                
                <div class="text_input_box">
                    <label for="image_p101">商品圖片</label>
                    <input type="file" class="form-control-file" name='image_p101' id="image_p101" accept="image/png, image/jpeg" oninput="addBtnEnable(true,101)"/>  
                </div>            
                <div class="poster_img_preview">                
                    <img id="preview_img_p101" src="/default_image/image_upload.png" class="w-50 mb-3"/>
                    <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                </div>

                <div class="text_input_box">
                    <label for="image_p100">商品展示背景</label>
                    <input type="file" class="form-control-file" name='image_p100' id="image_p100" accept="image/png, image/jpeg" oninput="addBtnEnable(true,100)"/>  
                </div>            
                <div class="img_preview_products_bg">                
                    <img id="preview_img_p100" src="/default_image/image_upload_product_bg.png" class="w-100 mb-3"/>
                </div>
                <p style="text-align: right;">(建議圖片比例: 350*250)</p>

                <div class="text_input_box">
                    <label for="image_p200">卡片背景</label>
                    <input type="file" class="form-control-file" name='image_p200' id="image_p200" accept="image/png, image/jpeg" oninput="addBtnEnable(true,200)"/>  
                </div>            
                <div class="img_preview_post04_cbg">                
                    <img id="preview_img_p200" src="/default_image/image_upload_card_bg.png" class="w-100 mb-3"/>
                </div>
                <p style="text-align: right;">(建議圖片比例: 300*400)</p>

            </div>
            
            <div class="box_btn_wrap_t_b">
                <button disabled id="btn_add" type='submit' class="box_btn" style="height: 40px;">新增</button>
            </div> 
        </div> 
    </form>    
</div>
@endsection