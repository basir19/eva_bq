<!------------------------------------------------------------------------------
  Modification Log
  Date          Name            Description
  ----------    -------------   -----------------------------------------------
  2-11-2019      JWokersien      Initial Deployment.
  ----------------------------------------------------------------------------->
<?php
     function getEmployees(){
        $db = Database::getDB();
        $query = 'SELECT * FROM employeelist
                  ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();
        $employees = $statement;

        return $employees;
        }
?>