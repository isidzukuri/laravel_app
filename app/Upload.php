<?php

namespace App;


use File;

class Upload
{
    
    public static $upload_dirs = array('files','images/uploads');
    

    public static function get_all_files_data(){
        $data = array();
        $files = self::get_all_files_pathes();
        foreach ($files  as $public_path) {
            $data[] = self::get_fileifo_by_path($public_path);
        }
        return $data;
    }


    public static function get_all_files_pathes(){
        $data = array();
        foreach (self::$upload_dirs as $dir) {
            $data = array_merge($data, File::files(public_path($dir)));
        }
        return $data;
    }


    public static function get_fileifo_by_path($public_path){
        $path_in_public = str_replace(base_path('public'), '', $public_path);
        $data = array(
            'name' => File::name($public_path),
            'extension' => File::extension($public_path),
            'path_in_public' => $path_in_public,
            'url' => url($path_in_public),
            'full_path' => $public_path,
            'kb' => File::size($public_path)/1024,
        );
        return $data;
    }


    public static function delete_file($full_filename){
        return File::delete($full_filename);
    }

}
