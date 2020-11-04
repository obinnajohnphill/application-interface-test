<?php

/**
 * This is a CreateCustomerAddress Class that a parent class to CreateRegistration Class
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

class CustomerEdit
{
    public function __construct()
    {
       $this->editCustomer();
    }

    public function editCustomer()
    {
        $database = new Database();
        $db = $database->getConnection();

        $item = new RegistrationSQL($db);

        $item->id = isset($_GET['id']) ? $_GET['id'] : die();

        $item->getCustomer();

        if ($item->id != null) {
            $emp_arr = array(
                "id" => $item->id,
                "title" => $item->title,
                "firstname" => $item->firstname,
                "lastname" => $item->lastname,
                "dob" => $item->dob,
                "email" => $item->email,
                "mobile_number" => $item->mobile_number,
                "pwd" => $item->pwd,
            );

            http_response_code(200);
            echo json_encode($emp_arr);
        } else {
            http_response_code(404);
            echo json_encode("Customer not found.");
        }
    }
}