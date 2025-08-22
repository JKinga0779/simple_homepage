@extends('layouts.app')

@section('content')
<div style="{{'background-color:' . $companyinfo['site_background_color']}}">    
    <div class="main_header">
        <div class="main_title">
            <h1>最新消息</h1>
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
       <div class="content_news_detail">       
            <h3>{{$newspost['title']}}</h3><br>

            {!!$newspost['content']!!}        
        
       </div>    
       <div class="content_news_date">         
            <p>發布日期： {{$newspost['created_at']}}</p>
            <p>最後編輯時間： {{$newspost['updated_at']}}</p>
       </div>
    </section>

    <div style="height: 100px">
        <div class="btn_back">
            <a href="{{ route('news') }}" class="">返回</a>
        </div>
    </div>
    
</div>
@endsection
