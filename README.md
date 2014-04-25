------Pendiente Aplicación-----------------------------------------------------------------------
Agregar los algoritmos y sus concernientes Datas

Dar de baja a un vehículo


--- Revision de la literatura----

http://www.kbb.com

http://www.truecar.com






------WebService-----------------------------------------------------------------------

Crear un cuenta Remota: http://54.200.195.186/user_controller/createUserRemote

Recibe el  siguiente JSON:

User = {
            ID: 11992312341,                    || int, 11 Digitos
            Name: "Prueba1",                    || String
            Flag: 0,                            || int, 0 = Venderdor, 1= Mécanico
            Phone:"Prueba1",                    || string
            Email:"Prueba1",                    || string
            Address:"Prueba1",                  || string
            Password: "Prueba1",                || string
            Dominican_Republic_City:"Prueba1"   || string, CamelCase
        }
Retorna un JSON con lo siguiente:

JSON = {Response};

Response tendrá uno de los siguientes valores:

  0 ; representa que es un vendedor
  1 ; representa que es un mécanico
 -1; represente que no es existe el usuarios/contraseña enviado.
 -2; El json es invalido.

Los valores deben estar validados por quien los envía.

*******************************************************************************************

Login remoto: http://54.200.195.186/user_controller/remoteUserLogin

Recibe un JSON con lo siguiente:
JSON = {
            userID:,
            password:
       };

Retorna un JSON con lo siguiente:

JSON = {Response};


Response tendrá uno de los siguientes valores:

  0 ; representa que es un vendedor
  1 ; representa que es un mécanico
  -1; represente que no es existe el usuarios/contraseña enviado.


*******************************************************************************************

Obtener información del carro: http://54.200.195.186/index.php/car_controller/carQuery

Recibe un JSON con un campo VIN y busca el VIN en la base de datos, si no existe pero es un VIN valido lo busca en
la base de dato del suplidor, lo creo y lo retorna. Si ya existe simplemente lo
retorna en JSON.

Recibe un JSON con lo siguiente:
VIN ={
        VIN:prueba || int, 17 digitos
     }

Retorna un JSON con lo siguiente:

Car = {
            VIN: 12345678912345672,
            Date:"2014-04-16 19:24:54",
            Manufacturer_Country:"Prueba1",
            Unique_Model:{
                            ID:93,
                            Year:2000,
                            Trim:"Prueba1",
                            Body_Style:"Prueba1",
                            Engine_Type:"Prueba1",
                            Transmission:"Prueba1",
                            Gallons:20,
                            Fuel_Economy_City:"Prueba1",
                            Fuel_Economy_Highway:     "Prueba1",
                            Seating:"Prueba1",
                            ABS_Brake:"Prueba1",
                            Driver_Airbag:"Prueba1",
                            Front_Side_Airbag:"Prueba1",
                            AC:"Prueba1",
                            Cruise_Control:"Prueba1",
                            Convertible_Top:"Prueba1",
                            Radio:"Prueba1",
                            CD_Player:"Prueba1",
                            Subwoofer:"Prueba1",
                            Leather_Seats:"Prueba1",
                            Power_Windows:"Prueba1",
                            Wheels:"Prueba1",
                            Brand:"Prueba1",
                            Model:"Prueba1"
                       }
      }

********************************************************************************************

Crear un anuncio: http://54.200.195.186/index.php/ad_controller/createAd

Recibe un JSON con lo siguiente:

ad = {
            VIN:"12345678912345672"                 || int, 11 Digitos
            Flag:0,                                 || int, 11 Digitos
            Price:"200000",                         || int, 11 Digitos
            Mileage:"20000",                        || int, 11 Digitos
            Pictures:["prueba1", "prueba1"],        || int, 11 Digitos
            Seller_ID:12345678912,                  || int, 11 Digitos
            Paper_Status:"prueba1",                 || int, 11 Digitos
            Trouble_Codes:["P0001","P0009","P0004"] || int, 11 Digitos
};

Retorna un JSON con lo siguiente:

JSON = {Response};

Response tendrá uno de los siguientes valores:

   1 ; anuncio fue creado satisfactoriamente
  -1 ; ya existe un anuncio pendiente o activo de este VIN
  -2; El json es invalido


*******************************************************************************************

Rectifica un anuncio http://54.200.195.186/index.php/ad_controller/insertMechanicReview

Recibe un JSON con lo siguiente:

var mechanicAd = {
                    adID      : 35,                        || int, Ad ID
                    Reviews   :   [2,1,2,5,1,3,2,2,4,5,3,  || int array, 44 int number from 1 to 5.
                                   4,3,2,1,2,3,2,1,3,5,4,
                                   2,4,5,5,5,3,1,1,2,3,2,
                                   1,3,5,4,2,4,5,5,5,3,1]
                  };


