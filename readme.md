<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="edgeforge Logo"></a></p>


# Laravel 11 - Base Container

Welcome to the **Laravel 11 Base Container** project! This open-source initiative provides a lightweight and fully functional containerized environment for Laravel development. Built on **Alpine Linux**, this container includes Laravel preconfigured with **Filament** and **Jetstream** for authentication. Notably, Filament authentication has been disabled to streamline the setup.

## Features

- **Lightweight and optimized** – Runs on Alpine Linux for minimal resource usage.
- **Preconfigured stack** – Laravel 11 with Filament and Jetstream.
- **Authentication setup** – Jetstream enabled, Filament authentication disabled.
- **Multiple deployment options** – Supports **Docker Compose** and **Kubernetes**.
- **Pipeline automation** – Streamlined container creation and automation.

## Architecture

This project is structured with modularity and flexibility in mind. Key components include:

- **Laravel 11 Setup** – Refer to [laravel setup](docs/readme.md#laravel-setup) for installation details.
- **Filament Setup** - Refer to [filament setup](docs/readme.md#filament) for installation details
- **Container Creation & Pipeline Automation** – Automates the build and deployment process.

## Deployment Options

### Deploy via Docker Compose

The default way to use this container is through Docker Compose. The required configuration can be found in the [compose file](./website/docker-compose.yaml) located in the [app root](./website). To deploy, simply run:

```sh
docker-compose up -d
```

Once deployed, verify functionality by visiting [`http://localhost:8080`](http://localhost:8080).

### Deploy via Kubernetes

For Kubernetes deployments, example manifests are available in the [`manifests/`](./manifests/) directory. Apply them using:

```sh
kubectl apply -f manifests/
```

This will provision the container within your Kubernetes cluster.

## Get Involved

Contributions are welcome! Feel free to submit issues, open pull requests, or suggest improvements to enhance this project further.

<!-- # Laravel 11 - Base Container


This project aims to provide a base container for laravel development. We have created a light weight container using **Alpine Linux**, in this container we have setup laraval with filament. Jetstream is used as the authentication plugin. Authentication from filament has been disabled.

# Architecture

- Initial laravel 11 setup todo write some info and refere to docs/initial-setup
- container creation / pipeline automation

## Deploy via docker compose

Docker compose is the default way to use this container. The [compose file](./website/docker-compose.yaml) can be found in the [app root](./website). Just run it and verify functionality at ``http://localhost:8080``

## Deploy via kubernetes

in the [manifestdir](manifests/) is an example of deploying this container via kubernetes. -->