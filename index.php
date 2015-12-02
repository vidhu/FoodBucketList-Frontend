<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <title>Food Bucketlist</title>

        <!-- External Bootstrap 3.3.2 Framework to help with styling -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
        <link rel="stylesheet" href="css/custom.css" />
    </head>
    <body>
        <?php include_once('header.php'); ?>

        <div class="container">
            <!-- Just demonstrating event listeners -->
            <div id="demoLoginMsg">
                <code>You are now logged in</code>
                <code id="demoLoginMsgUsrName"></code>
            </div>
        </div>

        <script type="text/javascript">
            //Page specific functions
            function onLogin(e) {
                console.log(e.userID);
                Auth.getUserInfo(function(user){
                    $('#demoLoginMsgUsrName').text(user.name);
                    $('#demoLoginMsg').show();
                });
            }
            function onLogout(e) {
                $('#demoLoginMsg').hide();
            }

            document.body.addEventListener("onFBLogin", onLogin, false);
            document.body.addEventListener("onFBLogout", onLogout, false);
        </script>
    </body>
</html>
