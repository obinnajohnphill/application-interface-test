<?php

/**
 * This is a CustomerAddressDelete deletes customer address via API
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

class CustomerAddressDelete
{
    public function __construct()
    {
        $this->deleteCustomerAddress();
    }

    public function deleteCustomerAddress(): void
    {
        $database = new Database();
        $db = $database->getConnection();

        $item = new AddressSQL($db);
        $data = json_decode(file_get_contents("php://input"));

        $item->title = $data->title;
        $item->firstname = $data->firstname;
        $item->lastname = $data->lastname;
        $item->dob = $data->dob;
        $item->email = $data->email;
        $item->intl_number = $data->intl_number;
        $item->mobile_number = $data->mobile_number;
        $item->pwd = $data->pwd;
        $item->created_at = date('Y-m-d H:i:s');

        if($item->deleteAddress()){
            echo 'Address deleted successfully.';
        } else{
            echo 'Address could not be deleted.';
        }
    }

}