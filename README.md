# cicd-wordpress

## web admin

http://cicd-wordpress.herokuapp.com/wp-admin/

ID: admin  
Pass: Test@123$

## Do test plugin

### Prerequisites
- [WP-CLI](http://wp-cli.org/#installing)
- [SVN](https://tortoisesvn.net/downloads.html) supports command line svn
- `MySQL` supports command line `mysqladmin`

### Install unit test
Create necessary files for testing:
```
wp scaffold plugin-tests PLUGIN_NAME
```

Create database test:
```
bash bin/install-wp-tests.sh wordpress_test root '123456' localhost latest
```

Explain the parameters:
- `wordpress_test`: database name
- `root`: database username
- `123456`: database password, it can be empty
- `localhost`: database host
- `latest`: wordpress version