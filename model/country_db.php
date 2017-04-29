<?php
class CountryDB {
    public static function get_countries() {
        $db = Database::getDB();

        $query = 'SELECT * FROM countries
              ORDER BY countryName';
        $statement = $db->prepare($query);
        $statement->execute();
        $countries = $statement->fetchAll();
        $statement->closeCursor();

        return $countries;
    }
}