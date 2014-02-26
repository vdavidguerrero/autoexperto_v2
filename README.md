Documentación

Los nombres de las tablas, vista, modelos y controladores estan escritos en Plural y minuscula. EX "trouble_codes".

Los campos  de las tablas están escritos en con la primera letra en Mayuscula, y en singular. EX "Trouble_Code"


Las variables y metodos estan escritos en camelCase.

Los metodos de los modelos están de la siguiente manera: 

  - getBrands()                      obitienes los carros sin paramatres.
  - getBrand($PK)                    obitene un carro por su PK. EX "getBrand($BrandID)"
  - getBrandByParamater($parameter)  obtiene un carro por un paramatro cualquiera. EX "getCarByParameter($brandName)



 Crear un metodo que reciba el request del WebService, si este valor no es un carro único que lo cree, si el módelo no es
un modelo existente, que lo cree por igual. 