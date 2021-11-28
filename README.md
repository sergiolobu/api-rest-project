# api-rest-project

START PROJECT:
- sudo make init (init the project)
- sudo make run-test (run test)

<h1><i>Endpoints</i></h1>

User:
    
- http://localhost:8001/api/user/{id} (GET) -> get user by id
- http://localhost:8001/api/users/ (GET) -> get all user
- http://localhost:8001/api/user (POST) -> create user by id
- http://localhost:8001/api/user/{id} (PUT) -> update user by id
- http://localhost:8001/api/user/{id} (DELETE) -> delete user by id

WorkEntry:

- http://localhost:8001/api/workentry/{id} (GET) -> get workentry by id
- http://localhost:8001/api/workentry/user/{id} (GET) -> get workentry by user
- http://localhost:8001/api/workentry (POST) -> create user by id
- http://localhost:8001/api/workentry/{id} (PUT) -> update user by id
- http://localhost:8001/api/workentry/{id} (DELETE) -> delete user by id