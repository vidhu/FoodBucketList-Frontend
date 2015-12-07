var devcoach = devcoach || {};
devcoach.CallChain = function () {
    var cs = [];
    this.add = function (call) {
        cs.push(call);
    };
    this.execute = function () {
        var wrap = function (call, callback) {
            return function () {
                call(callback);
            };
        };
        for (var i = cs.length-1; i > -1; i--) {
            cs[i] = 
                wrap(
                    cs[i], 
                    i < cs.length - 1 
                        ? cs[i + 1] 
                        : null);
        }
        cs[0]();
    };
};