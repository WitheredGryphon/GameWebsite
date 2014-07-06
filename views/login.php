<html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <script type="text/javascript" src="js/js.js"></script>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body>
        <div class = "loginpage">
            <div id = "header">
                <h1>Login</h1>
            </div>
             <div id = "content">
                 <form id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <label>User: <input type = "text" name = "user"></label>
                        <br /><br />
                        <label>Password: <input type = "password" name = "pass"></label>
                        <br /><br />
                        <input type = "submit" value = "Login" name = "login">
                 </form>
             </div>
             <div id="footer">
                Footer/Credits
             </div>
        </div>
    </body>
</html>