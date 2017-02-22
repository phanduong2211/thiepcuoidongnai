<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;

class UploadController extends BaseController
{

	public function upload(){
		return view("admin.upload");
	}

	public function loadfolder(){
		$path=public_path()."/image/".$_POST['folder'];
        
        if(!file_exists($path)){
            return -1;
        }

        $dir=scandir($path);

        unset($dir[0]);
        unset($dir[1]);

        $arr=array();

        $now=time();

        foreach ($dir as $key) {
            
            if(is_dir($path."/".$key))
            {
                 array_push($arr, array("name"=>$key,"time"=>'9999999999'));
            }else{
                $time=filemtime($path."/".$key);
                $size=filesize($path."/".$key);
                list($width,$height)=getimagesize($path."/".$key);
                $date=date("d/m/Y H:i",$time);
                array_push($arr, array("name"=>$key,"time"=>$date,"size"=>$size,"width"=>$width,"height"=>$height));
            }
        }

        return json_encode($arr);
	}

	public function checkfile(){
		$path=public_path()."/image/".$_POST['filename'];
        if(file_exists($path))
            return 1;
        return 2;
	}

	public function removeimg(){
		$path=public_path()."/image/".$_POST['file'];
        if(file_exists($path)){
            $result=unlink($path);

            return json_encode($result);
        }
        return -1;
	}

    public function removefolder(){
        $path=public_path()."/image/".$_POST['file'];
        if(file_exists($path)){
            $dir=scandir($path);

            if(count($dir)==2)
            {
                if(rmdir($path)){
                    return 1;
                }
                return -1;
            }

            return 3;
        }
        return 2;
    }

    public function createfolder(){
        if(isset($_POST['foldername'])){
            $path = public_path().'/image/'.$_POST['folderroot'].'/'.$_POST['foldername'];
            if(!file_exists($path)){
                if(mkdir($path))
                return 1;
             return -1;
            }
           
            return -1;
        }
    }

    public function loadonlyfolder(){
        $path=public_path()."/image/".$_POST['folder'];
        
        if(!file_exists($path)){
            return -1;
        }

        $dir=scandir($path);

        unset($dir[0]);
        unset($dir[1]);

        $arr=array();

        foreach ($dir as $key) {
            if(is_dir($path."/".$key))
            {
                 $arr[]=$key;
            }
        }

        return json_encode($arr);
    }
}

?>