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

|             | Queue        | Chain         | Batch         |
|-------------|--------------|---------------|---------------|
| Start       | /queue/start | /chain/start  | /batch/start  |
| See logs    | /logs        | /logs         | /logs         |
| Clear logs  | /logs/clear  | /logs/clear   | /logs/clear   |
| See result  |              | /chain/result | /batch/result |
| See total   | /total       | /total        | /total        |
| Make cancel |              |               | /batch/cancel |

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
# Possible start instructions:
## Up the services
```
docker-compose up --build -d
```

## Go to the container
```
docker exec -it queue-restapi-number-guesser-with-choice-app-1 bash
```

## Run inside the container
```
php artisan migrate  
cp .env.example .env
```

## Down services if you are exit
```
docker-compose down
```
## Posible endpoints:  
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

