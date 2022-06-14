### Vocation
The application can help you feel how queue can work. You can select what to put into 
the queue:  
* nothing,
* just jobs,
* chain of jobs or batch of jobs.

Code of the project can help you understand Laravel's contextual binding of service container, 
dependency injection. There is used hierarhy: interface - abstract class - classes. Contextual 
binding binds interface and class depending from one of three controllers.

### Description
Web app runs a queue on the server. Jobs are trying to guess a number by equaling a 
generated randomly number with a number had input. Data to manage a queue has stored
in config or can be inputed through a request, there is used RESTAPI. 
In case of using batch the executing of batch does not stop if some job has failed, it continues,
and app is able to output information by the request about the executing process or cancel the executing.
Having a batch id user are able to rerun the batch using artisan commands.

|             | Queue        | Chain         | Batch         |
|-------------|--------------|---------------|---------------|
| Start       | /queue/start | /chain/start  | /batch/start  |
| See logs    | /logs        | /logs         | /logs         |
| Clear logs  | /logs/clear  | /logs/clear   | /logs/clear   |
| See result  |              | /chain/result | /batch/result |
| See total   | /total       | /total        | /total        |
| Make cancel |              |               | /batch/cancel |

```
GET http://localhost:80/api/queue/start
Accept: application/json

###

GET http://localhost:80/api/queue/logs
Accept: application/json

###

GET http://localhost:80/api/queue/logs/clear
Accept: application/json

###

GET http://localhost:80/api/queue/total
Accept: application/json

###

GET http://localhost:80/api/queue/result
Accept: application/json

###

GET http://localhost:80/api/chain/start
Accept: application/json

###

GET http://localhost:80/api/chain/logs
Accept: application/json

###

GET http://localhost:80/api/chain/logs/clear
Accept: application/json

###

GET http://localhost:80/api/chain/total
Accept: application/json

###

GET http://localhost:80/api/chain/result
Accept: application/json

###
```
