var Nom = (function(accessToken){
    
    var endPoint = "http://api.fbl.vidhucraft.com";
    
    var makeRequest = function(resource, method, data, callback){
        $.ajax({
            url: endPoint + resource,
            type: method,
            data: data,
            success: function (data) {
                callback(data);
            }
        });
    };
    
    //Bucket API
    var Bucket = {
        getBuckets: function(callback){
            var resource = "/bucket";
            var method = "GET";
            makeRequest(resource, method, null, callback);
        },
        addBucket: function(name, description, callback){
            var resource = "/bucket";
            var method = "POST";
            var data = {
                bucketname: name,
                bucketdescription: description
            };
            makeRequest(resource, method, data, callback);
        },
        editBucket: function(id, name, description, callback){
            var resource = "/bucket/"+id;
            var method = "PUT";
            var data = {
                bucketname: name,
                bucketdescription: description
            };
            makeRequest(resource, method, data, callback);
        },
        deleteBucket: function(id, callback){
            var resource = "/bucket/"+id;
            var method = "DELETE";
            makeRequest(resource, method, null, callback);
        },
        getItems: function(id, callback){
            var resource = "/bucket/"+id;
            var method = "GET";
            makeRequest(resource, method, null, callback);
        },
        addItem: function(id, businessID, callback){
            var resource = "/bucket/"+id+"/"+businessID;
            var method = "POST";
            makeRequest(resource, method, null, callback);
        },
        deleteItem: function(id, businessID, callback){
            var resource = "/bucket/"+id+"/"+businessID;
            var method = "DELETE";
            makeRequest(resource, method, null, callback);
        }  
    };
    
    return {
        Bucket: Bucket
    };
})("accessToken");

