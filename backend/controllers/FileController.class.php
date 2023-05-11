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

    public function uploadFile($t_file, int $user_id = 0, $target_ext = "img"){
    
        $uploadOk = true;
        $fileTemp = $t_file["tmp_name"];
    
        if($user_id){
            $this->checkUserFolder($user_id);
            $this->target_dir = __DIR__ ."/../uploads/user".$user_id."/";
        }
        $fileTrueType = strtolower(pathinfo($t_file["name"],PATHINFO_EXTENSION));

        $fileType = $this->checkType($fileTrueType);
        $fileSize = $this->checkSize($t_file);
        $fileName = $t_file["name"] = uniqid() . "." . $fileTrueType;

        if ($uploadOk == 0)  return false;

            $target_file = $this->target_dir . basename($fileName);

            if (move_uploaded_file($fileTemp, $target_file)) {
                return "/uploads/user".$user_id."/".$fileName;
            } else {
                return false;
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