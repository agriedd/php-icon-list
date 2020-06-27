<?php
    namespace App;

    class FileManager{
        public static function readFiles($path){
            if(is_dir($path)){
                $files = array_diff(scandir($path), array('.', '..'));
                $data = array();
                foreach($files as $index => $file){
                    $read = file_get_contents("{$path}/{$file}");
                    $data[$index] = array(
                        "id"    => $index,
                        "name"  => $file,
                        "src"   => "{$path}/{$file}",
                        "file"  => $read,
                    );
                }
                header("Content-Type: application/json");
                echo json_encode($data);
            }
        }
    }