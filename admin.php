<?php
#project four starts
//$useName = filter_input(INPOT_POST, 'userName');    
//$password = filter_input(INPOT_POST, 'password');
//
//if(empty($useName) || empty($password)){
//    header('Location: logIn.html');
//}
//
//try{
//    include_once './database/database.php';
//    $db = Database::getDB();
//} catch (Exception $ex) {
//    echo "connection error: ". $e->getMessage();
//    exit();
//}




#project four ends

//    {
//    $dsn = 'mysql:host=localhost;dbname=ejdesign'; // the name of the database for the website
//    $username = 'root';
//    $password = 'Pa$$w0rd';
//
//    try {
//        $db = new PDO($dsn, $username, $password);
//
//    } catch (PDOException $e) {
//        $error_message = $e->getMessage();
//        /* include('database_error.php'); */
//        echo "DB Error: " . $error_message; 
//        exit();
//    }
//
//    $action = filter_input(INPUT_POST, 'action');
//    if($action == NULL){
//        $action = 'list_visitors';
//    }
//    if($action == 'list_visitors'){
//        $query = 'SELECT * from visitor
//                ORDER BY visitor_name';
//        $statement = $db->prepare($query);
//        $statement->execute();
//        $visitors = $statement->fetchAll();
//        $statement->closeCursor();
//    /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg; */
//    } else if($action == 'delete_visitor'){
//        $visitor_id = filter_input(INPUT_POST, 'visitor_id', FILTER_VALIDATE_INT);
//        $query = 'DELETE from visitor 
//                    WHERE visitor_id = :visitor_id';
//        $statement = $db->prepare($query);
//        $statement ->bindValue(':visitor_id', $visitor_id);
//        $statement->execute();
//        $statement->closeCursor();
//         //echo "Fields: " . $visitor_name . $visitor_email . $visitor_id;
//        header('Location: admin.php');
//  
//    }
//    // Read visitors 
//    
//    }
//////////////////////////////////////////////////////
// Check action; on initial load it is null
try {
    include_once './model/database.php';
    include "./model/visitor.php";
    include "./model/employee.php";
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
    exit();
}
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_visitors';
    }
}  

// List the visitors & employees
if ($action == 'list_visitors') {

    // Read employee data 

    $employeeID = filter_input(INPUT_GET, 'empID', 
            FILTER_VALIDATE_INT);
    if ($employeeID == NULL || $employeeID == FALSE) {
        $employeeID = 1;
    }
    try {

        $employees = getEmployees();
        
        $visitors = getVisitors($employeeID);
    }
    catch(PDOException $e){
        echo 'Error: ' . $e->getMessage();
    }
}

// Executed when user clicks delete button
else if ($action == 'delete_visitor') {

    deleteVisitor($visitor_id);
    header("Location: admin.php");
}


?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Eva Jones Design</title>
<style type="text/css">
@import url("CSS/stylesheet.css");
body {
	background-image: url(images/bkgdContact.jpg);
}
</style>
<!-- Mobile -->
<link href="CSS/mobile.css" rel="stylesheet" type="text/css" media="only screen and (max-width:800px)">
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>

<body>
<div id="logo"><img src="images/logo.png" width="220" height="103" alt="Eva Jones Design"></div>
<nav>
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="index.html">home</a>    </li>
    <li><a href="about.html">about</a></li>
    <li><a href="portfolio.html">portfolio</a>    </li>
    <li><a href="contact.html">contact</a></li>
  </ul>
</nav>
<header>
  <h1>contact <span class="fancy">Eva Jones</span></h1>
</header>
<section>
    <!---------------------------------->
<!--  <h1>Category List</h1>
    
<!----------------------------------------------------------------------------------------------------------->

          <h2>Admin Page</h2>

            <!-- display links for all employees -->

            </br>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th class="right">Message</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($visitors as $visitor) : ?>
            <tr>
                <td><?php echo $visitor['visitor_name']; ?></td>
                <td><?php echo $visitor['visitor_email']; ?></td>
                <td><?php echo $visitor['visitor_msg']; ?></td> </td>
                <td><form action="admin.php" method="post">
                    <input type="hidden" name="action"
                           value="delete_visitor">
                    <input type="hidden" name="visitor_id"
                           value="<?php echo $visitor['visitor_id']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>

    <!--------------------------------------- -->
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>&nbsp;</h1>
<h2>&nbsp;</h2>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
