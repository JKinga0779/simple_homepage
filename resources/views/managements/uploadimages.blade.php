@extends('layouts.management')

@section('content1')
<script>
    function addBtnEnable() {  
        const btn_add = document.getElementById('btn_add');      
        if(document.getElementById("image").value.trim().length !== 0){
            preview_img.src=URL.createObjectURL(event.target.files[0]);        
            btn_add.removeAttribute('disabled');
            btn_add.setAttribute("class","box_btn b_b color_g") 
        }else{
            preview_img.src="/default_image/image_upload.png"; 
            btn_add.setAttribute('disabled',true);
            btn_add.setAttribute("class","box_btn");
        }    
    }
</script>

<div class="manage_content">    
    <div class="manage_content_l ">
        <h1>上傳圖片</h1>
        <form method='POST' action="{{ route('uploadimages_store') }}" enctype="multipart/form-data">
            @csrf        
            <div class="management_motify">            
                <div>
                    <div class="text_input_box">
                        <label for="title">註解</label>
                        <input name='title' type="text" class="form-control" id="title" value=""/>
                    </div>              
                    <div class="text_input_box">
                        <label for="image">圖片</label>
                        <input type="file" class="form-control-file" name='image' id="image" onchange="addBtnEnable()" accept="image/png, image/jpeg"/>  
                    </div>            
                    <div class="img_preview">
                        <img id="preview_img" src="/default_image/image_upload.png"/>
                    </div> 
                </div>            
                <div class="box_btn_wrap_t_b">
                    <button disabled id="btn_add" type='submit' class="box_btn b_b" style="height: 40px;">新增</button>
                </div> 
            </div>
        </form>
    </div>

    <div class="manage_content_r ">
        <div  id="Title_A01">
            <h1>圖片瀏覽</h1>
        </div>
        <div class="btn_herf_wrap">
            <a href="\management\uploadimages" class="btn_herf">全部</a>
            <a href="\management\uploadimages\from\0" class="btn_herf">單獨上傳</a>
            <a href="\management\uploadimages\from\1" class="btn_herf">首頁幻燈片</a>
            <a href="\management\uploadimages\from\2" class="btn_herf">一般頁首</a>
            <a href="\management\uploadimages\from\3" class="btn_herf">產品</a>
            <a href="\management\uploadimages\from\4" class="btn_herf">首頁區塊</a>
        </div>
        <div class="display_show_sc scrollbar_hidden" style="height: 850px;">        
            <div class="display_show">                                           
                @if($uploadimages_count>0)                      
                <div class="image_show_items_wrap">  
                    @foreach($uploadimages AS $uploadimage)
                    <div class="image_show_items">
                        <div class="image_show_box">
                            <h6>檔名</h6>
                            <p>{{$uploadimage['image']}}</p>                            
                        </div>
                        <div class="img_preview">
                            <img src="{{'/storage/'.$uploadimage['image']}}" class="w-50 mb-3"/>
                        </div>                                    
                    </div>
                    @endforeach 
                </div>              
                @else
                <div class="content_nodata">
                    <p>無資料</p>
                </div>
                @endif               
            </div>    
        </div>
    </div>
</div>

@endsection