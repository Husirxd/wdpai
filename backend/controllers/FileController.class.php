<?php 

class FileManager{

    //implement singleton pattern
    private static $instance = null;

    private string $target_dir = __DIR__ ."/../uploads/";
    private function __construct(){}

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new FileManager();
        }
        return self::$instance;
    }

    public function uploadFile($file, int $user_id = 0, $target_ext = "img"){
            
        $uploadOk = true;

        if($user_id){
            $this->checkUserFolder($user_id);
            $this->target_dir = __DIR__ ."/../uploads/user".$user_id."/";
        }

        $fileTemp = $file["tmp_name"];
        $fileTrueType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));

        $fileType = $this->checkType($fileType);
        $fileSize = $this->checkSize($file);
        $fileType == $target_ext ? $uploadOk = 1 : $uploadOk = 0;
        $fileSize ? $uploadOk = 1 : $uploadOk = 0;

        //prepare file for upload
        $file["name"] = uniqid() . "." . $fileTrueType;


        if ($uploadOk == 0) {
            return false;
        } else {
            $target_file = $this->target_dir . basename($file["name"]);

            if (move_uploaded_file($file['tmp_name'], $target_file)) {
                return "/uploads/user".$user_id."/".$file["name"];
            } else {
                return false;
            }
        }
    }

    private function checkUserFolder($user_id){
        if(!file_exists(__DIR__ ."/../uploads/user".$user_id)){
            mkdir(__DIR__ ."/../uploads/user".$user_id, 0777, true);
        }
    }


    private function checkType($file_ext){
        if(in_array($file_ext ,["jpg", "png", "jpeg", "gif"]) ) {
            return "img";
        }else{
            return false;
        }
    }
    
    private function checkSize($file){
        if($file["size"] > 500000){
            return false;
        }else{
            return true;
        }
    }


    public function deleteImage($file){
        if(file_exists($file)){
            unlink($file);
            return true;
        }else{
            return false;
        }
    }

}

?>