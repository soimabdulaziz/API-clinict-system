# Clinic Appointment API

RESTful API built with Laravel 11 for managing clinic appointments. This API supports managing patients, services, diagnoses, and appointments, with queue-based processing for checkup progress.

---

## Installation

### extract file zip

```bash

###inslall dependencies
composer install

##setup environment
cp .env.example .env

##env configurations:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic
DB_USERNAME=<your_username>
DB_PASSWORD=<your_password>
QUEUE_CONNECTION=database

#create databse clinic

### run migrations
php artisan migrate

### run application
php artisan serve


###API ENDPOINT
###CREATE PATIENTS
#endpoint POST /api/patient
#request :
{
  "name": "budi"
}

###CREATE Services
#endpoint POST /api/service
#request :
{
  "name": "Bodrex"
}

###CREATE DIAGNOSE
#endpoint POST /api/diagnose
#request :
{
  "name": "Demam",
  "service": "[1]"
}

###CREATE Appoinment
#endpoint POST /api/appointment
#request :
{
  "patient_id": 1,
  "diagnose_id": 1
}

###GET Appoinment detail
#endpoint GET /api/appointment/{id}
#response :
{
    "id": 1,
    "patient": {
        "id": 1,
        "name": "budi"
    },
    "diagnose": {
        "id": 1,
        "name": "demam"
    },
    "checkup": [
        {
            "id": 1,
            "service": {
                "id": 1,
                "name": "obat"
            },
            "status": 0
        }
    ],
    "status": 1
}


###Update Appoinment status
#endpoint PATCH /api/appointment
#request :
{
  "status": 1
}

###Testing:

# configuration env.testing:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinic_testing
DB_USERNAME=root
DB_PASSWORD=

#CREATE DATABASE clinic_testing

#migrate env testing:
php artisan migrate --env=testing

#run Testing:
php artisan test

###Output:
 PASS  Tests\Unit\AppointmentTest
  ✓ create appointment                                                                                                      1.25s

   PASS  Tests\Unit\ExampleTest
  ✓ that true is true

   PASS  Tests\Feature\ExampleTest
  ✓ the application returns a successful response                                                                           0.08s

  Tests:    3 passed (5 assertions)
  Duration: 1.63s


```
