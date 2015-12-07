var Nom = (function () {

    //Static vars
    var endPoint = "http://api.fbl.vidhucraft.com";
    //var endPoint = "http://local.nom.vidhucraft.com/backend/public_html";

    var makeRequest = function (resource, method, data, callback) {
        $.ajax({
            url: endPoint + resource,
            type: method,
            data: data,
            dataType: "json",
            success: function (data) {
                callback(data);
            }
        });
    };

    return function (accessToken) {
        //Search API
        this.Search = {
            search: function (keyword, callback) {
                var resource = encodeURI("/search/" + keyword);
                var method = "GET";
                makeRequest(resource, method, null, callback);
            },
            getBusinessInfo: function (businessID, callback) {
                var resource = encodeURI("/search/id/" + businessID);
                var method = "GET";
                makeRequest(resource, method, null, callback);
            }
        };

        //Bucket API
        function bucket() {
            
        };
        bucket.prototype.getBuckets = function (callback) {
            var resource = "/bucket";
            var method = "GET";
            var data = {
                accessToken: accessToken
            };
            makeRequest(resource, method, data, function (r) {
                //Create new bucket for user
                if (r.result.length === 0) {
                    console.log("Creating a new bucket");
                    console.log(this);
                }
                callback(r);
            });
        };
        bucket.prototype.addBucket = function (name, description, callback) {
            var resource = "/bucket";
            var method = "POST";
            var data = {
                accessToken: accessToken,
                bucketname: name,
                bucketdescription: description
            };
            makeRequest(resource, method, data, callback);
        };
        bucket.prototype.editBucket = function (id, name, description, callback) {
            var resource = "/bucket/" + id;
            var method = "PUT";
            var data = {
                accessToken: accessToken,
                bucketname: name,
                bucketdescription: description
            };
            makeRequest(resource, method, data, callback);
        };
        bucket.prototype.deleteBucket = function (id, callback) {
            var resource = "/bucket/" + id + "?accessToken=" + accessToken;
            var method = "DELETE";
            var data = {
                accessToken: accessToken
            };
            makeRequest(resource, method, data, callback);
        };
        bucket.prototype.getItems = function (id, callback) {
            var resource = "/bucket/" + id;
            var method = "GET";
            var data = {
                accessToken: accessToken
            };
            makeRequest(resource, method, data, callback);
        };
        bucket.prototype.addItem = function (id, businessID, callback) {
            var resource = "/bucket/" + id + "/" + businessID;
            var method = "POST";
            var data = {
                accessToken: accessToken
            };
            makeRequest(resource, method, data, callback);
        };
        bucket.prototype.deleteItem = function (id, businessID, callback) {
            var resource = "/bucket/" + id + "/" + businessID + "?accessToken=" + accessToken;
            var method = "DELETE";
            var data = {
                accessToken: accessToken
            };
            makeRequest(resource, method, data, callback);
        };
        this.Bucket = new bucket();
    };
})();