Retorna un JSON con lo siguiente:

JSON = {Response};

Response tendrá uno de los siguientes valores:

   1 ; Anuncio publicado
  -1 ; Este anuncio ya está activo, o es un carro vendido
  -2 ; El json es invalido

*******************************************************************************************

Obtener tods los carros de un Mecanico: http://54.200.195.186/index.php/ad_controller/getMechanicAds

Recibe un JSON con un campo ID y busca el VIN en la base de datos, si no existe pero es un VIN valido lo busca en
la base de dato del suplidor, lo creo y lo retorna. Si ya existe simplemente lo
retorna en JSON.

Recibe un JSON con lo siguiente:
Mechanic ={
             ID:prueba || int
          }

Retorna un JSON con lo siguiente:

Array de anuncios...

------Flujo de la aplicación------------------------------------------------------------

  Se toma el VIN y los Trouble Codes del vehículos a través del OBD II Reader en la aplicación Android.
  Se envía un Request al WebService con el VIN del vehículo.
  El webservice retorna un objeto tipo carro con los siguientes datos:

    Modelo

        Year
        Modelo
        Trim
        Manufacturer_Country
        Body_Style
        Engine_Type
        Transmission
        Gallons
        Fuel_Economy_City
        Fuel_Economy_Highway
        Seating
        ABS_Brake
        Driver_Airbag
        Front_Side_AirBag
        AC
        Cruise_Control
        Convertible_Top
        Radio
        CD_Player
        Subwoofer
        Leather_Seats
        Power_Windows
        Wheels

  La aplicación móvil mostrará los datos recibidos al vendedor de forma informativa.
  La aplicación movil desplegará un formulario a ser llenado con lo siguiente:

    Precio
    Estado_Papeles_DGII

    Carrocería ID: 0-16


        Bonnette
        Bumper
        Parrila
        Puerta Delantera Izquierda
        Puerta Delantera Derecha
        Puerta Trasera Izquierda
        Puerta Trasera Derecha
        Luces Delanteras
        Luces Traseras
        Luces De Freno
        Luces De Reversa
        Alogenos
        Baul
        Retrovisor
        Guarda Lodo Delantero
        Guarda Lodo Trasero





    Interior ID: 17-31

        Panel Puerta Delantera Izquierda
        Panel Puerta Delantera Derecha
        Panel Puerta Trasera Izquierda
        Panel Puerta Trasera Derecha
        Guia
        Asiento Conductor
        Asiento Pasajero
        Bolsa De Aire
        Tablero
        Luces Interior
        Freno De Emergencia
        Palanca De cambios
        Gauntera
        Retrovisor Interior
        Baul interior



    Mecánico. ID: 32-48


        Motor
        Transmision
        Bujías
        Aceite De Motor
        Aceite De Transmision
        Aceite Hidraulico
        Líquido Frenos
        Tren Delantero
        Filtro Gasolina
        Filtro Aceite
        Filtro Aire
        Radiador
        Frenos
        Electricidad
        Alternador
        Piso
        Mofleria


  - La aplicación envía la data recolectada al webService para publicar el anuncio. Aparte de la data
    recolectada se envía los Trouble Codes tomados al principio, el VIN, Millaje y el ID del usuario.





 -----------Lista de trouble Codes---------------------------------------------------------------

    P0001 Fuel Volume Regulator Control Circuit/Open
    P0002 Fuel Volume Regulator Control Circuit Range/Performance
    P0003 Fuel Volume Regulator Control Circuit Low
    P0004 Fuel Volume Regulator Control Circuit High
    P0005 Fuel Shutoff Valve "A" Control Circuit/Open
    P0006 Fuel Shutoff Valve "A" Control Circuit Low
    P0007 Fuel Shutoff Valve "A" Control Circuit High
    P0008 Engine Positions System Performance Bank 1
    P0009 Engine Position System Performance Bank 2
    P0010 "A" Camshaft Position Actuator Circuit (Bank 1)
    P0011 "A" Camshaft Position - Timing Over-Advanced or System Performance (Bank 1)
    P0012 "A" Camshaft Position - Timing Over-Retarded (Bank 1)
    P0013 "B" Camshaft Position - Actuator Circuit (Bank 1)
    P0014 "B" Camshaft Position - Timing Over-Advanced or System Performance (Bank 1)
    P0015 "B" Camshaft Position -Timing Over-Retarded (Bank 1)
    P0016 Crankshaft Position - Camshaft Position Correlation (Bank 1 Sensor A)
    P0017 Crankshaft Position - Camshaft Position Correlation (Bank 1 Sensor B)
    P0018 Crankshaft Position - Camshaft Position Correlation (Bank 2 Sensor A)
    P0019 Crankshaft Position - Camshaft Position Correlation (Bank 2 Sensor B)
    P0020 "A" Camshaft Position Actuator Circuit (Bank 2)
    P0021 "A" Camshaft Position - Timing Over-Advanced or System Performance (Bank 2)
    P0022 "A" Camshaft Position - Timing Over-Retarded (Bank 2)
    P0023 "B" Camshaft Position - Actuator Circuit (Bank 2)
    P0024 "B" Camshaft Position - Timing Over-Advanced or System Performance (Bank 2)
    P0025 "B" Camshaft Position - Timing Over-Retarded (Bank 2)
    P0026 Intake Valve Control Solenoid Circuit Range/Performance Bank 1
    P0027 Exhaust Valve Control solenoid Circuit Range/Performance Bank 1
    P0028 Intake valve Control Solenoid Circuit Range/Performance Bank 2
    P0029 Exhaust Valve Control Solenoid Circuit Range/Performance Bank 2
    P0030 HO2S Heater Control Circuit (Bank 1 Sensor 1)
    P0031 HO2S Heater Control Circuit Low (Bank 1 Sensor 1)
    P0032 HO2S Heater Control Circuit High (Bank 1 Sensor 1)
    P0033 Turbo Charger Bypass Valve Control Circuit
    P0034 Turbo Charger Bypass Valve Control Circuit Low
    P0035 Turbo Charger Bypass Valve Control Circuit High
    P0036 HO2S Heater Control Circuit (Bank 1 Sensor 2)
    P0037 HO2S Heater Control Circuit Low (Bank 1 Sensor 2)
    P0038 HO2S Heater Control Circuit High (Bank 1 Sensor 2)
    P0039 Turbo/Super Charger Bypass Valve Control Circuit Range/Performance
    P0040 Upstream Oxygen Sensors Swapped From Bank To Bank
    P0041 Downstream Oxygen Sensors Swapped From Bank To Bank
    P0042 HO2S Heater Control Circuit (Bank 1 Sensor 3)
    P0043 HO2S Heater Control Circuit Low (Bank 1 Sensor 3)
    P0044 HO2S Heater Control Circuit High (Bank 1 Sensor 3)
    P0050 HO2S Heater Control Circuit (Bank 2 Sensor 1)
    P0051 HO2S Heater Control Circuit Low (Bank 2 Sensor 1)
    P0052 HO2S Heater Control Circuit High (Bank 2 Sensor 1)
    P0053 HO2S Heater Resistance (Bank 1, Sensor 1)
    P0054 HO2S Heater Resistance (Bank 1, Sensor 2)
    P0055 HO2S Heater Resistance (Bank 1, Sensor 3)
    P0056 HO2S Heater Control Circuit (Bank 2 Sensor 2)
    P0057 HO2S Heater Control Circuit Low (Bank 2 Sensor 2)
    P0058 HO2S Heater Control Circuit High (Bank 2 Sensor 2)
    P0059 HO2S Heater Resistance (Bank 2, Sensor 1)
    P0060 HO2S Heater Resistance (Bank 2, Sensor 2)
    P0061 HO2S Heater Resistance (Bank 2, Sensor 3)
    P0062 HO2S Heater Control Circuit (Bank 2 Sensor 3)
    P0063 HO2S Heater Control Circuit Low (Bank 2 Sensor 3)
    P0064 HO2S Heater Control Circuit High (Bank 2 Sensor 3)
    P0065 Air Assisted Injector Control Range/Performance
    P0066 Air Assisted Injector Control Circuit or Circuit Low
    P0067 Air Assisted Injector Control Circuit High
    P0068 MAP/MAF - Throttle Position Correlation
    P0069 Manifold Absolute Pressure - Barometric Pressure Correlation
    P0070 Ambient Air Temperature Sensor Circuit
    P0071 Ambient Air Temperature Sensor Range/Performance
    P0072 Ambient Air Temperature Sensor Circuit Low Input
    P0073 Ambient Air Temperature Sensor Circuit High Input
    P0074 Ambient Air Temperature Sensor Circuit Intermittent
    P0075 Intake Valve Control Solenoid Circuit (Bank 1)
    P0076 Intake Valve Control Solenoid Circuit Low (Bank 1)
    P0077 Intake Valve Control Solenoid Circuit High (Bank 1)
    P0078 Exhaust Valve Control Solenoid Circuit (Bank 1)
    P0079 Exhaust Valve Control Solenoid Circuit Low (Bank 1)
    P0080 Exhaust Valve Control Solenoid Circuit High (Bank 1)
    P0081 Intake valve Control Solenoid Circuit (Bank 2)
    P0082 Intake Valve Control Solenoid Circuit Low (Bank 2)
    P0083 Intake Valve Control Solenoid Circuit High (Bank 2)
    P0084 Exhaust Valve Control Solenoid Circuit (Bank 2)
    P0085 Exhaust Valve Control Solenoid Circuit Low (Bank 2)
    P0086 Exhaust Valve Control Solenoid Circuit High (Bank 2)
    P0087 Fuel Rail/System Pressure - Too Low
    P0088 Fuel Rail/System Pressure - Too High
    P0089 Fuel Pressure Regulator 1 Performance
    P0090 Fuel Pressure Regulator 1 Control Circuit
    P0091 Fuel Pressure Regulator 1 Control Circuit Low
    P0092 Fuel Pressure Regulator 1 Control Circuit High
    P0093 Fuel System Leak Detected - Large Leak
    P0094 Fuel System Leak Detected - Small Leak
    P0095 Intake Air Temperature Sensor 2 Circuit
    P0096 Intake Air Temperature Sensor 2 Circuit Range/Performance
    P0097 Intake Air Temperature Sensor 2 Circuit Low
    P0098 Intake Air Temperature Sensor 2 Circuit High
    P0099 Intake Air Temperature Sensor 2 Circuit Intermittent/Erratic DTC Codes -
    P0100 Mass or Volume Air Flow Circuit Malfunction
    P0101 Mass or Volume Air Flow Circuit Range/Performance Problem
    P0102 Mass or Volume Air Flow Circuit Low Input
    P0103 Mass or Volume Air Flow Circuit High Input
    P0104 Mass or Volume Air Flow Circuit Intermittent
    P0105 Manifold Absolute Pressure/Barometric Pressure Circuit Malfunction
    P0106 Manifold Absolute Pressure/Barometric Pressure Circuit Range/Performance Problem
    P0107 Manifold Absolute Pressure/Barometric Pressure Circuit Low Input
    P0108 Manifold Absolute Pressure/Barometric Pressure Circuit High Input
    P0109 Manifold Absolute Pressure/Barometric Pressure Circuit Intermittent
    P0110 Intake Air Temperature Circuit Malfunction
    P0111 Intake Air Temperature Circuit Range/Performance Problem
    P0112 Intake Air Temperature Circuit Low Input
    P0113 Intake Air Temperature Circuit High Input
    P0114 Intake Air Temperature Circuit Intermittent
    P0115 Engine Coolant Temperature Circuit Malfunction
    P0116 Engine Coolant Temperature Circuit Range/Performance Problem
    P0117 Engine Coolant Temperature Circuit Low Input
    P0118 Engine Coolant Temperature Circuit High Input
    P0119 Engine Coolant Temperature Circuit Intermittent
    P0120 Throttle Position Sensor/Switch A Circuit Malfunction
    P0121 Throttle Position Sensor/Switch A Circuit Range/Performance Problem
    P0122 Throttle Position Sensor/Switch A Circuit Low Input
    P0123 Throttle Position Sensor/Switch A Circuit High Input
    P0124 Throttle Position Sensor/Switch A Circuit Intermittent

