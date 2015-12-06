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
            <div id="demoLoginMsg" style="display: none;">
                <h1 id="demoLoginMsgUsrName"></h1>
                <div class="check-container">
                    <ul id="restaurants">
                    </ul>
                </div>   
            </div>    
        </div>
        


        <script type="text/javascript">
            //Page specific functions
            var accessToken;
            function onLogin(e) {
                console.log(e.userID);
                Auth.getUserInfo(function(user){
                    $('#demoLoginMsgUsrName').text(user.name + "'s Bucketlist");
                    $('#demoLoginMsg').show();
                });
                accessToken = FB.getAuthResponse()['accessToken'];

                console.log(accessToken);
            }


            function onLogout(e) {
                $('#demoLoginMsg').hide();
            }

            document.body.addEventListener("onFBLogin", onLogin, false);
            document.body.addEventListener("onFBLogout", onLogout, false);

            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '1206232049392333', // App ID
                    status     : true, // check login status
                    cookie     : true, // enable cookies to allow the server to access the session
                    xfbml      : true  // parse XFBML
                });

                console.log("in here");
                accessToken = FB.getAuthResponse()['accessToken'];
                var nom = new Nom(accessToken);

                var bucket_id;
                nom.Bucket.getBuckets(function(a){
                    console.log('getting buckets');
                    console.log(a);
                    if (a.success) {
                        console.log("in here");
                        bucket_id = a.result[0].id;
                    } else {
                        console.log("was not success");
                        nom.Bucket.addBucket(user.name, "hungry", function(b) {
                            bucket_id = b.result;
                        });
                    }

                    nom.Bucket.getItems(bucket_id, function(a) {
                        console.log("getting items")
                        a.result.forEach(function(restaurant) {
                            console.log(restaurant);

                            $.ajax({
                                url: "http://api.fbl.vidhucraft.com/search/id/" + restaurant,
                                dataType: "jsonp",
                                success: function (response) {
                                    $('#restaurants').append("<div class='item'><li><input id='" + restaurant + "' type='checkbox' value='" + response.name + "'> ");
                                    $('#restaurants').append("<label for='" + restaurant + "'>" + response.name + "</label> </li></div>");
                                }
                            });
                        });
                    });
                });
            };

            // Load the SDK Asynchronously
            (function(d){
                var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
                js = d.createElement('script'); js.id = id; js.async = true;
                js.src = "//connect.facebook.net/en_US/all.js";
                d.getElementsByTagName('head')[0].appendChild(js);
            }(document));
            
        </script>
    </body>
</html>
