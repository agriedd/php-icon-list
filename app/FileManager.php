<?php
    namespace App;

    class FileManager{
        public static function readFiles($path){
            if(is_dir($path)){
                $files = array_diff(scandir($path), array('.', '..'));
                $data = array();
                foreach($files as $index => $file){
                    $read = file_get_contents("{$path}/{$file}");
                    $tags = preg_replace("/(\.(.*))$/im", "", $file);
                    $tags = explode("-", $tags);
                    $data[] = array(
                        "id"    => $index,
                        "name"  => $file,
                        "src"   => "{$path}/{$file}",
                        "file"  => $read,
                        "tag"   => $tags,
                    );
                }
                return $data;
            }
            return null;
        }
        public static function storeFile($file, $path = "./", $name = "file.txt"){
            if(!file_exists($path) || !is_dir($path))
                mkdir($path, 0755, true);
            file_put_contents("{$path}/{$name}", $file);
        }
        public static function restoreFile($path = "./file.txt"){
            if(file_exists($path) && is_file($path))
                return file_get_contents($path);
            return null;
        }
    }