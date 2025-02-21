# Example kubernetes deployment.

This documentation outlines a standard kubernetes deployment for our container.

## Environment variables

The following environment variables are **required** for the container to function correctly:

- **Application settings:**
  - `APP_NAME` - The name of the application (used for emails, UI display, etc.)
  - `APP_ENV` - The environment in which the application is running (e.g., `local`, `production`)
  - `APP_KEY` - The application encryption key (⚠️ must be securely stored, we will be using ESO for secrets management.)
  - `APP_URL` - The base URL of the application

- **Database settings:**
  - `DB_CONNECTION` - The database connection type (e.g., `mysql`, `pgsql`, `sqlite`, `sqlsrv`)
  - `DB_HOST` - The hostname of the database server
  - `DB_PORT` - The port number of the database server
  - `DB_DATABASE` - The name of the database
  - `DB_USERNAME` - The username for the database (⚠️ must be securely stored.)
  - `DB_PASSWORD` - The password for the database (⚠️ must be securely stored.)

- **Session & Cache settings:**
  - `SESSION_DRIVER` - The session storage driver (e.g., `file`, `database`, `redis`)
  - `CACHE_STORE` - The cache storage driver (e.g., `file`, `database`, `redis`)
  - `QUEUE_CONNECTION` - The queue connection type (e.g., `sync`, `database`, `redis`)

The following environment variables are **optional** and will be defaulted to:

- **Application settings:**
  - `APP_DEBUG` - Whether debugging mode is enabled (`true` or `false`, default: `false` in production)
  - `APP_TIMEZONE` - The default timezone (default: `UTC`)
  - `APP_LOCALE` - The default application locale (default: `en`)
  - `APP_FALLBACK_LOCALE` - The fallback locale if the primary locale is unavailable (default: `en`)
  - `APP_FAKER_LOCALE` - The locale for Faker-generated test data (default: `en_US`)

- **Logging settings:**
  - `LOG_CHANNEL` - The primary log channel (default: `stack`)
  - `LOG_STACK` - Log stack driver (default: `single`)
  - `LOG_DEPRECATIONS_CHANNEL` - Log channel for deprecation warnings (default: `null`)
  - `LOG_LEVEL` - Log verbosity level (default: `debug`)

- **Session settings:**
  - `SESSION_LIFETIME` - The session expiration time in minutes (default: `120`)
  - `SESSION_ENCRYPT` - Whether session data should be encrypted (`true` or `false`, default: `false`)
  - `SESSION_PATH` - The session cookie path (default: `/`)
  - `SESSION_DOMAIN` - The session cookie domain (default: `null`)

- **Broadcasting, Filesystem, & Queue settings:**
  - `BROADCAST_CONNECTION` - The broadcast driver (default: `log`)
  - `FILESYSTEM_DISK` - The filesystem storage driver (default: `local`)

- **Memcached settings:**
  - `MEMCACHED_HOST` - The host address for Memcached (default: `127.0.0.1`)

- **Redis settings:**
  - `REDIS_CLIENT` - The Redis driver (default: `phpredis`)
  - `REDIS_HOST` - The Redis server host (default: `127.0.0.1`)
  - `REDIS_PASSWORD` - The Redis server password (default: `null`)
  - `REDIS_PORT` - The Redis server port (default: `6379`)

- **Mail settings:**
  - `MAIL_MAILER` - The mail transport driver (default: `log`)
  - `MAIL_HOST` - The mail server host (default: `127.0.0.1`)
  - `MAIL_PORT` - The mail server port (default: `2525`)
  - `MAIL_USERNAME` - The mail server username (default: `null`)
  - `MAIL_PASSWORD` - The mail server password (default: `null`)
  - `MAIL_ENCRYPTION` - The mail encryption method (`ssl`, `tls`, `null`)
  - `MAIL_FROM_ADDRESS` - The sender's email address (default: `"hello@example.com"`)
  - `MAIL_FROM_NAME` - The sender's name (default: `"${APP_NAME}"`)

- **AWS settings (optional unless using AWS services):**
  - `AWS_ACCESS_KEY_ID` - AWS Access Key ID
  - `AWS_SECRET_ACCESS_KEY` - AWS Secret Access Key
  - `AWS_DEFAULT_REGION` - AWS region (default: `us-east-1`)
  - `AWS_BUCKET` - AWS S3 bucket name
  - `AWS_USE_PATH_STYLE_ENDPOINT` - Whether to use path-style URLs for S3 (default: `false`)

- **Vite settings:**
  - `VITE_APP_NAME` - The application name for Vite (default: `${APP_NAME}`)

- **Miscellaneous:**
  - `PHP_CLI_SERVER_WORKERS` - Number of PHP CLI server workers (default: `4`)
  - `BCRYPT_ROUNDS` - Number of bcrypt hashing rounds (default: `12`)
  - `APP_MAINTENANCE_DRIVER` - The maintenance mode driver (default: `file`)
  - `APP_MAINTENANCE_STORE` - The maintenance mode storage driver (optional)

## Kubernetes Resources

**TODO** 
- maybe use kustomize structure? 
- Add external Secrets Example.