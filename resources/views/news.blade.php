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

    <div class="content_news">
        
        <div class="btn_news_type_wrap">
            <!-- 0.其他 1.一般公告 2.季節促銷 3.產品新聞 -->
            <div class="btn_news_type">
                <a href="{{ route('news') }} " class="btn">全部</a>
            </div>
            <div class="btn_news_type">
                <a href="{{ route('news_page', ['now_page' => 1, 'type' => 1 ] ) }} " class="btn">一般公告</a>
            </div>
            <div class="btn_news_type">
                <a href="{{ route('news_page', ['now_page' => 1, 'type' => 2 ] ) }} " class="btn">季節優惠</a>
            </div>
            <div class="btn_news_type">
                <a href="{{ route('news_page', ['now_page' => 1, 'type' => 3 ] ) }} " class="btn">產品新聞</a>
            </div>
            <div class="btn_news_type">
                <a href="{{ route('news_page', ['now_page' => 1, 'type' => 0 ] ) }} " class="btn">其他消息</a>
            </div>
        </div>

        <section class="bg-light shadow p-0 rounded-2 container section_news">
            <ul class="list-group">
                @if($newsposts_count>0)   
                    @foreach($now_newsposts AS $now_newspost) 
                        <li class="list-group-item list_news">                
                            <a href="{{ route('news_detail', ['id' => $now_newspost['id'] ] ) }}">
                                <div class="news_select">
                                    <div>
                                        <p>{{$now_newspost['created_date']}}</p>
                                        <p>{{$now_newspost['title']}}</p>
                                    </div>
                                    @switch($now_newspost['type'])
                                        @case(0) 
                                            <p class="content_news_type" style="background-color: #556b2f;">其他消息</p>
                                            @break
                                        @case(1) 
                                            <p class="content_news_type" style="background-color: #6682b6;">一般公告</p>
                                            @break
                                        @case(2) 
                                            <p class="content_news_type" style="background-color: #e47c7c;">季節優惠</p>
                                            @break
                                        @case(3) 
                                            <p class="content_news_type" style="background-color: #e6a937;">產品新聞</p>
                                            @break
                                    @endswitch
                                </div>
                            </a>
                        </li>
                    @endforeach
                @else
                <div class="no_date" style="height: 200px;">
                    <h1>無資料</h1>
                </div>
                @endif                                

            </ul>        
        </section>

        @if($newsposts_count>0) 
        <div class="news_btn_bar">
            <div class="btn-toolbar mb-3" role="toolbar">
                <div class="btn-group me-2" role="group">                                                                    
                    @for($i=1;$i<=$pagesinfo['all_pages'];$i++)
                        @if( ($i==1) || ($i==$pagesinfo['all_pages']) || ($i>=($pagesinfo['now_page']-2)) && ($i<=($pagesinfo['now_page']+2)) )
                        <div class="btn btn-outline-secondary btn_pages_wrap btn_pages_col">
                            <a href="{{ route('news_page', ['now_page' => $i, 'type' => $type ] ) }}" class="btn">{{$i}}</a>
                        </div>
                        @elseif ( ($i==2) && ($pagesinfo['all_pages']-2>0) || 
                                  ($i==$pagesinfo['all_pages']-1) && ( ($pagesinfo['all_pages']-3)>$pagesinfo['now_page'] ) )
                            <button type="button" class="btn btn-outline-secondary btn_pages_col" disabled>...</button>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        @endif

    </div>
    
    
    <div style="height: 100px">
                
    </div>
    

</div>
@endsection
