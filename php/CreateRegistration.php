<?php

/**
 * This is a CreateRegistration Class that extends a parent CreateCustomerAddress Class
 * It also implements CreateCustomerInterface which is an abstract class
 *
 * @author  Obinna Johnphill <obinna.johnphill@googlemail.com>
 *
 * @since 1.0
 *
 */

declare(strict_types=1);


class CreateRegistration extends CreateCustomerAddress implements CreateCustomerInterface
{
    protected $consignment;
    private $dispatch_period;
    private $courier;

    /**
     * Counts the number of items in the provided array.
     *
     * @param array $consignment
     * @param array $dispatch_period
     * @param string $courier
     */
      public function __construct(array $consignment, array $dispatch_period, array $courier)
        {
           $this->consignment = $consignment;
           $this->dispatch_period = $dispatch_period;
           $this->courier = $courier;
        }


    /**
     * Gets the dispatch period and set the start and end time.
     *
     * @return array Returns the start and end time.
     */
    public function startNewDispatch(): array{
        $dispatch_time = array();
        foreach ($this->dispatch_period as $period){
            if($this->isTodayWeekend() == true AND $period['day'] == "Weekend"){
                $dispatch_time = array("start"=>$period['start'], "end"=>$period['end']);
            }else{
                $dispatch_time = array("start"=>$period['start'], "end"=>$period['end']);
            }
        }
        return $dispatch_time;
    }


    /**
     * Generates unique code and assigns to the consignment.
     *
     * @return array Returns the consignment as array.
     */
    public function addConsignment(): array
    {
        $generated_consignment = array();
        for($i=0; $i < count($this->consignment); $i++) {
            $generated_consignment[] = array("product" => $this->consignment[$i],"uniqueID" => strtoupper(uniqid()));
        }
        return $generated_consignment;
    }


    /**
     * Creates consignment batches and sends them to courries via a parent Class.
     *
     *
     * @return string Returns a string message.
     */
    public function endCurrentBatch(): string
    {
        $batch = array();
        $batch_no = count($this->addConsignment()) / count($this->courier);
        for($i=0; $i < count($this->courier); $i++){
            $batch[] = array_slice($this->addConsignment(),$batch_no);
        }
        date_default_timezone_set("Europe/London");
        $time = $this->startNewDispatch();
        if (strtotime(date('H:i')) >= strtotime( $time["start"]) OR strtotime(date('H:i')) <= strtotime( $time["end"])){
            foreach ($this->courier as $key => $email){
                if($key == "Royal Mail"){
                    parent::sendEmail($email,$batch[0]);
                }else{
                    parent::sendFTP($batch[1]);
                }
            }
        } else {
            throw new \Exception('The time now is outside of the dispatch period!');
        }
        return "ended current batch";
    }

    /**
     * Checks is the current day is a weekday or weekend.
     *
     * @return bool Returns true if today is a weekend or false if not.
     */
    public function isTodayWeekend(): bool {
        return in_array(date("l"), ["Saturday", "Sunday"]);
    }
}