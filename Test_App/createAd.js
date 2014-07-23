/**
 * Created by VincentGuerrero on 4/16/14.
 */
var http = require('http');

var ad = {
            VIN             : "A234C12345432DC12",
            Flag            : 0,
            Price           : "200000",
            Mileage         : "20000",
            Pictures        : ["prueba3.jpg", "prueba3.jpg"],
            Seller_ID       : 00119045615,
            Paper_Status    : "OK",
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