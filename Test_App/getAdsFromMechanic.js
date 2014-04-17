
var http = require('http');

Mechanich = {ID:12345678923};

var Mechanich = JSON.stringify(Mechanich);

var headers = {
    'Content-Type': 'application/json',
    'Content-Length': Mechanich.length
};

var options = {
    host: 'localhost',
    port: 80,
    path: '/index.php/ad_controller/getMechanicAds',
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

req.write(Mechanich);
req.end();