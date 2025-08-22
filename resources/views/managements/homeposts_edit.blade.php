@extends('managements.homeposts')

@section('content2')
<script> 
    function editBtnEnable($isimage,$pic_no,$post_t) {  
        const btn_edit = document.getElementById('btn_edit');
        switch($post_t){
            case 1:
                if((document.getElementById("title").value.trim().length !== 0) &&
                    (document.getElementById("content").value.trim().length !== 0) ){
                        btn_edit.removeAttribute('disabled');
                        btn_edit.setAttribute("class","box_btn b_b color_g") 
                    }else{
                        btn_edit.setAttribute('disabled',true);
                        btn_edit.setAttribute("class","box_btn");
                    }    
                break;

            case 2:                   
                const post2_type = document.getElementById('post2_type').value;    
                switch(post2_type){
                    case '1':
                        if((document.getElementById("title").value.trim().length !== 0) &&
                            (document.getElementById("content").value.trim().length !== 0) ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }        
                        break;
                    case '2':
                        if((document.getElementById("title").value.trim().length !== 0) &&
                            (document.getElementById("content").value.trim().length !== 0) &&
                            (document.getElementById("m_iframe").value.trim().length !== 0) ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }        
                        break;
                    case '3':
                        if((document.getElementById("title").value.trim().length !== 0) &&
                            (document.getElementById("content").value.trim().length !== 0) ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }  
                        break;
                }    
                break;    
            case 3:
                var btn_exits = false;
                for(var i=1;i<=6;i++){
                    if((document.getElementById("btn_text_"+i).value.trim().length !== 0) &&
                       (document.getElementById("btn_herf_"+i).value.trim().length !== 0)){
                            btn_exits = true;
                            break;
                    }                    
                }
                if((document.getElementById("title").value.trim().length !== 0) &&
                    (document.getElementById("content").value.trim().length !== 0) &&
                    btn_exits ){
                        btn_edit.removeAttribute('disabled');
                        btn_edit.setAttribute("class","box_btn b_b color_g") 
                    }else{
                        btn_edit.setAttribute('disabled',true);
                        btn_edit.setAttribute("class","box_btn");
                    }    
                break;   

            case 4:
                var productsID_exits = false;
                const card_type = document.getElementById('card_type').value;     
                switch(card_type){
                    case '1':
                        if((document.getElementById("title").value.trim().length !== 0) &&
                            (document.getElementById("product_range").value.trim().length !== 0)  ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }        
                        break;
                    case '2':                        
                        for(var i=1;i<=10;i++){
                            if(document.getElementById("product_id_"+String(i).padStart(2, "0")).value.trim().length !== 0){
                                    productsID_exits = true;
                                    break;
                            }                    
                        }
                        if((document.getElementById("title").value.trim().length !== 0) &&
                            productsID_exits ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }        
                        break;
                }    
                break;   
                
            case 5:             
                const post5_type = document.getElementById('background_type').value;        
                switch(post5_type){
                    case '1':
                        if((document.getElementById("title").value.trim().length !== 0) &&
                            (document.getElementById("content").value.trim().length !== 0)  ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }        
                        break;
                    case '2':
                        if((document.getElementById("title").value.trim().length !== 0)   ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }        
                        break;
                    case '3':
                        if((document.getElementById("title").value.trim().length !== 0)  ){
                            btn_edit.removeAttribute('disabled');
                            btn_edit.setAttribute("class","box_btn b_b color_g") 
                        }else{
                            btn_edit.setAttribute('disabled',true);
                            btn_edit.setAttribute("class","box_btn");
                        }  
                        break;
                }    
                break;  
            case 6:
                if((document.getElementById("title").value.trim().length !== 0) &&
                   (document.getElementById("content").value.trim().length !== 0) ){
                        btn_edit.removeAttribute('disabled');
                        btn_edit.setAttribute("class","box_btn b_b color_g") 
                    }else{
                        btn_edit.setAttribute('disabled',true);
                        btn_edit.setAttribute("class","box_btn");
                    }    
                break;  
        }
        if($isimage){
            $img_input_id = "image"+$pic_no;
            const preview_img = document.getElementById('preview_img'+$pic_no);
            if(document.getElementById($img_input_id).value.trim().length !== 0){
                preview_img.src=URL.createObjectURL(event.target.files[0]);
            }else{
                if($pic_no==41)
                    preview_img.src="/default_image/image_upload_card_bg.png"; 
                else if($pic_no%10!=0)
                    preview_img.src="/default_image/image_upload.png"; 
                else                
                    preview_img.src="/default_image/image_upload_post_bg.png"; 
            }         
        }  
    };
