## How to start project
1. ```git clone https://github.com/anastasija-stepanova/Hospital.git```
2. ```cd Hospital```
3. Set up config in .env
4. ```./vendor/bin/sail up```
5. ```./vendor/bin/sail artisan migrate```


## Available routes

- POST /doctor

Example params

```
{
  "last_name": "Doctor last name",
  "first_name": "Doctor first name",
  "phone": "+1234564569",
  "working_start_time": "09:00",
  "working_end_time": "17:00"
}
```


- POST /patient

Example params

```
{
  "last_name": "Patient last name",
  "first_name": "Patient first name",
  "snils": "123-456-780 00"
}
```


- POST /appointment

Example params

```
{
  "doctor_id": 1,
  "patient_id": 1,
  "date": "2023-03-20 11:00:00"
}
```


- GET /appointments

Example params

```
/api/appointments?filter[doctor][lastName]=LastName&filter[patient][firstName]=FirstName&filter[date][from]=2020-02-20 14:00:00&filter[date][to]=2023-02-20 14:00:00&sortOrder=desc
```
