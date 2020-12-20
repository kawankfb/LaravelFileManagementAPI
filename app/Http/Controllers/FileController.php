<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        if(null===auth()->user())
        return new Response('"message":"please provide correct Bearer Token."',401,$http_response_header=['Content-Type'=>'application/json']);
        else
        {
        $user= User::find(auth()->user()->id);
        
        $request->validate([
            'directory'=>'required',
            'file'=>'file|required|max:3999',
            'name'=>'required'
        ]);
        $user_id=$user->id;
        $pathToStoreFile='/user_files/'.$user_id;
        $directory=$request->directory;
        
        if(str_ends_with($directory,"/"))
        $directory=substr($directory,0,strlen($directory)-1);
        $directory=str_replace(".","",$directory);
        if(strpos($directory,"\\")===false 
        && strpos($directory,":")===false 
        && strpos($directory,"?")===false 
        && strpos($directory,"<")===false 
        && strpos($directory,">")===false 
        && strpos($directory,"|")===false 
        && strpos($directory,"*")===false 
        && strpos($directory,'"')===false)
        $pathToStoreFile=$pathToStoreFile.'/'.$directory;
        else
        return new Response('{"error":"directory parameter should not contain the following letters :{* ," ,\\ ,| ,< ,> ,? ,:}."}',400,$http_response_header=['Content-Type'=>'application/json']);
        if(!Storage::exists($pathToStoreFile))
        Storage::disk('local')->makeDirectory("/user_files".'/'.$user_id);
        
                $extension=$request->file('file')->getClientOriginalExtension();
                $file_name=$request->name;
                if($extension=="")
                $img_path= $request->file('file')->storeAs($pathToStoreFile,$file_name);
                else
                $img_path= $request->file('file')->storeAs($pathToStoreFile,$file_name.'.'.$extension);
                
                
                $img_path=str_replace("user_files".'/'.$user_id.'/',"",$img_path);
            return $img_path;


        }
    

        
    }

    public function user_data()
    {
        if(null===auth()->user())
        return new Response('"message":"please provide correct Bearer Token"',401,$http_response_header=['Content-Type'=>'application/json']);
        else
        {
        $user= User::find(auth()->user()->id);
        $folder_size=0;
        $number_of_files=0;
        foreach (Storage::allFiles('/user_files/'.$user->id) as $file)
        {
            $folder_size=$folder_size+Storage::size($file);
            $number_of_files++;
        }
        }
        
    }

    public function getByFolder(Request $request){
        $url = $request->path();
        $url=substr($url,10);
        $directories=explode('/',$url);
        $auth=auth()->user();
        return $this->show($url,$auth);
    }


    public function show($file_name,$auth=null)
    {
        //
        $headers=getallheaders();
        if(null===auth()->user() && $auth==null)
        return new Response('"message":"please provide correct Bearer Token"',401,$http_response_header=['Content-Type'=>'application/json']);
        else
        {
            if($auth==null)
        $user= User::find(auth()->user()->id);
        else
        $user=$auth;
        if(Storage::exists('user_files/'.$user->id.'/'.$file_name))
        {
            $file_address='user_files/'.$user->id.'/'.$file_name;
                $file=Storage::get($file_address);

            if(isset($headers['Range'])){
                $range_header=$headers['Range'];
                $ranges=explode(", ",$range_header);
                $sub="";
                $size=0;
                foreach($ranges as $range)
                {
                    $range_boundaries=explode("-",$range);
                    $range_starting_point=$range_boundaries[0];
                    $range_length=$range_boundaries[1]-$range_boundaries[0];
                    if($range_starting_point<0 || $range_length<0 || $range_boundaries[1]>Storage::size($file_address))
                    return new Response('{"message":"range not satisfiable"}',416,$http_response_header=['Content-Type'=>'application/json']) ;
                    $size=$size+$range_length;
                    $subfile=Storage::get($file_address);
                    $sub=$sub.substr($subfile,$range_starting_point,$range_length);

                }
                
                
                
                return new Response($sub,206,$http_response_header=['Content-Type' => 'application/octet-stream','Content-Length' =>$size ]) ;
            }
            else   
                return new Response($file,200,$http_response_header=['Content-Type' => 'application/octet-stream', 'Content-Length' => Storage::size($file_address)]) ;
            
            
        }
            else return new Response('{"message":"no such file exists"}',404,$http_response_header=['Content-Type'=>'application/json']);

        }
    

        
    }
}
