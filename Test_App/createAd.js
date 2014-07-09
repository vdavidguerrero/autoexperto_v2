/**
 * Created by VincentGuerrero on 4/16/14.
 */
var http = require('http');

var ad = {
            VIN             : 18888888888888422,
            Flag            : 0,
            Price           : "200000",
            Mileage         : "20000",
            Pictures        : ["prueba1", "prueba1"],
            Seller_ID       : 12345678912,
            Paper_Status    : "prueba1",
            Trouble_Codes   : ["P0001","P0009","P0004"]
};

var ad = JSON.stringify(ad);
var headers = {
    'Content-Type': 'application/json',
    'Content-Length': ad.length
};


var options = {
    host: 'localhost',
    port: 80,
    path: '/index.php/ad_controller/createPendingAd',
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

req.write(ad);
req.end();