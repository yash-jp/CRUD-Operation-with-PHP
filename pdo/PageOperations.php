<?php
require_once 'pdo/Database.php';

function populateRecords($resultSet)
{
    if ($resultSet != null) {
        while ($row = $resultSet->fetch()) {
            echo "<form action='' method='post'>";
            echo "<tr>";
            echo "<td><input type='text' name='group_id' value='" . $row['group_id'] . "' readonly \></td>";
            echo "<td><input type='text' name='group_name' value='" . $row['group_name'] . "'\></td>";
//            to check radio value and check corresponding readio button
            echo "<td>Private <input type='radio' name='group_type' value='1'".($row['group_type']=="1"?'checked':'')."/></td>";
            echo "<td>Public <input type='radio' name='group_type' value='0'".($row['group_type']=="0"?'checked':'')."/></td>";
            echo "<td><input type='text' name='group_description' value='" . $row['group_description'] . "'\></td>";
            echo "<td><input type='submit' name='delete' value='Delete'></td>";
            echo "<td><input type='submit' name='update' value='Update'></td>";
            echo "</tr>";
            echo "</form>";
        }
    }
}

?>