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

        <div id='info'>
            <h2></h2>
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

            $.ajax({
                url: "http://api.fbl.vidhucraft.com/search/id/" + id,
                dataType: "jsonp",
                success: function (response) {
                    $('h2').append(response[0].name);
                    $('#info').append("<img src='" + response[0].snippet_img_url + "'> <br/>");
                    $('#info').append("description: " + response[0].snippet_text + "<br/>");
                    $('#info').append("rating: " + response[0].rating + "<br/>");
                    $('#info').append("review count: " + response[0].review_count + "<br/>");
                    $('#info').append("phone number: " + response[0].display_phone + "<br/>");
                    $('#info').append("address: \n" + response[0].display_address[0] + "<br/>");
                    $('#info').append(response.display_address[1] + "<br/>");
                    $('#info').append(response.display_address[2] + "<br/>");
                }
            });
        </script>
    </body>
</html>
