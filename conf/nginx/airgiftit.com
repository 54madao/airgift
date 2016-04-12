server {
    listen 80;
    server_name airgiftit.techcliks.com www.airgiftit.techcliks.com;
    root /home/dev/airgiftit/public/;

    index index.html index.php;  ## Set the index for site to use ##

    ssl_certificate /home/dev/airgiftit/conf/Certs/nginx.crt;
    ssl_certificate_key /home/dev/airgiftit/conf/Certs/nginx.key;

    charset utf-8; ## Set the charset ##
    access_log /var/log/nginx/airgiftit.com-access.log;
    error_log  /var/log/nginx/airgiftit.com-error.log error;

    location = /favicon.ico { log_not_found off; access_log off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    location / {
        try_files $uri $uri/ /index.php?query_string;
    }

    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $request_filename;
        fastcgi_pass unix:/var/run/php5-fpm.sock;
    }

    ## Don't allow access to .ht files ##
    location ~ /\.ht {
        deny all;
    }
}
