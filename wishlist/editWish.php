<?php
    session_start();
    if (!array_key_exists("user", $_SESSION)) 
    {
        header('Location: index.php');
        exit;
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require_once("Includes/db.php");
    $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION['user']);
    $wishDescriptionIsEmpty = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if (array_key_exists("back", $_POST))
        {
           header('Location: editWishList.php' ); 
           exit;
        }
        else if ($_POST['wish'] == "")
        {
            $wishDescriptionIsEmpty =  true;
        } 
	else if ($_POST["wishID"]=="")
        {
           WishDB::getInstance()->insert_wish($wisherID, $_POST['wish'], $_POST['dueDate']);
           header('Location: editWishList.php' );
           exit;
        }
        else if ($_POST["wishID"]!="")
        {
            WishDB::getInstance()->update_wish($_POST["wishID"], $_POST["wish"], $_POST["dueDate"]);
            header('Location: editWishList.php' );
            exit;
        } 
    }
    
    require_once("Includes/db.php");
    $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION['user']);

    $wishDescriptionIsEmpty = false;
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if (array_key_exists("back", $_POST))
        {
           header('Location: editWishList.php' ); 
           exit;
        } else if ($_POST['wish'] == "")
        {
            $wishDescriptionIsEmpty =  true;
        } 
	else
        {
           WishDB::getInstance()->insert_wish($wisherID, $_POST['wish'], $_POST['dueDate']);
           header('Location: editWishList.php' );
           exit;
        }
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
       <link rel="stylesheet" type="text/css" href="Style/wishlist.css">
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
         <div style="text-align: center;color:darkred ; vertical-align: middle;">
        <?php 
//            if ($_SERVER["REQUEST_METHOD"] == "POST")
//                $wish = array("description" => $_POST["wish"], "due_date" => $_POST["dueDate"]);
//            else
//                $wish = array("description" => "","due_date" => "");
        
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                $wish = array("id" => $_POST["wishID"], "description" =>$_POST["wish"], "due_date" => $_POST["dueDate"]);
            else if (array_key_exists("wishID", $_GET))
                $wish = mysqli_fetch_array(WishDB::getInstance()->get_wish_by_wish_id($_GET["wishID"]));
            else
                $wish = array("id" => "", "description" => "", "due_date" => "");
        ?>
             <div style="margin-top: 350px"><h2>
        <form name="editWish" action="editWish.php" method="POST">
            <input type="hidden" name="wishID" value="<?php echo $wish["id"];?>" />
            Describe your wish: <input type="text" name="wish"  value="<?php echo $wish['description'];?>" /><br><br>
            <?php  if ($wishDescriptionIsEmpty) echo "Please enter description<br/>";?>
            When do you want to get it?<br>(YYYY-MM-DD) <input type="text" name="dueDate" value="<?php echo $wish['due_date']; ?>"/><br><br>
            
            <input type="submit" name="saveWish" value="Save Changes" class="button"/>
            <input type="submit" name="back" value="Back to the List" class="button"/>
        </form>
                 </h2>     </div>
         </div>
    </body>
</html> 