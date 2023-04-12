<?php

require_once __DIR__."/../controllers/NewsletterApi.class.php";
class NewsletterAjax{

    //create instance of NewsletterApi
    private $newsletterApi;
    //create singleton pattern
    private static $instance = null;
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new NewsletterAjax();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->newsletterApi = new NewsletterApi();
    }

    public function handle_request($data){
        switch($data['action']){
            case "subscribe":
                return $this->subscribe($data);
            default:
                return false;
        }
    }

    public function subscribe($data){
        $email = $data['email'];
        $this->newsletterApi->add_to_newsletter($email);
    }

}

//create instance of NewsletterAjax
$newsletterAjax = NewsletterAjax::getInstance();

$data = json_decode(file_get_contents('php://input'), true);
$responseData = [];
$responseData['data'] = $newsletterAjax -> handle_request($data);
echo json_encode($responseData);

?>