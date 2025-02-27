# Laravel Base Container

**TODO: Change naming to laravel base and release as base config for new projects**

This project aims to provide a base container for laravel development. We have created a light weight container using **Alpine Linux**, in this container we have setup laraval with filament. Jetstream is used as the authentication plugin. Authentication from filament has been disabled.

# Architecture


## Deploy created image via docker compose

Docker compose is the default way to use this container. The [compose file](./website/docker-compose.yaml) can be found in the [app root](./website). Just run it and verify functionality at ``http://localhost:8080``

## Deploy created image via kubernetes

under manifests/ there is a ful deploy.yml, this has all the manifests needed to make the app, PV still needs to be added but all the rest is there.
