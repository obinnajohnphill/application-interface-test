<?php

/**
 * This is a CreateCustomer creates customer details via API
 *
 * @author  Obinna Johnphill <obinna.johnphill@googlemail.com>
 *
 * @since 1.0
 *
 */

declare(strict_types=1);


class CreateRegistration
{
    protected $request;
    protected $url = "http://127.0.0.1:8080/api/customer";

    /**
     * Counts the number of items in the provided array.
     * @param array $request
     *
     * @return void
     */
     public function __construct($request)
     {
         $this->request = $request;
         $this->createCustomerAPI();
     }


    public function createCustomerAPI(){
        $data = array(
                        "title" => $this->request['title'],
                        "firstname" => $this->request['firstname'],
                        "lastname" => $this->request['lastname'],
                        "dob" => $this->request['dob'],
                        "email" => $this->request['email'],
                        "intl_number" => $this->request['intl_number'],
                        "mobile_number" => $this->request['mobile_number'],
                        "pwd" => $this->request['pwd'],
                     );

        $ch = curl_init($this->url);
        $data_string = json_encode($data);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("customer"=>$data_string));

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);

        if (isset($error_msg)) {
            var_dump($error_msg);
            var_dump($httpcode);
        }


        curl_close($ch);

        echo $result;

        var_dump($result);
        die();
    }

}