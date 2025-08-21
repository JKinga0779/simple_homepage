@extends('managements.homecarousel')

@section('content2')
<script> 
    function preview() {
        if(document.getElementById("image").value.trim().length !== 0){
            preview_bgimg.src=URL.createObjectURL(event.target.files[0]); 
        }else{
            preview_bgimg.src="/default_image/image_upload_homecarousel.png"; 
        } 
    }
</script>
<div class="display_show">
    <h1>編輯幻燈片</h1>
    @if($error_id)
    <div class="error_route">
        <h4  class="text-black-50">錯誤編輯代碼</h4>
    </div>
    @else
        <form method='POST' action="{{ route('homecarousel_update', ['id' => $announcement_post['id']] ) }}" enctype="multipart/form-data">
            @csrf
            <div class="management_motify">
                <div>
                    <div class="text_input_box">
                        <label for="id">ID</label>
                        <input name="id" type="text" class="form-control-plaintext" id="id" value="{{$announcement_post['id']}}" readonly/>
                    </div>
                    <div class="text_input_box">
                        <label for="title">標題</label>
                        <input name='title' type="text" class="form-control" id="title" value="{{$announcement_post['title']}}"/>
                    </div>
                    <div class="text_input_box">
                        <label for="content">簡述</label>
                        <input name='content' type="text" class="form-control" id="content" value="{{$announcement_post['content']}}"/>                    
                    </div>
                    <div class="text_input_box">
                        <label for="herf">連結</label>
                        <input name='herf' type="text" class="form-control" id="herf" value="{{$announcement_post['herf']}}"/>
                    </div>                
                    <div class="text_input_box">
                        <label for="image">背景</label>
                        <input type="file" class="form-control-file" name='image' id="image" onchange="preview()" accept="image/png, image/jpeg"/>  
                    </div>            
                    <div class="img_preview_homecarousel">
                        <p>背景圖片預覽</p>
                        <img id="preview_bgimg" src="/default_image/image_upload_homecarousel.png" class="w-100 mb-3"/>
                        <p style="text-align: right;">(建議背景圖片比例: 500*200)</p>
                    </div>
                    <div class="img_preview_homecarousel">
                        <p>原背景圖片</p>
                        <img src="{{'/storage/' . $announcement_post['image']}}" class="w-100 mb-3"/>
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