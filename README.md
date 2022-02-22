### Installing Docker 
* Follow [the official guide](https://www.docker.com/ ) to install Docker

### Configuring the application

* Install image traefik
```sh
version: "3"
services:
  traefik:
    image: traefik:1.7
    container_name: traefik
    command:
      - --api
      - --docker
      - --docker.exposedbydefault=false
    restart: always
    ports:
      - 80:80
      - 8080:8080
    networks:
      - proxy
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
networks:
  proxy:
    external: true
```

* Run docker

```sh
$ docker-compose up -d
```
* run ```composer install```
* copy the .env.overseahr file to .env
* run ```php artisan key:generate``` to set APP_KEY