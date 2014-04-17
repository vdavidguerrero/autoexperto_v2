var http = require('http');

User = {
        ID: 12345678923,
        Name: "Prueba2",
        Flag:         1,
        Phone:"Prueba2",
        Email:"Prueba2",
        Address:"Prueba2",
        Password: "Prueba2",
        Dominican_Republic_City:"Prueba2"
}

var User = JSON.stringify(User);

var headers = {
    'Content-Type': 'application/json',
    'Content-Length': User.length
};

var options = {
    host: 'localhost',
    port: 80,
    path: '/index.php/user_controller/createUserRemote',
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

req.write(User);
req.end();
