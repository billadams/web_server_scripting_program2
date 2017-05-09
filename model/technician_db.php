<?php
class TechnicianDB {

    public static function getTechnicians() {
        $db = Database::getDB();

        $query = 'SELECT * FROM technicians
                  ORDER BY lastName';
        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        
        $technicians = array();
        foreach($rows as $row) {
            $t = new Technician(
                    $row['firstName'], $row['lastName'],
                    $row['email'], $row['phone'], $row['password']);
            $t->setID($row['techID']);
            $technicians[] = $t;
        }
        return $technicians;
    }

    public static function deleteTechnician($technician_id) {
        $db = Database::getDB();

        $query = 'DELETE FROM technicians
                 WHERE techID = :technician_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':technician_id', $technician_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function addTechnician($t) {
        $db = Database::getDB();
        
        $query = 'INSERT INTO technicians
                     (firstName, lastName, phone, email, password)
                  VALUES
                     (:first_name, :last_name, :phone, :email, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $t->getFirstName());
        $statement->bindValue(':last_name', $t->getLastName());
        $statement->bindValue(':phone', $t->getPhone());
        $statement->bindValue(':email', $t->getEmail());
        $statement->bindValue(':password', $t->getPassword());
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_num_open_incidents_by_technician()
    {
        $db = Database::getDB();

        $query = 'SELECT technicians.techID, firstName, lastName, COUNT(*) AS openInvoices
                  FROM technicians JOIN incidents
                    ON technicians.techID = incidents.techID
                  GROUP BY firstName, lastName
                  ORDER BY openInvoices';

        $statement = $db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        return $rows;
    }

    public static function update_incident($incident_id, $technician_id) {
        $db = Database::getDB();

        $query = 'UPDATE incidents
              SET techID = :technician_id
              WHERE incidentID = :technician_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':technician_id', $technician_id);
        $statement->bindValue(':incident_id', $incident_id);
        $statement->execute();
        $statement->closeCursor();
    }
}