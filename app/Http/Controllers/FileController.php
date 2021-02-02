<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
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
                $this->user_data($user);
            return $img_path;


        }



    }

    public function index(){
         //
         if(null===auth()->user())
         return new Response('"message":"please provide correct Bearer Token"',401,$http_response_header=['Content-Type'=>'application/json']);
         else
         {
         $user= User::find(auth()->user()->id);
         if(Storage::exists('user_files/'.$user->id.'/'))
         {

             $folder_address='user_files/'.$user->id;
             return $this->get_folder_paths("",$user);
         }

            else return new Response('{"message":"no such file exists"}',404,$http_response_header=['Content-Type'=>'application/json']);

        }



    }


    public function get_folder_paths($path,$auth=null){
        if($auth==null){
            return new Response('"message":"please provide correct Bearer Token"',401,$http_response_header=['Content-Type'=>'application/json']);
        }
        else
        {
            $user=$auth;
            if(Storage::exists('user_files/'.$user->id.'/'.$path))
            {
                $folder_address='user_files/'.$user->id.'/'.$path;
                    $folders=Storage::directories($folder_address);
                   $files=Storage::files($folder_address);
                   $i=0;
                   foreach($files as $file)
                   {
                       $files[$i++]=str_replace("user_files/".$user->id,"/api/files",$file);
                   }
                   $i=0;
                   foreach($folders as $folder)
                   {
                       $folders[$i++]=str_replace("user_files/".$user->id,"/api/files",$folder);
                   }
                   $sub_paths='{'.'"folders":[';
                       $i=0;
                       $relative_path=str_replace("user_files/".$user->id,"/api/files",$folder_address);
                       if(str_ends_with($relative_path,'/'))
                       $relative_path=substr($relative_path,0,strlen($relative_path)-1);
                       //return $relative_path;
                   foreach($folders as $folder){
                       $folder_name=str_replace($relative_path.'/',"",$folder);
                       $i++;
                       if(sizeof($folders)==$i)
                       $sub_paths=$sub_paths.'"'.$folder_name.'":'.'"'.$folder.'"';
                       else
                       $sub_paths=$sub_paths.'"'.$folder_name.'":'.'"'.$folder.'", ';

                   }
                   $sub_paths=$sub_paths.'],"files":[';
                       $i=0;
                   foreach($files as $file){
                       $file_name=str_replace($relative_path.'/',"",$file);
                       $i++;
                       if(sizeof($files)==$i)
                       $sub_paths=$sub_paths.'"'.$file_name.'":'.'"'.$file.'"';
                       else
                       $sub_paths=$sub_paths.'"'.$file_name.'":'.'"'.$file.'", ';
                   }
                   $sub_paths=$sub_paths.']}';
                    return new Response($sub_paths,200,$http_response_header=['Content-Type'=>'application/json']);

           }
               else return new Response('{"message":"no such file exists"}',404,$http_response_header=['Content-Type'=>'application/json']);

           }
        }






    public function user_data($user)
    {
        if(null==$user)
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
        $changes=["used_space"=>$folder_size,
        "file_count"=>$number_of_files];
        $user->update($changes);
        return $changes;
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

            if(sizeof(Storage::directories('user_files/'.$user->id.'/'.$file_name))>0)
            return $this->get_folder_paths($file_name,$user);

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

    public function destroy($request){
        if(null===auth()->user())
        return new Response('"message":"please provide correct Bearer Token"',401,$http_response_header=['Content-Type'=>'application/json']);
        else
        {
        $user=auth()->user();
        if(Storage::exists('user_files/'.$user->id.'/'.$request))
        {

            if(sizeof(Storage::directories('user_files/'.$user->id.'/'.$request))>0)
                Storage::deleteDirectory('user_files/'.$user->id.'/'.$request);
                else
                Storage::delete('user_files/'.$user->id.'/'.$request);
                $this->user_data($user);
                return new Response('{"message":"Resource was succesfully deleted"}',200,$http_response_header=['Content-Type' => 'application/json']) ;


        }
            else return new Response('{"message":"no such file exists"}',404,$http_response_header=['Content-Type'=>'application/json']);

        }
    }
    private function chooseImgPath($type){
        $white_list=['mp4','doc','css','csv','pdf','folder', 'html','jpg','js','zip','xml'];

        $result=asset('assets/media/svg/files/.svg');
        foreach ($white_list as $item){
            if ($item ==$type){
                $result=asset('assets/media/svg/files/'.$type.'.svg');
            }
        }
        return $result;

    }
    private function getImgPath($path)
    {
        $result='';
        if(is_dir('../storage/app/'.$path)){
            $result=$this->chooseImgPath('folder');

            return $result;
        }
        else
        {
            $tmp='';
            $temp=pathinfo($path);

            if(isset($temp['extension'])){
                $tmp=$temp['extension'];
            }
            $result=$this->chooseImgPath($tmp);
            return $result;
        }
    }

    public function showFolder(Request $request,$url=null)
    {

        $baseUrl='user_files/'.Auth::user()->id.'/';
        if (!Storage::exists($baseUrl))
            Storage::makeDirectory($baseUrl);
        $directories= Storage::directories($baseUrl.$url);
        $files=Storage::files($baseUrl.$url);
        $final=array_merge($directories,$files);
        $items=[];
        // dd($request->pathInfo);

        foreach ($final as $item) {
            $basename=pathinfo($item)['basename'];


            $items[]=[
                'svg_path'=>$this->getImgPath($item),
                'url'=>$request->getPathInfo().'/'.$basename,
                //'url'=>str_replace('files','',$request->path()).'/'.str_replace($baseUrl,'',$item),
                'basename'=>$basename
            ];

        }


        return view('files' , [
            'final' => $items
        ]);
    }

}
