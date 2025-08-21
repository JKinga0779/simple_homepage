@extends('layouts.management')

@section('content1')
<div class="manage_content">    
    <div class="manage_content_l scrollbar_hidden">
        <h1>商品類別設定</h1>
        <div class="btn_herf_wrap">
            <a href="\management\products_types\add" class="btn_herf">新增商品類別</a>
        </div>
        <div class="content_1">        
            <div class="home_carousel">             
                @if($products_types_count>0)   
                    @foreach($products_types AS $product_type) 
                    <div class="home_carousel_items">
                        <div class="order_box">
                            <h3>{{$product_type['post_order']}}</h3>
                        </div>
                        <div>
                            <div class="text_input_box">
                                <label for="{{'id_' . $product_type['id']}}">ID</label>
                                <input name="{{'id_' . $product_type['id']}}" type="text" class="form-control-plaintext" id="{{'id_' . $product_type['id']}}" value="{{$product_type['id']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'name_' . $product_type['id']}}">名稱</label>
                                <input name="{{'name_' . $product_type['id']}}" type="text" class="form-control-plaintext" id="{{'name_' . $product_type['id']}}" value="{{$product_type['name']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'post_type_' . $product_type['id']}}">簡述</label>
                                <input name="{{'post_type_' . $product_type['id']}}" type="text" class="form-control-plaintext" id="{{'post_type_' . $product_type['id']}}" value="{{$product_type['memo']}}" readonly>                    
                            </div>
                        </div>

                        <div class="box_btn_wrap_r_l">
                            <form method='GET' action="{{ route('products_types_edit', ['id' => $product_type['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_t color_g">編輯</button>
                            </form>
                            <form method='POST' action="{{ route('products_types_delete', ['id' => $product_type['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_b color_r">刪除</button>
                            </form>
                        </div>  
                        
                    </div>
                    @endforeach                    
                @else
                <div class="content_nodata">
                    <p>無資料</p>
                </div>
                @endif                            
            </div>
        </div>    
    </div>

    <div class="manage_content_r scrollbar_hidden">
        @yield('content2')
    </div>

    
</div>

@endsection
