/**
 * Created by VincentGuerrero on 4/16/14.
 */
var http = require('http');

var mechanicAd = {
    adID      : 35,
    Reviews   : [2,1,1,1,1,1,2,5,1,3,2,2,2,2,2,2,2,2,1,2,3,2,1,3,5,4,2,4,5,5,5,3,1,1,2,3,2,1,3,5,4,2,4,5,5,5,3,1]
};

var mechanicAd = JSON.stringify(mechanicAd);
var headers = {
    'Content-Type': 'application/json',
    'Content-Length': mechanicAd.length
};


var options = {
    host: 'localhost',
    port: 80,
    path: '/index.php/ad_controller/insertMechanicReview',
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

req.write(mechanicAd);
req.end();