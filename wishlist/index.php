<?php
    require_once("Includes/db.php");
    $logonSuccess = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials($_POST['user'], $_POST['userpassword']));
        if ($logonSuccess == true)
        {
            session_start();
            $_SESSION['user'] = $_POST['user'];
            header('Location: editWishList.php');
            exit;
        }
    }
?>





<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="Style/wishlist.css">
        <title>Wishlist</title>
    
    </head>
    <body>
        <table style="text-align: center; width: 100%; border:#d02718 ">
        <tr>
        <center>
            <h1 class="banner"  >wishlist</h1><br> <hr style="color:red">
        </center>
        </tr>
       
        <tr>
        <td width="50%">
        <input type="submit" name="showWishList" class="button" value="Show Wish List of >>" onclick="javascript:showHideShowWishListForm()"/>
        <form name="wishList" action="wishlist.php" style="visibility:hidden">
            <input type="text" name="user" value="" />
            <input type="submit" value="Go" class="button"/>
            <br>Still don't have a wish list?! <a href="createNewWisher.php" style="color:red"><br>Create now</a>
        </form> 
        </td>
        <td width="50%">
         <input type="submit" name="myWishList" class="button" value="My Wishlist >>" onclick="javascript:showHideLogonForm()"/>
         <form name="logon" action="index.php" method="POST" style="visibility:<?php if ($logonSuccess) echo "hidden";else echo "visible";?>"><br>
            Username: <input type="text" name="user"><br><br>
            Password  <input type="password" name="userpassword"><br><br>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                { 
                    if (!$logonSuccess)
                        echo "Invalid name and/or password";
                }
            ?>
            <input type="submit" class="button" value="Edit My Wish List">
        </form>

        </td>
        </tr>
        </table>
        <script>
            function showHideLogonForm()
            {
                if (document.all.logon.style.visibility == "visible")
                {
                    document.all.logon.style.visibility = "hidden";
                    document.all.myWishList.value = "My Wishlist >>";
                } 
                else
                {
                    document.all.logon.style.visibility = "visible";
                    document.all.myWishList.value = "<< My Wishlist";
                }
            }
            function showHideShowWishListForm()
            {
                if (document.all.wishList.style.visibility == "visible")
                {
                    document.all.wishList.style.visibility = "hidden";
                    document.all.showWishList.value = "Show Wish List of >>";
                }
                else
                {
                    document.all.wishList.style.visibility = "visible";
                    document.all.showWishList.value = "<< Show Wish List of";
                }
            }
        </script>
    <footer>
        <marquee direction="left" style="color: red">Website Designed & Developed by : Vignesh Sekar </marquee>
    </footer>   
    </body>
</html>
