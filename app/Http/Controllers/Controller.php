<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Announcement;
use App\Models\Homepost;
use App\Models\Product;
use App\Models\Companyinfo;
use App\Models\Header_image;
use App\Models\Newspost;
use App\Models\Products_type;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    
    public function index()
    {
        $announcement_posts = Announcement::select('announcements.*')
                                            ->where('status',1)
                                            ->orderby('show_order','ASC')                                         
                                            ->get();
        foreach($announcement_posts AS $announcement_post){
            if(!Empty($announcement_post['image'])){
                $announcement_img = "/storage/" . $announcement_post['image'];
            }else{
                $announcement_img = "/default_image/homecarousel_default00.png";  
            }
            $announcement_post['image'] = $announcement_img;
        }
        if(empty($announcement_posts)){
            $announcements_count = 0;            
        }else{
            $announcements_count = count($announcement_posts);
        }
        
        $homeposts = Homepost::select('homeposts.*')
                                ->where('status',1)
                                ->orderby('post_order','DESC')                                         
                                ->get();
        foreach($homeposts AS $homepost){
            if($homepost['post_type']==4){
                if($homepost['product_DESC_ASC']==1){
                    $orderby = 'DESC';
                }else{
                    $orderby = 'ASC';
                }

                if($homepost['card_type']==1){
                    if(!empty($homepost['product_typeid_1'])){
                        $products = Product::select('products.*')
                                            ->take($homepost['product_range'])
                                            ->where('type_id',$homepost['product_typeid_1'])
                                            ->where('status',1)
                                            ->orderby($homepost['product_orderby'],$orderby)                                         
                                            ->get();
                    }else{
                        $products = Product::select('products.*')
                                            ->take($homepost['product_range'])
                                            ->where('status',1)
                                            ->orderby($homepost['product_orderby'],$orderby)                                         
                                            ->get();
                    }
                    $products_count = count($products);
                    $products_count_de = (int) ($products_count/3);
                    $products_count_re = (int) ($products_count%3);
                }else if($homepost['card_type']==2){
                    $post_ids=[];
                    for($i=1 ; $i<=10 ; $i++){
                        $temp = 'product_id_'.str_pad($i,2,'0',STR_PAD_LEFT);
                        if($homepost[$temp]!=0){
                            
                            $post_ids[] = $homepost[$temp];
                        }                        
                    }                             
                    $products = Product::select('products.*')
                                        ->where('status',1)
                                        ->whereIn('id', $post_ids)
                                        ->orderby($homepost['product_orderby'],$orderby)                                         
                                        ->get();    
                    
                    $products_count = count($products);
                    $products_count_de = (int) ($products_count/3);
                    $products_count_re = (int) ($products_count%3);
                }

                $homepost['show_products'] = $products;
                $homepost['show_products_count'] = $products_count;
                $homepost['show_products_count_de'] = $products_count_de;
                $homepost['show_products_count_re'] = $products_count_re;    
                                  
                switch($homepost['card_background_type']){  //1.卡片顏色 2.圖片(上傳) 3.商品個別設定
                    case 1:
                        $card_bg_img = "/default_image/card_default00.png";
                        break;
                    case 2:
                        if(!Empty($homepost['card_background_img'])){
                            $card_bg_img = "/storage/" . $homepost['card_background_img'];
                        }else{
                            $card_bg_img = "/default_image/card_default00.png";  
                        }
                        break;
                    case 3:
                        if(!Empty($homepost['card_background_img'])){
                            $card_bg_img = "/storage/" . $homepost['card_background_img'];
                        }else{
                            $card_bg_img = "/default_image/card_default00.png";  
                        }
                        break;
                    default:
                        $card_bg_img = "/default_image/card_default00.png";
                        break;
                }
                $homepost['card_bg_img'] = $card_bg_img;      
            }
            
            //background setting
            switch($homepost['background_type']){  //1.color 2.img 3.video
                case 0:
                    $bg_style = "";  
                    break;
                case 1:
                    $bg_style = "background-color:". $homepost['background_color'] . ";" 
                              . "color:" . $homepost['text_color'] . ";";
                    break;
                case 2:
                    if(!Empty($homepost['background_img'])){
                        $bg_style = "background-image: url('/storage/" . $homepost['background_img'] . "');" 
                                  . "background-color:". $homepost['background_color'] . ";"   
                                  . "color:" . $homepost['text_color'] . ";";
                    }else{
                        $bg_style = "background-color:". $homepost['background_color'] . ";" 
                                  . "color:" . $homepost['text_color'] . ";";
                    }
                    break;
                case 3:
                    $bg_style = "color:" . $homepost['text_color'] . ";";
                    break;
                default:
                    $bg_style = "";
                    break;
            }
            $homepost['bg_style'] = $bg_style;
            $homepost['card_style'] = "background-color:". $homepost['card_background_color'] . ";" ;
            $homepost['btn_style'] = "background-color: ". $homepost['btn_bg_color']
                                  . ";color: ". $homepost['btn_text_color'] . ";";

            switch($homepost['text_align']){  //0.none 1.top 2.left 3.right
                case 0:
                    $homepost['text_align_class'] = "";  
                    break;
                case 1:
                    $homepost['text_align_class'] = "_all_wrap_text_top";  
                    break;
                case 2:
                    $homepost['text_align_class'] = "_all_wrap_text_left";  
                    break;
                case 3:
                    $homepost['text_align_class'] = "_all_wrap_text_right";  
                    break;
                default:
                  $homepost['text_align_class'] = "";
            }
        }
        return view('home',compact('announcement_posts','announcements_count','homeposts'));
    }
    
    public function companyinfo()
    {
        return view('companyinfo');
    }
    
    public function news()
    {
        $newsposts = Newspost::select('newsposts.*')
                                    ->where('status',1)
                                    ->orderby('id','DESC')                                      
                                    ->get();

        if(empty($newsposts)){
            $newsposts_count = 0;            
        }else{
            $newsposts_count = count($newsposts);
        }
        
        $pages = intdiv($newsposts_count, 10);
        $left = $newsposts_count % 10;

        if($left!=0){
            $all_pages = $pages+1;
        }else{
            $all_pages = $pages;
        }
        
        $pagesinfo=array("pages"=>$pages,
                         "left"=>$left,
                         "all_pages"=>$all_pages,
                         "now_page"=>1
                        );
        
                
        $now_newsposts =$newsposts->slice(0,10);

        foreach($now_newsposts as $now_newspost){
            $created_date = substr($now_newspost['created_at'],0,10);
            $now_newspost['created_date'] = $created_date;
        }

        $type='all';

        return view('news',compact('now_newsposts','newsposts_count','pagesinfo','type'));
    }

    public function news_page( $type, $now_page)
    {        
        $type_arr = array( '0', '1', '2', '3');
        
        if( in_array($type,$type_arr) ){
            $newsposts = Newspost::select('newsposts.*')
                                        ->where('status',1)
                                        ->where('type',$type)
                                        ->orderby('id','DESC')                                      
                                        ->get();
                                    
        }else if($type==="all"){
            $newsposts = Newspost::select('newsposts.*')
                                    ->where('status',1)
                                    ->orderby('id','DESC')                                      
                                    ->get();
        }else{
            abort(404);
        }

        if(empty($newsposts)){
            $newsposts_count = 0;            
        }else{
            $newsposts_count = count($newsposts);
        }
        
        $pages = intdiv($newsposts_count, 10);
        $left = $newsposts_count % 10;

        if($left!=0){
            $all_pages = $pages+1;
        }else{
            $all_pages = $pages;
        }

        if(($now_page>$all_pages) or ($now_page<1)){
            abort(404);
        }

        $pagesinfo=array("pages"=>$pages,
                         "left"=>$left,
                         "all_pages"=>$all_pages,
                         "now_page"=>$now_page
                        );
                                
        if($now_page==$all_pages){             
            if($left==0){
                $now_newsposts =$newsposts->slice(($now_page-1)*10,10);
            }else{
                $now_newsposts =$newsposts->slice(($now_page-1)*10,$left);
            }            
        }else{
                $now_newsposts =$newsposts->slice(($now_page-1)*10,10);
        }

        foreach($now_newsposts as $now_newspost){
            $created_date = substr($now_newspost['created_at'],0,10);
            $now_newspost['created_date'] = $created_date;
        }
        
        return view('news',compact('now_newsposts','newsposts_count','pagesinfo','type'));
    }

    public function news_detail($id)
    {
        $newspost = Newspost::select('newsposts.*')
                                    ->where('id',$id)
                                    ->where('status',1)
                                    ->orderby('id','DESC')                                      
                                    ->first();    
        return view('news_detail',compact('newspost'));
    }

    public function products_display_all()
    {
        $products_type = Request::query('products_type');        
        if(empty($products_type)){
            $products = Product::select('products.*','products_types.name as type_name')
                                ->leftjoin('products_types', 'products_types.id', '=', 'products.type_id')
                                ->where('products.status',1)
                                ->orderby('products.id','ASC')                                        
                                ->get();   
        }else{
            $products = Product::select('products.*','products_types.name as type_name')
                                ->leftjoin('products_types', 'products_types.id', '=', 'products.type_id')
                                ->where('products.status',1)
                                ->where('products.type_id',$products_type)
                                ->orderby('products.id','ASC')                                        
                                ->get();   
        }

        $products_types = Products_type::select('products_types.*')
                                        ->where('status',1)
                                        ->orderby('id','ASC')                                        
                                        ->get();
    
        if(empty($products)){
            $products_count = 0;            
        }else{
            $products_count = count($products);
        }

        foreach($products AS $product){
            if(!Empty($product['bgimg_herf'])){
                $bgimg_herf = "background-image: url('/storage/" . $product['bgimg_herf']. "');";
            }else{
                $bgimg_herf = "background-image: url('/default_image/products_bg_default01.png');";  
            }   
            $product['bgimg_herf'] = $bgimg_herf;

            if(Empty($product['type_name'])){
                $type_name = "無分類";
                $product['type_name'] = $type_name;
            }
        }

        return view('products_display_all',compact('products','products_count','products_types'));
    }

    public function product_detail($id)
    {
        $product = Product::select('products.*','products_types.name as type_name')
                            ->where('products.id',$id)
                            ->where('products.status',1)
                            ->leftjoin('products_types', 'products_types.id', '=', 'products.type_id')
                            ->first(); 

        if(!Empty($product['bgimg_herf'])){
            $bgimg_herf = "background-image: url('/storage/" . $product['bgimg_herf']. "');";
        }else{
            $bgimg_herf = "background-image: url('/default_image/products_bg_default01.png');";  
        }   
        $product['bgimg_herf'] = $bgimg_herf;

        if(Empty($product['type_name'])){
            $type_name = "無分類";
            $product['type_name'] = $type_name;
        }

        return view('product_detail',compact('product'));
    }


}


