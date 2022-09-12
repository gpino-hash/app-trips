# App Viajes

BraintlyViajes es un microservicio dedicado a gestionar la disponibilidad de viajes de distintas aerolíneas a distintos destinos.

Su principal propósito es servir una API que, dadas las necesidades del usuario, indique cuáles son los vuelos disponibles entre dos puntos.

## Consigna

Se le pide al desarrollador implementar los siguientes métodos:
1. Un endpoint que le recomiende al usuario 10 vuelos distintos que mejor se ajusten a su necesidad. El usuario enviará la siguiente información:
```javascript
{
  "occupants": "numeric",
  "departure_airport": "string" // (IATA code),
  "arrival_airport": "string" // (IATA code),
  "check_in": "date" // (yyy-mm-dd), 
  "check_out": "date" // (yyy-mm-dd), 
  "type": "economic|firstclass",
}
```

El sistema debe recomendarle 5 vuelos de ida y 5 de vuelta que sean cerca de las fechas indicadas, ordenados por precio.

Se deben mostrar 3 opciones con vuelo directo y 2 opciones con escala (en caso de que el vuelo admita escala).

Ejemplo de response:
```javascript
{
  "occupants": 2,
  "departure_airport": "EZE",
  "arrival_airport": "NYC",
  "check_in": 2020-12-14, 
  "check_out": 2020-12-18, 
  "type": "economic",
}
```

Ejemplo de response:
```javascript
{
  "data": {
    "departures": [
      {
        "total_price": 4000,
        "type": "Non-stop flight",
        "flights": [
          {
            "airline": "LIONAIR",
            "flight_number": "LNR-003",
            "departure_airport": "EZE",
            "arrival_airport": "NYC",
            "departure_date": "2020-12-14 14:00:00",
            "arrival_date": "2020-12-14 23:00:00",
            "price": 4000,
            "type": "economic"
          }
        ], 
      },
      {
        "total_price": 3000,
        "type": "Stopover flight",
        "flights": [
          {
            "airline": "LIONAIR",
            "flight_number": "LNR-004",
            "departure_airport": "EZE",
            "arrival_airport": "SCL",
            "departure_date": "2020-12-13 12:00:00",
            "arrival_date": "2020-12-13 17:00:00",
            "price": 1200,
            "type": "economic"
          },
          {
            "airline": "LIONAIR",
            "flight_number": "LNR-005",
            "departure_airport": "SCL",
            "arrival_airport": "NYC",
            "departure_date": "2020-12-13 20:00:00",
            "arrival_date": "2020-12-14 04:00:00",
            "price": 3800,
            "type": "economic"
          }
        ],
      }
    ],
    "returns": [
      {
        "total_price": 3800,
        "type": "Non-stop flight",
        "flights": [
          {
            "airline": "LIONAIR",
            "flight_number": "LNR-008",
            "departure_airport": "NYC",
            "arrival_airport": "EZE",
            "departure_date": "2020-12-18 02:00:00",
            "arrival_date": "2020-12-18 10:00:00",
            "price": 3800,
            "type": "economic"
          }
        ], 
      },
      {
        "total_price": 2820,
        "type": "Stopover flight",
        "flights": [
          {
            "airline": "LIONAIR",
            "flight_number": "LNR-0012",
            "departure_airport": "NYC",
            "arrival_airport": "SCL",
            "departure_date": "2020-12-18 05:00:00",
            "arrival_date": "2020-12-18 17:00:00",
            "price": 1200,
            "type": "economic"
          },
          {
            "airline": "LIONAIR",
            "flight_number": "LNR-0013",
            "departure_airport": "SCL",
            "arrival_airport": "EZE",
            "departure_date": "2020-12-18 19:00:00",
            "arrival_date": "2020-12-18 22:00:00",
            "price": 3500,
            "type": "economic"
          }
        ],
      }
    ]
  }
}

```
#### Consideraciones
* Solo se aplicarán vuelos con escala si la distancia entre ambos aeropuertos es mayor a 5.000 kilómetros.
* La distancia total del viaje al añadir una escala no puede ser superior a la distancia de vuelo directo más un 30%.
* El precio de cada pasaje estará dado por la siguiente fórmula:
    * Si el vuelo es dentro de las próximas 24 horas, se suma un 35% al precio del pasaje.
    * Si el vuelo es dentro de los próximos 7 dias, se suma un 20% al preciod el pasaje.
    * La primera clase cuesta un 40% más que la clase económica para todos los casos.
    * Todos los vuelos con escala tienen un 40% de descuento en su precio final.
