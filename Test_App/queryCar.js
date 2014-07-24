
var http = require('http');

  Car = {VIN:"1GTJ5MFE4B8822515"};


var Car = JSON.stringify(Car);

var headers = {
    'Content-Type': 'application/json',
    'Content-Length': Car.length
};

var options = {
    host: 'localhost',
    port: 80,
    path: '/index.php/car_controller/carQuery',
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

req.write(Car);
req.end();