/**
 * Created by VincentGuerrero on 4/16/14.
 */
var http = require('http');

var ad = {
            VIN             : "A234C12345432DC12",
            Flag            : 0,
            Price           : "200000",
            Mileage         : "20000",
            Pictures        : ["prueba3.jpg", "prueba3.jpg","prueba3.jpg"],
            Seller_ID       : 00119045615,
            Paper_Status    : "OK",
            Trouble_Codes   : ["P0001"]
};

//4JGBF8GB2AA461477  Acura TL 3.2 2004 440,000 S
//4JGBF8GB2AA461477  Acura MDX 2003 420,000 3.5, 6 Cilindros
//1B3AL56T54N678683  BMW M3 2009 2,200,000 4.0, 8 Cilindros
//19XFA1F56AE322845  Audi TT 2008  1,200,000 2.0 turbo, 4 Cilindros
//2G1FP22K722480693  Chevrolet Astro 2001 290,000 6 cilindros
//4T1BB46K29U391835  Chevrolet Aveo 2011 425,000 1.3, 4 Cilindros
//WVWME63B64E169063  Chrysler PT Cruiser 2002 200,000 2.0, 4 Cilindros
//1GCEC14CX7E816282  Citroen DS3
//JTDBA32KX50000522  Daihatsu Delta
//1N6AD07W18C506432  Daihatsu Terios
//1HGCP2F87AA524275  Dodge Caliber
//3GNFK16YX7G195531  Dodge Durango
//3G7DA03EX5S702217  Volvo S80
//9BWPG61J814610684  Volkswagen Passat
//1GCFH154X91649526  Volkswagen Tiguan
//2GCFK13Y271344892  Toyota Tundra
//1G1AZ37N0ER834116  Toyota Platz
//JACCN57X917854460  Suzuki Reno
//1N6AA0FC3BN034424  Suzuki APV
//3VWEF31C87M841227  Renault Laguna
//1HGCM55323A012149  Porsche Cayman
//1GCEC19T66Z813329  Pontiac GTO
//3D7MA48C43G515304  Peugeot Partner
//1GCGK24F0YF356220  Nissan  Versa
//1HGEM21025L221143  Nissan  Patrol
//1FT7W3A63BE766311  Mitsubishi Outlander
//1GTJ5MFE4B8822515  Mitsubishi L 300
//1FMZU83W04Z571010  Mitsubishi Endeavor
//JM1BK344091819566  Mazda RX-7
//3D7HA16H35G453587  Mazda 6
//1FMEU63E48U228925  Lexus GX
//1D3HU16207J750516  Lexus IS 250
//1FTSS34P68D026910  Lexus IS 350
//KMHDH4AE0BU666326  Kia Sportage
//1GC4KXBG4AF665674  Land Rover Model
//1C3AL56T64N055589  Isuzu DMAX
//WBAPH57599N445453  Hyundai Tiburon
//1GTHC23G91F565697  Hyundai Entourage
//1D4PT4GK3AW466754  Honda Logo

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