var http = require('http');
var http2 = require('http');

var ad = {
    Seller_ID: 00119045775,
    VIN: 12345678914896549,
    Price: "320000",
    Mileage: "7500",
    Paper_Status: "OK",
    Flag   : 0,
   
    Trouble_Codes:   ["P0001","P0007","P0002"],
    Pictures:        ["Path1", "Path2"       ]
};

 // Car_Part_Reviews:[
 //                        1,2,3,4,5,1,2,3,4,5,1,2,3,4,5,
 //                        1,2,3,4,5,1,2,3,4,5,1,2,3,4,5,
 //                        1,2,3,4,5,1,2,3,4,5,1,2,3,4
 //     ],


var car = {VIN: ad.VIN};
//var car = {ID: 12345678912};


var carJson = JSON.stringify(car);
var adJson = JSON.stringify(ad);

// No we prepare the packge

var headers = {
  'Content-Type': 'application/json',
  'Content-Length': carJson.length
};

var headers2 = {
  'Content-Type': 'application/json',
  'Content-Length': adJson.length
};

  
var options = {
  host: 'localhost',
  port: 80,
  path: '/index.php?/car_controller/carQuery',
  method: 'POST',
  headers: headers
};

  
var options2 = {
  host: 'localhost',
  port: 80,
  path: '/index.php/ad_controller/createPendingAd',
  method: 'POST',
  headers: headers2
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
  console.log("Manito, error :'( ");
});

req.write(carJson);
req.end();

//callBack = function(res) {
//  res.setEncoding('utf-8');
//
//  var responseString = '';
//
//  res.on('data', function(data) {
//    responseString += data;
//  });
//
//  res.on('end', function() {
//    console.log(responseString);
//  });
//};

//assigned = function() {
//     req2 = http2.request(options2,callBack);
//     req2.write(adJson);
//     req2.end();
//};
//
//setTimeout(assigned, 8000);
// 
