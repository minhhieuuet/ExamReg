ExamReg project

Comes with:
- web-app: `Laravel/PHP-7.2`
- web-server: `Nginx:alpine`
- database: `Mysql-5.7.22`

## Installatioin
- `sudo make docker-start`
- `sudo make docker-init`
- `sudo make watch`

Now that all containers are up, we can add `127.0.0.1 project.local` to our `/etc/hosts` file

Now you can access `project.local` on your favorite browser

<b>If you got any error, attempt to run </b> `make docker-init` <b>again</b>
<br>
Login information: admin / 123456
