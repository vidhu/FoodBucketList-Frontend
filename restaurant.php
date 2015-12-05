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

        <div class="container">
            <div class="row">
                <h2></h2>
                <input id="add" type="submit" class = "btn btn-default" value="Add"><br/>
                <div id="info" class="col-md-8"></div>
                <div id="map" style="width: 400px; height: 300px; float: right" class="col-md-4"></div>
            </div>

            <script type="text/javascript">
                var getUrlParameter = function getUrlParameter(sParam) {
                    var sPageURL = window.location.search.substring(1),
                            sURLVariables = sPageURL.split('&'),
                            sParameterName,
                            i;

                    for (i = 0; i < sURLVariables.length; i++) {
                        sParameterName = sURLVariables[i].split('=');

                        if (sParameterName[0] === sParam) {
                            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                        }
                    }
                };
                var id = getUrlParameter('id');

                $(document).ready(function() {
                    

                    $("#add").click(function(){
                        var accessToken = FB.getAuthResponse()['accessToken'];
                        console.log("clicked");
                        console.log(accessToken);
                        var nom = new Nom(accessToken);

                        var bucket_id;
                        nom.Bucket.getBuckets(function(a){
                            console.log('getting buckets');
                            bucket_id = a.result[0].id;
                            nom.Bucket.addItem(bucket_id, id, function(){
                                console.log('added'); 
                            });
                        });
                    });
                });

                $.ajax({
                    url: "http://api.fbl.vidhucraft.com/search/id/" + id,
                    dataType: "jsonp",
                    success: function (response) {
                        $('h2').append("<a href='" + response.url.replace('\\', '') + "' target='_blank'>" + response.name + "</a>");
                        $('#info').append("<strong>Rating:</strong> " + response.rating + "<br/>");
                        $('#info').append("<strong>Review count: </strong>" + response.review_count + "<br/>");
                        $('#info').append("<strong>Phone number: </strong>" + response.display_phone + "<br/>");
                        $('#info').append("<strong>Address: </strong><br/>" + response.location.display_address[0] + "<br/>");
                        $('#info').append(response.location.display_address[1] + "<br/><br/>");
                        if (response.reviews.length > 0) {
                            $('#info').append("<strong>Reviews:</strong></br>");

                        response.reviews.forEach(function(review) {
                            $('#info').append("<strong>Rating:</strong> <img src='" + review.rating_image_url.replace('\\','') + "'></img></br>");
                            $('#info').append(review.excerpt);
                        });
                    }

                        var coordinates = response.location.coordinate;
                        var myLatLng = new google.maps.LatLng(coordinates.latitude, coordinates.longitude);

                        // Create a map object and specify the DOM element for display
                        var map = new google.maps.Map(document.getElementById("map"), {
                            center: myLatLng,
                            scrollwheel: false,
                            zoom: 15
                        });

                        // Create a marker and set its position
                        var marker = new google.maps.Marker({
                            map: map,
                            position: myLatLng,
                            title: response.name
                        })
                    }
                });
            </script>
        </div>
    </body>
</html>
