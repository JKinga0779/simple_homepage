<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use App\Models\Companyinfo;
use App\Models\Header_image;
use App\Models\Uploadimage;
use App\Models\Homepost;
use App\Models\Newspost;
use App\Models\Products_type;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function companyinfo_edit()
    {
        $companyinfo = Companyinfo::select('*')
                                  ->where('status',1)    
                                  ->first();
        if(empty($companyinfo)){
                $companyinfo = Companyinfo::insertGetId([
                'status' => 1
            ]);

        }
        return view('managements.companyinfo_edit',compact('companyinfo'));      
    }

    public function companyinfo_update(Request $request,$id)
    {
        $data = $request->all();
        $companyinfo = Companyinfo::select('logo_img_1','logo_img_2')
                                    ->where('status',1)    
                                    ->first();                                
        
        $logo_img_1_new = $request->file('logo_img_1');
        $logo_img_2_new = $request->file('logo_img_2');       
        if($request->hasFile('logo_img_1')){
            $path = Storage::put('/public',$logo_img_1_new); //將圖片上傳至public內
            $path = explode('/',$path); //去掉已上傳的圖片的路徑剩下圖片名字
            $logo_img_1_path = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                'title' => $logo_img_1_path, 
                'image' => $logo_img_1_path,
                'from' => 0
            ]);
        }
        else{            
            $logo_img_1_path = $companyinfo['logo_img_1'];
        }
        if($request->hasFile('logo_img_2')){
            $path = Storage::put('/public',$logo_img_2_new); //將圖片上傳至public內
            $path = explode('/',$path); //去掉已上傳的圖片的路徑剩下圖片名字
            $logo_img_2_path = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                'title' => $logo_img_2_path, 
                'image' => $logo_img_2_path,
                'from' => 0
            ]);
        }
        else{            
            $logo_img_2_path = $companyinfo['logo_img_2'];
        }


        Companyinfo::where('id', $id)
                    ->update([
                            'company_id' => $data['company_id'],
                            'name_full' => $data['name_full'],
                            'name_short' => $data['name_short'],
                            'name_eng' => $data['name_eng'],
                            'address_1' => $data['address_1'],
                            'address_2' => $data['address_2'],
                            'tel_num_1' => $data['tel_num_1'],
                            'tel_num_2' => $data['tel_num_2'],
                            'email' => $data['email'],
                            'content' => $data['content'], 
                            'note' => $data['note'], 
                            'site_background_color' => $data['site_background_color'], 
                            'nav_color' => $data['nav_color'], 
                            'logo_img_1' => $logo_img_1_path,
                            'logo_img_2' => $logo_img_2_path,
                            'other_herf_1' => $data['other_herf_1'],
                            'other_herf_2' => $data['other_herf_2'],
                            'other_herf_3' => $data['other_herf_3'],
                            'other_herf_4' => $data['other_herf_4'],
                            'other_herf_5' => $data['other_herf_5']
                            ]);

        return redirect()->route('header_edit')->with('success','公司資料修改成功！');
    }

    public function header_edit(Request $request)
    {
        $companyinfo = Companyinfo::select('*')
                                  ->where('status',1)    
                                  ->first();

        $header_images = Header_image::select('*')
                                     ->where('status',1)    
                                     ->orderby('id','ASC')  
                                     ->get();
        if(empty($header_images)){
            $header_images_count = 0;            
        }else{
            $header_images_count = count($header_images);
        }
        
        return view('managements.header_edit',compact('companyinfo','header_images','header_images_count'));         
    }

    public function header_store(Request $request){
        $data = $request->all();        

        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = Storage::put('/public',$image); //將圖片上傳至public內
            $path = explode('/',$path); //去掉已上傳的圖片的路徑剩下圖片名字
            $img_path = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                'title' => $img_path, 
                'image' => $img_path,
                'from' => 2
            ]);
        }
        else{
            $img_path = null;
        }
        
        $header_image = Header_image::insertGetId([
            'title' => $data['title'], 
            'image' => $img_path,
            'status' => 1
        ]);
                        
        return redirect()->route('header_edit')->with('success','頁首圖片新增成功！');
    }

    public function header_delete(Request $request,$header_id){
        $inputs = $request->all();
        Header_image::where('id', $header_id)->update(['status' => 3]); 

        return redirect()->route('header_edit')->with('success','頁首圖片刪除成功！');
    }

    public function homecarousel()
    {
        $announcement_posts = Announcement::select('announcements.*')
                                            ->where('status',1)
                                            ->orderby('show_order','ASC')                                         
                                            ->get();
        if(empty($announcement_posts)){
            $announcements_count = 0;            
        }else{
            $announcements_count = count($announcement_posts);
        }
        
        return view('managements.homecarousel',compact('announcement_posts','announcements_count'));
    }

    public function homecarousel_add()
    {
        $announcement_posts = Announcement::select('announcements.*')
                                            ->where('status',1)
                                            ->orderby('show_order','ASC')                                         
                                            ->get();
        if(empty($announcement_posts)){
            $announcements_count = 0;            
        }else{
            $announcements_count = count($announcement_posts);
        }

        return view('managements.homecarousel_add',compact('announcement_posts','announcements_count'));
    }

    public function homecarousel_store(Request $request){
        $data = $request->all();

        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = Storage::put('/public',$image); //將圖片上傳至public內
            $path = explode('/',$path); //去掉已上傳的圖片的路徑剩下圖片名字
            $img_path = $path[1];         
            
            $uploadimages = Uploadimage::insertGetId([
                'title' => $img_path, 
                'image' => $img_path,
                'from' => 1
            ]);
        }
        else{
            $img_path = null;
        }

        $last_oder = Announcement::select('announcements.show_order')
                                 ->where('status', 1)
                                 ->orderby('show_order','DESC')  
                                 ->first();        
        $new_show_order = $last_oder['show_order']+1;

        
            
        $announcement_id = Announcement::insertGetId([
            'title' => $data['title'], 
            'content' => $data['content'], 
            'herf' => $data['herf'], 
            'image' => $img_path,
            'show_order' => $new_show_order,
            'status' => 1
        ]);        
        
        return redirect()->route('homecarousel_add')->with('success','幻燈片新增成功！');
    }

    public function homecarousel_edit($id)
    {
        $announcement_posts = Announcement::select('announcements.*')
                                            ->where('status',1)
                                            ->orderby('show_order','ASC')                                         
                                            ->get();        
        if(empty($announcement_posts)){
            $announcements_count = 0;            
        }else{
            $announcements_count = count($announcement_posts);
        }
        $announcement_post = Announcement::Where('status',1)
                                         ->where('id',$id)
                                         ->first();

        $error_id = false;
        if(empty($announcement_post)){
            $error_id= true;              
        }                           
                          
        return view('managements.homecarousel_edit',compact('announcement_post','announcement_posts','announcements_count','error_id'));
    }

    public function homecarousel_update(Request $request,$announcement_id){
        $data = $request->all();
        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = Storage::put('/public',$image); //將圖片上傳至public內
            $path = explode('/',$path); //去掉已上傳的圖片的路徑剩下圖片名字
            $img_path = $path[1];
            
            $uploadimages = Uploadimage::insertGetId([
                'title' => $img_path, 
                'image' => $img_path,
                'from' => 1
            ]);
        }
        else{
            $img_path = null;
        }
        if($img_path!=null){
            Announcement::where('id', $announcement_id)
                        ->update([
                                'title' => $data['title'], 
                                'content' => $data['content'], 
                                'herf' => $data['herf'], 
                                'image' => $img_path
                                ]);

            $uploadimages = Uploadimage::insertGetId([
                'title' => $img_path, 
                'image' => $img_path,
                'from' => 1
            ]);
        }else{
            Announcement::where('id', $announcement_id)
                        ->update([
                                'title' => $data['title'], 
                                'content' => $data['content'], 
                                'herf' => $data['herf']
                                ]);
        }
                
        return redirect()->route('homecarousel_add')->with('success','幻燈片修改成功！');
    }

    public function homecarousel_delete(Request $request,$announcement_id){
        $inputs = $request->all();
        Announcement::where('id', $announcement_id)->update(['status' => 3])
                                                   ->update(['show_order' => 0]); //刪除順序也刪除   

        return redirect()->route('homecarousel_add')->with('success','幻燈片刪除成功！');
    }

    public function homecarousel_order()
    {
        $announcement_posts = Announcement::select('announcements.*')
                                            ->where('status',1)
                                            ->orderby('show_order','ASC')                                         
                                            ->get();        
        if(empty($announcement_posts)){
            $announcements_count = 0;            
        }else{
            $announcements_count = count($announcement_posts);
        }
        return view('managements.homecarousel_order',compact('announcement_posts','announcements_count'));
    }

    public function homecarousel_orderupdate(Request $request)
    {
        $inputs = $request->all();        
        $j = 0;
        foreach($inputs AS $input){
            if($j!=0){          
                Announcement::where('id', $input)
                            ->update(['show_order' => $j ]);                
            }
            $j++;
        }
        return redirect()->route('homecarousel_add')->with('success','幻燈片順序調整成功！');        
    }    

    public function newsposts()
    {
        $newsposts = Newspost::select('*')
                             ->where('status',1)   
                             ->orderby('id','DESC')   
                             ->get();
        
        if(empty($newsposts)){
            $newsposts_count = 0;            
        }else{
            $newsposts_count = count($newsposts);
        }

        return view('managements.newsposts',compact('newsposts','newsposts_count'));            
    }

    public function newsposts_add()
    {
        $newsposts = Newspost::select('*')
                                ->where('status',1)    
                                ->orderby('id','DESC')  
                                ->get();                                
        
        if(empty($newsposts)){
            $newsposts_count = 0;            
        }else{
            $newsposts_count = count($newsposts);
        }

        return view('managements.newsposts_add',compact('newsposts','newsposts_count'));            
    }

    public function newsposts_store(Request $request){
        $data = $request->all();            
        $newsposts = Newspost::insertGetId([
            'title' => $data['title'], 
            'content' => $data['content'], 
            'type' => $data['type']
        ]);  
        
        return redirect()->route('newsposts_add')->with('success','公告新增成功！');
    }

    public function newsposts_edit($id)
    {
        $newsposts = Newspost::select('*')
                            ->where('status',1)    
                            ->get();
                                
        if(empty($newsposts)){
            $newsposts_count = 0;            
        }else{
            $newsposts_count = count($newsposts);
        }

        $newspost = Newspost::where('status',1)
                            ->where('id',$id)
                            ->first();

        return view('managements.newsposts_edit',compact('newsposts','newsposts_count','newspost'));            
    }

    public function newsposts_update(Request $request,$id){
        $data = $request->all();

        Newspost::where('id', $id)
                ->update([
                        'title' => $data['title'], 
                        'content' => $data['content'], 
                        'type' => $data['type']
                        ]);
        
        return redirect()->route('newsposts_add')->with('success','公告修改成功！');
    }

    public function newsposts_delete(Request $request,$id){
        $data = $request->all();

        Newspost::where('id', $id)
                ->update([ 'status' => 3 ]);
        
        return redirect()->route('newsposts_add')->with('success','公告修改成功！');
    }

    public function homeposts()
    {
        $homeposts = Homepost::select('homeposts.*')
                                    ->whereNot('status',3)
                                    ->orderby('post_order','DESC')                                         
                                    ->get();
        if(empty($homeposts)){
            $homeposts_count = 0;            
        }else{
            $homeposts_count = count($homeposts);
        }
                
        return view('managements.homeposts',compact('homeposts','homeposts_count'));
    }

    public function homeposts_select()
    {
        $homeposts = Homepost::select('homeposts.*')
                                    ->whereNot('status',3)
                                    ->orderby('post_order','DESC')                                         
                                    ->get();                              
        
        if(empty($homeposts)){
            $homeposts_count = 0;            
        }else{
            $homeposts_count = count($homeposts);
        }
                
        return view('managements.homeposts_select',compact('homeposts','homeposts_count'));         
    }

    public function homeposts_add($post_type)
    {
        $homeposts = Homepost::select('homeposts.*')
                                    ->whereNot('status',3)
                                    ->orderby('post_order','DESC')                                         
                                    ->get();                              
        
        if(empty($homeposts)){
            $homeposts_count = 0;            
        }else{
            $homeposts_count = count($homeposts);
        }            

        $products_types = Products_type::select('products_types.*')
                                        ->where('status',1)
                                        ->orderby('id','ASC')                                         
                                        ->get();   

        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }   

        return view('managements.homeposts_add',compact('homeposts','homeposts_count','post_type','products_types','products_types_count'));         
    }

    public function homeposts_store(Request $request){
        $data = $request->all();            
        
        if($data['status']==1){
            $homeposts_last = Homepost::select('homeposts.*')
                                        ->where('status',1)
                                        ->orderby('post_order','DESC')                                         
                                        ->first();                
            $post_order_new = $homeposts_last['post_order']+1;
        }else{            
            $post_order_new = 0;
        }
        
        switch($data['post_type']){
            case "1":
                $image11 = $request->file('image11');
                $image12 = $request->file('image12');
                $image13 = $request->file('image13');
                $image10 = $request->file('image10');
                if($request->hasFile('image11')){
                    $path = Storage::put('/public',$image11); 
                    $path = explode('/',$path); 
                    $img_path11 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                        'title' => $img_path11, 
                        'image' => $img_path11,
                        'from' => 4
                    ]);
                }
                else{
                    $img_path11 = null;
                }   
                if($request->hasFile('image12')){
                    $path = Storage::put('/public',$image12); 
                    $path = explode('/',$path); 
                    $img_path12 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                        'title' => $img_path12, 
                        'image' => $img_path12,
                        'from' => 4
                    ]);
                }
                else{
                    $img_path12 = null;
                }   
                if($request->hasFile('image13')){
                    $path = Storage::put('/public',$image13); 
                    $path = explode('/',$path); 
                    $img_path13 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                        'title' => $img_path13, 
                        'image' => $img_path13,
                        'from' => 4
                    ]);
                }
                else{
                    $img_path13 = null;
                }  
                if($request->hasFile('image10')){
                    $path = Storage::put('/public',$image10); 
                    $path = explode('/',$path); 
                    $img_path10 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                        'title' => $img_path10, 
                        'image' => $img_path10,
                        'from' => 4
                    ]);
                }
                else{
                    $img_path10 = null;
                }  
                Homepost::insertGetId([
                    'post_type' => $data['post_type'],
                    'post_order' => $post_order_new,
                    'title' => $data['title'],
                    'content' => $data['content'], 
                    'text_align' => $data['text_align'],
                    'background_color' => $data['background_color'],
                    'text_color' => $data['text_color'],
                    'circle_color' => $data['circle_color'],
                    'btn_bg_color' => $data['btn_bg_color'],
                    'btn_text_color' => $data['btn_text_color'],
                    'background_type' => $data['background_type'],
                    'background_img' => $img_path10,
                    'btn_count' => $data['btn_count'],
                    'btn_text_1' => $data['btn_text_1'],
                    'btn_herf_1' => $data['btn_herf_1'],
                    'btn_text_2' => $data['btn_text_2'],
                    'btn_herf_2' => $data['btn_herf_2'],
                    'btn_text_3' => $data['btn_text_3'],
                    'btn_herf_3' => $data['btn_herf_3'],
                    'btn_text_4' => $data['btn_text_4'],
                    'btn_herf_4' => $data['btn_herf_4'],
                    'btn_text_5' => $data['btn_text_5'],
                    'btn_herf_5' => $data['btn_herf_5'],
                    'btn_text_6' => $data['btn_text_6'],
                    'btn_herf_6' => $data['btn_herf_6'],
                    's_img_title_1' => $data['img_title_11'],
                    's_img_title_2' => $data['img_title_12'],
                    's_img_title_3' => $data['img_title_13'],
                    's_img_1' => $img_path11,
                    's_img_2' => $img_path12,
                    's_img_3' => $img_path13,
                    'status' => $data['status']
                ]);  
                break;

            case "2":
                $m_media_title = "";
                $m_img = "";
                $m_iframe  = "";
                $m_video = "";
                switch($data['post2_type']){
                    case 1:
                        $image21 = $request->file('image21');
                        if($request->hasFile('image21')){
                            $path = Storage::put('/public',$image21); 
                            $path = explode('/',$path); 
                            $img_path21 = $path[1];

                            $uploadimages = Uploadimage::insertGetId([
                                'title' => $img_path21, 
                                'image' => $img_path21,
                                'from' => 4
                            ]);
                        }
                        else{
                            $img_path21 = null;
                        }                 
                        $m_media_title = $data['m_img_title'];
                        $m_img = $img_path21;
                        $m_iframe  = "";
                        $m_video = "";
                        break;

                    case 2:               
                        $m_media_title = $data['m_iframe_title'];
                        $m_img = "";
                        $m_iframe  = $data['m_iframe'];
                        $m_video = "";
                        break;

                    case 3:
                        $m_video = $request->file('m_video');
                        if($request->hasFile('m_video')){
                            $path = Storage::put('/public',$m_video); 
                            $path = explode('/',$path); 
                            $m_video_path = $path[1];
                        }
                        else{
                            $m_video_path = null;
                        }                 
                        $m_media_title = $data['m_video_title'];
                        $m_img = "";
                        $m_iframe  = "";
                        $m_video = $m_video_path;
                        break;
                }                
                
                $image20 = $request->file('image20');
                if($request->hasFile('image20')){
                    $path = Storage::put('/public',$image20); 
                    $path = explode('/',$path); 
                    $img_path20 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                    'title' => $img_path20, 
                                    'image' => $img_path20,
                                    'from' => 4
                                ]);
                }
                else{
                    $img_path20 = null;
                }      
                Homepost::insertGetId([
                    'post_type' => $data['post_type'],
                    'post_order' => $post_order_new,
                    'title' => $data['title'],
                    'content' => $data['content'], 
                    'text_align' => $data['text_align'],
                    'background_color' => $data['background_color'],
                    'text_color' => $data['text_color'],
                    'btn_bg_color' => $data['btn_bg_color'],
                    'btn_text_color' => $data['btn_text_color'],
                    'background_type' => $data['background_type'],
                    'background_img' => $img_path20,
                    'btn_count' => $data['btn_count'],
                    'btn_text_1' => $data['btn_text_1'],
                    'btn_herf_1' => $data['btn_herf_1'],
                    'btn_text_2' => $data['btn_text_2'],
                    'btn_herf_2' => $data['btn_herf_2'],
                    'btn_text_3' => $data['btn_text_3'],
                    'btn_herf_3' => $data['btn_herf_3'],
                    'btn_text_4' => $data['btn_text_4'],
                    'btn_herf_4' => $data['btn_herf_4'],
                    'btn_text_5' => $data['btn_text_5'],
                    'btn_herf_5' => $data['btn_herf_5'],
                    'btn_text_6' => $data['btn_text_6'],
                    'btn_herf_6' => $data['btn_herf_6'],
                    'm_media_type' => $data['post2_type'],                    
                    'm_media_title' => $m_media_title,
                    'm_img' => $m_img,
                    'm_iframe' => $m_iframe,
                    'm_video' => $m_video,
                    'status' => $data['status']
                ]);  

                break;

            case "3":
                $image30 = $request->file('image30');
                if($request->hasFile('image30')){
                    $path = Storage::put('/public',$image30); 
                    $path = explode('/',$path); 
                    $img_path30 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                        'title' => $img_path30, 
                                        'image' => $img_path30,
                                        'from' => 4
                                    ]);
                }
                else{
                    $img_path30 = null;
                }      
                Homepost::insertGetId([
                    'post_type' => $data['post_type'],
                    'post_order' => $post_order_new,
                    'title' => $data['title'],
                    'content' => $data['content'], 
                    'text_align' => $data['text_align'],
                    'background_color' => $data['background_color'],
                    'text_color' => $data['text_color'],
                    'btn_bg_color' => $data['btn_bg_color'],
                    'btn_text_color' => $data['btn_text_color'],
                    'background_type' => $data['background_type'],
                    'background_img' => $img_path30,
                    'btn_count' => $data['btn_count'],
                    'btn_text_1' => $data['btn_text_1'],
                    'btn_herf_1' => $data['btn_herf_1'],
                    'btn_text_2' => $data['btn_text_2'],
                    'btn_herf_2' => $data['btn_herf_2'],
                    'btn_text_3' => $data['btn_text_3'],
                    'btn_herf_3' => $data['btn_herf_3'],
                    'btn_text_4' => $data['btn_text_4'],
                    'btn_herf_4' => $data['btn_herf_4'],
                    'btn_text_5' => $data['btn_text_5'],
                    'btn_herf_5' => $data['btn_herf_5'],
                    'btn_text_6' => $data['btn_text_6'],
                    'btn_herf_6' => $data['btn_herf_6'],
                    'status' => $data['status']
                ]);  
                break;

            case "4":    
                $image41 = $request->file('image41');
                if($request->hasFile('image41')){
                    $path = Storage::put('/public',$image41); 
                    $path = explode('/',$path); 
                    $card_background_img = $path[1];
                    $uploadimages = Uploadimage::insertGetId([
                                        'title' => $card_background_img, 
                                        'image' => $card_background_img,
                                        'from' => 4
                                    ]);
                }
                else{
                    $card_background_img = null;
                }        
                    
                if(empty($data['product_typeid_1'])){
                    $product_typeid_1 = null;
                }else{
                    $product_typeid_1 = $data['product_typeid_1'];
                }

                $image40 = $request->file('image40');
                if($request->hasFile('image40')){
                    $path = Storage::put('/public',$image40); 
                    $path = explode('/',$path); 
                    $img_path40 = $path[1];
                    $uploadimages = Uploadimage::insertGetId([
                                        'title' => $img_path40, 
                                        'image' => $img_path40,
                                        'from' => 4
                                    ]);
                }
                else{
                    $img_path40 = null;
                }      
                
                Homepost::insertGetId([
                    'post_type' => $data['post_type'],
                    'post_order' => $post_order_new,                    
                    'title' => $data['title'],
                    'background_color' => $data['background_color'],
                    'text_color' => $data['text_color'],
                    'btn_bg_color' => $data['btn_bg_color'],
                    'btn_text_color' => $data['btn_text_color'],
                    'card_background_color' => $data['card_background_color'],	
                    'card_text_color' => $data['card_text_color'],
                    'background_type' => $data['background_type'],
                    'background_img' => $img_path40,
                    'card_type' => $data['card_type'],
                    'product_typeid_1' => $product_typeid_1,
                    'product_range' => $data['product_range'],
                    'product_orderby' => $data['product_orderby'],
                    'product_DESC_ASC' => $data['product_DESC_ASC'],
                    'product_id_01' => $data['product_id_01'],
                    'product_id_02' => $data['product_id_02'],
                    'product_id_03' => $data['product_id_03'],
                    'product_id_04' => $data['product_id_04'],
                    'product_id_05' => $data['product_id_05'],
                    'product_id_06' => $data['product_id_06'],
                    'product_id_07' => $data['product_id_07'],
                    'product_id_08' => $data['product_id_08'],
                    'product_id_09' => $data['product_id_09'],
                    'product_id_10' => $data['product_id_10'],
                    'card_background_type' => $data['card_background_type'],
                    'card_background_img' => $card_background_img,
                    'status' => $data['status']
                ]);                
                break;

            case "5":
                $content = "";
                $background_img = "";
                $background_video = "";
                $m_media_title = "";
                switch($data['background_type']){
                    case 1:             
                        $content  = $data['content'];                    
                        break;
                    case 2:      
                        $image52 = $request->file('image52');
                        if($request->hasFile('image52')){
                            $path = Storage::put('/public',$image52); 
                            $path = explode('/',$path); 
                            $img_path52 = $path[1];

                            $uploadimages = Uploadimage::insertGetId([
                                                'title' => $img_path52, 
                                                'image' => $img_path52,
                                                'from' => 4
                                            ]);
                        }
                        else{
                            $img_path52 = null;
                        }               
                        $m_media_title = $data['m_img_title'];
                        $background_img = $img_path52;
                        break;
                    case 3:
                        $background_video = $request->file('background_video');
                        if($request->hasFile('background_video')){
                            $path = Storage::put('/public',$background_video); 
                            $path = explode('/',$path); 
                            $background_video = $path[1];
                        }
                        else{
                            $background_video = null;
                        }                 
                        $background_video = $background_video;
                        break;
                }                
                Homepost::insertGetId([
                    'post_type' => $data['post_type'],
                    'post_order' => $post_order_new,
                    'background_type' => $data['background_type'],
                    'title' => $data['title'],
                    'background_herf' => $data['background_herf'],
                    'content' => $content, 
                    'background_img' => $background_img,
                    'm_media_title' => $m_media_title,
                    'background_video' => $background_video,
                    'background_color' => $data['background_color'],
                    'text_color' => $data['text_color'],
                    'status' => $data['status']
                ]);  
                break;

            case "6":
                $image60 = $request->file('image60');
                if($request->hasFile('image60')){
                    $path = Storage::put('/public',$image60); 
                    $path = explode('/',$path); 
                    $img_path60 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                'title' => $img_path60, 
                                                'image' => $img_path60,
                                                'from' => 4
                                            ]);
                }
                else{
                    $img_path60 = null;
                }                         
                Homepost::insertGetId([
                    'post_type' => $data['post_type'],
                    'post_order' => $post_order_new,
                    'background_type' => $data['background_type'],
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'background_img' => $img_path60,
                    'background_color' => $data['background_color'],
                    'text_color' => $data['text_color'],
                    'status' => $data['status']
                ]);  
                break;
        } 

        return redirect()->route('homeposts_select')->with('success','首頁區塊新增成功！');
    }

    public function homeposts_edit($id)
    {
        $homeposts = Homepost::select('homeposts.*')
                                ->whereNot('status',3)
                                ->orderby('post_order','DESC')                                         
                                ->get();       
                                
        if(empty($homeposts)){
            $homeposts_count = 0;            
        }else{
            $homeposts_count = count($homeposts);
        }

        $homepost = Homepost::whereNot('status',3)
                            ->where('id',$id)
                            ->first();

        $products_types = Products_type::select('products_types.*')
                    ->where('status',1)
                    ->orderby('id','ASC')                                         
                    ->get();   

        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }   

        $error_id = false;
        if(empty($homepost)){
            $error_id= true;              
        }    

        return view('managements.homeposts_edit',compact('homeposts','homeposts_count','homepost','error_id','products_types','products_types_count'));            
    }

    public function homeposts_update(Request $request,$id){
        $data = $request->all();

        $homepost = Homepost::whereNot('status',3)
                            ->where('id',$id)
                            ->first();
        
        if($data['status']==1){
            if($homepost['status']!=1){
                $homeposts_last = Homepost::select('homeposts.*')
                                            ->where('status',1)
                                            ->orderby('post_order','DESC')                                         
                                            ->first();                
                $post_order_new = $homeposts_last['post_order']+1;
            }else{
                $post_order_new = $homepost['post_order'];
            }            
        }else{            
            $post_order_new = 0;
        }
                                
        switch($homepost['post_type']){
            case "1":
                $image11 = $request->file('image11');
                $image12 = $request->file('image12');
                $image13 = $request->file('image13');
                $image10 = $request->file('image10');
                if($request->hasFile('image11')){
                    $path = Storage::put('/public',$image11); 
                    $path = explode('/',$path); 
                    $img_path11 = $path[1];
                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path11, 
                                                    'image' => $img_path11,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path11 = $homepost['s_img_1'];
                }   
                if($request->hasFile('image12')){
                    $path = Storage::put('/public',$image12); 
                    $path = explode('/',$path); 
                    $img_path12 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path12, 
                                                    'image' => $img_path12,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path12 = $homepost['s_img_2'];
                }   
                if($request->hasFile('image13')){
                    $path = Storage::put('/public',$image13); 
                    $path = explode('/',$path); 
                    $img_path13 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path13, 
                                                    'image' => $img_path13,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path13 = $homepost['s_img_3'];
                }  
                if($request->hasFile('image10')){
                    $path = Storage::put('/public',$image10); 
                    $path = explode('/',$path); 
                    $img_path10 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path10, 
                                                    'image' => $img_path10,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path10 = $homepost['background_img'];
                } 
                Homepost::where('id', $id)
                        ->update([
                            'post_order' => $post_order_new,
                            'title' => $data['title'],
                            'content' => $data['content'], 
                            'text_align' => $data['text_align'],
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'circle_color' => $data['circle_color'],
                            'btn_bg_color' => $data['btn_bg_color'],
                            'btn_text_color' => $data['btn_text_color'],
                            'background_type' => $data['background_type'],
                            'background_img' => $img_path10,
                            'btn_count' => $data['btn_count'],
                            'btn_text_1' => $data['btn_text_1'],
                            'btn_herf_1' => $data['btn_herf_1'],
                            'btn_text_2' => $data['btn_text_2'],
                            'btn_herf_2' => $data['btn_herf_2'],
                            'btn_text_3' => $data['btn_text_3'],
                            'btn_herf_3' => $data['btn_herf_3'],
                            'btn_text_4' => $data['btn_text_4'],
                            'btn_herf_4' => $data['btn_herf_4'],
                            'btn_text_5' => $data['btn_text_5'],
                            'btn_herf_5' => $data['btn_herf_5'],
                            'btn_text_6' => $data['btn_text_6'],
                            'btn_herf_6' => $data['btn_herf_6'],
                            's_img_title_1' => $data['img_title_11'],
                            's_img_title_2' => $data['img_title_12'],
                            's_img_title_3' => $data['img_title_13'],
                            's_img_1' => $img_path11,
                            's_img_2' => $img_path12,
                            's_img_3' => $img_path13,
                            'status' => $data['status']
                        ]);
                break;

            case "2":
                switch($homepost['m_media_type']){
                    case 1:
                        $image21 = $request->file('image21');
                        if($request->hasFile('image21')){
                            $path = Storage::put('/public',$image21); 
                            $path = explode('/',$path); 
                            $img_path21 = $path[1];

                            $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path21, 
                                                    'image' => $img_path21,
                                                    'from' => 4
                                                ]);
                        }
                        else{
                            $img_path21 = $homepost['m_img'];
                        }                 
                        $m_media_title = $data['m_img_title'];
                        $m_img = $img_path21;
                        $m_iframe  = "";
                        $m_video = "";
                        break;
                    case 2:               
                        $m_media_title = $data['m_iframe_title'];
                        $m_img = "";
                        $m_iframe  = $data['m_iframe'];
                        $m_video = "";
                        break;
                    case 3:
                        $m_video = $request->file('m_video');
                        if($request->hasFile('m_video')){
                            $path = Storage::put('/public',$m_video); 
                            $path = explode('/',$path); 
                            $m_video_path = $path[1];
                        }
                        else{
                            $m_video_path = $homepost['m_video'];
                        }                 
                        $m_media_title = $data['m_video_title'];
                        $m_img = "";
                        $m_iframe  = "";
                        $m_video = $m_video_path;
                        break;
                }     
                $image20 = $request->file('image20');
                if($request->hasFile('image20')){
                    $path = Storage::put('/public',$image20); 
                    $path = explode('/',$path); 
                    $img_path20 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path20, 
                                                    'image' => $img_path20,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path20 = $homepost['background_img'];
                }       
                Homepost::where('id', $id)
                        ->update([
                            'post_order' => $post_order_new,
                            'title' => $data['title'],
                            'content' => $data['content'], 
                            'text_align' => $data['text_align'],
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'btn_bg_color' => $data['btn_bg_color'],
                            'btn_text_color' => $data['btn_text_color'],
                            'background_type' => $data['background_type'],
                            'background_img' => $img_path20,
                            'btn_count' => $data['btn_count'],
                            'btn_text_1' => $data['btn_text_1'],
                            'btn_herf_1' => $data['btn_herf_1'],
                            'btn_text_2' => $data['btn_text_2'],
                            'btn_herf_2' => $data['btn_herf_2'],
                            'btn_text_3' => $data['btn_text_3'],
                            'btn_herf_3' => $data['btn_herf_3'],
                            'btn_text_4' => $data['btn_text_4'],
                            'btn_herf_4' => $data['btn_herf_4'],
                            'btn_text_5' => $data['btn_text_5'],
                            'btn_herf_5' => $data['btn_herf_5'],
                            'btn_text_6' => $data['btn_text_6'],
                            'btn_herf_6' => $data['btn_herf_6'],                 
                            'm_media_title' => $m_media_title,
                            'm_img' => $m_img,
                            'm_iframe' => $m_iframe,
                            'm_video' => $m_video,
                            'status' => $data['status']
                        ]);
                break;

            case "3":             
                $image30 = $request->file('image30');   
                if($request->hasFile('image30')){
                    $path = Storage::put('/public',$image30); 
                    $path = explode('/',$path); 
                    $img_path30 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path30, 
                                                    'image' => $img_path30,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path30 = $homepost['background_img'];
                } 
                Homepost::where('id', $id)
                        ->update([
                            'post_order' => $post_order_new,
                            'title' => $data['title'],
                            'content' => $data['content'], 
                            'text_align' => $data['text_align'],
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'btn_bg_color' => $data['btn_bg_color'],
                            'btn_text_color' => $data['btn_text_color'],
                            'background_type' => $data['background_type'],
                            'background_img' => $img_path30,
                            'btn_count' => $data['btn_count'],
                            'btn_text_1' => $data['btn_text_1'],
                            'btn_herf_1' => $data['btn_herf_1'],
                            'btn_text_2' => $data['btn_text_2'],
                            'btn_herf_2' => $data['btn_herf_2'],
                            'btn_text_3' => $data['btn_text_3'],
                            'btn_herf_3' => $data['btn_herf_3'],
                            'btn_text_4' => $data['btn_text_4'],
                            'btn_herf_4' => $data['btn_herf_4'],
                            'btn_text_5' => $data['btn_text_5'],
                            'btn_herf_5' => $data['btn_herf_5'],
                            'btn_text_6' => $data['btn_text_6'],
                            'btn_herf_6' => $data['btn_herf_6'],
                            'status' => $data['status']
                        ]);
                break;

            case "4":    
                $image41 = $request->file('image41');
                if($request->hasFile('image41')){
                    $path = Storage::put('/public',$image41); 
                    $path = explode('/',$path); 
                    $card_background_img = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $card_background_img, 
                                                    'image' => $card_background_img,
                                                    'from' => 4
                                                ]);
                }
                else{
                     $card_background_img = $homepost['card_background_img'];
                }        
                    
                if(empty($data['product_typeid_1'])){
                    $product_typeid_1 = null;
                }else{
                    $product_typeid_1 = $data['product_typeid_1'];
                }      

                $image40 = $request->file('image40');   
                if($request->hasFile('image40')){
                    $path = Storage::put('/public',$image40); 
                    $path = explode('/',$path); 
                    $img_path40 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path40, 
                                                    'image' => $img_path40,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path40 = $homepost['background_img'];
                }                   

                switch($homepost['card_type']){
                    case 1:             
                        Homepost::where('id', $id)
                        ->update([       
                            'post_order' => $post_order_new,
                            'title' => $data['title'],
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'btn_bg_color' => $data['btn_bg_color'],
                            'btn_text_color' => $data['btn_text_color'],
                            'card_background_color' => $data['card_background_color'],	
                            'card_text_color' => $data['card_text_color'],
                            'background_type' => $data['background_type'],
                            'background_img' => $img_path40,
                            'product_typeid_1' => $product_typeid_1,
                            'product_range' => $data['product_range'],
                            'product_orderby' => $data['product_orderby'],
                            'product_DESC_ASC' => $data['product_DESC_ASC'],
                            'card_background_type' => $data['card_background_type'],
                            'card_background_img' => $card_background_img,
                            'status' => $data['status']
                        ]);             
                        break;
                    case 2:    
                        Homepost::where('id', $id)
                        ->update([           
                            'post_order' => $post_order_new,
                            'title' => $data['title'],
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'btn_bg_color' => $data['btn_bg_color'],
                            'btn_text_color' => $data['btn_text_color'],
                            'card_background_color' => $data['card_background_color'],
                            'card_text_color' => $data['card_text_color'],
                            'background_type' => $data['background_type'],
                            'background_img' => $img_path40,
                            'product_id_01' => $data['product_id_01'],
                            'product_id_02' => $data['product_id_02'],
                            'product_id_03' => $data['product_id_03'],
                            'product_id_04' => $data['product_id_04'],
                            'product_id_05' => $data['product_id_05'],
                            'product_id_06' => $data['product_id_06'],
                            'product_id_07' => $data['product_id_07'],
                            'product_id_08' => $data['product_id_08'],
                            'product_id_09' => $data['product_id_09'],
                            'product_id_10' => $data['product_id_10'],
                            'card_background_type' => $data['card_background_type'],
                            'card_background_img' => $card_background_img,
                            'status' => $data['status']
                        ]); 
                        break;
                }             
                
                
                break;

            case "5":
                switch($homepost['background_type']){
                    case 1:             
                        $content  = $data['content']; 
                        $background_img = "";
                        $background_video = "";
                        $m_media_title = "";                   
                        break;
                    case 2:      
                        $image52 = $request->file('image52');
                        if($request->hasFile('image52')){
                            $path = Storage::put('/public',$image52); 
                            $path = explode('/',$path); 
                            $img_path52 = $path[1];

                            $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path52, 
                                                    'image' => $img_path52,
                                                    'from' => 4
                                                ]);
                        }
                        else{
                            $img_path52 = $homepost['background_img'];
                        }               
                        $m_media_title = $data['m_img_title'];
                        $background_img = $img_path52;
                        $content = "";
                        $background_video = "";
                        break;
                    case 3:
                        $background_video = $request->file('background_video');
                        if($request->hasFile('background_video')){
                            $path = Storage::put('/public',$background_video); 
                            $path = explode('/',$path); 
                            $background_video = $path[1];
                        }
                        else{
                            $background_video = $homepost['background_video'];
                        }                 
                        $background_video = $background_video;
                        $content = "";
                        $background_img = "";
                        $m_media_title = "";
                        break;
                }          
                Homepost::where('id', $id)
                        ->update([
                            'post_order' => $post_order_new,
                            'title' => $data['title'],
                            'background_herf' => $data['background_herf'],
                            'content' => $content, 
                            'background_img' => $background_img,
                            'm_media_title' => $m_media_title,
                            'background_video' => $background_video,
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'status' => $data['status']
                        ]);
                break;

            case "6":
                $image60 = $request->file('image60');
                if($request->hasFile('image60')){
                    $path = Storage::put('/public',$image60); 
                    $path = explode('/',$path); 
                    $img_path60 = $path[1];

                    $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $img_path60, 
                                                    'image' => $img_path60,
                                                    'from' => 4
                                                ]);
                }
                else{
                    $img_path60 = $homepost['background_img'];
                }         
                Homepost::where('id', $id)
                        ->update([
                            'post_order' => $post_order_new,
                            'background_type' => $data['background_type'],
                            'title' => $data['title'],
                            'content' => $data['content'],
                            'background_img' => $img_path60,
                            'background_color' => $data['background_color'],
                            'text_color' => $data['text_color'],
                            'status' => $data['status']
                        ]);   
                break;
            

        } 
        
        return redirect()->route('homeposts_select')->with('success','首頁區塊修改成功！');
    }

    public function homeposts_delete(Request $request,$id){
        $data = $request->all();

        Homepost::where('id', $id)
                ->update([ 'status' => 3 ]);
        
        return redirect()->route('homeposts_select')->with('success','首頁區塊刪除成功！');
    }

    public function homeposts_order()
    {
        $homeposts = Homepost::select('homeposts.*')
                             ->whereNot('status',3)
                             ->orderby('post_order','DESC')                                         
                             ->get();        
        if(empty($homeposts)){
            $homeposts_count = 0;            
        }else{
            $homeposts_count = count($homeposts);
        }

        $homeposts_order = Homepost::select('homeposts.*')
                                    ->where('status',1)
                                    ->orderby('post_order','DESC')                                         
                                    ->get();        
        if(empty($homeposts_order)){
            $homeposts_order_count = 0;            
        }else{
            $homeposts_order_count = count($homeposts_order);
        }

        return view('managements.homeposts_order',compact('homeposts','homeposts_count','homeposts_order','homeposts_order_count'));
    }

    public function homeposts_orderupdate(Request $request)
    {
        $inputs = $request->all();    
        $inputs_count = count($inputs);    
        $j = $inputs_count-1;       
        foreach($inputs AS $input){
            if($j!=0){         
                Homepost::where('id', $input)
                        ->update(['post_order' => $j ]);                
            }
            $j--;
        }
        Homepost::whereNot('status', 1)
                ->update(['post_order' => 0 ]);    
        return redirect()->route('homeposts_order')->with('success','首頁區塊調整成功！');        
    }

    public function products_types()
    {
        $products_types = Products_type::select('products_types.*')
                                     ->where('status',1)
                                     ->orderby('id','ASC')                                         
                                     ->get();
        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }
                
        return view('managements.products_types',compact('products_types','products_types_count'));
    }

    public function products_types_add()
    {
        $products_types = Products_type::select('products_types.*')
                                     ->where('status',1)
                                     ->orderby('id','ASC')                                        
                                     ->get();
        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }         
        return view('managements.products_types_add',compact('products_types','products_types_count'));         
    }

    public function products_types_store(Request $request){
        $data = $request->all();            
        
        $image_pt100 = $request->file('image_pt100');
        if($request->hasFile('image_pt100')){
            $path = Storage::put('/public',$image_pt100); 
            $path = explode('/',$path); 
            $cover_img_path = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $cover_img_path, 
                                                    'image' => $cover_img_path,
                                                    'from' => 3
                                                ]);
        }
        else{
            $cover_img_path = "";
        }  

        $image_pt101 = $request->file('image_pt101');
        if($request->hasFile('image_pt101')){
            $path = Storage::put('/public',$image_pt101); 
            $path = explode('/',$path); 
            $background_img_path = $path[1];
        }
        else{
            $background_img_path = "";
        }  
        
        $products_types = Products_type::insertGetId([
            'name' => $data['name'], 
            'content' => $data['content'], 
            'memo' => $data['memo'], 
            'cover_img' => $cover_img_path,
            'background_img' => $background_img_path
        ]);  
        
        return redirect()->route('products_types')->with('success','商品種類新增成功！');
    }

    public function products_types_edit($id)
    {
        $products_types = Products_type::select('products_types.*')
                                     ->where('status',1)
                                     ->orderby('id','ASC')                                        
                                     ->get();
        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }

        $products_type = Products_type::where('status',1)
                                        ->where('id',$id)
                                        ->first();

        $error_id = false;
        if(empty($products_type)){
            $error_id= true;              
        }    

        return view('managements.products_types_edit',compact('products_types','products_types_count','products_type','error_id'));            
    }

    public function products_types_update(Request $request,$id){
        $data = $request->all();

        $products_type = Products_type::where('status',1)
                            ->where('id',$id)
                            ->first();

        $image_pt100 = $request->file('image_pt100');
        if($request->hasFile('image_pt100')){
            $path = Storage::put('/public',$image_pt100); 
            $path = explode('/',$path); 
            $cover_img_path = $path[1];
            $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $cover_img_path, 
                                                    'image' => $cover_img_path,
                                                    'from' => 3
                                                ]);
        }
        else{
            $cover_img_path = $products_type['cover_img'];
        }  
        $image_pt101 = $request->file('image_pt101');
        if($request->hasFile('image_pt101')){
            $path = Storage::put('/public',$image_pt101); 
            $path = explode('/',$path); 
            $background_img_path = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                                    'title' => $background_img_path, 
                                                    'image' => $background_img_path,
                                                    'from' => 3
                                                    ]);
        }
        else{
            $background_img_path = $products_type['background_img'];
        }                  
                
        Products_type::where('id', $id)
                    ->update([
                        'name' => $data['name'], 
                        'content' => $data['content'], 
                        'memo' => $data['memo'], 
                        'cover_img' => $cover_img_path,
                        'background_img' => $background_img_path
                    ]); 
                    
        return redirect()->route('products_types')->with('success','商品種類修改成功！');
    }

    public function products_types_delete(Request $request,$id){
        $data = $request->all();

        Products_type::where('id', $id)
                    ->update([ 'status' => 3 ]);
        
        return redirect()->route('products_types')->with('success','商品種類刪除成功！');
    }

    public function products()
    {
        $products = Product::select('products.*')
                                ->where('status',1)
                                ->orderby('id','ASC')                                         
                                ->get();
        if(empty($products)){
            $products_count = 0;            
        }else{
            $products_count = count($products);
        }

        $products_types = Products_type::select('products_types.*')
                                        ->where('status',1)
                                        ->orderby('id','ASC')                                         
                                        ->get();
        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }
                
        return view('managements.products',compact('products','products_count','products_types','products_types_count'));
    }

    public function products_add()
    {
        $products = Product::select('products.*')
                            ->where('status',1)
                            ->orderby('id','ASC')                                        
                            ->get();
        if(empty($products)){
            $products_count = 0;            
        }else{
            $products_count = count($products);
        }         

        $products_types = Products_type::select('products_types.*')
                                        ->where('status',1)
                                        ->orderby('id','ASC')                                         
                                        ->get();
        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }

        return view('managements.products_add',compact('products','products_count','products_types','products_types_count'));       
    }

    public function products_store(Request $request){
        $data = $request->all();                        

        $image_p101 = $request->file('image_p101');
        if($request->hasFile('image_p101')){
            $path = Storage::put('/public',$image_p101); 
            $path = explode('/',$path); 
            $img_herf = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                            'title' => $img_herf, 
                                            'image' => $img_herf,
                                            'from' => 3
                                        ]);
        }
        else{
            $img_herf = "";
        }  

        $image_p100 = $request->file('image_p100');
        if($request->hasFile('image_p100')){
            $path = Storage::put('/public',$image_p100); 
            $path = explode('/',$path); 
            $bgimg_herf = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                            'title' => $bgimg_herf, 
                                            'image' => $bgimg_herf,
                                            'from' => 3
                                        ]);
        }
        else{
            $bgimg_herf = "";
        } 

        $image_p200 = $request->file('image_p200');
        if($request->hasFile('image_p200')){
            $path = Storage::put('/public',$image_p200); 
            $path = explode('/',$path); 
            $card_background_img_herf = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                            'title' => $card_background_img_herf, 
                                            'image' => $card_background_img_herf,
                                            'from' => 3
                                        ]);
        }
        else{
            $card_background_img_herf = "";
        } 
        
        if(!empty($data['retail_price'])){
            $retail_price = $data['retail_price'];        
        }else{
            $retail_price =  0;        
        }
        if(!empty($data['factory_price'])){
            $factory_price = $data['factory_price'];        
        }else{
            $factory_price =  0;        
        }
        if(!empty($data['special_price'])){
            $special_price = $data['special_price'];        
        }else{
            $special_price =  0;        
        }
        if(!empty($data['discount'])){
            $discount = $data['discount'];        
        }else{
            $discount =  100;        
        }
        if(!empty($data['stores_num'])){
            $stores_num = $data['stores_num'];        
        }else{
            $stores_num =  0;        
        }
        if(!empty($data['sales_num'])){
            $sales_num = $data['retail_price'];        
        }else{
            $sales_num =  0;        
        }

        $products = Product::insertGetId([
            'name' => $data['name'], 
            'content' => $data['content'], 
            'type_id' => $data['type_id'], 
            'retail_price' => $retail_price, 
            'factory_price' => $factory_price, 
            'special_price' => $special_price, 
            'discount' => $discount, 
            'stores_num' => $stores_num, 
            'sales_num' => $sales_num, 
            'img_herf' => $img_herf, 
            'bgimg_herf' => $bgimg_herf,
            'card_background_img_herf' => $card_background_img_herf
        ]);  
        
        return redirect()->route('products_add')->with('success','商品新增成功！');
    }

    public function products_edit($id)
    {
        $products = Product::select('products.*')
                            ->where('status',1)
                            ->orderby('id','ASC')                                        
                            ->get();
        if(empty($products)){
            $products_count = 0;            
        }else{
            $products_count = count($products);
        }         


        $products_types = Products_type::select('products_types.*')
                                        ->where('status',1)
                                        ->orderby('id','ASC')                                         
                                        ->get();
        if(empty($products_types)){
            $products_types_count = 0;            
        }else{
            $products_types_count = count($products_types);
        }        

        $product = Product::where('status',1)
                          ->where('id',$id)
                          ->first();
                          
        $error_id = false;
        if(empty($product)){
            $error_id= true;              
        }    

        return view('managements.products_edit',compact('products','products_count','product','error_id','products_types','products_types_count'));            
    }

    public function products_update(Request $request,$id){
        $data = $request->all();

        $product = Product::where('status',1)
                          ->where('id',$id)
                          ->first();

        $image_p101 = $request->file('image_p101');
        if($request->hasFile('image_p101')){
            $path = Storage::put('/public',$image_p101); 
            $path = explode('/',$path); 
            $img_herf = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                            'title' => $img_herf, 
                                            'image' => $img_herf,
                                            'from' => 3
                                        ]);
        }
        else{
            $img_herf = $product['img_herf'];
        }  

        $image_p100 = $request->file('image_p100');
        if($request->hasFile('image_p100')){
            $path = Storage::put('/public',$image_p100); 
            $path = explode('/',$path); 
            $bgimg_herf = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                            'title' => $bgimg_herf, 
                                            'image' => $bgimg_herf,
                                            'from' => 3
                                        ]);
        }
        else{
            $bgimg_herf = $product['bgimg_herf'];
        } 

        $image_p200 = $request->file('image_p200');
        if($request->hasFile('image_p200')){
            $path = Storage::put('/public',$image_p200); 
            $path = explode('/',$path); 
            $card_background_img_herf = $path[1];

            $uploadimages = Uploadimage::insertGetId([
                                            'title' => $card_background_img_herf, 
                                            'image' => $card_background_img_herf,
                                            'from' => 3
                                        ]);
        }
        else{
            $card_background_img_herf = $product['card_background_img_herf'];
        } 
        
        if(!empty($data['retail_price'])){
            $retail_price = $data['retail_price'];        
        }else{
            $retail_price =  0;        
        }
        if(!empty($data['factory_price'])){
            $factory_price = $data['factory_price'];        
        }else{
            $factory_price =  0;        
        }
        if(!empty($data['special_price'])){
            $special_price = $data['special_price'];        
        }else{
            $special_price =  0;        
        }
        if(!empty($data['discount'])){
            $discount = $data['discount'];        
        }else{
            $discount =  100;        
        }
        if(!empty($data['stores_num'])){
            $stores_num = $data['stores_num'];        
        }else{
            $stores_num =  0;        
        }
        if(!empty($data['sales_num'])){
            $sales_num = $data['retail_price'];        
        }else{
            $sales_num =  0;        
        }            
                
        Product::where('id', $id)
                ->update([
                    'name' => $data['name'], 
                    'content' => $data['content'], 
                    'type_id' => $data['type_id'], 
                    'retail_price' => $retail_price, 
                    'factory_price' => $factory_price, 
                    'special_price' => $special_price, 
                    'discount' => $discount, 
                    'stores_num' => $stores_num, 
                    'sales_num' => $sales_num, 
                    'img_herf' => $img_herf, 
                    'bgimg_herf' => $bgimg_herf,
                    'card_background_img_herf' => $card_background_img_herf
                ]); 
                    
        return redirect()->route('products_add')->with('success','商品修改成功！');
    }

    public function products_delete(Request $request,$id){
        $data = $request->all();

        Product::where('id', $id)
                ->update([ 'status' => 3 ]);
        
        return redirect()->route('products_add')->with('success','商品刪除成功！');
    }


    public function uploadimages()
    {
        $uploadimages = Uploadimage::select('*')
                                     ->where('status',1)    
                                     ->orderby('id','DESC')  
                                     ->get();
        if(empty($uploadimages)){
            $uploadimages_count = 0;            
        }else{
            $uploadimages_count = count($uploadimages);
        }
        
        return view('managements.uploadimages',compact('uploadimages','uploadimages_count'));       
    }

    public function uploadimages_from($from)
    {
        $uploadimages = Uploadimage::select('*')
                                     ->where('status',1)    
                                     ->where('from',$from)    
                                     ->orderby('id','DESC')  
                                     ->get();
        if(empty($uploadimages)){
            $uploadimages_count = 0;            
        }else{
            $uploadimages_count = count($uploadimages);
        }
        
        return view('managements.uploadimages',compact('uploadimages','uploadimages_count'));       
    }

    public function uploadimages_store(Request $request)
    {
        $data = $request->all();        

        $image = $request->file('image');
        if($request->hasFile('image')){
            $path = Storage::put('/public',$image); //將圖片上傳至public內
            $path = explode('/',$path); //去掉已上傳的圖片的路徑剩下圖片名字
            $img_path = $path[1];            
        }
        else{
            $img_path = null;
        }

        if($img_path!=null){
            $uploadimages = Uploadimage::insertGetId([
                'title' => $data['title'], 
                'image' => $img_path,
                'from' => 0
            ]);
        }
                        
        return redirect()->route('uploadimages')->with('success','圖片上傳成功！');     
    }
    
}
