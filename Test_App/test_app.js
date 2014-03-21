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
    
            1,2,3,4
//          
//          {Review:"1",ID:1} ,{Review:"4",ID:2} ,{Review:"2",ID:3} ,{Review:"3",ID:4} ,
//          {Review:"2",ID:5} ,{Review:"5",ID:6} ,{Review:"3",ID:7} ,{Review:"1",ID:8} ,
//          {Review:"3",ID:9} ,{Review:"2",ID:10},{Review:"5",ID:11},{Review:"2",ID:12},
//          {Review:"4",ID:13},{Review:"1",ID:14},{Review:"1",ID:15},{Review:"3",ID:16},
//          {Review:"5",ID:17},{Review:"3",ID:18},{Review:"2",ID:19},{Review:"4",ID:20},
//          {Review:"2",ID:21},{Review:"2",ID:22},{Review:"4",ID:23},{Review:"2",ID:24},
//          {Review:"1",ID:25},{Review:"4",ID:26},{Review:"2",ID:27},{Review:"3",ID:28},
//          {Review:"4",ID:29},{Review:"2",ID:30},{Review:"1",ID:31},{Review:"1",ID:32},
//          {Review:"2",ID:33},{Review:"3",ID:34},{Review:"4",ID:35},{Review:"4",ID:36},
//          {Review:"3",ID:37},{Review:"6",ID:38},{Review:"3",ID:39},{Review:"2",ID:40},
//          {Review:"4",ID:41},{Review:"2",ID:42},{Review:"1",ID:43},{Review:"2",ID:44}
       ],

 
Trouble_Codes: 
        [
          {Trouble:"P0001"},{Trouble:"P0007"},{Trouble:"P0002"}
       ]
  

};

var car = {
  VIN: 52140228312341051
  };

var userString = JSON.stringify(car);

var headers = {
  'Content-Type': 'application/json',
  'Content-Length': userString.length
};

  
var options = {
  host: 'localhost',
  port: 80,
//  path: '/index.php/ad_controller/createAd',
  path: '/index.php?/car_controller/carQuery',
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


