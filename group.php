<?php
require_once 'pdo/Database.php';
require_once 'pdo/PageOperations.php';
//INITIALLY TO DISPLAY ALL THE RECORDS WE NEED TO QUERY DATABASE
$dataBase = new Database;
$connection = Database::getDb();
$resultSet = $dataBase->getRecord($connection, "groups");

//THIS WILL BE PEROFRMED ONLY IF USER WANTS TO ADD RECORD
if (isset($_POST['add'])) {
//    getTheFormVariables
    $groupName = $_POST['groupName'];
    $groupType = $_POST['groupType'];
    $groupDescription = $_POST['groupDescription'];

//        call add method with specified parameter
    $count=$dataBase->addRecord($connection, $groupName, $groupType, $groupDescription);

//    if rows has been updated in database then and only
    if($count>0){
//call getRecords method
    $resultSet = $dataBase->getRecord($connection, "groups");
    }

//    to prevent adding recood when refreshing
//    unset($_POST['add']);
//    $_POST['add']=null;
//        WHEN USER WANTS TO UPDATE RECORD
} elseif (isset($_POST['update'])) {
//    perform update logic
    echo $group_id = $_POST['group_id'];
    echo $group_name = $_POST['group_name'];
    echo $group_type = $_POST['group_type'];
    echo $group_description = $_POST['group_description'];

//        call add method with specified parameter
    $count=$dataBase->updateRecord($connection,$group_id, $group_name, $group_type, $group_description);
    echo "we are here".$count;
//    if rows has been updated in database then and only
    if($count>0){
//        call getRecords method
        header("Location: group.php");
    }
}
//    WHEN USER WANTS TO DELETE RECORD
elseif(isset($_POST['delete'])) {
//    perform delete logic
    echo "hereaaaaa";
    $id = $_POST['group_id'];
//    $name=$_POST['name'];
//    $email = $_POST['email'];
//    $program = $_POST['program'];

//    call delete method with specific parameter
    $count=$dataBase->deleteRecord($connection,$id);
    echo $count;
//    echo $count;
//    if rows has been updated in database then and only
    if($count>0){
//        call getRecords method
        header("Location: group.php");
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <link href="./css/group.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Form</title>
</head>
<body>
<div class="container">
    <div class="enter-records">
        <form class = "enter-records" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="groupName" placeholder="Enter Group Name"/></br></br>
            Group Type : Private <input type="radio" name="groupType" value="1" checked/>
            Public <input type="radio" name="groupType" value="0"/></br></br>
            <textarea name="groupDescription" placeholder="Enter Group Description"></textarea></br></br>
            <input type="submit" value="Add" name="add"/>
        </form>
    </div>
    </br></br>

    <div class="display-records">

        <table>
            <?php
                populateRecords($resultSet);
            ?>
        </table>
        </form>
    </div>
</div>
</body>
</html>
