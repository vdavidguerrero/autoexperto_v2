/**
 * Created by VincentGuerrero on 4/16/14.
 */
var http = require('http');

var mechanicAd = {
    adID      : 98,
//    Reviews   : [1,1,1,4,1,4,4,4,4,3,4,2,4,2,4,4,1,2,1,2,3,4,2,3,1,4,2,4,2,2,1,3,2,1,4,3,2,3,3,1,4,2,4,5,3,2,3,1]
//    Reviews   : [1,1,4,1,5,1,5,1,1,3,2,5,5,2,5,2,2,5,1,2,3,5,3,3,1,5,2,4,5,1,2,3,2,1,2,3,2,4,2,1,4,2,4,4,4,3,3,5]
//    Reviews   : [2,3,3,1,3,1,2,1,3,3,2,2,4,2,2,2,3,2,1,2,3,2,1,3,1,4,2,4,1,1,1,3,3,1,2,3,2,1,3,1,4,2,3,1,1,1,3,1]
//    Reviews   : [3,1,5,1,3,1,2,5,1,4,2,2,3,2,2,3,4,2,1,2,3,2,2,3,1,4,2,4,1,1,1,3,1,1,1,3,2,1,4,1,4,2,4,1,1,1,3,1]
//    Reviews   : [5,1,1,2,1,1,2,1,1,2,2,2,2,2,2,5,5,2,1,2,3,2,3,1,1,3,2,3,1,3,1,3,1,1,2,3,2,3,3,1,3,2,2,1,1,1,3,1]
    Reviews   : [4,1,1,1,1,1,2,1,1,3,2,2,1,2,2,2,1,2,1,2,3,2,3,3,1,4,2,4,1,1,1,3,5,1,2,3,2,1,2,1,2,2,1,1,1,1,3,1]
};

//98
//99
//100
//101
//102
//103
//104
//105
//106
//107
//108
//109
//110
//111
//112
//113
//114
//115
//116
//117

var mechanicAd = JSON.stringify(mechanicAd);
var headers = {
    'Content-Type': 'application/json',
    'Content-Length': mechanicAd.length
};


var options = {
    host: '54.200.195.186',
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


