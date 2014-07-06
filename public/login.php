<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class = "loginpage">
            <div id = "header">
                <h1>Login</h1>
            </div>
             <div id = "content">
                <form id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <label>User: <input type = "text" name = "user" id = "user"></label>
                    <br /><br />
                    <label>Password: <input type = "password" name = "pass" id = "pass"></label>
                    <br /><br />
                    <input type = "submit" value = "Login" name = "login" id = "login">
                </form>
                <div id = "add_error"></div>
            </div>
            <div id="footer">
                Footer/Credits
            </div>
        </div>
    </body>
</html>

<?php
    if (isset($_POST['login'])) {
        require_once '../config.php';
        
        function better_crypt($input, $rounds = 7)
        {
            $salt       = "";
            $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
            for ($i = 0; $i < 22; $i++) {
                $salt .= $salt_chars[array_rand($salt_chars)];
            }
            return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
        }
        
        function verify($password, $hashedPassword)
        {
            return crypt($password, $hashedPassword) == $hashedPassword;
        }
        
        $link   = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
        $query  = "CREATE DATABASE IF NOT EXISTS `gamedb` DEFAULT CHARACTER SET utf8";
        $query2 = "CREATE TABLE IF NOT EXISTS `users` (
                        `uid` INT(10) unsigned NOT NULL AUTO_INCREMENT,
                        `login` VARCHAR(30) NOT NULL,
                        `hash` VARCHAR(100) NOT NULL,
                        `first_name` CHAR(30) DEFAULT NULL,
                        `last_name` CHAR(60) DEFAULT NULL,
                        `email` CHAR(100) NOT NULL,
                        `registered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `email_confirmed` BOOLEAN NOT NULL DEFAULT FALSE,
                        `mailing_list` BOOLEAN NOT NULL DEFAULT FALSE,
                        `role` VARCHAR(30) NOT NULL DEFAULT 'user',
                        PRIMARY KEY(`uid`),
                        UNIQUE KEY `login_UNIQUE` (`login`),
                        UNIQUE KEY `email_UNIQUE` (`email`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        
        mysqli_query($link, $query);
        mysqli_select_db($link, DB_NAME) or die("Cannot connect to database.");
        mysqli_query($link, $query2);
        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        session_start();
        
        $user = mysqli_real_escape_string($link, stripslashes($_POST['user']));
        $pass = mysqli_real_escape_string($link, stripslashes($_POST['pass']));
        
        $qry = "SELECT * FROM users WHERE login='" . $user . "'";
        if (mysqli_query($link, $qry)) {
            $result = mysqli_query($link, $qry);
            $row    = mysqli_fetch_array($result);
            $hash   = $row['hash'];
            
            if (verify($pass, $hash)) {
                ?>
                <script>
                    $("#add_error").html("Successfully logged in.");
                </script>
                <?php
                $_SESSION['user'] = $row['login'];
            } else {
                ?>
                <script>
                    $("#add_error").html("Invalid username or password.");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                $("#add_error").html("Invalid username or password.");
            </script>
            <?php    
        }
    }
?>