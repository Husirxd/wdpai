<?php
require_once __DIR__ . '/../../vendor/autoload.php';
class NewsletterApi{

    private string $api_token;
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../../");
        $dotenv->load();
        $this->api_token = $_ENV['MAILERLITE_API_TOKEN'];
        echo $this->api_token;
    }

    public function add_to_newsletter($email){
        $data = array(
            "email"=>$email
        );

        $data = json_encode( $data );
        $curl = curl_init();
        curl_setopt_array($curl,array(
            CURLOPT_URL => "https://connect.mailerlite.com/api/subscribers",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer ".$this->api_token,
                "content-type: application/json"
            ),
        ));
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);

        $response = curl_exec($curl);
        $err = curl_error($curl);   
        curl_close($curl);

        if ($err) {
            error_log( "cURL Error #:" . $err );
            error_log( json_encode( $err ) );
            return false;
        } else {
            $response = json_decode( $response );
            return $response->data;
        }     
    }
}
?>