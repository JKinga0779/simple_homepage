@extends('managements.newsposts')

@section('content2')

<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js">
    CKEDITOR.replace('editor');
</script>

<div class="display_show">  
    <h1>編輯公告</h1>
    <form method='POST' action="{{ route('newsposts_update', ['id' => $newspost['id']]) }}" enctype="multipart/form-data">
        @csrf
        <div class="management_motify">
        <div>
            <div class="text_input_box">
                <label for="id">公告ID</label>
                <input name="id" type="text" class="form-control-plaintext" id="id" value="{{$newspost['id']}}" readonly/>
            </div>
            <div class="text_input_box">
                <label for="created_at">新增日期</label>
                <input name="created_at" type="text" class="form-control-plaintext" id="created_at" value="{{$newspost['created_at']}}" readonly/>
            </div>
            <div class="text_input_box">
                <label for="updated_at">修改日期</label>
                <input name="updated_at" type="text" class="form-control-plaintext" id="updated_at" value="{{$newspost['updated_at']}}" readonly/>
            </div>
            <div class="text_input_box">
                <label for="title">標題</label>
                <input name="title" type="text" class="form-control" id="title" value="{{$newspost['title']}}"/>
            </div>
            <div class="text_input_box">
                <label for="type">分類</label>
                <select name='type' value="{{$newspost['type']}}">
                    <option value=1>一般公告</option>
                    <option value=2>季節促銷</option>
                    <option value=3>產品新聞</option>
                    <option value=0>其他</option>
                </select>                            
            </div>
            <div class="text_input_box">
                <label for="content">內容</label>
                <textarea id="content" name='content' class="form-control" rows="20">{{$newspost['content']}}</textarea>
            </div>

        </div>
        
        <div class="box_btn_wrap_t_b">
            <button type='submit' class="box_btn b_b color_g" style="height: 40px;">儲存</button>
        </div> 
    </form>     

</div>

@endsection
