@extends('managements.companyinfo_edit')

@section('content2')
<script> 
    function addBtnEnable() {  
        const btn_add = document.getElementById('btn_add');      
        if(document.getElementById("image").value.trim().length !== 0){
            preview_topimg.src=URL.createObjectURL(event.target.files[0]); 
            btn_add.removeAttribute('disabled');
            btn_add.setAttribute("class","box_btn b_b color_g") 
        }else{
            preview_topimg.src="/default_image/image_upload_top_carousel.png"; 
            btn_add.setAttribute('disabled',true);
            btn_add.setAttribute("class","box_btn");
        }    
    }
</script>
<div class="display_show">
    <h1>新增刪除頁首圖片</h1>
    <form method='POST' action="{{ route('header_store') }}" enctype="multipart/form-data">
        @csrf
        <div class="management_motify">            
            <div>
                <div class="text_input_box">
                    <label for="title">註解</label>
                    <input name='title' type="text" class="form-control" id="title" value=""/>
                </div>              
                <div class="text_input_box">
                    <label for="image">圖片</label>
                    <input type="file" class="form-control-file" name='image' id="image" onchange="addBtnEnable()"  accept="image/png, image/jpeg"/>  
                </div>            
                <div class="img_preview_topcarousel">
                    <p>圖片預覽</p>
                    <img id="preview_topimg" src="/default_image/image_upload_top_carousel.png" class="w-100 mb-3"/>
                    <p style="text-align: right;">(建議圖片比例: 500*100)</p>
                </div> 
            </div>            
            <div class="box_btn_wrap_t_b">
                <button disabled id="btn_add" type='submit' class="box_btn" style="height: 40px;">新增</button>
            </div> 
        </div>
    </form>
 </div>  

<div class="display_show_sc scrollbar_hidden" style="height: 450px;">        
    <div class="display_show">             
        @if($header_images_count>0)   
            @foreach($header_images AS $header_image) 
            <div class="home_carousel_items">
                <div class="order_box">
                    <h3></h3>
                </div>
                <div>
                    <div class="text_input_box">
                        <label for="{{'id_' . $header_image['id']}}">ID</label>
                        <input name="{{'id_' . $header_image['id']}}" type="text" class="form-control-plaintext" id="{{'id_' . $header_image['id']}}" value="{{$header_image['id']}}" readonly>
                    </div>
                    <div class="text_input_box">
                        <label for="{{'title_' . $header_image['id']}}">註解</label>
                        <input name="{{'title_' . $header_image['id']}}" type="text" class="form-control-plaintext" id="{{'title_' . $header_image['id']}}" value="{{$header_image['title']}}" readonly>
                    </div>
                    <div class="img_preview_topcarousel">
                        <img src="{{'/storage/' . $header_image['image']}}" class="w-100 mb-3"/>
                    </div>
                </div>

                <div class="box_btn_wrap_r_l">
                    <form method='POST' action="{{ route('header_delete', ['id' => $header_image['id']] ) }}" class="box_btn">
                        @csrf
                        <button class="box_btn r_r color_r">刪除</button>
                    </form>
                </div>  
                
            </div>
            @endforeach                    
        @else
        <div class="content_nodata">
            <p>無資料</p>
        </div>
        @endif                            
    </div>    
</div>
@endsection