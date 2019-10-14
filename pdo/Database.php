<?php
class Database
{    //properties
    private static $user = 'root';
    private static $pass = '';
    private static $db = 'examination_system';
    private static $dsn = 'mysql:host=localhost;dbname=examination_system';
    private static $dbcon;
    public function __construct()
    {
    }
    //get pdo connection
    public static function getDb(){
        if(!isset(self::$dbcon)) {
            try {
                self::$dbcon = new PDO(self::$dsn, self::$user, self::$pass);
                self::$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "exception";
            }
        }
        return self::$dbcon;
    }

//    call this method to add record in the database
    public function addRecord($connection,$groupName,$groupType,$groupDescription){
        $sql = "INSERT INTO groups (group_name, group_type, group_description) 
              VALUES (:group_name, :group_type, :group_description)";
        $pst = $connection->prepare($sql);
        $pst->bindParam(':group_name', $groupName);
        $pst->bindParam(':group_type', $groupType);
        $pst->bindParam(':group_description', $groupDescription);
        $count = $pst->execute();
        return $count;
    }

    //    call this method to update record in the database
    public function updateRecord($connection,$groupId,$groupName,$groupType,$groupDescription){
        echo "inside update records";
        $sql = "UPDATE groups SET group_name=:groupName, group_type=:groupType, group_description=:groupDescription WHERE group_id=:groupId";
        $pst = $connection->prepare($sql);
        $pst->bindParam(':groupId', $groupId);
        $pst->bindParam('groupName', $groupName);
        $pst->bindParam(':groupType', $groupType);
        $pst->bindParam(':groupDescription', $groupDescription);
        $count = $pst->execute();
        echo $count;
        return $count;
//        return $count;
    }

    //    call this method to add record in the database
    public function getRecord($connection,$tableName){
        $sql = "SELECT * FROM $tableName";
        $pst = $connection->prepare($sql);
        $pst->execute();
//        check if records are there or not
        if($pst!=null){
//            if resultset is not empty return an array
            return $pst;

        }
    }

//    call this method to delete record from the database
public function deleteRecord($connection,$groupId){
    $sql = "DELETE from groups WHERE group_id=:id";
    $pst = $connection->prepare($sql);
    $pst->bindParam(':id', $groupId);
    $count = $pst->execute();
    return $count;
//        return $count;
}
}
