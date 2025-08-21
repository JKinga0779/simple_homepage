@extends('layouts.management')

@section('content1')
<div class="manage_content">    
    <div class="manage_content_l scrollbar_hidden">
        <div  id="Title_A01">
            <h1>首頁區塊設定</h1>
        </div>
        <div class="btn_herf_wrap">
            <a href="\management\homeposts\select" class="btn_herf">新增首頁區塊</a>
            <a href="\management\homeposts\order" class="btn_herf">首頁區塊順序調整</a>
        </div>
        <!-- 幻燈片 -->
        <div class="content_1">        
            <div class="home_carousel">             
                @if($homeposts_count>0)   
                    @foreach($homeposts AS $homepost) 
                    <div class="home_carousel_items">
                        <div class="order_box">
                            @if($homepost['status']==2)
                                <h6 style="color: red;">隱藏</h6>
                            @endif
                        </div>
                        <div>
                            <div class="text_input_box">
                                <label for="{{'id_' . $homepost['id']}}">ID</label>
                                <input name="{{'id_' . $homepost['id']}}" type="text" class="form-control-plaintext" id="{{'id_' . $homepost['id']}}" value="{{$homepost['id']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'title_' . $homepost['id']}}">標題</label>
                                <input name="{{'title_' . $homepost['id']}}" type="text" class="form-control-plaintext" id="{{'title_' . $homepost['id']}}" value="{{$homepost['title']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="post_type">類型</label>
                                <select id='post_type' name='post_type' value="{{$homepost['post_type']}}" disabled>
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
                            <form method='GET' action="{{ route('homeposts_edit', ['id' => $homepost['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_t color_g">編輯</button>
                            </form>
                            <form method='POST' action="{{ route('homeposts_delete', ['id' => $homepost['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_b color_r">刪除</button>
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
    </div>

    <div class="manage_content_r scrollbar_hidden">
        @yield('content2')
    </div>

    
</div>

@endsection
