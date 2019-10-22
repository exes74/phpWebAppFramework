# phpWebAppFramework
Light PHP MVC Framework to develop lightweight PHP application

Inspired and forked from https://github.com/bpesquet/Framework-MVC

--1/ SQL -- Used MARIADB but any DB can be used through the adaptation of the "config/prodApp.ini" file.
SQL file for the creation of the DB:
An admin user must be created in order to be able to log in as administrator in the webApp (example here Admin/Azerty123):

INSERT INTO `application`.`user` (`id`, `username`, `password`, `activated`, `is_admin`, `create_time`) VALUES (NULL, 'Admin', '$2y$10$x4SjfxKogs88VHhIARK1veSaeE4xXOp22Ly2x/f7hUlq0.g/Qe0dW', '1', '1', '2019-02-11 14:07:29')


--2/ WebServer - Configuration Sample based on NGINX / PHP-FPM 

server {
        listen 80;
        server_name WWW.SERVER.COM; // To be changed
        return 301 https://$server_name$request_uri; // Redirection to HTTPS
}

server {
        listen 443 ssl http2;
        server_name WWW.SERVER.COM; // To be changed
        root /var/www/;

        location ~ \.php$ {
                fastcgi_index index.php;
                fastcgi_pass 127.0.0.1:9000;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include /etc/nginx/fastcgi_params;
        }
                location /webapp/ {
                alias /var/www/webapp/;
                rewrite ^/webapp/([a-zA-Z]*)/?([a-zA-Z]*)?/?([a-zA-Z0-9\-]*)?/?$ /webapp/index.php?controleur=$1&a$
                index   index.php;
        }


 ## Certificates
 ssl_certificate /etc/nginx/ssl/s2emetcqsc01r.orion.s2e-net.com.crt;
 ssl_certificate_key /etc/nginx/ssl/s2emetcqsc01r.orion.s2e-net.com.key;


 ## Protocol
 ssl_protocols TLSv1.2;

 ## Diffie-Hellman
 ssl_ecdh_curve secp384r1;

 ## Ciphers
 ssl_ciphers EECDH+CHACHA20:EECDH+AESGCM:EECDH+AES;
 ssl_prefer_server_ciphers on;

 ## TLS parameters
 ssl_session_cache shared:SSL:10m;
 ssl_session_timeout 5m;
 ssl_session_tickets off;

 ## TLS parameters
 ssl_session_cache shared:SSL:10m;
 ssl_session_timeout 5m;
 ssl_session_tickets off;

}
