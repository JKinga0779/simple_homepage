@extends('managements.products_types')

@section('content2')
<script> 
    function addBtnEnable($isimage,$pic_no) {  
        const btn_edit = document.getElementById('btn_edit');
        if(document.getElementById("name").value.trim().length !== 0){
            btn_edit.removeAttribute('disabled');
            btn_edit.setAttribute("class","box_btn b_b color_g") 
        }else{
            btn_edit.setAttribute('disabled',true);
            btn_edit.setAttribute("class","box_btn");
        }        
        if($isimage){
            $img_input_id = "image_pt"+$pic_no;
            const preview_img = document.getElementById('preview_img_pt'+$pic_no);
            if(document.getElementById($img_input_id).value.trim().length !== 0){
                preview_img.src=URL.createObjectURL(event.target.files[0]);
            }else{
                preview_img.src="/default_image/image_upload.png"; 
            }         
        } 
    }
</script>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js">
    CKEDITOR.replace('content');
</script>
<div class="display_show">
    <h1>編輯商品類別</h1>
    @if($error_id)
    <div class="error_route">
        <h4  class="text-black-50">錯誤編輯代碼</h4>
    </div>
    @else
        <form method='POST' action="{{ route('products_types_update', ['id' => $products_type['id']] ) }}" enctype="multipart/form-data">
            @csrf
            <div class="management_motify">
                <div>
                    <div class="text_input_box">
                        <label for="name">名稱</label>
                        <input name='name' type="text" class="form-control" id="name" placeholder="" value="{{$products_type['name']}}" oninput="addBtnEnable(false,0)"/>
                    </div>
                    <div class="text_input_box">
                        <label for="memo">簡述</label>
                        <textarea id="memo" name='memo' class="form-control" rows="5" onchange="addBtnEnable(false,0)">{{$products_type['memo']}}</textarea>
                    </div>
                    <div class="text_input_box">
                        <label for="content">詳細</label>
                        <textarea id="content" name='content' class="form-control" rows="10" onchange="addBtnEnable(false,0)">{{$products_type['content']}}</textarea>
                    </div>
                    
                    <div class="text_input_box">
                        <label for="image_pt100">封面圖片</label>
                        <input type="file" class="form-control-file" name='image_pt100' id="image_pt100" onchange="addBtnEnable(true,100)" accept="image/png, image/jpeg"/>  
                    </div>            
                    <div class="poster_img_preview">                
                        @if($products_type['cover_img']!="")
                            <img id="preview_img_pt100" src="{{'/storage/' . $products_type['cover_img']}}" class="w-50 mb-3"/>
                        @else
                            <img id="preview_img_pt100" src="/default_image/products_types_default01.png" class="w-50 mb-3"/>
                        @endif
                        <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                    </div>
                </div>
                
                <div class="box_btn_wrap_t_b">
                    <button type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                </div> 
            </div>
        </form>
    @endif
    
    
</div>
@endsection