@extends('managements.homecarousel')

@section('content2')
<script> 
    function MoveUp(item) {
        const btn_update = document.getElementById('btn_update');
        const itemID = document.getElementById(item);
        const prevID = itemID.previousSibling;
        if (prevID){
            if (prevID!=btn_update)
                itemID.parentNode.insertBefore(itemID,prevID);
        }
    }
    function MoveDown(item) {
        const btn_update = document.getElementById('btn_update');
        const itemID = document.getElementById(item);
        const nextID = itemID.nextElementSibling;
        if (nextID){
            if (nextID!=btn_update)
                itemID.parentNode.insertBefore(nextID,itemID);
        }
    }    
</script>
<div class="display_show">
    <h1>編輯幻燈片順序</h1>
    <form method='POST' action="{{ route('homecarousel_orderupdate') }}" enctype="multipart/form-data">
        @csrf
        <div>
            @if($announcements_count>0)   
                @for($i = 1; $i <= $announcements_count; $i++)                 
                <div id="box_{{ $i}}" class="home_carousel_items">              
                    <div class="order_box">
                        <!-- <h3 name="s_oder">{{$i}}</h3> -->
                    </div> 
                    <div>
                        <div class="text_input_box">
                            <label for="id_{{$i}}">ID</label>
                            <input name="id_{{$i}}" type="text" class="form-control-plaintext" id="id_{{$i}}" value="{{$announcement_posts[$i-1]['id']}}" readonly/>
                        </div>
                        <div class="text_input_box">
                            <label for="title_{{$i}}">標題</label>
                            <input type="text" class="form-control-plaintext" id="title_{{$i}}" value="{{$announcement_posts[$i-1]['title']}}" readonly/>
                        </div>
                        <div class="text_input_box">
                            <label for="content_{{$i}}">簡述</label>
                            <input type="text" class="form-control-plaintext" id="content_{{$i}}" value="{{$announcement_posts[$i-1]['content']}}" readonly/>                    
                        </div>    
                        <div class="img_preview_homecarousel">
                            <img src="{{'/storage/' . $announcement_posts[$i-1]['image']}}" class="w-100 mb-3"/>
                        </div>  
                    </div>        
                    <div class="box_btn_wrap_r_l">
                        <button type="button" class="box_btn r_t color_y" onclick="MoveUp('box_{{$i}}')">↑</button>
                        <button type="button" class="box_btn r_b color_y" onclick="MoveDown('box_{{$i}}')">↓</button>
                    </div>  
                </div>   
                @endfor    
                <button id="btn_update" type='submit' class="box_btn t_b_r_l color_g" style="height: 40px;">更新</button>                  
            @else
                <div class="content_nodata">
                    <p>無資料</p>
                </div>
            @endif                         
        </div>
                  
    </form>
</div>
@endsection