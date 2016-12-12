# PHP Encrypt

[![Build Status](https://travis-ci.org/jdmaymeow/php-encrypt.svg?branch=master)](https://travis-ci.org/jdmaymeow/php-encrypt)

Certification authority management script

## Installation

### Prerequisities

* PHP with openssl extension (PHP 5.5 and higher)
* PHP mb-string extension
* Composer to install

### From GitHub mirror

Installation from public GitHub repository

```bash
git clone https://github.com/jdmaymeow/php-encrypt
cd php-encrypt
composer install
```

### With composer (for developers)

If you are familiar with composer, you can install latest stable version with composer too.

```bash
composer create-project jdmaymeow/php-encrypt
```

There are both versions and you have to be a developer.

## Configuration

Default configuration file is located in

```bash
config/encrypt.yml
```

Default configuration per each certificate type looks like

```yaml
certificates:
  ca:
    daysvalid: 7000
    x509_extensions: v3_ca
  intermediate:
    daysvalid: 3650
    x509_extensions: v3_intermediate_ca
```

You can add new configuration if you want anther certificate type

## Usage

With this script you can sign certificates for CA, Intermediate CA, users and servers. Before you can do this
you will need create your CA and Intermediate CA certificates

### Creating CA

Example to create CA

```bash
php index.php bf:ca DesiredNameCa --CN="My CA" --C=SK --O="My Organization ltd."
```
### Creating Intermediate CA

To sign certificates you will need Intermediate CA certificate. Here is example:

```bash
php index.php bf:intermediatesign DesiredNameCa --CN="My Intermediate CA" --C=SK --O="My Organization ltd." --CA=DesiredNameCa
```

* DesiredNameCa must be same as name of your certification authority.
* in ```--ca=...```  you will specify which CA you want use to sign certificate is the  same as DesiredNameCa

### Signing Certificates

#### User certificates

```bash
php index.php bf:usersign jane-doe --CN="Jane Doe" --C=SK --E=jane@doe.local --CA=MyCA
```

Script will use intermediate.cert and key from MyCa folder.Certificates

If you need override certificate validity you can do it with option ```--validity``` and add your lenght (in days).  Example:

```bash
php index.php bf:usersign jane-doe --CN="Jane Doe" --C=SK --E=jane@doe.local --validity=30 --CA=MyCA
```

#### Server Certificates

Before you can sign server certificate go to ```config/intermediate.cnf``` and add to end of this file

```
[ alt_names ]
# To add domaind add DNS.1, DNS.2 ...
# for multi domain add DNS.1=domain.tld and DNS.2=*.domain.tld
DNS.1 = www.somewhere.com

# If you want add IP addresses add IP.1, Ip.2 ...
# IP.1=127.0.0.1
```

now you can sign certificate with

```bash
php index.php bf:serversign my-server --CN="www.domain.tld" --C=SK --CA=MyCA
```

Override certificate validity in days (same as in users certificates)

```bash
php index.php bf:serversign my-server --CN="www.domain.tld" --C=SK --validity=30 --CA=MyCA
```

## Running as CLI globally from system

If you want to run your script globally over the system is importatn to change configuration to read current working directory
instead of parrent directory where is script installed. Go to ```config/app.php``` and change following line as on example:

```bash
define('WWW_ROOT', ROOT . DS . 'webroot' . DS);

//change to
define('WWW_ROOT', CLI_ROOT . DS . 'webroot' . DS);
```

Script will now create webroot folder and all certificates i your working directory.

### Windows

To run script anywhere from windows create Path to forlder which is containing ```php-encrypt.bat``` with this content:

```batch
@php "%~dp0path-to-php-encrypt-folder\index.php" %*
```
### Linux

TODO comming soon

## Backup

All you need is backup ```webroot``` folder where are stored all certificates  and your config files ``` *.cnf encrypt.yml``` if
you have changed them.

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

TODO: Write history

## Credits

 * May Meow
 * BlackFriday  community on GitlabCafe

## License

MIT
