<?php
class order {
    private $id;
    private $customer_id;
    private $timestamp;
    private $status;
    private $total_price;

    public function __construct($id, $customer_id, $timestamp, $status, $total_price) {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->timestamp = $timestamp;
        $this->status = $status;
        $this->total_price = $total_price;
    }

    public function getId() {
        return $this->id;
    }
    public function getCustomerId() {
        return $this->customer_id;
    }
    public function getTimestamp() {
        return $this->timestamp;
    }
    public function getStatus() {
        return $this->status;
    }
    public function getTotalPrice() {
        return $this->total_price;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
    }
    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    public function setStatus($status) {
        $this->status = $status;
    }
    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }
}