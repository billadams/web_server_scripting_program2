<?php
class IncidentDB {
    public static function add_incident($customer_id, $product_code, $title, $description) {
        $db = Database::getDB();

        $date_opened = date('Y-m-d');  // get current date in yyyy-mm-dd format
        $query =
            'INSERT INTO incidents
            (customerID, productCode, dateOpened, title, description)
        VALUES (
               :customer_id, :product_code, :date_opened,
               :title, :description)';
        $statement = $db->prepare($query);
        $statement->bindValue(':customer_id', $customer_id);
        $statement->bindValue(':product_code', $product_code);
        $statement->bindValue(':date_opened', $date_opened);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_all_incidents()
    {
        $db = Database::getDB();

        $query =
            'SELECT * 
              FROM incidents';

        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchAll();
        $statement->closeCursor();

        return $incidents;
    }

    public static function get_unassigned_incidents()
    {
        $db = Database::getDB();

        $query =
            'SELECT * 
              FROM incidents 
                JOIN customers ON incidents.customerID = customers.customerID
                JOIN products on products.productCode = incidents.productCode
              WHERE techID IS NULL';
        //ORDER BY dateOpened DESC';
        $statement = $db->prepare($query);
        $statement->execute();
        $incidents = $statement->fetchAll();
        $statement->closeCursor();

        return $incidents;
    }

    public static function get_incident_by_id($incident_id)
    {
        $db = Database::getDB();

        $query =
            'SELECT *
            FROM incidents
            WHERE incidentID = :incident_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':incident_id', $incident_id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        return $row;
    }

    public static function update_incident($incident_id, $technician_id) {
        $db = Database::getDB();

        $query = 'UPDATE incidents
              SET techID = :technician_id
              WHERE incidentID = :incident_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':technician_id', $technician_id);
        $statement->bindValue(':incident_id', $incident_id);
        $statement->execute();
        $statement->closeCursor();
    }
}