ExamReg project

Comes with:
- web-app: `Laravel/PHP-7.2`
- web-server: `Nginx:alpine`
- database: `Mysql-5.7.22`

## Installatioin
- `make docker-start`
- `make docker-init`

Now that all containers are up, we can add `127.0.0.1 project.local` to our `/etc/hosts` file

Now you can access `project.local` on your favorite browser
