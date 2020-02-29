<?php include_once('database_connect.php'); 
    $message = '';
    if(isset($_POST['login']) && !empty($_POST['login'])){
        
        $query = "SELECT * FROM `users` WHERE `username` = :username";
        $statement = $connection->prepare($query);
        $statement->execute(
            array(
                'username' => $_POST['username']
            )
        );
        $count = $statement->rowCount();
        if($count > 0){
            $result = $statement->fetchAll();
            foreach($result as $row){
                if($_POST['password'] === $row['password']){
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    // Insert Into Login Details
                    $subQuery = "INSERT INTO `login_details` (user_id) VALUES ('".$row['id']."')";
                    $statement = $connection->prepare($subQuery);
                    $statement->execute();
                    $_SESSION['login_details_id'] = $connection->lastInsertId();
                    header('location:index.php');
                }else{
                    $message .="<label>Password Is Wrong</label>";
                }
            }
        }else{
            $message .="<label>Username Is Not Found Pleaser Regitster </label>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Chat Application PHP Adn Mysql Using Ajax</title>
        <script src="js/jquery.min.js"></script>
        <link rel='stylesheet' href="css/jquery-ui.min.css">
        <link rel='stylesheet' href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
        <body>
            <div class="container">
            <br>
                <div class='row'>
                    <div class='col-md-12'>
                        <h3 class='text-center'>Chat Application</h3>
                    </div>
                </div>
                <br>
                <div class='row'>
                <div class='col-md-12'>
                    <div class='card'>
                        <h4 class='card-header'>Login Page</h4>
                        <div class='card-body'>
                            <form action='' method='post'>
                                <div class='form-group'>
                                    <label>Enter Username :</label>
                                    <input type="text" name='username' id='username' class='form-control'>

                                </div>
                                <div class='form-group'>
                                    <label>Enter Password : </label>
                                    <input type="password" name="password" id='password' class='form-control'>
                                </div>
                                <div class='form-gorup'>
                                    <input type='submit' name='login' value='Login' class='btn btn-primary'>
                                </div>
                            </form>
                            <br>
                            <?php 
                            if(isset($message) and !empty($message)){?>
                            <div class="alert alert-danger">
                                <?php echo $message;?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </body>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
<html>