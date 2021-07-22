# Weather App

docker-compose build

docker-compose up - start the application

docker-compose down - stop the application

<h3> General app description </h3>

This is a simple weather application prototype that makes use of several Docker services through containers. The services stack can be entirely visualised in /docker_compose.yml file.
- admin: contains the administrator privileged methods (only the adding users command)
- server: contains some basic server backend operations
  - register
  - login
  - some queries on weather data in the database (get weather conditions, show weather history, show weather predictions, etc)
- db: contains the SQL database stored on a Docker volume
- website: the engine that assembles the user interface (frontend) and the server logic (backend)
- adminer
- grafana: only for testing; monitoring the evolution (over time) of some weather conditions

The server logic is written in Python and the frontend is written in PHP.
