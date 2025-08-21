@extends('managements.homecarousel')

@section('content2')
<script> 
    function addBtnEnable($isimage) {  
        const btn_add = document.getElementById('btn_add');
        if((document.getElementById("title").value.trim().length !== 0) ||
           (document.getElementById("content").value.trim().length !== 0) ||
           (document.getElementById("herf").value.trim().length !== 0) ||
           (document.getElementById("image").value.trim().length !== 0)){
            btn_add.removeAttribute('disabled');
            btn_add.setAttribute("class","box_btn b_b color_g") 
        }else{
            btn_add.setAttribute('disabled',true);
            btn_add.setAttribute("class","box_btn");
        }        
        if($isimage){
            if(document.getElementById("image").value.trim().length !== 0){
                preview_bgimg.src=URL.createObjectURL(event.target.files[0]); 
            }else{
                preview_bgimg.src="/default_image/image_upload_homecarousel.png"; 
            }            
        }
    }
</script>
<div class="display_show">
    <h1>新增商品種類</h1>
    <form method='POST' action="{{ route('homecarousel_store') }}" enctype="multipart/form-data">
        @csrf
        <div class="management_motify">
            <div>
                <div class="text_input_box">
                    <label for="title">標題</label>
                    <input name='title' type="text" class="form-control" id="title" placeholder="" value="" oninput="addBtnEnable(false)"/>
                </div>
                <div class="text_input_box">
                    <label for="content">簡述</label>
                    <input name='content' type="text" class="form-control" id="content" placeholder="" value="" oninput="addBtnEnable(false)"/>                    
                </div>
                <div class="text_input_box">
                    <label for="herf">連結</label>
                    <input name='herf' type="text" class="form-control" id="herf" placeholder="" value=""  oninput="addBtnEnable(false)"/>
                </div>
                
                <div class="text_input_box">
                    <label for="image">背景</label>
                    <input type="file" class="form-control-file" name='image' id="image" onchange="addBtnEnable(true)"  accept="image/png, image/jpeg"/>  
                </div>            
                <div class="img_preview_homecarousel">                
                    <img id="preview_bgimg" src="/default_image/image_upload_homecarousel.png" class="w-100 mb-3"/>
                    <p style="text-align: right;">(建議背景圖片比例: 500*200)</p>
                </div>
            </div>
            
            <div class="box_btn_wrap_t_b">
                <button disabled id="btn_add" type='submit' class="box_btn" style="height: 40px;">新增</button>
            </div> 
        </div> 
    </form>    
</div>
@endsection