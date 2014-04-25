
var http = require('http');

var VIN = {VIN:12345678912345671};

var VIN = JSON.stringify(VIN);
var headers = {
    'Content-Type': 'application/json',
    'Content-Length': VIN.length
};


var options = {
    host: 'localhost',
    port: 80,
    path: '/index.php/ad_controller/getActiveAdByVin',
    method: 'POST',
    headers: headers
};



var req = http.request(options, function(res) {
    res.setEncoding('utf-8');

    var responseString = '';

    res.on('data', function(data) {
        responseString += data;
    });

    res.on('end', function() {
        console.log(responseString);
    });
});

req.on('error', function(e) {
    console.log("error! :'( ");
});

req.write(VIN);
req.end();