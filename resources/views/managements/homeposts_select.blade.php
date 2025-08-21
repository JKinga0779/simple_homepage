@extends('managements.homeposts')

@section('content2')
<script> 
    function changeExample(type) {  
        const btn_go = document.getElementById('btn_go');
        example_img.src= "/default_image/post_0"+type.value+"_example.png";         
        btn_go.setAttribute("href","/management/homeposts/add/"+type.value);
    }
</script>

<div class="display_show">
    <h1>新增首頁區塊</h1>
    <div class="management_motify">
        <div>
            <div class="text_input_box">
                <label for="post_type">區塊種類</label>
                <select id='post_type' name='post_type' onchange="changeExample(this)">
                    <option value=1 selected>1.標題+說明+3圖</option>
                    <option value=2>2.標題+說明+圖片/影片(+按鈕)</option>
                    <option value=3>3.標題+說明+按鈕</option>
                    <option value=4>4.滑動產品圖卡</option>
                    <option value=5>5.單一文字/圖片/影片</option>
                    <option value=6>6.標題+敘述</option>
                </select>                            
            </div>
        </div>
        <div class="example_img"> 
            <img id="example_img" src="/default_image/post_01_example.png" class="w-100"/>
        </div>
        <div class="box_btn b_b color_w box_btn_wrap_t_b btn_herf_wrap">
            <a id="btn_go" href="/management/homeposts/add/1" type="button" class="box_btn" style="height: 40px; color:black">下一步</a>                
        </div>
    </div> 
</div>
@endsection