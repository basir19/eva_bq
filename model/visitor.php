<!------------------------------------------------------------------------------
  Modification Log
  Date          Name            Description
  ----------    -------------   -----------------------------------------------
  2-11-2019      JWokersien      Initial Deployment.
  ----------------------------------------------------------------------------->
<?php
    // Add the visitor to the database  
    function add_visitor ($visitor_name, $visitor_email, $visitor_msg) {
        $db = Database::getDB();
        $query = 'INSERT INTO visitor
                     (visitor_name, visitor_email, visitor_msg)
                  VALUES
                     (:visitor_name, :visitor_email, :visitor_msg)';
        $statement = $db->prepare($query);
        $statement->bindValue(':visitor_name', $visitor_name);
        $statement->bindValue(':visitor_email', $visitor_email);
        $statement->bindValue(':visitor_msg', $visitor_msg);
        $statement->execute();
        $statement->closeCursor();
        /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg; */
    }
        function getVisitors($employeeID){
        $db = Database::getDB();

//        $query2 = 'SELECT * FROM visitor
//                join history on visitor.visitor_id = history.visitor_id
//                WHERE employeeID = :employeeID
//                ORDER BY visitor_email';
        $query2 = 'SELECT * FROM visitor';
        $statement2 = $db->prepare($query2);
        //$statement2->bindValue(":employeeID", $employeeID);
        $statement2->execute();
        $visitors = $statement2;
        return $visitors;
    }
    
    function deleteVisitor($visitor_id){
        $db = Database::getDB();
        $visitor_id = filter_input(INPUT_POST, 'visitor_id', 
                FILTER_VALIDATE_INT);
        $query = 'DELETE FROM visitor
                  WHERE visitor_id = :visitor_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':visitor_id', $visitor_id);
        $statement->execute();
        $statement->closeCursor();
        //echo ($visitor_id);
        
    }
?>