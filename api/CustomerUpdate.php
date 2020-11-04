<?php

/**
 * This is a CustomerUpdate updates customer details via API
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
include_once '../sql/RegistrationSQL.php';

class CustomerUpdate
{
    public function __construct()
    {
        $this->updateCustomer();
    }

    public function updateCustomer(): void
    {
        $database = new Database();
        $db = $database->getConnection();

        $item = new RegistrationSQL($db);
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

        if($item->addCustomer()){
            echo 'Customer created successfully.';
        } else{
            echo 'Customer could not be created.';
        }
    }

}