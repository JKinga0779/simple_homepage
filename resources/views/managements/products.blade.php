@extends('layouts.management')

@section('content1')
<div class="manage_content">    
    <div class="manage_content_l scrollbar_hidden">
        <h1>商品詳細設定</h1>
        <div class="btn_herf_wrap">
            <a href="\management\products\add" class="btn_herf">新增商品</a>
        </div>
        <div class="content_1">        
            <div class="home_carousel">             
                @if($products_count>0)   
                    @foreach($products AS $product) 
                    <div class="home_carousel_items">
                        <div class="order_box">
                            <!-- <h3>{{$product['id']}}</h3> -->
                        </div>
                        <div>
                            <div class="text_input_box">
                                <label for="{{'id_' . $product['id']}}">ID</label>
                                <input name="{{'id_' . $product['id']}}" type="text" class="form-control-plaintext" id="{{'id_' . $product['id']}}" value="{{$product['id']}}" readonly>
                            </div>
                            <div class="text_input_box">
                                <label for="{{'name_' . $product['id']}}">名稱</label>
                                <input name="{{'name_' . $product['id']}}" type="text" class="form-control-plaintext" id="{{'name_' . $product['id']}}" value="{{$product['name']}}" readonly>
                            </div>                              
                            <div class="text_input_box">
                                <label for="{{'type_id_' . $product['id']}}">種類</label>
                                <select id="{{'type_id_' . $product['id']}}" name="{{'type_id_' . $product['id']}}" value="{{$product['type_id']}}" disabled>
                                    <option value=0>未分類</option>
                                    @if($products_types_count>0)
                                        @foreach($products_types AS $products_type)                     
                                            <option value={{$products_type['id']}}>{{$products_type['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>                                 
                            </div>
                        </div>

                        <div class="box_btn_wrap_r_l">
                            <form method='GET' action="{{ route('products_edit', ['id' => $product['id']] ) }}" class="box_btn">
                                @csrf
                                <button class="box_btn r_t color_g">編輯</button>
                            </form>
                            <form method='POST' action="{{ route('products_delete', ['id' => $product['id']] ) }}" class="box_btn">
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
