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
                    <div class="task-content">
                        <ul class="task-list js-bucketlistitems">

                        </ul>
                    </div>
                    <a class="btn btn-success btn-sm js-savebucketlist" href="#">Save</a>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar js-achievementbar js-loggedin" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="10" style="width:0%"></div>
            </div>
            <img src="img/burger.png" alt="" class='img-fix'/>


            <script type="text/javascript">
                var nom;
                function onLogin(e) {
                    nom = new Nom(Auth.getAccessToken());

                    //Get and display username
                    Auth.getUserInfo(function (user) {
                        $('.js-username').text(user.name + "'s bucketlist");
                    });

                    //Get Achievements
                    nom.Achievement.getAchievement(function(r){
                       updateProgressbar(r.result);
                    });

                    //Get user's buckets AND Get items in bucket
                    nom.Bucket.getBuckets(function (r) {
                        window.userBucketId = r.result[0].id;
                        nom.Bucket.getItems(r.result[0].id, function (r) {
                            r.result.forEach(addBucketItems);
                        });
                    });


                    //Finally display the bucket list
                    $('.js-loggedin').show();
                }

                //Add items to the bucket list
                function addBucketItems(element, index, array) {
                    nom.Search.getBusinessInfo(element, function (business) {
                        var item = $('#templates .bucketListItem').clone();
                        item.find('.businessName').attr("href", "/restaurant.php?id=" + business.id);
                        item.find('.businessName').find("span").html(business.name);
                        item.find('.task-checkbox').find("input").attr('data-businessID', business.id);
                        $('.task-list').append(item);
                    });

                }


                function onLogout(e) {
                    $('.js-loggedin').hide();
                }

                function updateProgressbar(achievement){
                    $('.js-achievementbar').css('width', achievement%10*10+"%");
                    $('.js-achievementbar').text("Level " + Math.floor(achievement/10) + " " + achievement%10*10 + "%");
                }
                
                $(document).ready(function () {
                    $(".js-savebucketlist").click(function () {
                        var listItems = $(".js-bucketlistitems input");
                        listItems.each(function (i, e) {
                            var businessID = e.getAttribute('data-businessID');
                            if (e.checked) {
                                nom.Bucket.deleteItem(window.userBucketId, businessID, function (r) {
                                    console.log("Deleted " + businessID);
                                    nom.Achievement.incAchievement(function (r) {
                                        console.log("Achievements is now: " + r.result);
                                        updateProgressbar(r.result);
                                    });
                                });
                            }
                        });
                        $(".task-list").find('input:checkbox:checked').closest('li').hide();
                    });
                });

                document.body.addEventListener("onFBLogin", onLogin, false);
                document.body.addEventListener("onFBLogout", onLogout, false);
            </script>

            <!-- Used for storing html templates for use in jQuery -->
            <div id="templates" style="display: none">
                <li class="bucketListItem">
                    <div class="task-checkbox">
                        <input type="checkbox" class="list-child" value="">
                    </div>
                    <div class="task-title">
                        <a href="sdf" class="businessName" target="_blank">
                            <span class="task-title-sp">
                                Business Name
                            </span>
                        </a>
                    </div>
                </li>
            </div>
    </body>
</html>
