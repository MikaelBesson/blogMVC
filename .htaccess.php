RewriteEngine On

rewriteCond %{REQUEST_FILENAME} !-f
rewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php?url=$1
