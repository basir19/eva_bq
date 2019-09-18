<?php
class Database {

    private static $dsn = 'mysql:host=localhost;dbname=ejdesign';
    private static $username = 'root';
    private static $password = 'Pa$$w0rd';
    private static $db;

    private function __construct() {

    }

    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
            } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
            }
        }
        return self::$db;
    }

}

class Employee {

    private $id;
    private $firstName;
    private $lastName;

    public function __construct($id, $firstName, $lastName) {
        $this->EmployeeID = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getID() {
        return $this->id;
    }

    public function setID($value) {
        $this->id = $value;
    }

    public function getfirstName() {
        return $this->firstName;
    }

    public function setfirstName($value) {
        $this->firstName = $value;
    }
    public function getlastName() {
        return $this->firstName;
    }

    public function setlastName($value) {
        $this->lastName = $value;
    }
}
class EmployeeDB {
    public static function getEmployee() {
        $db = Database::getDB();
        $query = 'SELECT * FROM employeelist
                          ORDER BY employeeID';
        $statement = $db->prepare($query);
        $statement->execute();

        $employees = array();
        foreach ($statement as $row) {
            $employee = new Employee($row['employeeID'],
                                        $row['firstName'],
                                        $row['lastName']);
            $employees[] = $employee;
        }
        return $employees;
    }
}
$employees = EmployeeDB::getEmployee();
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
            <ul>
            <?php
                foreach($employees as $employee):
            ?>
                <li>
                    <?php echo $employee->getfirstName(). ", " .$employee->getlastName(); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h1>&nbsp;</h1>
        <h2>&nbsp;</h2>
        <script type="text/javascript">
            var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown: "SpryAssets/SpryMenuBarDownHover.gif", imgRight: "SpryAssets/SpryMenuBarRightHover.gif"});
        </script>
    </body>
</html>
