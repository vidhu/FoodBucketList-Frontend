<!DOCTYPE html>
<html>
<head>
    <title>Food Bucketlist Login via Facebook</title>
    <meta charset="UTF-8">

    <!-- External Bootstrap 3.3.2 Framework to help with styling -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
    <link rel="stylesheet" href="css/custom.css" />
</head>
<body>
    <script>

    // http://www.developer.com/lang/working-with-facebook-sdk-for-javascript.html

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1206232049392333',
        cookie     : true,  // enable cookies to allow the server to access the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2' // use version 2.2
      });


      FB.Event.subscribe('auth.authResponseChange', function (response) {
        if (response.status === 'connected') {
          alert("Successfully connected to Facebook!");
        }
        else if (response.status === 'not_authorized') {
          alert("Login failed!");
        } else {
          alert("Unknown error!");
        }
      });
    };

    // Load the SDK asynchronously
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    function login() {
      FB.login(function (response) {
        if (response.authResponse) {
          FB.api('/me', function(response) {
            console.log('Good to see you, ' + response.name + '.');
          });

          FB.api('/me', function (response) {
            document.getElementById("displayName").innerHTML = response.name;
            document.getElementById("userName").innerHTML = response.username;
            document.getElementById("userID").innerHTML = response.id;
            document.getElementById("userEmail").innerHTML = response.email;
            FB.api('/me/picture?type=normal', function (response) {
              document.getElementById("profileImage").setAttribute("src", response.data.url);
            });
          });
        } else {
          alert("Login attempt failed!");
        }
      }, { scope: 'email,user_photos,publish_actions' });

    }

    function logout() {
      FB.logout(function () { 
        document.location.reload(); 
      });
    }

    function PostMessage() {
      FB.api('/me/feed', 'post', {
        message: document.getElementById("messageToPost").value
      });
    }
  </script>

<?php include_once('header.php'); ?>

<div id="fb-root"></div>

<input type="button" id = "login_button" value="login" onclick="login();" />

<br>

<input type="button" id="postButton" value="Post" onclick="PostMessage();" />

<br>

<input type="button" id = "logout_button" value="logout" onclick="logout();" />

<!-- <div id="status">
</div> -->



</body>
</html>