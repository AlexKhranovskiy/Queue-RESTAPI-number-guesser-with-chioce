### Vocation
The application can help you feel how queue can work. You can select what to put into 
the queue:  
* nothing,just jobs,
* chain of jobs,
* batch of jobs.

Code of the project can help you understand Laravel's contextual binding of service container, 
dependency injection, how to realize polymorphism conception, using of a static methods if need execute a 
method without object. There is used hierarchy: interface - abstract class - classes. Contextual 
binding binds interface and class depending on one of three controllers.

### Description
Web app runs a queue on the server. Jobs are trying to guess a number by equaling a 
generated randomly number with a number had input. Data to manage a queue has stored
in config or can be inputted through a request, there is used RESTAPI. 
In case of using batch the executing of batch does not stop if some job has failed, it continues,
and app is able to output information by the request about the executing process or cancel the executing.
Having a batch id user are able to rerun the batch using artisan commands.

### Control
Use request which starts from: http://localhost:80/api and continues in one of the options in the table.
Request must use GET method & Accept: application/json. You can make request just from a browser.

|             | Queue              | Chain               | Batch            |
|-------------|--------------------|---------------------|------------------|
| Start       | /queue/start       | /chain/start        | /batch/start     |
| See logs    | /logs              | /logs               | /logs            |
| Clear logs  | /queue/logs/clear  | /chain/logs/clear   | /batch/logs/clear|
| See result  |                    | /chain/result       | /batch/result    |
| See total   | /total             | /total              | /total           |
| Make cancel |                    |                     | /batch/cancel    |

* Start will begin a queue
* Result shows a current progress or progress that have done.
* Total is detailed information of finished queue's work.
* Cancel is used for cancel the batch execution.

http://localhost:80/api/start can be run with the default settings (from .env) or can receive paramaters(all or their combinations):
* links=x, x is number of jobs in queue, chain
* tries=x, x is number of tries for all the jobs
* guess_number=x, x is number app will try to guess in all the jobs
* range[start]=x&range[end]=y, x and y is numbers describes start of the range and end respectively
* backoff=x, x is time in seconds which queue waits between the jobs.

http://localhost:80/api/logs can be run with option:
* transaction=x, where x is number of transaction you want to see.

```
Default settings:  
    Jobs = 2
    Tries = 100
    Guess number = 50
    Range start = 0
    Range end = 100
    Backoff = 0
```
## Possible start instructions:
### Up the services
```
docker-compose up --build -d
```

### Go to the container
```
docker exec -it queue-restapi-number-guesser-with-choice-app-1 bash
```

### Run inside the container
```
php artisan migrate  
cp .env.example .env
```

### Down services if you are exit
```
docker-compose down
```
### Posible endpoints:  
* For queue
```
http://localhost:80/api/queue/start
```
```
http://localhost:80/api/logs
```
```
http://localhost:80/api/logs/clear
```
```
http://localhost:80/api/total
```
* For chain of jobs
```
http://localhost:80/api/chain/start?links=4
```
```
http://localhost:80/api/logs
```
```
http://localhost:80/api/logs/clear
```
```
http://localhost:80/api/chain/result
```
```
http://localhost:80/api/total
```
* For batch of jobs
```
http://localhost:80/api/batch/start?links=4
```
```
http://localhost:80/api/batch/result
```
```
http://localhost:80/api/batch/cancel
```
```
http://localhost:80/api/total
```
## Some demonstration:
```
GET http://localhost:80/api/queue/start

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:27:50 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:27:50 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Started, transaction = 1655198870 Args: tries = 100 guessNumber = 50 start = 0 end = 100

Response code: 200 (OK); Time: 450ms; Content length: 88 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies

```
```
GET http://localhost:80/api/logs

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:28:58 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:28:58 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 1,
    "transaction": 1655193443,
    "trial number": 37,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 2,
    "transaction": 1655193443,
    "trial number": 11,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 3,
    "transaction": 1655193443,
    "trial number": 71,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 4,
    "transaction": 1655193443,
    "trial number": 50,
    "guess number": 50,
    "status": "OK"
  },
  {
    "id": 5,
    "transaction": 1655198872,
    "trial number": 17,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 6,
    "transaction": 1655198872,
    "trial number": 32,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 7,
    "transaction": 1655198872,
    "trial number": 63,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 8,
    "transaction": 1655198872,
    "trial number": 23,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 9,
    "transaction": 1655198872,
    "trial number": 95,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 10,
    "transaction": 1655198872,
    "trial number": 84,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 11,
    "transaction": 1655198872,
    "trial number": 64,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 12,
    "transaction": 1655198872,
    "trial number": 8,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 13,
    "transaction": 1655198872,
    "trial number": 89,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 14,
    "transaction": 1655198872,
    "trial number": 69,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 15,
    "transaction": 1655198872,
    "trial number": 45,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 16,
    "transaction": 1655198872,
    "trial number": 53,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 17,
    "transaction": 1655198872,
    "trial number": 3,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 18,
    "transaction": 1655198872,
    "trial number": 47,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 19,
    "transaction": 1655198872,
    "trial number": 96,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 20,
    "transaction": 1655198872,
    "trial number": 39,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 21,
    "transaction": 1655198872,
    "trial number": 57,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 22,
    "transaction": 1655198872,
    "trial number": 22,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 23,
    "transaction": 1655198872,
    "trial number": 1,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 24,
    "transaction": 1655198872,
    "trial number": 22,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 25,
    "transaction": 1655198872,
    "trial number": 51,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 26,
    "transaction": 1655198872,
    "trial number": 95,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 27,
    "transaction": 1655198872,
    "trial number": 22,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 28,
    "transaction": 1655198872,
    "trial number": 93,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 29,
    "transaction": 1655198872,
    "trial number": 35,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 30,
    "transaction": 1655198872,
    "trial number": 22,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 31,
    "transaction": 1655198872,
    "trial number": 91,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 32,
    "transaction": 1655198872,
    "trial number": 14,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 33,
    "transaction": 1655198872,
    "trial number": 15,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 34,
    "transaction": 1655198872,
    "trial number": 58,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 35,
    "transaction": 1655198872,
    "trial number": 60,
    "guess number": 50,
    "status": "Failed"
  },
  {
    "id": 36,
    "transaction": 1655198872,
    "trial number": 50,
    "guess number": 50,
    "status": "OK"
  }
]

Response code: 200 (OK); Time: 354ms; Content length: 3185 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
```
GET http://localhost:80/api/logs/clear

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:29:51 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 58
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:29:51 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Cleared

