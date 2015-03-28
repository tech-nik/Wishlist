
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="Style/wishlist.css">
        <title></title>
    </head>
    <body>
        <div style="text-align: center;color: coral ; vertical-align: middle;">
        Wish List of <?php echo htmlentities($_GET["user"])."<br/>";?>
        <?php
        require_once("Includes/db.php");
//            $con = mysqli_connect("localhost", "phpuser");
//            if (!$con)
//                {
//                    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
//                }
//            mysqli_set_charset($con, 'utf-8');
//             
//            mysqli_select_db($con, "wishlist");
//            $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));
//
//            $wisher = mysqli_query($con, "SELECT id FROM wishers WHERE name='" . $user . "'");
//
//            if (mysqli_num_rows($wisher) < 1)
//                {
//                    exit("The person " . htmlentities($_GET["user"]) . " is not found. Please check the spelling and try again");
//                }
//            $row = mysqli_fetch_row($wisher);
//            $wisherID = $row[0];
//            mysqli_free_result($wisher);
              
            $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_GET["user"]);
            if (!$wisherID)
            {
                exit("The person " .$_GET["user"]. " is not found. Please check the spelling and try again" );
            }
        
                
        ?>
         
         
        <table border="black" width="100%">
        <tr>
            <th>Item</th>
            <th>Due Date<br>(YYYY-MM-DD)</th>
        </tr>
        <?php
            //$result = mysqli_query($con, "SELECT description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
            $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
            while ($row = mysqli_fetch_array($result))
            {
                echo "<tr><td>" . htmlentities($row["description"]) . "</td>";
                echo "<td>" . htmlentities($row["due_date"]) . "</td></tr>\n";
            }
            mysqli_free_result($result);
            //mysqli_close($con);
        ?>
                 
        
        </table>
        <form action="index.php">
            <button type="submit" formaction="index.php" class="homebutton">Home</button>
        </form>
    </div>    
    </body>
</html>