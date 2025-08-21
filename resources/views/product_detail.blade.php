@extends('layouts.app')

@section('content')
<div style="{{'background-color:' . $companyinfo['site_background_color']}}">
    
    <div class="main_header">
        @if($header_images_count>0)    
        <div id="carousel_header" class="carousel slide carousel-fade" data-bs-ride="carousel" style="z-index:1;">
            <div class="carousel-inner carousel_top">                            
                <div class="carousel-item carousel_top_img active">           
                    <label class="header_title">{{$header_images[0]['title']}}</label> 
                    <img src="{{'/storage/' . $header_images[0]['image']}}" class="d-block w-100" alt="{{$header_images[0]['title']}}">
                        
                </div>
            @for($i = 1; $i < $header_images_count; $i++)                 
                <div class="carousel-item carousel_top_img">
                    <label class="header_title">{{$header_images[$i]['title']}}</label>    
                    <img src="{{'/storage/' . $header_images[$i]['image']}}" class="d-block w-100" alt="{{$header_images[$i]['title']}}">                     
                </div>
            @endfor        
            </div>
        </div>  
        @else
        <div class="carousel_top_img"  style="background-color:gray;">
        </div>
        @endif
    </div>


    <section class="bg-light shadow p-0 rounded-2 container">
        <div class="product_detail_wrap">       
            
            <div class="product_detail_wrap_top">
                <div class="product_detail_img">
                    @if(!empty($product['img_herf']))
                    <img src="{{'/storage/' . $product['img_herf']}}" alt="{{$product['name']}}"/>
                    @else
                    <img src="/default_image/products_default01.png" alt="{{$product['name']}}"/>
                    @endif 
                </div>
                
                <div class="product_detail_top_text">
                    <p class="product_detail_name">{{$product['name']}}</p>
                    <p class="product_detail_type">{{$product['type_name']}}</p>
                    @if($product['special_price']!=0)
                        <div class="product_detail_price_sp" style="color: red;">
                            <sup>$</sup>
                                {{$product['special_price']}}
                            <sup>特價</sup>
                        </div>
                    @elseif(($product['discount']!=0)&&($product['discount']!=100))                                        
                        <div class="product_detail_price_dc_o">
                            <sup>$</sup>
                                <del>{{$product['retail_price']}}</del>                                           
                        </div>
                        <div class="product_detail_price_dc">
                            <sup>$</sup>
                                {{$product['retail_price']*$product['discount']/100}}
                            <sup>{{$product['discount']/10}}折</sup>
                        </div>
                    @else
                        <div class="product_detail_price">
                            <sup>$</sup>
                                {{$product['retail_price']}}                                                
                        </div>
                    @endif
                    @if($product['stores_num']!=0)
                        <p class="product_detail_stores">庫存量：{{$product['stores_num']}}</p>
                    @else
                        <p class="product_detail_stores_runout">庫存量：0</p>
                    @endif                    
                    <br>
                    <br>
                    <br>                    
                    <div class="product_detail_date">         
                        <p>發布時間： {{$product['create_at']}}</p>
                        <p>編輯時間： {{$product['updated_at']}}</p>
                    </div>
                </div>                
            </div>
            <hr>
            <div class="product_detail_wrap_content">
                {!!$product['content']!!}  
            </div>

            
        
        </div>    
    </section>

    <div style="height: 100px">
        <div class="btn_back">
            <a href="{{ route('products_display_all') }}" class="">返回</a>
        </div>
    </div>
    
</div>



@endsection
