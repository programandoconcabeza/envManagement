
# ENV MANAGEMENT

You can manage .env files in a secure way, the env management package manages them generically, so that all team members have the same type of configuration.
## Installation

Install the last version of env management with composer install

```bash
  composer require programandoconcabeza/env-management
```

## Usage/Examples

Is mandatory use always the same password used for crypt it for decrypt files.

### Crypt and create zip
Create a zip file with the general environments system variables named `environments.zip` and put it in the root of the project.

We recommend that you create a makefile or an automation for the execution of this script

```php
php vendor/programandoconcabeza/env-management/crypt.php
```

### Decrypt and replace .env file
The script get the content of `environments.zip` file and replace the .env content file.

We recommend that you create a makefile or an automation for the execution of this script

```php
php vendor/programandoconcabeza/env-management/decrypt.php
```

## Support

For support, email programandoconcabeza@gmail.com.

