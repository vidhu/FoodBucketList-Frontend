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
        <div class="page-container">
            <div id='info'>
                <h2></h2>
                <button id="add" type="button">Add</button><br/>
            </div>
    
            <div id="map" style="width: 400px; height: 300px"></div> 
            
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
    
                $.ajax({
                    url: "http://api.fbl.vidhucraft.com/search/id/" + id,
                    dataType: "jsonp",
                    success: function (response) {
                        $('h2').append("<a href='" + response.url.replace('\\', '') + "' target='_blank'>" + response.name + "</a>");
                        $('#info').append("rating: " + response.rating + "<br/>");
                        $('#info').append("review count: " + response.review_count + "<br/>");
                        $('#info').append("phone number: " + response.display_phone + "<br/>");
                        $('#info').append("address: <br/>" + response.location.display_address[0] + "<br/>");
                        $('#info').append(response.location.display_address[1] + "<br/><br/>");
                        if (response.reviews.length > 0) {
                            $('#info').append("<strong>Reviews:</strong></br>");
    
                            response.reviews.forEach(function(review) {
                                $('#info').append("rating: <img src='" + review.rating_image_url.replace('\\','') + "'></img>");
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
