@extends('managements.products_types')

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
    <h1>新增商品類別</h1>
    <form method='POST' action="{{ route('products_types_store') }}" enctype="multipart/form-data">
        @csrf
        <div class="management_motify">
            <div>
                <div class="text_input_box">
                    <label for="name">名稱</label>
                    <input name='name' type="text" class="form-control" id="name" placeholder="" value="" oninput="addBtnEnable(false,0)"/>
                </div>
                <div class="text_input_box">
                    <label for="memo">簡述</label>
                    <textarea id="memo" name='memo' class="form-control" rows="5" onchange="addBtnEnable(false,0)"></textarea>
                </div>
                <div class="text_input_box">
                    <label for="content">詳細</label>
                    <textarea id="content" name='content' class="form-control" rows="10" onchange="addBtnEnable(false,0)"></textarea>
                </div>
                
                <div class="text_input_box">
                    <label for="image_pt100">封面圖片</label>
                    <input type="file" class="form-control-file" name='image_pt100' id="image_pt100" onchange="addBtnEnable(true,100)"  accept="image/png, image/jpeg"/>  
                </div>            
                <div class="poster_img_preview">                
                    <img id="preview_img_pt100" src="/default_image/image_upload.png" class="w-50 mb-3"/>
                    <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                </div>
            </div>
            
            <div class="box_btn_wrap_t_b">
                <button disabled id="btn_add" type='submit' class="box_btn" style="height: 40px;">新增</button>
            </div> 
        </div> 
    </form>    
</div>
@endsection