<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="edgeforge Logo"></a></p>

# Laravel 11 - Base Container

**TODO: Change naming to laravel base and release as base config for new projects**

This project aims to provide a base container for laravel development. We have created a light weight container using **Alpine Linux**, in this container we have setup laraval with filament. Jetstream is used as the authentication plugin. Authentication from filament has been disabled.

# Architecture

- Initial laravel 11 setup
- container creation / pipeline automation

## Deploy created image via docker compose

Docker compose is the default way to use this container. The [compose file](./website/docker-compose.yaml) can be found in the [app root](./website). Just run it and verify functionality at ``http://localhost:8080``

## Deploy created image via kubernetes

in the [manifestdir](manifests/) is an example of deploying this container via kubernetes.
