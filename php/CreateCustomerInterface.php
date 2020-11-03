<?php


interface CreateCustomerInterface
{
    public function startNewDispatch();
    public function addConsignment();
    public function endCurrentBatch();
}