<?php

require_once __DIR__."/../controllers/NewsletterApi.class.php";
class NewsletterAjax{

    private $newsletterApi;
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
?>