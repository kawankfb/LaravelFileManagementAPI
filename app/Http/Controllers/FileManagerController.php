<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FileManagerController extends Controller
{
    private function isDirectory($path){
        return is_dir('../storage/app/'.$path);
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
        if($this->isDirectory($path)){
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


        $finalPath=$baseUrl.$url;
        if ($this->isDirectory($finalPath)) {
            $directories = Storage::directories($finalPath);
            $files = Storage::files($finalPath);
            $final = array_merge($directories, $files);
            $items = [];

            if (str_ends_with($request->getPathInfo(), '/'))
                $connective = substr($request->getPathInfo(), 0, strlen($request->getPathInfo()) - 1);
            else
                $connective = $request->getPathInfo();


            foreach ($final as $item) {
                $basename = pathinfo($item)['basename'];


                $items[] = [
                    'svg_path' => $this->getImgPath($item),
                    'url' => $connective . '/' . $basename,
                    'basename' => $basename
                ];

            }


            return view('files', [
                'final' => $items,
                'file_count' => Auth::user()->file_count,
                'route' =>$connective,
                'used_space' =>number_format((float)(Auth::user()->used_space/1024)/1024, 2, '.', '')
            ]);
        }
        else{

            if (Storage::exists($finalPath)){
                return redirect(URL::temporarySignedRoute('download',now()->addMinutes(1),['url' =>$finalPath]));
            }
            else{
                abort(404);
            }
        }
    }

    public function downloader($url)
    {
        return Storage::download($url);
    }

    public function spaceCalculator()
    {
        $folder_size=0;
        $number_of_files=0;
        $user=Auth::user();
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



    public function store(Request $request, $url=null)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'max:20480', //20MB
        ]);
        $baseUrl='user_files/'.Auth::user()->id.'/';
        if (!Storage::exists($baseUrl))
            Storage::makeDirectory($baseUrl);

        $folder= $request->input('folder');
        if (isset($folder)){
            Storage::makeDirectory($baseUrl.$url.'/'.$folder);
        }
        $file=$request->file('file');
        if (isset($file))
        Storage::putFileAs($baseUrl.$url , $file,$file->getClientOriginalName());

        $this->spaceCalculator();

        return back();

    }

    public function delete(Request $request, $url)
    {

        $baseUrl='user_files/'.Auth::user()->id.'/';
        if ($this->isDirectory($baseUrl.$url))
            Storage::deleteDirectory($baseUrl.$url);
        else
            Storage::delete($baseUrl.$url);

        $this->spaceCalculator();

        return back();

    }
}
