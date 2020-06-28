<?php
    namespace App;

    use Exception;

    class Response{
        public static function json($data){
            header('Content-Type: application/json');
            try{
                $data = json_encode($data);
            } catch(Exception $e){

            }
            echo $data;
            exit();
        }
    }