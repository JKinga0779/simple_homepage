@extends('layouts.app')

@section('content')
<div style="{{'background-color:' . $companyinfo['site_background_color']}}">    
    <div class="main_header">
        <div class="main_title">
            <h1>品牌介紹</h1>
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

    <section class="bg-light shadow p-0 rounded-2 container section_companyinfo">
       <div class="content_companyinfo">        
            {!!$companyinfo['content']!!}        
       </div>    
    </section>
    <div style="height: 100px"></div>
    
</div>
@endsection
