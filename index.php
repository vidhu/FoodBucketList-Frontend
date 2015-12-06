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
            function onLogin(e) {
                console.log(e.userID);
                Auth.getUserInfo(function(user){
                    $('#demoLoginMsgUsrName').text(user.name + "'s Bucketlist");
                    $('#demoLoginMsg').show();
                });
                var accessToken = FB.getAuthResponse()['accessToken'];

                console.log(accessToken);
                var nom = new Nom(accessToken);

                var bucket_id;
                nom.Bucket.getBuckets(function(a){
                    console.log('getting buckets');
                    if (a.success) {
                        bucket_id = a.result[0].id;
                    } else {
                        nom.Bucket.addBucket(user.name, "hungry", function(b) {
                            console.log(b);
                        });
                    }
                });
                nom.Bucket.getItems(bucket_id, function(a) {
                    console.log(a);
                    a.forEach(function(restaurant) {
                        $('#restaurants').append()
                    });
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
