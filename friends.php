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

        <div class="container js-loggedin">
            <div class="panel row">
                <header class="panel-heading">
                    <span>Your friend list</span>
                </header>
                <div class="panel-body">
                    <div class="tasks-widget">
                        <ul class="task-list">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        

        <div id="templates" style="display: none;">
            <div class="list-item">
                <li>
                    <div class="task-title">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="task-title-sp">Business Name</span>
                    </div>
                </li>
            </div>
        </div>

        <script type="text/javascript">
            function onFbSDKLoad(e) {
                console.log("sdk loaded");
                FB.getLoginStatus(function (response) {
                    if (response.status === 'connected') {

                        Auth.getUserInfo(function (user) {
                            $('.js-username').text(user.name + "'s Friends");
                        });

                        console.log("logged in");
                        FB.api('/me/friends', function (friends) {
                            console.log("friends: ");
                            console.log(friends);
                            if (friends.data.length > 0) {
                                console.log("YAY FRIENDS");
                                friends.data.forEach(function (friend) {
                                    var item = $('#templates .list-item li').clone();
                                    item.find('.task-title-sp').html(friend.name);
                                    $('.tasks-widget ul').append(item);
                                    //$('ul').append("<li>" + friend.name + "</li>")
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

            function onLogin(e) {
                $('.js-loggedin').show();
            }

            function onLogout(e) {
                $('.js-loggedin').hide();
            }

            document.body.addEventListener("onFBSdkLoad", onFbSDKLoad, false);
            document.body.addEventListener("onFBLogin", onLogin, false);
            document.body.addEventListener("onFBLogout", onLogout, false);        
        </script>
    </body>
</html>
