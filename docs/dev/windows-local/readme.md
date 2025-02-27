## Windows Local Dev environment

### Install dependencies

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Composer](https://getcomposer.org/download/)
- [php](https://www.php.net/downloads)
- [Node.js](https://nodejs.org/en/download/)

### Install using chocolatey

```powershell
choco install php composer docker-desktop nodejs
```

## Install php dependencies with composer

> [!IMPORTANT]
> Be sure to run the composer commands inside the ``website/`` folder.

if you want to run **artisan** commands locally you'll need to install the php dependencies with **composer** as they are not included in the git repo but generated while creating the container.  

we'll be running the following command to install the dependencies:

```shell
composer update --ignore-platform-reqs
```

afterward, you will be able to use the **artisan** commands locally while in the ``website/`` directory.