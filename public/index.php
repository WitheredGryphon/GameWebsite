<html>

<head>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="js/jQuery.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <script>
        $(document).ready(function () {

            var hash = window.location.hash.substr(1);
            var href = $('#nav li a').each(function () {
                var href = $(this).attr('href');
                if (hash == href.substr(0, href.length - 5)) {
                    var toLoad = hash + '.html #content';
                    $('#content').load(toLoad)
                }
            });

            $('#nav li a').click(function () {

                var toLoad = $(this).attr('href') + ' #content';
                $('#content').hide('fast', loadContent);
                $('#load').remove();
                $('#wrapper').append('<span id="load">LOADING...</span>');
                $('#load').fadeIn('normal');

                function loadContent() {
                    $('#content').load(toLoad, '', showNewContent())
                }

                function showNewContent() {
                    $('#content').show('normal', hideLoader());
                }

                function hideLoader() {
                    $('#load').fadeOut('normal');
                }

                window.location.hash = $(this).attr('href').substr(0, $(this).attr('href').length - 4);
                return false;
            });
        });
    </script>
    <div id="wrapper">
        <div id="logo">
            <h1>Sample Title / Logo</h1>
        </div>
        <ul id="nav">
            <li><a href="index.php">Welcome</a>
            </li>
            <li><a href="about.php">About</a>
            </li>
            <li><a href="contact.php">Contact</a>
            </li>
            <li><a href="press.php">Press</a>
            </li>
            <li><a href="terms.php">Terms</a>
            </li>
            <div id="llink"><a href="login.php">Login</a>
            </div>
        </ul>
        <div id="content">
            <h2>Welcome!</h2>
            <br />
            <br />
            <p>This site is under construction.</p>
        </div>
        <div id="foot">
            Footer/Credits
            <div id="bottomimg">
                <img src="http://placehold.it/80x80">
            </div>
        </div>
    </div>
</body>

</html>

<?php ?>