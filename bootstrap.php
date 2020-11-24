<?php
error_reporting(0);
require "vendor/autoload.php";
require "config.php";

if (COCKPIT_API_REQUEST) {
    $app->on('cockpit.rest.init', function($routes) use($app) {
        $routes['cloudinary'] = function() use($app){

            // If request includes deleteId
            if(isset($_POST["deleteId"])){
                $deletId = $_POST["deleteId"];
                $result = \Cloudinary\Uploader::destroy($deletId);
                return json_encode($result);
            }

            // If upload without file data
            if(!isset($_FILES["file"])){
                return json_encode(Array('Error'=>'You need to provide file data!'));
            }

            if(isset($_FILES["file"])){

                // Check file type
                $file_type = $_FILES['file']['type'];
                $allowed = array("image/jpeg", "image/gif", "image/png");
                if(!in_array($file_type, $allowed)) {
                    $err_msg = 'Only jpg, png and gif are allowed!';
                    return $app->stop(json_encode(['error' => [ 'message' => $err_msg ]]), 500);
                }

                $file = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $uId =  date('m-d-Y_hia').'_'.explode(".", $name)[0]; // UID
                $result =  \Cloudinary\Uploader::upload($file,array(
                    "folder" => "cockpit/",
                    "public_id" => $uId
                ));
                return json_encode($result);
            }
        };
    });
}