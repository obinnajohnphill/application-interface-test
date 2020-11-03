<?php

/**
 * This is a CreateCustomerTest Class
 * The code test data is setup here
 * Some of the functions as tested but not extensively due to time or lack of it factor
 *
 * @author  Obinna Johnphill <obinna.johnphill@googlemail.com>
 *
 * @since 1.0
 *
 */
    declare(strict_types = 1);

    use PHPUnit\Framework\TestCase;

    class CreateCustomerTest extends TestCase{

        protected $newClassWithInterface;
        protected $consignment = array ("Red Shoe", "White Shoe","Green Bag", "yellow Shoe","Red Bag", "White Dress","Green Shoe", "yellow Bag");
        protected $dispatch_period = array(array("day"=>"Weekday",'start'=>"8:00","end"=>"18:00"), array("day"=>"Weekend",'start'=>"10:00","end"=>"14:00"));
        protected $courier = array("Royal Mail"=>"courier@royalmail.com","ANC"=>"courier@anc.com");

        protected function setUp(): void{
            $this->newClassWithInterface = new CreateRegistration($this->consignment, $this->dispatch_period , $this->courier);
        }

        public function testStartNewDispatch(): void{
            $this->assertArrayHasKey(
                'start',
                $this->newClassWithInterface->startNewDispatch()
            );
            $this->assertArrayHasKey(
                'end',
                $this->newClassWithInterface->startNewDispatch()
            );
        }

        public function testAddConsignment(): void{
            $this->assertArrayHasKey(
                'product',
                $this->newClassWithInterface->addConsignment()[0]
            );
            $this->assertArrayHasKey(
                'uniqueID',
                $this->newClassWithInterface->addConsignment()[0]
            );
        }

        public function testEndCurrentBatch(): void{
            $this->assertEquals(
                'ended current batch',
                $this->newClassWithInterface->endCurrentBatch()
            );
        }


    }
