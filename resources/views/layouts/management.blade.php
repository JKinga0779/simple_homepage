<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(!empty($companyinfo['name_full']))
        <title>{{$companyinfo['name_full'] . '-編輯設定'}}</title>
    @else
        <title>{{ config('app.name', 'Laravel') . '-編輯設定'}}</title>
    @endif 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- <link href="C:/xampp/htdocs/productdisplay/resources/css/app.css" rel="stylesheet"> -->
    <link href="{{ URL::asset('css/management.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/carousel_top.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/poster_type_01.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/poster_type_02.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/poster_type_03.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/poster_type_04.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/poster_type_05.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/btn.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @if(!empty($companyinfo['logo_img_2']))
                        <img id="company_logo_top" src="{{'/storage/' . $companyinfo['logo_img_2']}}" class="top_toolbar_logo" alt="{{$companyinfo['name_short']}}"/>
                    @elseif(!empty($companyinfo['name_short']))
                        {{$companyinfo['name_short']}}
                    @else
                        {{ config('app.name', 'Laravel') }}
                    @endif                 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <a class="navbar-brand" href="/companyinfo">
                            品牌介紹
                        </a>
                    </ul>
                    <ul class="navbar-nav">
                        <a class="navbar-brand" href="/news">
                            最新消息
                        </a>
                    </ul>
                    <ul class="navbar-nav dropdown">
                        <a class="navbar-brand" href="/products/display" id="navbarproduct">                            
                            商品總覧
                        </a>
                    </ul>
                    <ul class="navbar-nav">
                        <a class="navbar-brand" href="/management/companyinfo/header">
                            工作人員專頁
                        </a>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>                    
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                {{ session('success') }}
                </div>
            @endif 
            <div class="management_all">
                <div class="manage_toolbar">
                    <div class="list-group">
                        <a href="\management\companyinfo\header" class="list-group-item list-group-item-action">公司詳細</a>
                        <a href="\management\homecarousel\add" class="list-group-item list-group-item-action">首頁幻燈片</a>
                        <a href="\management\homeposts\select" class="list-group-item list-group-item-action">首頁區塊</a>
                        <a href="\management\newsposts\add" class="list-group-item list-group-item-action">最新消息</a>
                        <a href="\management\products_types\add" class="list-group-item list-group-item-action">商品類別</a>
                        <a href="\management\products\add" class="list-group-item list-group-item-action">商品詳細</a>
                        <a href="\management\uploadimages" class="list-group-item list-group-item-action">圖片上傳</a>
                    </div>
                </div>

                @yield('content1')
                
            </div>
        </main>
        
    </div>
</body>
</html>
