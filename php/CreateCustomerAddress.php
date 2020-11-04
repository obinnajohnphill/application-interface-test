<?php

/**
 * This is a CreateCustomerAddress creates customer address via API
 *
 * @author  Obinna Johnphill <obinna.johnphill@googlemail.com>
 *
 * @since 1.0
 *
 */

declare(strict_types=1);


class CreateCustomerAddress
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
        $this->createCustomerAddressAPI();
    }


    public function createCustomerAddressAPI(){
        $data = array(
            "contact_name" => $this->request['contact_name'],
            "business_name" => $this->request['business_name'],
            "address_one" => $this->request['address_one'],
            "address_two" => $this->request['address_two'],
            "city" => $this->request['city'],
            "county" => $this->request['county'],
            "country" => $this->request['country'],
            "postcode" => $this->request['postcode'],
            "address_type" => $this->request['address_type'],
        );

        $ch = curl_init($this->url);
        $data_string = json_encode($data);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("addresses"=>$data_string));

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