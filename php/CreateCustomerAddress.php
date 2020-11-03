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

class CreateCustomerAddress
{

    private $email;
    protected $consignment;

    /**
     *  Constructor which calls email validation and assigns email to variable
     * @param string
     * @param array $consignment
     */
    private function __construct(string $email)
    {
        $this->checkIfValidEmail($email);
        $this->email = $email;
    }

    public static function fromString(string $email): self
    {
        return new self($email);
    }

    public function __toString(): string
    {
        return $this->email;
    }

    /**
     *  Checks if email is valid
     * @param string $email
     * @return void
     */
    private function checkIfValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf(
                    '"%s" is not a valid email address',
                    $email
                )
            );
        }
    }

    /**
     *  Send consignment via email
     * @param string $email
     * @param array $consignment
     * @return void
     */
    protected function sendEmail($email,$consignment): void
    {
        try {
            $to = $email;
            $items = "";
            $subject = "Blobs Clothing Order Dispatch";
            foreach ($consignment as $value) {
                $items .= ($value["product"]).': '.$value["uniqueID"].PHP_EOL;
            }
            $headers = "From: admin@blobs-clothing.com" . "\r\n" .
                "CC: manager@blobs-clothing.com";
            mail($to,$subject,$items,$headers);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    /**
     *  Send consignment via FTP
     * @param array $consignment
     * @return void
     */
    protected function sendFTP(array $consignment): void
    {
        $this->writeFile($consignment);
        $file = 'dispatch.txt';
        $ftp_server = "IP ADDRESS"; // Address of FTP server.
        $ftp_user_name = " SERVER USERNAME"; // Username
        $ftp_user_pass = " SERVER PASSWORD"; // Password

        $conn_id = ftp_connect($ftp_server);
        if($conn_id) {
            $login = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
            if ($login == true) {
                if (ftp_put($conn_id, $file, FTP_ASCII)) {
                    echo "successfully uploaded $file\n";
                } else {
                    echo "There was a problem while uploading $file\n";
                }
            }
            ftp_close($conn_id);
        }
    }


    /**
     *  Creates a file dispatch.txt
     *  Writes consignment dispatch to the file
     * @param array $consignment
     * @return bool
     */
    protected function writeFile(array $consignment): bool
    {
        try {
            $items = "";
            $file = fopen("dispatch.txt", "w");
            foreach ($consignment as $value) {
                $items .= ($value["product"]).': '.$value["uniqueID"].PHP_EOL;
            }
            fwrite($file, $items);
            fclose($file);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return true;
    }
}