<<<<<<< HEAD
=======

        $this->db->from('car_ads');
        $this->db->join('unique_cars'                 , 'car_ads.Unique_Car_ID = unique_cars.ID'                 ,'inner');
        $this->db->join('unique_models'               , 'unique_cars.Unique_Model = unique_models.ID'            ,'inner');
        $this->db->join('car_models'                  , 'unique_models.Car_Model_ID = car_models.ID'             ,'inner');
        $this->db->join('car_brands'                  , 'car_models.Brand_ID = car_brands.ID'                    ,'inner');
        $this->db->join('users'                       , 'car_ads.Seller_ID = users.ID'                           ,'inner');
        $this->db->join('dominican_republic_cities'   , 'users.DR_City_ID = dominican_republic_cities.ID'        ,'inner');
        this->db->where('unique_cars.VIN'    ,$carVIN);
        $this->db->where('car_ads.Flag', $flag);
        $query = $this->db->get();
        return $query->row();



SELECT *
FROM car_ads
INNER JOIN unique_cars  ON car_ads.Unique_Car_ID = unique_cars.ID;
INNER JOIN trouble_codes_N_ad      on trouble_codes_N_ad.Car_Ad_ID = car_ads.ID
INNER JOIN trouble_codes              on trouble_codes_N_ad.Trouble_Code_ID = trouble_codes.ID
INNER JOIN car_part_review            on car_part_review.Car_Ad_ID = car_ads.ID
INNER JOIN car_parts                   on car_part_review.Car_Part_ID = Car_Parts.ID




