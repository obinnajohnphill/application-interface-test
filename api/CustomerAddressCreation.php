<?php

/**
 * This is a CustomerAddressCreation creates customer address via API
 *
 * @author  Obinna Johnphill <obinna.johnphill@googlemail.com>
 *
 * @since 1.0
 *
 */

declare(strict_types=1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../sql/AddressSQL.php';

class CustomerAddressCreation
{
    public function __construct()
    {
        $this->createCustomerAddress();
    }

    public function createCustomerAddress(): void
    {
        $database = new Database();
        $db = $database->getConnection();

        $item = new AddressSQL($db);
        $data = json_decode(file_get_contents("php://input"));

        $item->contact_name = $data->contact_name;
        $item->business_name = $data->business_name;
        $item->address_one = $data->address_one;
        $item->address_two = $data->address_two;
        $item->city = $data->city;
        $item->county = $data->county;
        $item->country = $data->country;
        $item->postcode = $data->postcode;
        $item->address_type = $data->address_type;
        $item->created_at = date('Y-m-d H:i:s');

        if($item->createAddress()){
            echo 'Address created successfully.';
        } else{
            echo 'Address could not be created.';
        }
    }

}