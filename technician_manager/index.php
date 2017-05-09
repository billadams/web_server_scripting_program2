<?php
require('../model/database_oo.php');
require('../model/technician.php');
require('../model/technician_db.php');
require('../model/incident_db.php');
require('../model/customer_db.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_technicians';
    }
}

switch ($action) {
    case 'list_technicians':
        // Get technician data
        $technicians = TechnicianDB::getTechnicians();

        // Display the technician list
        include('technician_list.php');
        break;
    case 'delete_technician':
        $technician_id = filter_input(INPUT_POST, 'technician_id', FILTER_VALIDATE_INT);
        TechnicianDB::deleteTechnician($technician_id);
        header("Location: .");
        break;
    case 'show_add_form':
        include('technician_add.php');
        break;
    case 'add_technician':
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $phone = filter_input(INPUT_POST, 'phone');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        // Validate the inputs
        if (empty($first_name) || empty($last_name) || empty($phone) ||
            $email === NULL || $email === FALSE || empty($password)) {
                $error = "Invalid technician data. Check all fields and try again.";
                include('../errors/error.php');
        } else {
            // Create technician object
            $t = new Technician($first_name, $last_name, $email, $phone, $password);
            TechnicianDB::addTechnician($t);
            header("Location: .");
        }
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