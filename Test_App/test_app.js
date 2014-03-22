var http = require('http');

var ad = {
  Seller_ID: 119045622,
  VIN: 12345678912341111,
  Price: "320000",
  Mileage: "7500",
  Paper_Status: "OK",
  Flag   : "0",
  Car_Part_Reviews: 
        [
    
            1,2,3,4,5,1,2,3,4,5,1,2,3,4,5,
            1,2,3,4,5,1,2,3,4,5,1,2,3,4,5,
            1,2,3,4,5,1,2,3,4,5,1,2,3,4
       ],

 
Trouble_Codes: 
         [
          "P0001","P0007","P0002"
         ],
Pictures:
         [
          "Path1", "Path2"
         ]
  

};

var car = {
  VIN: 52140228312341051
  };

var userString = JSON.stringify(ad);

var headers = {
  'Content-Type': 'application/json',
  'Content-Length': userString.length
};

  
var options = {
  host: 'localhost',
  port: 80,
  path: '/index.php/ad_controller/createPendingAd',
  //path: '/index.php?/car_controller/carQuery',
  method: 'POST',
  headers: headers
};

// Setup the request.  The options parameter is
// the object we defined above.


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
  // TODO: handle error.
});

req.write(userString);
req.end();


