@extends('layouts.management')

@section('content1')
<div class="manage_content">    
    <div class="manage_content_l scrollbar_hidden">
        <h1>首頁幻燈片設定</h1>
        <div class="btn_herf_wrap">
            <a href="\management\homecarousel\add" class="btn_herf">新增幻燈片</a>
            <a href="\management\homecarousel\order" class="btn_herf">幻燈片順序調整</a>
        </div>
        <!-- 幻燈片 -->
        <div class="content_1">        
            <div class="home_carousel">             
                @if($announcements_count>0)   
                    @foreach($announcement_posts AS $announcements_post) 
                    <div class="home_carousel_items">
                        <div class="order_box">
                            <!-- <h3>{{$announcements_post['show_order']}}</h3> -->
                        </div>
                        <div>
                            <div class="text_input_box">
                                <label for="{{'id_' . $announcements_post['id']}}">ID</label>
                                <input name="{{'id_' . $announcements_post['id']}}" type="text" class="form-control-plaintext" id="{{'id_' . $announcements_post['id']}}" value="{{$announcements_post['id']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'title_' . $announcements_post['id']}}">標題</label>
                                <input name="{{'title_' . $announcements_post['id']}}" type="text" class="form-control-plaintext" id="{{'title_' . $announcements_post['id']}}" value="{{$announcements_post['title']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'content_' . $announcements_post['id']}}">簡述</label>
                                <input name="{{'content_' . $announcements_post['id']}}" type="text" class="form-control-plaintext" id="{{'content_' . $announcements_post['id']}}" value="{{$announcements_post['content']}}" readonly>                    
                            </div>
                            <div class="text_input_box">
                                <label for="{{'herf_' . $announcements_post['id']}}">連結</label>
                                <input name="{{'herf_' . $announcements_post['id']}}" type="text" class="form-control-plaintext" id="{{'herf_' . $announcements_post['id']}}" value="{{$announcements_post['herf']}}" readonly>
                            </div>
                        </div> 

                        <div class="box_btn_wrap_r_l">
                            <form method='GET' action="{{ route('homecarousel_edit', ['id' => $announcements_post['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_t color_g">編輯</button>
                            </form>
                            <form method='POST' action="{{ route('homecarousel_delete', ['id' => $announcements_post['id']] ) }}" class="box_btn">
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
