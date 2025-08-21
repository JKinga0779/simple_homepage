@extends('layouts.management')

@section('content1')
<script> 
    function preview($pic_no) {
        switch($pic_no){
            case 1:
                preview_logo1.src=URL.createObjectURL(event.target.files[0]);
                break;
            case 2:
                preview_logo2.src=URL.createObjectURL(event.target.files[0]);
                break;
        }     
    }
</script>
<div class="manage_content">    
    <div class="manage_content_l scrollbar_hidden">
        <h1>公告設定</h1>
        <div class="btn_herf_wrap">
            <a href="\management\newsposts\add" class="btn_herf">新增公告</a>
        </div>
        <div class="content_1">        
                @if($newsposts_count>0)   
                    @foreach($newsposts AS $newspost) 
                    <div class="news_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="{{'id_' . $newspost['id']}}">ID</label>
                                <input name="{{'id_' . $newspost['id']}}" type="text" class="form-control-plaintext" id="{{'id_' . $newspost['id']}}" value="{{$newspost['id']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'create_date_' . $newspost['id']}}">新增日期</label>
                                <input name="{{'create_date_' . $newspost['id']}}" type="text" class="form-control-plaintext" id="{{'create_date_' . $newspost['id']}}" value="{{$newspost['create_at']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'updated_at_' . $newspost['id']}}">修改日期</label>
                                <input name="{{'updated_at_' . $newspost['id']}}" type="text" class="form-control-plaintext" id="{{'updated_at_' . $newspost['id']}}" value="{{$newspost['updated_at']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'title_' . $newspost['id']}}">標題</label>
                                <input name="{{'title_' . $newspost['id']}}" type="text" class="form-control-plaintext" id="{{'title_' . $newspost['id']}}" value="{{$newspost['title']}}" readonly>                    
                            </div>
                            <div class="text_input_box">
                                <label for="type">分類</label>
                                <select name='type' value="{{$newspost['type']}}" disabled>
                                    <option value=1>一般公告</option>
                                    <option value=2>季節促銷</option>
                                    <option value=3>產品新聞</option>
                                    <option value=0>其他</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="box_btn_wrap_r_l">
                            <form method='GET' action="{{ route('newsposts_edit', ['id' => $newspost['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_t color_g">編輯</button>
                            </form>
                            <form method='POST' action="{{ route('newsposts_delete', ['id' => $newspost['id']] ) }}" class="box_btn">
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

    <div class="manage_content_r ">
        @yield('content2')
    </div>

    
</div>

@endsection
