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
                <code>You are now logged in</code>
                <code id="demoLoginMsgUsrName"></code>
            </div>

            <div class="check-container">
                <h1 style="font-family: Geneva">Your Food Bucketlist!</h1>
                <h4 style="font-family: Geneva"><em>Check off the restaurant(s) that you have visited</em></h3>
                
                <div class="checkbox">
                    <label>
                      <input type="checkbox"> One! </input>
                      <button class="glyphicon glyphicon-remove-circle" style = "color: red; font-size: 18px; background: none; border: 0; outline: none"></button>
                    </label>
                  </div>
                  
                <div class="checkbox">
                    <label>
                      <input type="checkbox"> Two! </input>
                      <button class="glyphicon glyphicon-remove-circle" style = "color: red; font-size: 18px; background: none; border: 0; outline: none"></button>
                    </label>
                </div>
                  
                <div class="checkbox">
                    <label>
                      <input type="checkbox"> Three! </input>
                      <button class="glyphicon glyphicon-remove-circle" style = "color: red; font-size: 18px; background: none; border: 0; outline: none"></button>
                    </label>
                </div>
          
                <div align="center">
                    <input type="button" name="button" value="Check Off" id="button" onclick="javascript:removeItem();"/>
                </div>
            </div>
        </div>
        
        <script>
        function removeItem() {
            var x = document.getElementsByTagName("input");
                for(i = 0; i < x.length; i++) {
                    if (x[i].checked) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
        }
        </script>

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
