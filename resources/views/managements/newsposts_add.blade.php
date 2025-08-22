@extends('managements.newsposts')

@section('content2')
<script> 
    function addBtnEnable() {  
        const btn_add = document.getElementById('btn_add');
        if((document.getElementById("title").value.trim().length !== 0) &&
           (document.getElementById("content").value.trim().length !== 0)){
            btn_add.removeAttribute('disabled');
            btn_add.setAttribute("class","box_btn b_b color_g") 
        }else{
            btn_add.setAttribute('disabled',true);
            btn_add.setAttribute("class","box_btn");
        }   
    }
</script>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js">
    CKEDITOR.replace('content');
</script>

<div class="display_show">    
    <h1>新增公告</h1>
    <form method='POST' action="{{ route('newsposts_store') }}" enctype="multipart/form-data">
        @csrf
        <div class="management_motify">
        <div>
            <div class="text_input_box">
                <label for="title">標題</label>
                <input name="title" id="title" type="text" class="form-control" id="title" value="" oninput="addBtnEnable()"/>
            </div>
            <div class="text_input_box">
                <label for="type">分類</label>
                <select name='type'>
                    <option value=1>一般公告</option>
                    <option value=2>季節促銷</option>
                    <option value=3>產品新聞</option>
                    <option value=0>其他</option>
                </select>                            
            </div>
            <div class="text_input_box">
                <label for="content">內容</label>
                <textarea id="content" name='content' class="form-control" rows="20" value="" oninput="addBtnEnable()"></textarea>
            </div>
        </div>
        
        <div class="box_btn_wrap_t_b">
            <button disabled id="btn_add" type='submit' class="box_btn" style="height: 40px;">新增</button>
        </div> 
    </form>     

</div>

@endsection
