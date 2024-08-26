Notes on Apache Virtual Hosts for Personal Website
==================================================

The file [./apache-vhost.conf](./apache-vhost.conf) is used to ensure the
correct configuration for Apache in the app's Docker container.

The file does the following:

- Specifies a virtual host to listen for all IP addresses on port 80.

- Sets the document root to `/var/www/html/` (note that the
  [Dockerfile](../Dockerfile) copies the website's files to this location in the
  container).

- Allows directives to be overridden by the [.htaccess](../.htaccess) file (this
  is done by the `AllowOverride All` option).

- Specifies log file locations.

In the [Dockerfile](../Dockerfile), the line

```
COPY apache/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
```

copies this virtual host configuration file in the location
`/etc/apache2/sites-available/000-default.conf`, thus overriding the default
configuration and forcing the custom configuration will be used.
