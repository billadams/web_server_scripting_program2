<?php
class Incident {
    private $id,
            $customer_id,
            $product_code,
            $tech_id,
            $date_opened,
            $date_closed,
            $title,
            $description;

    public function __construct($customer_id, $product_code, $tech_id, $date_opened, $date_closed, $title, $description) {
        $this->customer_id = $customer_id;
        $this->product_code = $product_code;
        $this->tech_id = $tech_id;
        $this->date_opened = $date_opened;
        $this->date_closed = $date_closed;
        $this->title = $title;
        $this->description = $description;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_customer_id() {
        return $this->customer_id;
    }

    public function set_customer_id($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function get_product_code() {
        return $this->product_code;
    }

    public function set_product_code($product_code)
    {
        $this->product_code = $product_code;
    }

    public function get_date_opened() {
        return $this->date_opened;
    }

    public function set_date_opened($date_opened) {
        $this->date_opened = $date_opened;
    }

    public function get_date_closed()
    {
        return $this->date_closed;
    }

    public function set_date_closed($date_closed)
    {
        $this->date_closed = $date_closed;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function set_description($description)
    {
        $this->description = $description;
    }
}
