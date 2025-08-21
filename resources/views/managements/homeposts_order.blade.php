@extends('managements.homeposts')

@section('content2')
<script> 
    function MoveUp(item) {
        const itemID = document.getElementById(item);
        const prevID = itemID.previousSibling;
        if (prevID){
            itemID.parentNode.insertBefore(itemID,prevID);
        }
    }
    function MoveDown(item) {
        const itemID = document.getElementById(item);
        const nextID = itemID.nextElementSibling;
        if (nextID){
            itemID.parentNode.insertBefore(nextID,itemID);
        }
    }    
</script>
<div class="display_show">
    <h1>編輯首頁區塊順序</h1>
    <form method='POST' action="{{ route('homeposts_orderupdate') }}" enctype="multipart/form-data">
        @csrf
        <div>
            @if($homeposts_order_count>0)   
                @for($i = 1; $i <= $homeposts_order_count; $i++)                 
                <div id="{{'box_' . $i}}" class="home_carousel_items">          
                    <div class="order_box">
                        <!-- <h3 name="s_oder">{{$i}}</h3> -->
                    </div> 
                    <div>
                        <div class="text_input_box">
                            <label for="{{'id_' . $i}}">ID</label>
                            <input name="{{'id_' . $i}}" type="text" class="form-control-plaintext" id="{{'id_' . $i}}" value="{{$homeposts_order[$i-1]['id']}}" readonly>
                        </div>
                        <div class="text_input_box">
                            <label for="{{'title_' . $i}}">標題</label>
                            <input type="text" class="form-control-plaintext" id="{{'title_' . $i}}" value="{{$homeposts_order[$i-1]['title']}}" readonly>
                        </div>
                        <div class="text_input_box">
                            <label for="{{'post_type_' . $i}}">類型</label>
                            <select id="{{'post_type_' . $i}}" value="{{$homeposts_order[$i-1]['post_type']}}" disabled>
                                <option value=1>1.標題+說明+3圖</option>
                                <option value=2>2.標題+說明+圖片/影片(+按鈕)</option>
                                <option value=3>3.標題+說明+按鈕</option>
                                <option value=4>4.滑動產品圖卡</option>
                                <option value=5>5.單一圖片/影片/文字</option>
                                <option value=6>6.標題+敘述</option>
                            </select>                            
                        </div>
                    </div>   
                    <div class="box_btn_wrap_r_l">
                        <button type="button" class="box_btn r_t color_y" onclick="MoveUp('box_{{$i}}')">↑</button>
                        <button type="button" class="box_btn r_b color_y" onclick="MoveDown('box_{{$i}}')">↓</button>
                    </div>  
                </div>   
                @endfor    
                <button type='submit' class="box_btn t_b_r_l color_g" style="height: 40px;">更新</button>                  
            @else
                <div class="content_nodata">
                    <p>無資料</p>
                </div>
            @endif                         
        </div>
                  
    </form>
</div>
@endsection