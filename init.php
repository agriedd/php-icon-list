<?php

use App\FileManager;
use App\Response;

if(isset($_GET['reload'])){
    $data = FileManager::readFiles('./node_modules/bootstrap-icons/icons');
    FileManager::storeFile(json_encode($data), './storage/', 'icon.json');
}
if(isset($_GET['get'])){
    $data = FileManager::restoreFile('./storage/icon.json');
    $data = json_decode($data);
    Response::json($data);
}
if(isset($_GET['find'])){
    $data = FileManager::restoreFile('./storage/icon.json');
    $data = (array) json_decode($data);
    $data = array_filter($data, function($icon){
        return preg_match("/{$_GET['find']}/im", $icon->name);
    });
    Response::json($data);
}