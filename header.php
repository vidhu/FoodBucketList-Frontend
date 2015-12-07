<nav class="navbar-custom white-bg">
    <div class="container-fluid">
        <!-- Using a list glyphicon as the logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span></a>
        </div>

        <!-- nav bar -->
        <div class="collapse navbar-collapse" id="navbar">
            
            <ul class="nav navbar-nav">
                <li><a id="login_button" href="#" onclick="Auth.login()" data-toggle='tab'>Log in</a></li>
                <li class="divider-vertical"></li>
                <li><a id="logout_button" href="#" onclick="Auth.logout()" style="display: none;">Log Out</a></li>
                <li class="divider-vertical"></li>
                <li><a href="friends.php" data-toggle='tab'>Friends</a></li>
                <li class="divider-vertical"></li>
                <li><a href="Achievements.php" data-toggle='tab'>Achievements</a></li>
                <li class="divider-vertical"></li>
                <li><a href="index.php" data-toggle='tab'>Your Bucket List</a></li>
            </ul>

            <div class="navbar-form navbar-right form-group">
                <div class="input-group">
                    <div class="form-group has-feedback has-feedback-right">
                        <input type="text" class="form-control search" size="40" autocomplete="off" placeholder="Search for your favorite food...">
                        <i class="form-control-feedback glyphicon glyphicon-search"></i>
                    </div>
                    <ul class="dropdown-menu searchresults" role="listbox" style="top: 34px; left: 0px;">
                    </ul>
                </div>
            </div>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<!-- JS CDN Links -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/3.1.1/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="https://cdn.rawgit.com/twitter/typeahead.js/master/dist/bloodhound.min.js" type="text/javascript"></script>
<script src="js/auth.js" type="text/javascript"></script>
<script src="js/nomapi.js" type="text/javascript"></script>
<script src="js/callChain.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).click(function(){
        $('.searchresults').hide();
    });
    
    $('.search').on('input propertychange paste', function () {
        if ($('.search').val().length === 0) {
            $('.searchresults').hide();
        }
        $.ajax({
            url: "http://api.fbl.vidhucraft.com/search/" + $('.search').val(),
            dataType: "jsonp",
            success: function (response) {
                $('.searchresults').empty();
                if(response.length > 0){
                    $('.searchresults').show();
                }
                for (var b in response) {
                    $('.searchresults').append('<li><a href="/restaurant.php?id=' + encodeURIComponent(response[b].id) + '">' + response[b].name + '</a></li>');
                }
            }
        });
    });
</script>