</script>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js">
    CKEDITOR.replace('content');
    CKEDITOR.replace('m_iframe');   
</script>
<div class="display_show">
    <h1>編輯首頁區塊</h1>
    @if($error_id)
    <div class="error_route">
        <h4  class="text-black-50">錯誤編輯代碼</h4>
    </div>
    @else
        <div class="management_motify">
            <div>
                <div class="text_input_box">
                    <label for="post_type">區塊種類</label>
                    <select id='post_type' name='post_type' value="{{$homepost['post_type']}}" disabled>
                        <option value=1>標題+說明+3圖</option>
                        <option value=2>標題+說明+圖片/影片(+按鈕)</option>
                        <option value=3>標題+說明+按鈕</option>
                        <option value=4>滑動產品圖卡</option>
                        <option value=5>單一圖片/影片/文字</option>
                        <option value=6>標題+敘述</option>
                    </select>                            
                </div>
            </div>
            <div class="example_img"> 
                <img id="example_img" src="{{'/default_image/post_0' . $homepost['post_type'] . '_example.png'}}"/>
            </div>
        </div> 
        <form method='POST' action="{{ route('homeposts_update', ['id' => $homepost['id']] ) }}" enctype="multipart/form-data">
            @csrf
            @switch($homepost['post_type'])
                @case(1)                    
                    <div class="management_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="title">標題</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$homepost['title']}}" onchange="editBtnEnable(false,0,1)"/>
                            </div>
                            <div class="text_input_box">
                                <label for="content">內容</label>
                                <textarea id="content" name='content' class="form-control" rows="10" value="{{$homepost['content']}}" onchange="editBtnEnable(false,0,1)"></textarea>
                            </div>
                            <hr>
                            <div class="colorpick_wrap">
                                <label  class="management_title" for="background_color">背景顏色</label>
                                <input type="color" id="background_color" name="background_color"  value="{{$homepost['background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="text_color">文字顏色</label>
                                <input type="color" id="text_color" name="text_color"  value="{{$homepost['text_color']}}" style="vertical-align: middle;"/>               
                                <label  class="management_title" for="circle_color">圓圈顏色</label>
                                <input type="color" id="circle_color" name="circle_color"  value="{{$homepost['circle_color']}}" style="vertical-align: middle;"/>                                                      
                                <label  class="management_title" for="circle_text_color">圓圈文字顏色</label>
                                <input type="color" id="circle_text_color" name="circle_text_color" value="{{$homepost['circle_text_color']}}" style="vertical-align: middle;"/>   
                                <label  class="management_title" for="btn_bg_color">按鈕顏色</label>
                                <input type="color" id="btn_bg_color" name="btn_bg_color"  value="{{$homepost['btn_bg_color']}}" style="vertical-align: middle;"/>     
                                <label  class="management_title" for="btn_text_color">按鈕文字顏色</label>
                                <input type="color" id="btn_text_color" name="btn_text_color"  value="{{$homepost['btn_text_color']}}" style="vertical-align: middle;"/>                         
                            </div>                            
                            <hr>
                            <p class="management_title">文字區塊位置</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_top" value="1" {{ $homepost['text_align'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_top">
                                        置頂
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_left" value="2" {{ $homepost['text_align'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_left">
                                        置左
                                    </label>
                                </div>
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_right" value="3" {{ $homepost['text_align'] == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_right">
                                        置右
                                    </label>
                                </div>  
                            </div>  
                            <hr>
                            <p class="management_title">按鈕設定</p>    
                            <p style="margin-left: 15px;">(需要文字連結都填寫才會顯示，不需要按鈕可空白)</p>   
                            <div>
                                @for( $i=1 ; $i <= 6 ; $i++ )     
                                <div class="btn_manage">
                                    <label for="{{'btn_text_' . $i}}">{{$i}}</label>
                                    <input name="{{'btn_text_' . $i}}" type="text" class="form-control" id="{{'btn_text_' . $i}}" value="{{$homepost['btn_text_' . $i]}}" placeholder="按鈕文字"/>                            
                                    <label for="{{'btn_herf_' . $i}}"></label>
                                    <input name="{{'btn_herf_' . $i}}" type="text" class="form-control" id="{{'btn_herf_' . $i}}" value="{{$homepost['btn_herf_' . $i]}}" placeholder="按鈕連結"/>
                                </div>                         
                                @endfor 
                            </div>                                                        
                            <p class="management_title">排列方式</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="btn_count" id="btn_count_odd" value="1" {{ $homepost['btn_count'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="btn_count_odd">
                                        一列
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="btn_count" id="btn_count_even" value="2" {{ $homepost['btn_count'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="btn_count_even">
                                        兩列
                                    </label>
                                </div>
                            </div> 
                            <hr>
                            <div class="text_input_box">
                                <label for="image11">圖一</label>
                                <input type="file" class="form-control-file" name='image11' id="image11" onchange="editBtnEnable(true,11,1)" accept="image/png, image/jpeg"/>  
                            </div>          
                            <div class="poster_img_preview">                
                                <img id="preview_img11" src="{{'/storage/' . $homepost['s_img_1']}}" class="w-50 mb-3"/>
                                <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                                <input name="img_title_11" type="text" class="form-control" id="img_title_11" value="{{$homepost['s_img_title_1']}}" placeholder="圖一敘述" />
                            </div>
                            <div class="text_input_box">
                                <label for="image12">圖二</label>
                                <input type="file" class="form-control-file" name='image12' id="image12" onchange="editBtnEnable(true,12,1)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="poster_img_preview">                
                                <img id="preview_img12" src="{{'/storage/' . $homepost['s_img_2']}}" class="w-50 mb-3"/>
                                <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                                <input name="img_title_12" type="text" class="form-control" id="img_title_12" value="{{$homepost['s_img_title_2']}}" placeholder="圖二敘述" />
                            </div>

                            <div class="text_input_box">
                                <label for="image13">圖三</label>
                                <input type="file" class="form-control-file" name='image13' id="image13" onchange="editBtnEnable(true,13,1)" accept="image/png, image/jpeg"/>  
                            </div>    
                            <div class="poster_img_preview">                
                                <img id="preview_img13" src="{{'/storage/' . $homepost['s_img_3']}}" class="w-50 mb-3"/>
                                <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                                <input name="img_title_13" type="text" class="form-control" id="img_title_13" value="{{$homepost['s_img_title_3']}}" placeholder="圖三敘述" />
                            </div>
                            <hr>              
                            <p class="management_title">區塊背景使用</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_color" value="1" {{ $homepost['background_type'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_color">
                                        背景顏色
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_img" value="2" {{ $homepost['background_type'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_img">
                                        背景圖片
                                    </label>
                                </div>
                            </div>  
                            <div class="text_input_box">
                                <label for="image10">背景圖片</label>
                                <input type="file" class="form-control-file" name='image10' id="image10" onchange="editBtnEnable(true,10,1)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="background_img_wrap"> 
                                @if($homepost['background_img']!="")
                                    <img id="preview_img10" src="{{'/storage/' . $homepost['background_img']}}" class="w-100 mb-3"/>
                                @else
                                    <img id="preview_img10" src="/default_image/image_upload_post_bg.png" class="w-100 mb-3"/>
                                @endif
                            </div> 
                            <hr>                                                              
                            <p class="management_title">是否顯示</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" {{ $homepost['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_1">
                                        顯示
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" {{ $homepost['status'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_2">
                                        隱藏
                                    </label>
                                </div>
                            </div>                      
                            <p style="text-align: right;">(重啟顯示會在最上面)</p>   
                        </div>
                        
                        <div class="box_btn_wrap_t_b">
                            <button id="btn_edit" type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                        </div> 
                    </div> 
                    @break
                @case(2)    
                    <div class="management_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="title">標題</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$homepost['title']}}" onchange="editBtnEnable(false,0,2)"/>
                            </div>
                            <div class="text_input_box">
                                <label for="content">內容</label>
                                <textarea id="content" name='content' class="form-control" rows="10" value="{{$homepost['content']}}" onchange="editBtnEnable(false,0,2)"></textarea>
                            </div>
                            <hr>
                            <div class="colorpick_wrap">
                                <label  class="management_title" for="background_color">背景顏色</label>
                                <input type="color" id="background_color" name="background_color"  value="{{$homepost['background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="text_color">文字顏色</label>
                                <input type="color" id="text_color" name="text_color"  value="{{$homepost['text_color']}}" style="vertical-align: middle;"/>                                           
                                <label  class="management_title" for="btn_bg_color">按鈕顏色</label>
                                <input type="color" id="btn_bg_color" name="btn_bg_color"  value="{{$homepost['btn_bg_color']}}" style="vertical-align: middle;"/>     
                                <label  class="management_title" for="btn_text_color">按鈕文字顏色</label>
                                <input type="color" id="btn_text_color" name="btn_text_color"  value="{{$homepost['btn_text_color']}}" style="vertical-align: middle;"/>                         
                            </div>
                            <hr>
                            <p class="management_title">文字區塊位置</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_top" value="1" {{ $homepost['text_align'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_top">
                                        置頂
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_left" value="2" {{ $homepost['text_align'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_left">
                                        置左
                                    </label>
                                </div>
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_right" value="3" {{ $homepost['text_align'] == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_right">
                                        置右
                                    </label>
                                </div>  
                            </div>  
                            <hr>
                            <p class="management_title">按鈕設定</p>    
                            <p style="margin-left: 15px;">(需要文字連結都填寫才會顯示，不需要按鈕可空白)</p>   
                            <div>
                                @for( $i=1 ; $i <= 6 ; $i++ )     
                                <div class="btn_manage">
                                    <label for="{{'btn_text_' . $i}}">{{$i}}</label>
                                    <input name="{{'btn_text_' . $i}}" type="text" class="form-control" id="{{'btn_text_' . $i}}" value="{{$homepost['btn_text_' . $i]}}" placeholder="按鈕文字"/>                            
                                    <label for="{{'btn_herf_' . $i}}"></label>
                                    <input name="{{'btn_herf_' . $i}}" type="text" class="form-control" id="{{'btn_herf_' . $i}}" value="{{$homepost['btn_herf_' . $i]}}" placeholder="按鈕連結"/>
                                </div>                         
                                @endfor                              
                            </div>                                                     
                            <p class="management_title">排列方式</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="btn_count" id="btn_count_odd" value="1" {{ $homepost['btn_count'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="btn_count_odd">
                                        一列
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="btn_count" id="btn_count_even" value="2" {{ $homepost['btn_count'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="btn_count_even">
                                        兩列
                                    </label>
                                </div>
                            </div> 
                            <hr>
                            <div class="text_input_box">
                                <label for="post2_type">媒體種類</label>
                                <select id='post2_type' name='post2_type' value="{{$homepost['m_media_type']}}" disabled>
                                    <option value=1 >圖片(上傳)</option>
                                    <option value=2 >影片(youtube連結)</option>
                                    <option value=3 >影片(上傳)</option>
                                </select>                            
                            </div>
                            @switch($homepost['m_media_type'])
                                @case(1)
                                    <div id="post_02_01" >
                                        <div class="text_input_box">
                                            <label for="image21">上傳圖片</label>
                                            <input type="file" class="form-control-file" name='image21' id="image21" onchange="editBtnEnable(true,21,2)" accept="image/png, image/jpeg"/>  
                                        </div>  
                                        <div class="poster_img_preview">                
                                            <img id="preview_img21"  src="{{'/storage/' . $homepost['m_img']}}" class="w-50 mb-3"/>
                                            <p style="text-align: right;">(建議圖片比例: 150*150)</p>
                                            <input name="m_img_title" type="text" class="form-control" id="m_img_title" value="{{$homepost['m_media_title']}}" placeholder="圖片備註" />
                                        </div>
                                    </div>
                                    @break
                                @case(2)
                                    <div id="post_02_02">
                                        <div class="text_input_box">
                                            <label for="m_iframe">youtube</label>
                                            <textarea id="m_iframe" name='m_iframe' class="form-control" rows="10" value="{{$homepost['m_iframe']}}" placeholder="輸入youtube內嵌代碼" onchange="addBtnEnable(false,22,2)"></textarea>                                  
                                            <label for="m_iframe_title"></label>
                                            <input name="m_iframe_title" type="text" class="form-control" id="m_iframe_title" value="{{$homepost['m_media_title']}}" placeholder="影片備註"/>   
                                        </div>
                                    </div>
                                    @break
                                @case(3)
                                    <div id="post_02_03">
                                        <div class="poster_img_preview">
                                            <label for="m_video">上傳影片</label>
                                            <input type="file" class="form-control-file" name='m_video' id="m_video" onchange="editBtnEnable(false,23,2)" accept="video/mp4"/>                                
                                            <input name="m_video_title" type="text" class="form-control" id="m_video_title" value="{{$homepost['m_media_title']}}" placeholder="影片備註" />                                                                             
                                            <label for="m_video_old">原影片</label>
                                            <input name="m_video_old" type="text" class="form-control-plaintext" id="m_video_old" value="{{$homepost['m_video']}}" placeholder="原影片" readonly/> 
                                        </div>  
                                    </div>
                                    @break
                            @endswitch
                            <hr>              
                            <p class="management_title">區塊背景使用</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_color" value="1" {{ $homepost['background_type'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_color">
                                        背景顏色
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_img" value="2" {{ $homepost['background_type'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_img">
                                        背景圖片
                                    </label>
                                </div>
                            </div>  
                            <div class="text_input_box">
                                <label for="image20">背景圖片</label>
                                <input type="file" class="form-control-file" name='image20' id="image20" onchange="editBtnEnable(true,20,2)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="background_img_wrap"> 
                                @if($homepost['background_img']!="")
                                    <img id="preview_img20" src="{{'/storage/' . $homepost['background_img']}}" class="w-100 mb-3"/>
                                @else
                                    <img id="preview_img20" src="/default_image/image_upload_post_bg.png" class="w-100 mb-3"/>
                                @endif
                            </div> 
                            <hr>                                                              
                            <p class="management_title">是否顯示</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" {{ $homepost['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_1">
                                        顯示
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" {{ $homepost['status'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_2">
                                        隱藏
                                    </label>
                                </div>
                            </div>                      
                            <p style="text-align: right;">(重啟顯示會在最上面)</p>   
                        </div>

                        <div class="box_btn_wrap_t_b">
                            <button id="btn_edit" type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                        </div> 
                    </div> 
                    @break

                @case(3)                    
                    <div class="management_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="title">標題</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$homepost['title']}}" onchange="editBtnEnable(false,0,3)"/>
                            </div>
                            <div class="text_input_box">
                                <label for="content">內容</label>
                                <textarea id="content" name='content' class="form-control" rows="10" value="{{$homepost['content']}}" onchange="editBtnEnable(false,0,3)"></textarea>
                            </div>
                            <hr>
                            <div class="colorpick_wrap">
                                <label  class="management_title" for="background_color">背景顏色</label>
                                <input type="color" id="background_color" name="background_color"  value="{{$homepost['background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="text_color">文字顏色</label>
                                <input type="color" id="text_color" name="text_color"  value="{{$homepost['text_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="btn_bg_color">按鈕顏色</label>
                                <input type="color" id="btn_bg_color" name="btn_bg_color"  value="{{$homepost['btn_bg_color']}}" style="vertical-align: middle;"/>     
                                <label  class="management_title" for="btn_text_color">按鈕文字顏色</label>
                                <input type="color" id="btn_text_color" name="btn_text_color"  value="{{$homepost['btn_text_color']}}" style="vertical-align: middle;"/>                         
                            </div>
                            <hr>
                            <p class="management_title">文字區塊位置</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_top" value="1" {{ $homepost['text_align'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_top">置頂</label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_left" value="2" {{ $homepost['text_align'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_left">置左</label>
                                </div>
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="text_align" id="show_right" value="3" {{ $homepost['text_align'] == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="show_right">置右</label>
                                </div>  
                            </div>  
                            <hr>
                            <p class="management_title">按鈕設定</p>    
                            <p style="margin-left: 15px;">(需要文字連結都填寫才會顯示，不需要按鈕可空白)</p>   
                            <div>
                                @for( $i=1 ; $i <= 6 ; $i++ )     
                                <div class="btn_manage">
                                    <label for="{{'btn_text_' . $i}}">{{$i}}</label>
                                    <input name="{{'btn_text_' . $i}}" type="text" class="form-control" id="{{'btn_text_' . $i}}" value="{{$homepost['btn_text_' . $i]}}" placeholder="按鈕文字" onchange="editBtnEnable(false,0,3)"/>                            
                                    <label for="{{'btn_herf_' . $i}}"></label>
                                    <input name="{{'btn_herf_' . $i}}" type="text" class="form-control" id="{{'btn_herf_' . $i}}" value="{{$homepost['btn_herf_' . $i]}}" placeholder="按鈕連結" onchange="editBtnEnable(false,0,3)"/>
                                </div>                         
                                @endfor
                            </div>                                   
                            <p class="management_title">排列方式</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="btn_count" id="btn_count_odd" value="1" {{ $homepost['btn_count'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="btn_count_odd">
                                        一列
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="btn_count" id="btn_count_even" value="2" {{ $homepost['btn_count'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="btn_count_even">
                                        兩列
                                    </label>
                                </div>
                            </div> 
                            <hr>              
                            <p class="management_title">區塊背景使用</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_color" value="1" {{ $homepost['background_type'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_color">
                                        背景顏色
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_img" value="2" {{ $homepost['background_type'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_img">
                                        背景圖片
                                    </label>
                                </div>
                            </div>  
                            <div class="text_input_box">
                                <label for="image30">背景圖片</label>
                                <input type="file" class="form-control-file" name='image30' id="image30" onchange="editBtnEnable(true,30,3)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="background_img_wrap"> 
                                @if($homepost['background_img']!="")
                                    <img id="preview_img30" src="{{'/storage/' . $homepost['background_img']}}" class="w-100 mb-3"/>
                                @else
                                    <img id="preview_img30" src="/default_image/image_upload_post_bg.png" class="w-100 mb-3"/>
                                @endif
                            </div> 
                            <hr>                                                              
                            <p class="management_title">是否顯示</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" {{ $homepost['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_1">
                                        顯示
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" {{ $homepost['status'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_2">
                                        隱藏
                                    </label>
                                </div>
                            </div>                      
                            <p style="text-align: right;">(重啟顯示會在最上面)</p>   
                        </div>

                        <div class="box_btn_wrap_t_b">
                            <button id="btn_edit" type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                        </div> 
                    </div> 
                    @break

                @case(4)
                    <div class="management_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="title">標題</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$homepost['title']}}" onchange="addBtnEnable(false,0,4)"/>
                            </div>
                            <hr>
                            <div class="colorpick_wrap">
                                <label  class="management_title" for="background_color">背景顏色</label>
                                <input type="color" id="background_color" name="background_color" value="{{$homepost['background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="text_color">文字顏色</label>
                                <input type="color" id="text_color" name="text_color" value="{{$homepost['text_color']}}" style="vertical-align: middle;"/>         
                                <label  class="management_title" for="btn_bg_color">按鈕顏色</label>
                                <input type="color" id="btn_bg_color" name="btn_bg_color" value="{{$homepost['btn_bg_color']}}" style="vertical-align: middle;"/>     
                                <label  class="management_title" for="btn_text_color">按鈕文字顏色</label>
                                <input type="color" id="btn_text_color" name="btn_text_color" value="{{$homepost['btn_text_color']}}" style="vertical-align: middle;"/>  
                                <label  class="management_title" for="card_background_color">卡片顏色</label>
                                <input type="color" id="card_background_color" name="card_background_color" value="{{$homepost['card_background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="card_text_color">卡片文字顏色</label>
                                <input type="color" id="card_text_color" name="card_text_color" value="{{$homepost['card_text_color']}}" style="vertical-align: middle;"/>
                            </div>                       
                            <hr>
                            <div class="text_input_box">
                                <label for="card_type">顯示商品</label>
                                <select id='card_type' name='card_type' value="{{$homepost['card_type']}}" disabled>
                                    <option value=1>條件產生</option>
                                    <option value=2>手動填入(最大10個)</option>
                                </select>                            
                            </div>
                            <hr>
                            @switch($homepost['card_type'])
                                @case(1)
                                    <div id="post_04_01">
                                        <div class="text_input_box">
                                            <label for="product_typeid_1">限定類別</label>
                                            <select id='product_typeid_1' name='product_typeid_1' value="{{$homepost['product_typeid_1']}}">
                                                <option value=0>未分類</option>
                                                @if($products_types_count>0)
                                                    @foreach($products_types AS $products_type)                     
                                                        <option value={{$products_type['id']}}>{{$products_type['name']}}</option>
                                                    @endforeach
                                                @endif
                                                <option value="">不限類別</option>
                                            </select>                            
                                        </div>
                                        <div class="text_input_box">
                                            <label for="product_orderby">依此排列</label>
                                            <select id='product_orderby' name='product_orderby' value="{{$homepost['product_orderby']}}">
                                                <option value="id">商品ID</option>       
                                                <option value="retail_price">零售價</option>          
                                                <option value="factory_price">出廠價</option>         
                                                <option value="special_price">特價</option>      
                                                <option value="stores_num">庫存量</option>         
                                                <option value="sales_num">銷售量</option>   
                                                <option value="discount">折扣率</option>     
                                                <option value="created_at">創建時間</option>  
                                            </select>                            
                                        </div>
                                        <div class="text_input_box">
                                            <label for="product_range">範圍</label>
                                            <input name="product_range" type="number" class="form-control" id="product_range" value="{{$homepost['product_range']}}" min="1" onkeyup="value=value.replace(/[^\d]/g,'').replace(/^0{1,''}/g,'')" onchange="editBtnEnable(false,0,4)"/>
                                        </div>
                                        <p class="management_title">排列方式</p>                 
                                        <div class="checkbox_selector">
                                            <div class="form-check checkbox_selector_check">
                                                <input class="form-check-input" type="radio" name="product_DESC_ASC" id="product_DESC" value="1"  {{ $homepost['product_DESC_ASC'] == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="product_DESC">
                                                    降序
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="product_DESC_ASC" id="product_ASC" value="2"  {{ $homepost['product_DESC_ASC'] == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="product_ASC">
                                                    升序
                                                </label>
                                            </div>  
                                        </div>                             
                                    </div>
                                    @break
                                @case(2)
                                    <div id="post_04_02">
                                        <p class="management_title">商品ID</p>  
                                        @for( $i=1 ; $i <= 10 ; $i++ )                                       
                                            <div class="text_input_box">
                                                <label for="{{'product_id_' . @str_pad($i,2,'0',STR_PAD_LEFT)}}">{{$i}}</label>
                                                <input name="{{'product_id_' . @str_pad($i,2,'0',STR_PAD_LEFT)}}" type="text" class="form-control" id="{{'product_id_' . @str_pad($i,2,'0',STR_PAD_LEFT)}}" value="{{$homepost['product_id_' . @str_pad($i,2,'0',STR_PAD_LEFT)]}}" placeholder="輸入商品ID" onchange="editBtnEnable(false,0,4)"/>
                                            </div>                                
                                        @endfor
                                    </div>
                                    @break
                            @endswitch
                            <hr>
                            <p class="management_title">卡片背景</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="card_background_type" id="card_background_type_product" value="1" {{ $homepost['card_background_type'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="card_background_type_product">
                                        卡片顏色
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="card_background_type" id="card_background_type_this" value="2" {{ $homepost['card_background_type'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="card_background_type_this">
                                        圖片(上傳)
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="card_background_type" id="card_background_type_product" value="3" {{ $homepost['card_background_type'] == 3 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="card_background_type_product">
                                        商品個別設定
                                    </label>
                                </div>
                            </div> 
                                                        
                            <div class="text_input_box">
                                <label for="image41">背景上傳</label>
                                <input type="file" class="form-control-file" name='image41' id="image41" onchange="editBtnEnable(true,41,4)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="img_preview_post04_cbg">                
                                @if($homepost['card_background_img']!="")
                                    <img id="preview_img41" src="{{'/storage/' . $homepost['card_background_img']}}" class="w-100 mb-3"/>
                                @else
                                    <img id="preview_img41" src="/default_image/image_upload_card_bg.png" class="w-100 mb-3"/>
                                @endif                                
                                <p style="text-align: right;">(建議圖片比例: 300*400)</p>
                            </div>
                            <hr>              
                            <p class="management_title">區塊背景使用</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_color" value="1" {{ $homepost['background_type'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_color">
                                        背景顏色
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_img" value="2" {{ $homepost['background_type'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_img">
                                        背景圖片
                                    </label>
                                </div>
                            </div>  
                            <div class="text_input_box">
                                <label for="image40">背景圖片</label>
                                <input type="file" class="form-control-file" name='image40' id="image40" onchange="editBtnEnable(true,40,4)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="background_img_wrap"> 
                                @if($homepost['background_img']!="")
                                    <img id="preview_img40" src="{{'/storage/' . $homepost['background_img']}}" class="w-100 mb-3"/>
                                @else
                                    <img id="preview_img40" src="/default_image/image_upload_post_bg.png" class="w-100 mb-3"/>
                                @endif
                            </div>   
                            <hr>                                                              
                            <p class="management_title">是否顯示</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" {{ $homepost['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_1">
                                        顯示
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" {{ $homepost['status'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_2">
                                        隱藏
                                    </label>
                                </div>
                            </div>                      
                            <p style="text-align: right;">(重啟顯示會在最上面)</p>                        
                        </div>    

                        <div class="box_btn_wrap_t_b">
                            <button id="btn_edit" type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                        </div>                 
                    </div>
                    @break
                @case(5)
                    <div class="management_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="background_type">內容種類</label>
                                <select id='background_type' name='background_type' value="{{$homepost['background_type']}}" disabled>
                                    <option value=1 >1.文字</option>
                                    <option value=2 >2.圖片</option>
                                    <option value=3 >3.影片</option>
                                </select>                            
                            </div>
                            <hr>                            
                            <div class="colorpick_wrap">
                                <label  class="management_title" for="background_color">背景顏色</label>
                                <input type="color" id="background_color" name="background_color" value="{{$homepost['background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="text_color">文字顏色</label>
                                <input type="color" id="text_color" name="text_color" value="{{$homepost['text_color']}}" style="vertical-align: middle;"/>                        
                            </div>
                            <hr>
                            <div class="text_input_box">
                                <label for="title">區塊名稱</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$homepost['title']}}" placeholder="必填、不顯示" onchange="editBtnEnable(false,0,5)"/>
                            </div>
                            <div class="text_input_box">
                                <label for="background_herf">連結網址</label>
                                <input name="background_herf" type="text" class="form-control" id="background_herf" value="{{$homepost['background_herf']}}" placeholder="點選此區塊用連結(可不填)"/>
                            </div>
                            @switch($homepost['background_type'])
                                @case(1)
                                    <div id="post_05_01">
                                        <div class="text_input_box">
                                            <label for="content">顯示文字</label>
                                            <textarea id="content" name='content' class="form-control" rows="5" onchange="editBtnEnable(false,51,5)">{{$homepost['content']}}</textarea>
                                        </div>
                                    </div>
                                    @break
                                @case(2)
                                    <div id="post_05_02">
                                        <div class="text_input_box">
                                            <label for="image52">上傳圖片</label>
                                            <input type="file" class="form-control-file" name='image52' id="image52" onchange="editBtnEnable(true,52,5)" accept="image/png, image/jpeg"/>  
                                        </div>  
                                        <div class="poster_img_preview">                
                                            <img id="preview_img52" src="{{'/storage/' . $homepost['background_img']}}" class="w-50 mb-3"/>
                                            <p style="text-align: right;">(圖片依寬度填滿畫面)</p>
                                            <input name="m_img_title" type="text" class="form-control" id="m_img_title" value="{{$homepost['m_media_title']}}" placeholder="圖片備註" />
                                        </div>
                                    </div>
                                    @break
                                @case(3)
                                    <div id="post_05_03">
                                        <div class="text_input_box">
                                            <label for="background_video">上傳影片</label>
                                            <input type="file" class="form-control-file" name='background_video' id="background_video" onchange="editBtnEnable(false,53,5)" accept="video/mp4"/>                                
                                            <label for="m_video_old">原影片</label>
                                            <input name="m_video_old" type="text" class="form-control-plaintext" id="m_video_old" value="{{$homepost['background_video']}}" placeholder="原影片" readonly/> 
                                        </div>
                                        <p style="text-align: right;">(.mp4)(影片依寬度填滿畫面)</p> 
                                    </div>  
                                    @break
                            @endswitch  
                            <hr>                                                              
                            <p class="management_title">是否顯示</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" {{ $homepost['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_1">
                                        顯示
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" {{ $homepost['status'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_2">
                                        隱藏
                                    </label>
                                </div>
                            </div>                      
                            <p style="text-align: right;">(重啟顯示會在最上面)</p>                   
                        </div>    

                        <div class="box_btn_wrap_t_b">
                            <button id="btn_edit" type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                        </div>                 
                    </div>
                    @break
                @case(6)
                    <div class="management_motify">
                        <div>
                            <div class="text_input_box">
                                <label for="title">標題</label>
                                <input name="title" type="text" class="form-control" id="title" value="{{$homepost['title']}}" onchange="editBtnEnable(false,0,6)"/>
                            </div>
                            <div class="text_input_box">
                                <label for="content">內容</label>
                                <textarea id="content" name='content' class="form-control" rows="10" onchange="editBtnEnable(false,0,6)">{{$homepost['content']}}</textarea>
                            </div>
                            <hr>
                            <p class="management_title">區塊背景使用</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_color" value="1" {{ $homepost['background_type'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_color">
                                        背景顏色
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="background_type" id="background_type_img" value="2" {{ $homepost['background_type'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="background_type_img">
                                        背景圖片
                                    </label>
                                </div>
                            </div>  
                            <hr>
                            <div class="colorpick_wrap">
                                <label  class="management_title" for="background_color">背景顏色</label>
                                <input type="color" id="background_color" name="background_color" value="{{$homepost['background_color']}}" style="vertical-align: middle;"/>
                                <label  class="management_title" for="text_color">文字顏色</label>
                                <input type="color" id="text_color" name="text_color" value="{{$homepost['text_color']}}" style="vertical-align: middle;"/>   
                            </div>
                            <hr>              
                            <div class="text_input_box">
                                <label for="image60">背景圖片</label>
                                <input type="file" class="form-control-file" name='image60' id="image60" onchange="editBtnEnable(true,60,6)" accept="image/png, image/jpeg"/>  
                            </div>  
                            <div class="background_img_wrap">
                                @if($homepost['background_img']!="")
                                    <img id="preview_img60" src="{{'/storage/' . $homepost['background_img']}}" class="w-100 mb-3"/>
                                @else
                                    <img id="preview_img60" src="/default_image/image_upload_post_bg.png" class="w-100 mb-3"/>
                                @endif
                            </div> 
                            <hr>                                                              
                            <p class="management_title">是否顯示</p>                 
                            <div class="checkbox_selector">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="status_1" value="1" {{ $homepost['status'] == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_1">
                                        顯示
                                    </label>
                                </div>  
                                <div class="form-check checkbox_selector_check">
                                    <input class="form-check-input" type="radio" name="status" id="status_2" value="2" {{ $homepost['status'] == 2 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_2">
                                        隱藏
                                    </label>
                                </div>
                            </div>                      
                            <p style="text-align: right;">(重啟顯示會在最上面)</p>                            
                        </div>
                        <div class="box_btn_wrap_t_b">
                            <button id="btn_edit" type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                        </div>                               
                    </div>
                    @break
            @endswitch

        </form>    
        
        
    @endif
    
    
</div>
@endsection