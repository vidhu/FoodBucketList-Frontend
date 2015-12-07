<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <title>Food Bucketlist</title>

        <!-- External Bootstrap 3.3.2 Framework to help with styling -->        
        <link rel="stylesheet" href="http://thevectorlab.net/flatlab/css/bootstrap-reset.css" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" />
        <link rel="stylesheet" href="css/custom.css" />
    </head>
    <body>
        <?php include_once('header.php'); ?>

        <div class="container">
            <div class="js-loggedin panel tasks-widget">
                <header class="panel-heading">
                    <span class='js-username'></span>
                </header>

                <div class="panel-body">
                </div>
            </div>

        <div class="progress">
            <div class="progress-bar js-achievementbar js-loggedin" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="10" style="width:0%"></div>
        </div>

        <script type='text/javascript'>
        var nom;
        function onLogin(e) {
            nom = new Nom(Auth.getAccessToken());
            Auth.getUserInfo(function (user) {
                $('.js-username').text(user.name + "'s Current Level");
            });

            //Get Achievements
            nom.Achievement.getAchievement(function(r){
               updateProgressbar(r.result);
            });

            //Finally display the bucket list
            $('.js-loggedin').show();
        }

        function onLogout(e) {
            $('.js-loggedin').hide();
        }

        function updateProgressbar(achievement){
            var levels = ["Food Noob", "Gobbler", "Intermediate", "Chomper", "Nom Pro", "Fat"]
            $('.js-achievementbar').css('width', achievement%10*10+"%");
            $('.js-achievementbar').text("Level " + Math.floor(achievement/10) + " " + achievement%10*10 + "%");
            if (Math.floor(achievement/10) > 5) {
                $('.panel-body').append("<h3>" + levels[5] + "<h3>");
                $('.panel-body').append("<h4>Highest level<h4>");
            } else {
                $('.panel-body').append("<h3>" + levels[Math.floor(achievement/10)] + "<h3>");
                $('.panel-body').append("<h4>" + achievement%10 + " more restaurants to next level<h4>");
                console.log(Math.floor(achievement/10));
            }
        }

        $(document).ready(function () {


        });

        document.body.addEventListener("onFBLogin", onLogin, false);
        document.body.addEventListener("onFBLogout", onLogout, false);
        </script>
    </body>
</html>