@extends('layouts.app')

@section('content')
<div style="{{'background-color:' . $companyinfo['site_background_color']}}">
    @if($announcements_count>0)    
    <div id="announcement_top" class="carousel carousel-dark slide" data-bs-ride="carousel" >       
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#announcement_top" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            @for($i = 1; $i < $announcements_count; ++$i)                 
                <button type="button" data-bs-target="#announcement_top" data-bs-slide-to="{{$i}}" aria-label="{{'Slide ' . $i+1}}"></button>
            @endfor
        </div> 

        <div class="carousel-inner announcement_top" >
            @foreach($announcement_posts AS $announcements_post)
                @if($announcements_post['show_order']===1)
                    <div class="carousel-item announcement_top_img active">
                        @if(empty($announcements_post['herf']))
                        <img src="{{$announcements_post['image']}}" class="d-block w-100" alt="{{$announcements_post['title']}}">         
                        @else                    
                        <a href="{{$announcements_post['herf']}}">
                        <img src="{{$announcements_post['image']}}" class="d-block w-100" alt="{{$announcements_post['title']}}">
                        </a>   
                        @endif                    
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$announcements_post['title']}}</h5>
                            <p>{{$announcements_post['content']}}</p>
                        </div>
                    </div>
                @else
                    <div class="carousel-item announcement_top_img">                
                        @if(empty($announcements_post['herf']))
                        <img src="{{$announcements_post['image']}}" class="d-block w-100" alt="{{$announcements_post['title']}}">         
                        @else                    
                        <a href="{{$announcements_post['herf']}}">
                        <img src="{{$announcements_post['image']}}" class="d-block w-100" alt="{{$announcements_post['title']}}">
                        </a>   
                        @endif                    
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{$announcements_post['title']}}</h5>
                            <p>{{$announcements_post['content']}}</p>
                        </div>
                    </div>
                @endif
            @endforeach            
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#announcement_top" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#announcement_top" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif

    @foreach($homeposts AS $homepost)
        @switch($homepost['post_type'])
            @case(1)
                <div class="poster_01" style="{{ $homepost['bg_style'] }}">        
                    <div class="{{'poster_01' . $homepost['text_align_class']}}">                               
                        <div class="poster_01_text_wrap">
                            <h2>{{$homepost['title']}}</h2>
                            <div class="poster_01_content">
                                {!!$homepost['content']!!}
                            </div>
                            <div class="{{'poster_01_btn_wrap_' . $homepost['btn_count']}}">
                                @for( $i=1 ; $i <= 6 ; $i++ )       
                                    @if( !(empty($homepost['btn_text_' . $i])) && !(empty($homepost['btn_herf_' . $i])))                                                                 
                                    <a href="{{$homepost['btn_herf_' . $i]}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                        {{$homepost['btn_text_' . $i]}}
                                    </a>                                
                                    @endif
                                @endfor
                            </div>
                        </div>             
                        <div class="all_circle_wrap" >
                            @for( $i=1 ; $i <= $homepost['circle_count'] ; $i++ )
                            <div class="circle_wrap">   
                                <div class="circle rounded-circle" style="{{'background-color:' . $homepost['circle_color']}}">           
                                    <div class="poster_01_img_wrap" >        
                                        <img src="{{'/storage/' . $homepost['s_img_' . $i]}}" alt="...">
                                        <p>{{$homepost['s_img_title_' . $i]}}</p>
                                    </div>
                                </div>
                            </div>  
                            @endfor
                        </div>                                                    
                    </div>        
                </div>
                @break
            
            @case(2)                       
                <div class="poster_02" style="{{ $homepost['bg_style'] }}">
                    <div class="{{'poster_02' . $homepost['text_align_class']}}">                        
                        <div class="poster_02_items_wrap" >                                
                            @switch($homepost['m_media_type'])
                                @case(1) 
                                    <div class="poster_02_media1"> 
                                        <img src="{{'/storage/' . $homepost['m_img']}}" alt="{{$homepost['m_media_title']}}">                                    
                                    </div> 
                                    @break
                                @case(2)          
                                    <div class="poster_02_media2">                                               
                                        {!!$homepost['m_iframe']!!}    
                                    </div> 
                                    @break
                                @case(3)    
                                    <div class="poster_02_media2">                              
                                        <video autoplay loop muted controls>
                                            <source src="{{'/storage/' . $homepost['m_video']}}" type="video/mp4">
                                        </video>
                                    </div> 
                                    @break
                            @endswitch                                           
                            <p>{{$homepost['m_media_title']}}</p>
                        </div>   
                        <div class="poster_02_text_wrap">
                            <h2>{{$homepost['title']}}</h2>
                            <div class="poster_02_content">
                                {!!$homepost['content']!!}
                            </div>
                            <div class="{{'poster_02_btn_wrap_' . $homepost['btn_count']}}">
                                @for( $i=1 ; $i <= 6 ; $i++ )       
                                    @if( !(empty($homepost['btn_text_' . $i])) && !(empty($homepost['btn_herf_' . $i])))                                                                 
                                    <a href="{{$homepost['btn_herf_' . $i]}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                        {{$homepost['btn_text_' . $i]}}
                                    </a>                                
                                    @endif
                                @endfor
                            </div>
                        </div>        
                    </div>   
                </div>
                @break

            @case(3)
                <div class="poster_03" style="{{ $homepost['bg_style'] }}">
                    <div class="{{'poster_03' . $homepost['text_align_class']}}">  
                        <div class="poster_03_text_wrap">
                            <h2>{{$homepost['title']}}</h2>
                            <div class="poster_03_content">
                                {!!$homepost['content']!!}
                            </div>
                        </div>                                      
                        <div class="{{'poster_03_btn_wrap_' . $homepost['btn_count']}}">
                            @for( $i=1 ; $i <= 6 ; $i++ )       
                                @if( !(empty($homepost['btn_text_' . $i])) && !(empty($homepost['btn_herf_' . $i])))                                                                 
                                <a href="{{$homepost['btn_herf_' . $i]}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                    {{$homepost['btn_text_' . $i]}}
                                </a>                                
                                @endif
                            @endfor
                        </div>                               
                    </div>
                </div>
                @break

            @case(4)
                <div class="poster_04" style="{{ $homepost['bg_style'] }}">
                    <h1>{{$homepost['title']}}</h1>
                    <div>
                        @if($homepost['show_products_count_re']==0 && $homepost['show_products_count_de']==0)
                            <h2>無對應資料</h2>      
                        @else
                        <div id="{{'poster_04_bg_' . $homepost['id']}}" class="carousel slide poster_04_bg" data-bs-ride="carousel">
                            <div class="carousel-inner">                                
                                @for( $i=1 ; $i <= $homepost['show_products_count_de'] ; $i++ )                            
                                @if($i===1)
                                <div class="carousel-item active">                                    
                                    <div class="poster_04_card_wrapper">      
                                        @for( $j=1 ; $j <= $i*3 ; $j++ )                                         
                                        <div class="card text-dark">
                                            @if($homepost['card_background_type']==3)
                                                @if(!empty($homepost['show_products'][$j-1]['card_background_img_herf']))
                                                <img src="{{'/storage/' . $homepost['show_products'][$j-1]['card_background_img_herf']}}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                @else
                                                <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                @endif                                                
                                            @else
                                                <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">                                                
                                            @endif                                            
                                            <div class="card-img-overlay">
                                                @if(!empty($homepost['show_products'][$j-1]['img_herf']))
                                                <img src="{{'/storage/' . $homepost['show_products'][$j-1]['img_herf']}}">
                                                @else
                                                <img src="/default_image/products_default01.png">
                                                @endif 
                                                <h4 class="card-title" style="{{'color:' . $homepost['card_text_color'] }}">{{$homepost['show_products'][$j-1]['name']}}</h4>                                           
                                                <div class="poster_04_btn_wrap">                                                 
                                                    <a href="{{'/product/detail/' . $homepost['show_products'][$j-1]['id']}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                                        了解詳細
                                                    </a>     
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                                @else
                                <div class="carousel-item">                                    
                                    <div class="poster_04_card_wrapper">                                                
                                        @for( $j=($i-1)*3+1 ; $j <= $i*3 ; $j++ )                                         
                                        <div class="card text-dark">
                                            @if($homepost['card_background_type']==3)
                                                @if(!empty($homepost['show_products'][$j-1]['card_background_img_herf']))
                                                <img src="{{'/storage/' . $homepost['show_products'][$j-1]['card_background_img_herf']}}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                @else
                                                <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                @endif                                                
                                            @else
                                                <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">                                                
                                            @endif
                                            <div class="card-img-overlay">          
                                                @if(!empty($homepost['show_products'][$j-1]['img_herf']))
                                                <img src="{{'/storage/' . $homepost['show_products'][$j-1]['img_herf']}}">
                                                @else
                                                <img src="/default_image/products_default01.png">
                                                @endif 
                                                <h4 class="card-title" style="{{'color:' . $homepost['card_text_color'] }}">{{$homepost['show_products'][$j-1]['name']}}</h4>   
                                                <div class="poster_04_btn_wrap">                                                  
                                                    <a href="{{'/product/detail/' . $homepost['show_products'][$j-1]['id']}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                                        了解詳細
                                                    </a>     
                                                </div>
                                            </div>
                                        </div> 
                                        @endfor
                                    </div>
                                </div>
                                @endif  
                                @endfor      

                                @if($homepost['show_products_count_re']!=0)
                                    @if($homepost['show_products_count_de']==0)
                                    <div class="carousel-item active">                                    
                                        <div class="poster_04_card_wrapper">    
                                            @for( $j=1 ; $j <= $homepost['show_products_count'] ; $j++ )                                         
                                            <div class="card text-dark"  style="{{ $homepost['card_style'] }}">
                                                @if($homepost['card_background_type']==3)
                                                    @if(!empty($homepost['show_products'][$j-1]['card_background_img_herf']))
                                                    <img src="{{'/storage/' . $homepost['show_products'][$j-1]['card_background_img_herf']}}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @endif                                                
                                                @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">                                                
                                                @endif
                                                <div class="card-img-overlay">
                                                    @if(!empty($homepost['show_products'][$j-1]['img_herf']))
                                                    <img src="{{'/storage/' . $homepost['show_products'][$j-1]['img_herf']}}">
                                                    @else
                                                    <img src="/default_image/products_default01.png">
                                                    @endif 
                                                    <h4 class="card-title" style="{{'color:' . $homepost['card_text_color'] }}">{{$homepost['show_products'][$j-1]['name']}}</h4>  
                                                    <div class="poster_04_btn_wrap">                                                  
                                                        <a href="{{'/product/detail/' . $homepost['show_products'][$j-1]['id']}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                                            了解詳細
                                                        </a>     
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                    @else
                                    <div class="carousel-item">                                    
                                        <div class="poster_04_card_wrapper">                                                
                                            @for( $j=($homepost['show_products_count_de']*3)+1 ; $j <= $homepost['show_products_count'] ; $j++ )
                                            <div class="card text-dark"  style="{{ $homepost['card_style'] }}">
                                                @if($homepost['card_background_type']==3)
                                                    @if(!empty($homepost['show_products'][$j-1]['card_background_img_herf']))
                                                    <img src="{{'/storage/' . $homepost['show_products'][$j-1]['card_background_img_herf']}}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @endif                                                
                                                @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">                                                
                                                @endif
                                                <div class="card-img-overlay">
                                                    @if(!empty($homepost['show_products'][$j-1]['img_herf']))
                                                    <img src="{{'/storage/' . $homepost['show_products'][$j-1]['img_herf']}}">
                                                    @else
                                                    <img src="/default_image/products_default01.png">
                                                    @endif 
                                                    <h4 class="card-title" style="{{'color:' . $homepost['card_text_color'] }}">{{$homepost['show_products'][$j-1]['name']}}</h4>   
                                                    <div class="poster_04_btn_wrap">                                                  
                                                        <a href="{{'/product/detail/' . $homepost['show_products'][$j-1]['id']}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                                            了解詳細
                                                        </a>     
                                                    </div>
                                                </div>
                                            </div> 
                                            @endfor
                                        </div>
                                    </div>
                                    @endif 
                                @endif                                                       
                            </div>                        
                            <button class="carousel-control-prev" type="button" data-bs-target="{{'#poster_04_bg_' . $homepost['id']}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="{{'#poster_04_bg_' . $homepost['id']}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <div id="{{'poster_04_sm_' . $homepost['id']}}" class="carousel slide poster_04_sm" data-bs-ride="carousel">
                            <div class="carousel-inner">                                                                   
                                @for( $i=0 ; $i < $homepost['show_products_count'] ; $i++ )
                                    @if($i===0)
                                    <div class="carousel-item active">
                                        <div class="poster_04_card_wrapper">
                                            <div class="card text-dark">
                                                @if($homepost['card_background_type']==3)
                                                    @if($homepost['show_products'][$i]['card_background_img_herf']!="")
                                                    <img src="{{'/storage/' . $homepost['show_products'][$i]['card_background_img_herf']}}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @endif                                                
                                                @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">                                                
                                                @endif
                                                <div class="card-img-overlay">
                                                    @if(!empty($homepost['show_products'][$i]['img_herf']))
                                                    <img src="{{'/storage/' . $homepost['show_products'][$i]['img_herf']}}">
                                                    @else
                                                    <img src="/default_image/products_default01.png">
                                                    @endif 
                                                    <h4 class="card-title">{{$homepost['show_products'][$i]['name']}}</h4>   
                                                    <div class="poster_04_btn_wrap">                                                  
                                                        <a href="{{'/product/detail/' . $homepost['show_products'][$i]['id']}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                                            了解詳細
                                                        </a>     
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    @else
                                    <div class="carousel-item">
                                        <div class="poster_04_card_wrapper">
                                            <div class="card text-dark">
                                                @if($homepost['card_background_type']==3)
                                                    @if($homepost['show_products'][$i]['card_background_img_herf']!="")
                                                    <img src="{{'/storage/' . $homepost['show_products'][$i]['card_background_img_herf']}}" class="card-img">
                                                    @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">
                                                    @endif                                                
                                                @else
                                                    <img src="{{ $homepost['card_bg_img'] }}" class="card-img" style="{{ $homepost['card_style'] }}">                                                
                                                @endif
                                                <div class="card-img-overlay">
                                                    @if(!empty($homepost['show_products'][$i]['img_herf']))
                                                    <img src="{{'/storage/' . $homepost['show_products'][$i]['img_herf']}}">
                                                    @else
                                                    <img src="/default_image/products_default01.png">
                                                    @endif 
                                                    <h4 class="card-title">{{$homepost['show_products'][$i]['name']}}</h4>                                                
                                                    <div class="poster_04_btn_wrap">                                                  
                                                        <a href="{{'/product/detail/' . $homepost['show_products'][$i]['id']}}" class="btn btn-primary" role="button" style="{{ $homepost['btn_style'] }}">
                                                            了解詳細
                                                        </a>     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    @endif                                
                                @endfor
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="{{'#poster_04_sm_' . $homepost['id']}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="{{'#poster_04_sm_' . $homepost['id']}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        @endif 
                    </div>
                </div>
                @break

            @case(5)
                <div class="poster_05" style="{{ $homepost['bg_style'] }}">
                    @switch($homepost['background_type'])
                        @case(1) 
                            @if(empty($homepost['background_herf']))
                                <div class="poster_05_text" style="{{'color:' . $homepost['text_color']}}">
                                    {!!$homepost['content']!!}
                                </div>
                            @else
                                <a href="{{$homepost['background_herf']}}">
                                    <div class="poster_05_text" style="{{'color:' . $homepost['text_color']}}">
                                        {!!$homepost['content']!!} 
                                    </div>
                                </a>
                            @endif
                            @break
                        @case(2)          
                            @if(empty($homepost['background_herf']))
                                <div class="poster_05_media">
                                    <p style="{{'color:' . $homepost['text_color']}}">{{$homepost['m_media_title']}}</p>
                                    <img src="{{'/storage/' . $homepost['background_img']}}" alt="{{$homepost['m_media_title']}}">  
                                </div>
                            @else
                                <a href="{{$homepost['background_herf']}}">
                                    <div class="poster_05_media">
                                        <p style="{{'color:' . $homepost['text_color']}}">{{$homepost['m_media_title']}}</p>
                                        <img src="{{'/storage/' . $homepost['background_img']}}" alt="{{$homepost['m_media_title']}}">  
                                    </div>
                                </a>
                            @endif
                            @break
                        @case(3)    
                            @if(empty($homepost['background_herf']))
                                <div class="poster_05_media">
                                    <video autoplay loop muted controls>
                                        <source src="{{'/storage/' . $homepost['background_video']}}" type="video/mp4">
                                    </video>  
                                </div>
                            @else
                                <a href="{{$homepost['background_herf']}}">
                                    <div class="poster_05_media">
                                        <video autoplay loop muted >
                                            <source src="{{'/storage/' . $homepost['background_video']}}" type="video/mp4">
                                        </video>  
                                    </div>
                                </a>
                            @endif
                            @break
                    @endswitch  
                </div>
                @break

            @case(6)
                <div class="poster_06" style="{{ $homepost['bg_style'] }}">
                    <div class="poster_06_text_wrap">
                        <h1>{{$homepost['title']}}</h1>
                        <div class="poster_06_content">
                            {!!$homepost['content']!!}
                        </div>
                    </div>
                </div>
                @break

            @default
                <span></span>
                @break
        @endswitch

    @endforeach

</div>
@endsection
