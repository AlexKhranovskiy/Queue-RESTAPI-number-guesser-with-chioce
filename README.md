### Vocation
The application can help you feel how queue can work. You can select what to put into 
the queue:  
* nothing,just jobs,
* chain of jobs,
* batch of jobs.

Code of the project can help you understand Laravel's contextual binding of service container, 
dependency injection, how to realize polymorphism conception. There is used hierarchy: interface - abstract class - classes. Contextual 
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
* Total is detailed infromation of finished queue's work.
