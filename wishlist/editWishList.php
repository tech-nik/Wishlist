<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Style/wishlist.css">
        <title></title>
    </head>
    <body>
        <div style="text-align: center;color:#1AF029 ; vertical-align: middle;">
            <h1>
            <?php
            session_start();
            if (array_key_exists("user", $_SESSION))
            {
                echo "Hello " . $_SESSION['user'] . "!";
            }
            else
            {
                header('Location: index.php');
                exit;
            }
        ?>
            </h1>
        <table border="black" width="100%">
            <tr><th>Item</th><th>Due Date<br>(YYYY-MM-DD)</th></tr>
        <?php
            require_once("Includes/db.php");
            $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION["user"]);
            $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
            while($row = mysqli_fetch_array($result))
            :   
                echo "<tr><td>" . htmlentities($row['description']) . "</td>";
                echo "<td>" . htmlentities($row['due_date']) . "</td>";
                $wishID = $row["id"];
            
            
        ?>
            <td>
                <form name="editWish" action="editWish.php" method="GET">
                    <input type="hidden" name="wishID" value="<?php echo $wishID; ?>">
                    <input type="submit" name="editWish" value="Edit" class="edit" >
                </form>
            </td>
            <td>
                <form name="deleteWish" action="deleteWish.php" method="POST">
                    <input type="hidden" name="wishID" value="<?php echo $wishID; ?>"/>
                    <input type="submit" name="deleteWish" value="Delete" class="delete"/>
                </form>
            </td>
        <?php
            echo "</tr>\n";
            endwhile;
            mysqli_free_result($result);
        ?>
        </table>
        <form name="addNewWish" action="editWish.php">            
            <input type="submit" value="Add Wish" class="button">
        </form>
        
        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Back To Main Page" class="button"/>
        </form>
        </div>    
    </body>
</html>
