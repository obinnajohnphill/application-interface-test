<?php


class RegistrationSQL
{
    private $conn;
    private $db_table = "customers";

    public $id;
    public $title;
    public $firstname;
    public $lastname;
    public $dob;
    public $email;
    public $intl_number;
    public $mobile_number;
    public $pwd;
    public $created_at;


    public function __construct($db)
    {
        $this->conn = $db;
    }



    public function getAllCustomer()
    {
        $sqlQuery = "SELECT id, title, firstname, lastname, dob,email,intl_number,mobile_number created_at FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function addCustomer()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        title = :title, 
                        firstname = :firstname, 
                        lastname = :lastname, 
                        dob = :dob, 
                        email = :email, 
                        intl_number = :intl_number,
                        mobile_number = :mobile_number,
                        pwd = :pwd,
                        created_at = :created_at";


        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->title= htmlspecialchars(strip_tags($this->title));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->intl_number = htmlspecialchars(strip_tags($this->intl_number));
        $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));
        $this->pwd = htmlspecialchars(strip_tags($this->pwd));
        $this->created_at =htmlspecialchars(strip_tags($this->created_at));

        // bind data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":intl_number", $this->intl_number);
        $stmt->bindParam(":mobile_number", $this->mobile_number);
        $stmt->bindParam(":pwd", $this->pwd);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($stmt->execute()) {
            return true;
        }
        print_r($stmt->errorInfo());
        return false;
    }


    public function getCustomer()
    {
        $sqlQuery = "SELECT
                        id, 
                        title, 
                        firstname, 
                        lastname, 
                        dob, 
                        email,
                        intl_number,
                        mobile_number,
                        pwd
                      FROM
                        " .$this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $dataRow['title'];
        $this->firstname = $dataRow['firstname'];
        $this->lastname = $dataRow['lastname'];
        $this->dob = $dataRow['dob'];
        $this->email  = $dataRow['email'];
        $this->intl_number = $dataRow['intl_number'];
        $this->mobile_number  = $dataRow['mobile_number'];
        $this->pwd = $dataRow['pwd'];
    }

    public function updateCustomer()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        title = :title, 
                        firstname = :firstname, 
                        lastname = :lastname, 
                        dob = :dob, 
                        email = :email, 
                        mobile_number = :mobile_number,
                        pwd = :pwd,
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->title= htmlspecialchars(strip_tags($this->title));
        $this->firstname = htmlspecialchars(strip_tags($this->firstname));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->dob = htmlspecialchars(strip_tags($this->dob));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mobile_number = htmlspecialchars(strip_tags($this->mobile_number));
        $this->pwd = htmlspecialchars(strip_tags($this->pwd));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":firstname", $this->firstname);
        $stmt->bindParam(":lastname", $this->lastname);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":mobile_number", $this->mobile_number);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    function deleteCustomer()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}