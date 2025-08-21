@extends('layouts.app')

@section('content')
<div style="{{'background-color:' . $companyinfo['site_background_color']}}">
    <div class="main_header">
        <div class="main_title">
            <h1>所有商品</h1>
        </div>
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

    <div class="products_wrap">
        <div class="search_bar_p">          
            <div class="search_tag_wrap_p">
                <span>商品類型</span>  
                @foreach($products_types AS $products_type)
                    <a href="/products/display/?products_type={{$products_type['id']}}" class="d-block">{{$products_type['name'] }}</a>
                @endforeach
                <a class='d-block' href='/products/display'>全部展開</a>
            </div>
        </div>

        <div class="products_display">
            @if($products_count!=0)
            @foreach($products AS $product)
            <a href="{{'/product/detail/' . $product['id']}}" class="product_card">
                <div class="product_card_bg" style="{{$product['bgimg_herf']}}">
                    @if(!empty($product['img_herf']))
                    <img src="{{'/storage/' . $product['img_herf']}}" class="product_card_img" alt="{{$product['name']}}">
                    @else
                    <img src="/default_image/products_default01.png" class="product_card_img" alt="{{$product['name']}}">
                    @endif 
                </div>
                <div class="product_textbox">
                    <div>
                        <p class="product_name">{{$product['name']}}</p>
                        <p class="product_tag">{{$product['type_name']}}</p>
                    </div>
                    <div class="product_price">                        
                        <p>
                            <sup>$</sup>
                            {{$product['retail_price']}}
                        </p>
                    </div>                    
                </div>
            </a>
            @endforeach
            @else
            <p></p>
            <div class="no_date">
                <h1>無商品資料</h1>
            </div>
            <p></p>
            @endif
            
        </div>
        
    </div>
    
    <div style="height: 100px">
                
    </div>

</div>


@endsection
