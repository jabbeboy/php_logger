# PHP-Logger
## A persistent log-system

The log-system was built with the help of the following log library.
https://github.com/dntoll/phpLoggerLib

### Screenshots
[Screenshot 1](Screenshot1.png)
[Screenshot 2](Screenshot2.png)



### Tasks
:ballot_box_with_check: 1. Add a persistent storage to store messages on the server for the following log library.

:ballot_box_with_check: 2. Add a log manager (controller) to a log library that allows a site administrator to view, and navigate to code log traces.

### Use Cases

:ballot_box_with_check: UC0. Add a log item
* Programmer wants to add a log message to the code
* System presents a simple interface for logging
* Programmer uses a method in the interface to log a message.
* System stores the message in a log item each time the method is called.

:ballot_box_with_check: UC1. View all ip-addresses
* Administrator wants to see all logs by ip-address
* System presents a list of ip-addresses and how many sessions each ip-address has had sorted by time of last trace for that IP-address.

:ballot_box_with_check: UC2. View all sessions from an ip-address
* Administrator wants to see all HTTP-sessions from an ip-address.

:ballot_box_with_check: UC1.
* Administrator selects an IP-address from the list
* System presents all recorded sessions from that log-trace ordered by time

:ballot_box_with_check: UC3. View all traces from a session
* Administrator wants to see all traces from a specific session.
* UC2.
* Administrator selects a session from the list
* System presents a list of all log items in each requests in that session ordered by time


Admin is the only authorized user that should be able to log in, therefor there is no registration system. 
