<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Using a list glyphicon as the logo -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-list"></span></a>
        </div>

        <!-- nav bar -->
        <div class="collapse navbar-collapse" id="navbar">

            <ul class="nav navbar-nav">
                <li><a href="user_account.html">Account</a></li>
                <li><a href="friends.html">Friends</a></li>
                <li><a href="Achievements.html">Achievements</a></li>
                <li><a href="list.html">Your Bucket List</a></li>
            </ul>

            <div class="navbar-form navbar-right form-group">
                <div class="input-group">
                    <input type="text" class="form-control search" size="40" autocomplete="off" placeholder="Search for your favorite food...">
                    <ul class="dropdown-menu searchresults" role="listbox" style="top: 34px; left: 0px;">
                    </ul>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Go!</button>
                    </span>
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

<script type="text/javascript">
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
                    $('.searchresults').append('<li><a>' + response[b].name + '</a></li>');
                }
            }
        });
    });
</script>
