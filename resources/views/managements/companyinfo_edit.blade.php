@extends('layouts.management')

@section('content1')
<script> 
    function preview($pic_no) {
        // switch($pic_no){
        //     case 1:
        //         preview_logo1.src=URL.createObjectURL(event.target.files[0]);
        //         break;
        //     case 2:
        //         preview_logo2.src=URL.createObjectURL(event.target.files[0]);
        //         break;
        // }     

        // if($isimage){
            $img_input_id = "logo_img_"+$pic_no;
            const preview_img = document.getElementById('preview_logo'+$pic_no);
            if(document.getElementById($img_input_id).value.trim().length !== 0){
                preview_img.src=URL.createObjectURL(event.target.files[0]);
            }else{
                // if($pic_no==41)
                //     preview_img.src="/default_image/card_default01.png"; 
                // else if($pic_no%10!=0)
                //     preview_img.src="/default_image/image_upload.png"; 
                // else                
                    preview_img.src="/default_image/image_upload.png"; 
            }         
        // }  
    }
</script>
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js">    
    CKEDITOR.replace('content');
    CKEDITOR.replace('note');
</script>
<div class="manage_content">    
    <div class="manage_content_l scrollbar_hidden">
        <h1>公司基本資訊</h1>
        <div class="btn_herf_wrap">
            <a href="\management\companyinfo\header" class="btn_herf">頁首圖片編輯</a>
        </div>
        <div class="content_1">        
            <form method='POST' action="{{ route('companyinfo_update', ['id' => $companyinfo['id']] ) }}" enctype="multipart/form-data">
                @csrf
                <div class="management_motify">
                    <div>
                        <div class="text_input_box">
                            <label for="company_id">統一編號</label>
                            <input name="company_id" type="text" class="form-control" id="company_id" value="{{$companyinfo['company_id']}}"/>
                        </div>
                        <div class="text_input_box">
                            <label for="name_full">全名</label>
                            <input name='name_full' type="text" class="form-control" id="name_full" value="{{$companyinfo['name_full']}}"/>
                        </div>
                        <div class="text_input_box">
                            <label for="name_short">簡稱</label>
                            <input name='name_short' type="text" class="form-control" id="name_short" value="{{$companyinfo['name_short']}}"/>                    
                        </div>
                        <div class="text_input_box">
                            <label for="name_eng">英文名稱</label>
                            <input name='name_eng' type="text" class="form-control" id="name_eng" value="{{$companyinfo['name_eng']}}"/>                    
                        </div>
                        <div class="text_input_box">
                            <label for="address_1">地址1</label>
                            <input name='address_1' type="text" class="form-control" id="address_1" value="{{$companyinfo['address_1']}}"/>
                        </div>            
                        <div class="text_input_box">
                            <label for="address_2">地址2</label>
                            <input name='address_2' type="text" class="form-control" id="address_2" value="{{$companyinfo['address_2']}}"/>
                        </div>       
                        <div class="text_input_box">
                            <label for="tel_num_1">電話1</label>
                            <input name='tel_num_1' type="text" class="form-control" id="tel_num_1" value="{{$companyinfo['tel_num_1']}}"/>
                        </div>   
                        <div class="text_input_box">
                            <label for="tel_num_2">電話2</label>
                            <input name='tel_num_2' type="text" class="form-control" id="tel_num_2" value="{{$companyinfo['tel_num_2']}}"/>
                        </div> 
                        <div class="text_input_box">
                            <label for="email">Email</label>
                            <input name='email' type="text" class="form-control" id="email" value="{{$companyinfo['email']}}"/>
                        </div> 
                    
                        <div class="text_input_box">
                            <label for="content">公司介紹</label>
                            <textarea id="content" name='content' class="form-control" rows="10">{{$companyinfo['content']}}</textarea>
                        </div>

                        <div class="text_input_box">
                            <label for="note">頁尾註記</label>
                            <textarea id="note" name='note' class="form-control" rows="5">{{$companyinfo['note']}}</textarea>
                        </div>

                        <div class="text_input_box">
                        <label class="management_title" for="site_background_color">網站背景顏色</label>
                        <input type="color" id="site_background_color" name="site_background_color" value="{{$companyinfo['site_background_color']}}" style="vertical-align: middle;"/>
                        </div>                         
                        <div class="text_input_box">
                        <p class="management_title">網站導覽列</p>                 
                        <div class="checkbox_selector">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="nav_color" id="nav_color_light" value="1" {{ $companyinfo['nav_color'] == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="nav_color_light">
                                    白色
                                </label>
                            </div>  
                            <div class="form-check checkbox_selector_check">
                                <input class="form-check-input" type="radio" name="nav_color" id="nav_color_dark" value="2" {{ $companyinfo['nav_color'] == 2 ? 'checked' : '' }}>
                                <label class="form-check-label" for="nav_color_dark">
                                    黑色
                                </label>
                            </div>
                        </div>  
                        </div> 

                        <div class="text_input_box">
                            <label for="other_herf_1">外部連結 1</label>
                            <input name='other_herf_1' type="text" class="form-control" id="other_herf_1" value="{{$companyinfo['other_herf_1']}}"/>
                        </div> 
                        <div class="text_input_box">
                            <label for="other_herf_2">外部連結 2</label>
                            <input name='other_herf_2' type="text" class="form-control" id="other_herf_2" value="{{$companyinfo['other_herf_2']}}"/>
                        </div> 
                        <div class="text_input_box">
                            <label for="other_herf_3">外部連結 3</label>
                            <input name='other_herf_3' type="text" class="form-control" id="other_herf_3" value="{{$companyinfo['other_herf_3']}}"/>
                        </div> 
                        <div class="text_input_box">
                            <label for="other_herf_4">外部連結 4</label>
                            <input name='other_herf_4' type="text" class="form-control" id="other_herf_4" value="{{$companyinfo['other_herf_4']}}"/>
                        </div> 
                        <div class="text_input_box">
                            <label for="other_herf_5">外部連結 5</label>
                            <input name='other_herf_5' type="text" class="form-control" id="other_herf_5" value="{{$companyinfo['other_herf_5']}}"/>
                        </div> 

                        <div class="text_input_box">
                            <label for="logo_img_1">公司LOGO</label>
                            <input type="file" class="form-control-file" name='logo_img_1' id="logo_img_1" onchange="preview(1)"  accept="image/png, image/jpeg"/>  
                        </div>            
                        <div class="logo_wrap">                                                    
                            <div class="logo_preview">
                                <img id="preview_logo1" src="/default_image/image_upload.png" class="w-100 mb-3"/>
                            </div>
                            <div class="logo_preview">
                                <img src="{{'/storage/' . $companyinfo['logo_img_1']}}" class="w-100 mb-3"/>
                            </div>             
                            <p>(更改後LOGO)</p>
                            <p>(原有LOGO)</p>  
                        </div>

                        <div class="text_input_box">
                            <label for="logo_img_2">工具列LOGO</label>
                            <input type="file" class="form-control-file" name='logo_img_2' id="logo_img_2" onchange="preview(2)"  accept="image/png, image/jpeg"/>  
                        </div>            
                        <div class="logo_wrap">
                            <div class="logo_preview">
                                <img id="preview_logo2" src="/default_image/image_upload.png" class="w-100 mb-3"/>
                            </div>
                            <div class="logo_preview">
                                <img src="{{'/storage/' . $companyinfo['logo_img_2']}}" class="w-100 mb-3"/>
                            </div>       
                            <p>(更改後LOGO)</p>
                            <p>(原有LOGO)</p>
                        </div>
                    </div>                    
                    
                    <div class="box_btn_wrap_t_b">
                        <button type='submit' class="box_btn b_b color_g" style="height: 40px;">更新</button>
                    </div> 
                </div>
            
            </form>
        </div>    
    </div>

    <div class="manage_content_r ">
        @yield('content2')
    </div>

    
</div>

@endsection
