<?php
class Incident {
    private $id,
            $customer_name,
            $product_name,
            $date_opened,
            $title,
            $description;

    public function __construct($customer_name, $product_name, $date_opened, $title, $description) {
        $this->customer_name = $customer_name;
        $this->product_name = $product_name;
        $this->date_opened = $date_opened;
        $this->title = $title;
        $this->description = $description;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_customer_name() {
        return $this->customer_name;
    }

//    public function set_customer_name() {
//        return Customer $customer->get_customer_full_name;
//    }

    public function get_product_name() {
        return $this->product_name;
    }

    public function get_date_opened() {
        return $this->date_opened;
    }

    public function set_date_opened($date_opened) {
        $this->date_opened = $date_opened;
    }
}