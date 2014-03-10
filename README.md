    Documentación

-----Descripción del Código------------------------------------------------------------

Los nombres de las tablas, vista, modelos y controladores estan escritos en Plural y minuscula. EX "trouble_codes".

Los campos  de las tablas están escritos en con la primera letra en Mayuscula, y en singular. EX "Trouble_Code"


Las variables y metodos estan escritos en camelCase.

Los metodos de los modelos están de la siguiente manera: 

  - getBrands()                      obitienes los carros sin paramatres.
  - getBrand($PK)                    obitene un carro por su PK. EX "getBrand($BrandID)"
  - getBrandByParamater($parameter)  obtiene un carro por un paramatro cualquiera. EX "getCarByParameter($brandName)




Hay que hacer la conexión con VinQuery para esto. 

- Hay trabajar el controlador del Anuncion. 

Proxima Función a trabajar: ad_controller->showad()
                            ad_controller->createAd()
                            ad_controller->showSearchResults()

------Pendiente-----------------------------------------------------------------------

Arreglar el documento de VISIO, de la base de datos. 



------WebService-----------------------------------------------------------------------

Obtener información del carro: http://54.200.195.186/index.php/car_controller/carQuery

Recibe un JSON con un campo VIN y busca el VIN en la base de datos, si no existe pero es un VIN valido lo busca en 
la base de dato del suplidor, lo creo y lo retorna. Si ya existe simplemente lo 
retorna en JSON. 


Crear un anuncio: http://54.200.195.186/index.php/ad_controller/createAd

Recibe un JSON con lo siguiente:
JSON = {
            userID: 119045622,
            VIN: "12345678912345678",
            adPrice: "5000",
            mileage: "135000",
            papers: "OK",
            carParts: 
                  [
                    {Review:"1",ID:1} ,{Review:"4",ID:2} ,{Review:"2",ID:3} ,{Review:"3",ID:4} ,
                    {Review:"2",ID:5} ,{Review:"5",ID:6} ,{Review:"3",ID:7} ,{Review:"1",ID:8} ,
                    {Review:"3",ID:9} ,{Review:"2",ID:10},{Review:"5",ID:11},{Review:"2",ID:12},
                    {Review:"4",ID:13},{Review:"1",ID:14},{Review:"1",ID:15},{Review:"3",ID:16},
                    {Review:"5",ID:17},{Review:"3",ID:18},{Review:"2",ID:19},{Review:"4",ID:20},
                    {Review:"2",ID:21},{Review:"2",ID:22},{Review:"4",ID:23},{Review:"2",ID:24},
                    {Review:"1",ID:25},{Review:"4",ID:26},{Review:"2",ID:27},{Review:"3",ID:28},
                    {Review:"4",ID:29},{Review:"2",ID:30},{Review:"1",ID:31},{Review:"1",ID:32},
                    {Review:"2",ID:33},{Review:"3",ID:34},{Review:"4",ID:35},{Review:"4",ID:36},
                    {Review:"3",ID:37},{Review:"6",ID:38},{Review:"3",ID:39},{Review:"2",ID:40},
                    {Review:"4",ID:41},{Review:"2",ID:42},{Review:"1",ID:43},{Review:"2",ID:44}
                 ],

            troubleCodes:[{Trouble:"P0001"},{Trouble:"P0002"},{Trouble:"P0003"},{Trouble:"P0004"}]
        };

Como se puede ver este tiene valores por defecto. Esto creara un anuncio siempre y cuando se asuma 
que el VIN es carro que fue solicitado por el metodo anterior; existe en la base de datos. 
 

Login remoto: http://54.200.195.186/user_controller/remoteUserLogin

Recibe un JSON con lo siguiente:
JSON = {    
            userID: 119045622,
            password: "porche"
       };

Retorna un JSON con lo siguiente: 

JSON = {
            Response:OK ; si está bien
            Response:NO ; si no está bien
       };

De esta manera se puede validar la sesión en el aplicación movil. 


------Flujo de la aplicación------------------------------------------------------------

  - Se toma el VIN y los Trouble Codes del vehículos a través del OBD II Reader en la aplicación Android.
  - Se envía un Request al WebService con el VIN del vehículo. 
  - El webservice retorna un objeto tipo carro con los siguientes datos:
 
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

  - La aplicación móvil mostrará los datos recibidos al vendedor de forma informativa. 
  - La aplicación movil desplegará un formulario a ser llenado con lo siguiente: 
 
    Precio
    Estado_Papeles_DGII

    Carrocería ID: 1-16
        
        Bonnet
        Bumper
        Grille
        Door_FR
        Door_FL
        Door_RR
        Door_RL
        Head_Lights
        Tail_Lights
        Brake_Lights
        Reverse_Lights
        Fog_Lights
        Tail_Gate
        Mirror
        Side_Panel
        Guard

    Interior ID: 17-31

        Door_FR_Panel
        Door_FL_Panel
        Door_RR_Panel
        Door_RL_Panel
        Steering_Wheel
        Driver_Seat
        Passanger_Seat
        Air_Bag
        Dashboard
        Dimmer
        emergency_Brake
        Gear_Stick
        Glove_Comparmet
        Rear_View_Mirror
        Trunk

    Mecánico. ID: 32-44

        Motor
        Transmision
        Bujías
        Aceite_Motor
        Aceite_Transmision
        Aceite_Hidraulico
        Líquido_Frenos
        Tren Delantero
        Filtro_Gasolina
        Filtro_Aceite
        Filtro_Aire
        Radiador
        Frenos

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

