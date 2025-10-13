Setting Up Nginx for the Personal Website
=========================================

The infrastructure of this site uses Nginx to reverse proxy incoming HTTP
requests to a running Docker container for the personal website.

This configuration works in conjunction with a blue/green deployment
strategy, where two different versions of the app are available on two
distinct ports, and Nginx is responsible for routing production traffic
to one of them at a time.

How It Works
------------

- The [Nginx config file](./personal_website.nginx.conf) defines an `upstream`
  block that maps to a specific version of the application, typically
  running on port `9001` (blue) or `9002` (green).

- Jenkins updates this config file to switch between versions after the
  new container passes a health check.

- Nginx is reloaded to apply the change, causing traffic to be rerouted
  immediately with no downtime.

What to Edit in the Nginx Config File
-------------------------------------

The Nginx config file at
[./personal_website.nginx.conf](./personal_website.nginx.conf)
is a template and needs to be adjusted before being used.

- Line 3:

  ```nginx
  server 127.0.0.1:9001;
  ```

   Change this to point to the port of the currently active container (e.g. 9002 if deploying green).

- Line 7:

    ```
    server_name personal.example.com;
    ```

    Replace personal.example.com with the domain or IP address of the server.

Where to Put the Nginx Config File
----------------------------------

Copy the **edited** config file into Nginx's sites-available directory:

```bash
sudo cp personal_website.nginx.conf /etc/nginx/sites-available/personal_website
```

Then enable it by symlinking it to sites-enabled:

```bash
sudo ln -s /etc/nginx/sites-available/personal_website /etc/nginx/sites-enabled/
```

Reload Nginx to apply the new configuration:

```bash
sudo nginx -t && sudo systemctl reload nginx
```

Integration with Jenkins
------------------------

In the Jenkins pipeline, you must set the environment variable:

```
NGINX_SITE_CONFIG_PATH=/etc/nginx/sites-available/personal_website
```

where `/etc/nginx/sites-available/personal_website` is the location OF the edited configuration file.

This allows Jenkins to find the file and perform the necessary operations to switch between blue/green when deploying.

### Security & Permissions

Ensure Jenkins has permission to:

- Edit the config file (something like `/etc/nginx/sites-available/personal_website`)

- Reload Nginx via `nginx -s reload`

You can configure `/etc/sudoers` to allow this without a password:

```
jenkins ALL=(ALL) NOPASSWD: /bin/sed -i * /etc/nginx/sites-available/personal_website, /usr/sbin/nginx -t, /usr/sbin/nginx -s reload
```
