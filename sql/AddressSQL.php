<?php


class AddressSQL
{
    private $conn;

    private $db_table = "addresses";

    public $id;
    public $contact_name;
    public $business_name;
    public $address_one;
    public $address_two;
    public $city;
    public $county;
    public $country;
    public $postcode;
    public $address_type;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

   /*
    public function getAllAddress()
    {
        $sqlQuery = "SELECT id, name, email, age, designation, created FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
   */

    public function createAddress()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        contact_name = :contact_name, 
                        business_name = :business_name, 
                        address_one = :address_one, 
                        address_two = :address_two, 
                        city = :city,
                        county = :county,
                        country = :country,
                        postcode = :postcode,
                        address_type = :address_type,
                        created_at = :created_at";

        $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->contact_name = htmlspecialchars(strip_tags($this->contact_name));
        $this->business_name = htmlspecialchars(strip_tags($this->business_name));
        $this->address_one= htmlspecialchars(strip_tags($this->address_one));
        $this->address_two = htmlspecialchars(strip_tags($this->address_two));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->county = htmlspecialchars(strip_tags($this->county));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->postcode = htmlspecialchars(strip_tags($this->postcode));
        $this->address_type = htmlspecialchars(strip_tags($this->address_type));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        // bind data
        $stmt->bindParam(":contact_name", $this->contact_name);
        $stmt->bindParam(":business_name", $this->business_name);
        $stmt->bindParam(":address_one", $this->address_one);
        $stmt->bindParam(":address_two", $this->address_two);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":county", $this->county);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":postcode", $this->postcode);
        $stmt->bindParam(":address_type", $this->address_type);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($stmt->execute()) {
            return true;
        }
        print_r($stmt->errorInfo());
        return false;
    }


    public function getAddress()
    {
        $sqlQuery = "SELECT
                        id, 
                        contact_name, 
                        business_name, 
                        address_one, 
                        address_two, 
                        city,
                        county,
                        country,
                        postcode,
                        address_type,
                        created_at
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->contact_name = $dataRow['contact_name '];
        $this->business_name = $dataRow['business_name'];
        $this->address_one = $dataRow['address_one'];
        $this->address_two = $dataRow['address_two'];
        $this->city = $dataRow['city'];
        $this->county = $dataRow['county'];
        $this->country = $dataRow['country'];
        $this->postcode = $dataRow['postcode'];
        $this->address_type = $dataRow['address_type'];
        $this->created_at = $dataRow['created_at'];
    }


    public function updateAddress()
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        contact_name = :contact_name, 
                        business_name = :business_name,  
                        address_one = :address_one, 
                        address_two = :address_two, 
                        city = :city, 
                        county = :county, 
                        country = :country, 
                        postcode = :postcode, 
                        address_type = :address_type, 
                        created = :created
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->contact_name = htmlspecialchars(strip_tags($this->contact_name));
        $this->business_name = htmlspecialchars(strip_tags($this->business_name));
        $this->address_one= htmlspecialchars(strip_tags($this->address_one));
        $this->address_two = htmlspecialchars(strip_tags($this->address_two));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->county = htmlspecialchars(strip_tags($this->county));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->postcode = htmlspecialchars(strip_tags($this->postcode));
        $this->address_type = htmlspecialchars(strip_tags($this->address_type));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        // bind data
        $stmt->bindParam(":contact_name", $this->contact_name);
        $stmt->bindParam(":business_name", $this->business_name);
        $stmt->bindParam(":address_one", $this->address_one);
        $stmt->bindParam(":address_two", $this->address_two);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":county", $this->county);
        $stmt->bindParam(":country", $this->country);
        $stmt->bindParam(":postcode", $this->postcode);
        $stmt->bindParam(":address_type", $this->address_type);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    function deleteAddress()
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