Response code: 200 (OK); Time: 313ms; Content length: 7 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
```
ET http://localhost:80/api/total

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:31:06 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 57
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:31:06 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "transaction": 1655199062,
    "guess number": 50,
    "status": "OK",
    "used tries": 30,
    "params": {
      "tries": "100",
      "guessNumber": "50",
      "range": {
        "start": "0",
        "end": "100"
      }
    },
    "start date": "2022-06-14 09:30:59",
    "end date": "2022-06-14 09:31:02",
    "completion time": "00:00:03"
  }
]

Response code: 200 (OK); Time: 230ms; Content length: 251 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
```
GET http://localhost:80/api/chain/start?links=4

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:31:46 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 55
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:31:46 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Started,  Args: tries = 100 guessNumber = 50 start = 0 end = 100 links = 4

Response code: 200 (OK); Time: 267ms; Content length: 74 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies

```
```
GET http://localhost:80/api/chain/result

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:33:31 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 56
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:33:31 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "chain length": "4"
  },
  {
    "transaction": 1655199224,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1655199225,
    "guess number": 50,
    "status": "OK"
  },
  {
    "transaction": 1655199226,
    "guess number": 50,
    "status": "Failed"
  },
  "Aborted"
]

Response code: 200 (OK); Time: 266ms; Content length: 213 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
```
GET http://localhost:80/api/batch/start?links=4

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: text/html; charset=UTF-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:37:04 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 58
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:37:04 GMT; Max-Age=7200; path=/; httponly; samesite=lax

Started,  Args: tries = 100 guessNumber = 50 start = 0 end = 100 links = 4

Response code: 200 (OK); Time: 356ms; Content length: 74 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
```
GET http://localhost:80/api/batch/result

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:35:30 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 56
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:35:30 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 1,
    "batch_id": "968a1c8e-d7ee-4f87-a93c-ca261f8a97fa",
    "progress": 50,
    "jobs": 4,
    "successed": 2,
    "failed": 2,
    "status": [
      "Failed",
      "Batch finished"
    ]
  }
]

Response code: 200 (OK); Time: 231ms; Content length: 145 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
```
GET http://localhost:80/api/batch/result

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 09:34:51 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 57
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=XgrBpMzra7cdk89aU1CRl9WlGr4DzZb9Ueotnuu6; expires=Tue, 14-Jun-2022 11:34:51 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 1,
    "batch_id": "968a1c8e-d7ee-4f87-a93c-ca261f8a97fa",
    "progress": 25,
    "jobs": 4,
    "successed": 1,
    "failed": 0,
    "status": "in process"
  }
]

Response code: 200 (OK); Time: 403ms; Content length: 130 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies

```
```
GET http://localhost:80/api/batch/cancel

HTTP/1.1 200 OK
Server: nginx/1.21.6
Content-Type: application/json
Transfer-Encoding: chunked
Connection: keep-alive
X-Powered-By: PHP/8.0.2
Cache-Control: no-cache, private
Date: Tue, 14 Jun 2022 14:15:57 GMT
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 57
Access-Control-Allow-Origin: *
Set-Cookie: laravel_session=akCaWbhw5CLxrgpsJWfb8MC9MYASZdCEkXMsQWfA; expires=Tue, 14-Jun-2022 16:15:57 GMT; Max-Age=7200; path=/; httponly; samesite=lax

[
  {
    "id": 6,
    "batch_id": "968a8116-3217-40e9-a9ef-c1f3d94588b9",
    "progress": 0,
    "jobs": 4,
    "successed": 0,
    "failed": 0,
    "status": "canceled"
  }
]

Response code: 200 (OK); Time: 430ms; Content length: 127 bytes

Cookies are preserved between requests:
> C:\Users\Alexander\PhpstormProjects\Queue-RESTAPI-number-guesser-with-choice\.idea\httpRequests\http-client.cookies
```
