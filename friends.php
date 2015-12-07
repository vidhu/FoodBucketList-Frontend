<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <title>Food Bucketlist</title>

        <!-- External Bootstrap 3.3.2 Framework to help with styling -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
        <link rel="stylesheet" href="css/custom.css" />

        <script type="text/javascript" 
        src="http://maps.google.com/maps/api/js?sensor=false"></script>
    </head>
    <body>
        <?php include_once('header.php'); ?>
        <header class="panel-heading">
            <span class='js-username'></span>
        </header>

        <ul></ul>

        <script type="text/javascript">
        function onFbSDKLoad(e){
            console.log("sdk loaded");
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {

                    Auth.getUserInfo(function (user) {
                        $('.js-username').text(user.name + "'s bucketlist");
                    });

                    console.log("logged in");
                    FB.api('/me/friends', function(friends) {
                        console.log("friends: ");
                        console.log(friends);
                        if (friends.data.length > 0) {
                            console.log("YAY FRIENDS");
                            friends.data.forEach(function(friend) {
                                $('ul').append("<li>" + friend.name + "</li>")
                            });
                        } else {
                            console.log("no friends");
                            $('h1').append("No friends :'(");
                        }
                    });
                } else {
                    console.log("needs to log in");
                }
            });
        }

        document.body.addEventListener("onFBSdkLoad", onFbSDKLoad, false);
        </script>
    </body>
</html>
