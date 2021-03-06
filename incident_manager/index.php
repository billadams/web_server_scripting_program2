<?php
require('../model/database_oo.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/incident_db.php');
require('../model/technician_db.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'select_incident';
    }
}

//instantiate variable(s)
$email = '';

switch ($action) {
    case 'display_customer_get':
        include('customer_get.php');
        break;
    case 'get_customer':
        $email = filter_input(INPUT_POST, 'email');
        $customer = CustomerDB::get_customer_by_email($email);
        $products = ProductDB::get_products_by_customer($email);
        include('incident_create.php');
        break;
    case 'select_incident':
        $message = "This incident was added to our database.";
        $incidents = IncidentDB::get_unassigned_incidents();
        include('incident_select.php');
        break;
    case 'create_incident':
        $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_VALIDATE_INT);
        $product_code = filter_input(INPUT_POST, 'product_code');
        $title = filter_input(INPUT_POST, 'title');
        $description = filter_input(INPUT_POST, 'description');
        IncidentDB::add_incident($customer_id, $product_code, $title, $description);
        $message = "This incident was added to our database.";
        include('incident_create.php');
        break;
    case 'select_tech_for_incident':
        $incident_id = filter_input(INPUT_POST, 'incident_id', FILTER_VALIDATE_INT);
        $_SESSION['incident_id'] = $incident_id;

        $rows = TechnicianDB::get_num_open_incidents_by_technician();

        include('select_tech_for_incident.php');
        break;
    case 'assign_incident':
        $assigned = false;

        $technician_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
        $_SESSION['technician_id'] = $technician_id;

        $incident = IncidentDB::get_incident_by_id($_SESSION['incident_id']);

        $customer_id = $incident['customerID'];
        $customer = CustomerDB::get_customer($customer_id);
        $customer_name = $customer['firstName'] . ' ' .$customer['lastName'];

        $product_code = $incident['productCode'];

        $technician = TechnicianDB::get_technician_by_id($_SESSION['technician_id']);
        $technician_name = $technician['firstName'] . ' ' . $technician['lastName'];

        include('assign_incident.php');
        break;
    case 'update_incident':
        $assigned = true;
        IncidentDB::update_incident($_SESSION['incident_id'], $_SESSION['technician_id']);

        include('assign_incident.php');
        break;
}
?>