# Deployment Guide - Raah-e-Haq Admin Panel

## 🚀 Production Deployment

### Server Requirements
- PHP 8.2 or higher
- MySQL 5.7 or higher
- Nginx/Apache web server
- SSL certificate (recommended)
- Composer
- Node.js & NPM

### 1. Server Setup

#### Install PHP and Extensions
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-bcmath

# CentOS/RHEL
sudo yum install php82 php82-cli php82-fpm php82-mysql php82-xml php82-mbstring php82-curl php82-zip php82-bcmath
```

#### Install Composer
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

#### Install Node.js
```bash
# Using NodeSource repository
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt-get install -y nodejs
```

### 2. Application Deployment

#### Clone and Setup
```bash
# Clone repository
git clone <repository-url> /var/www/raah-e-haq-admin
cd /var/www/raah-e-haq-admin

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Set permissions
sudo chown -R www-data:www-data /var/www/raah-e-haq-admin
sudo chmod -R 755 /var/www/raah-e-haq-admin
sudo chmod -R 775 /var/www/raah-e-haq-admin/storage
sudo chmod -R 775 /var/www/raah-e-haq-admin/bootstrap/cache
```

#### Environment Configuration
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database
# Edit .env file with production database credentials
nano .env
```

#### Database Setup
```bash
# Run migrations
php artisan migrate --force

# Seed database
php artisan db:seed --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Web Server Configuration

#### Nginx Configuration
```nginx
server {
    listen 80;
    listen 443 ssl http2;
    server_name your-domain.com;
    root /var/www/raah-e-haq-admin/public;

    # SSL Configuration
    ssl_certificate /path/to/your/certificate.crt;
    ssl_certificate_key /path/to/your/private.key;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

#### Apache Configuration
```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot /var/www/raah-e-haq-admin/public

    <Directory /var/www/raah-e-haq-admin/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/raah-e-haq-admin_error.log
    CustomLog ${APACHE_LOG_DIR}/raah-e-haq-admin_access.log combined
</VirtualHost>
```

### 4. Security Configuration

#### Firewall Setup
```bash
# UFW (Ubuntu)
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable

# Firewalld (CentOS)
sudo firewall-cmd --permanent --add-service=ssh
sudo firewall-cmd --permanent --add-service=http
sudo firewall-cmd --permanent --add-service=https
sudo firewall-cmd --reload
```

#### File Permissions
```bash
# Set proper permissions
sudo chown -R www-data:www-data /var/www/raah-e-haq-admin
sudo find /var/www/raah-e-haq-admin -type f -exec chmod 644 {} \;
sudo find /var/www/raah-e-haq-admin -type d -exec chmod 755 {} \;
sudo chmod -R 775 /var/www/raah-e-haq-admin/storage
sudo chmod -R 775 /var/www/raah-e-haq-admin/bootstrap/cache
```

### 5. SSL Certificate (Let's Encrypt)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Obtain SSL certificate
sudo certbot --nginx -d your-domain.com

# Auto-renewal
sudo crontab -e
# Add: 0 12 * * * /usr/bin/certbot renew --quiet
```

### 6. Performance Optimization

#### PHP-FPM Configuration
```ini
# /etc/php/8.2/fpm/pool.d/www.conf
pm = dynamic
pm.max_children = 50
pm.start_servers = 5
pm.min_spare_servers = 5
pm.max_spare_servers = 35
pm.max_requests = 500
```

#### Laravel Optimization
```bash
# Production optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Queue worker (if using queues)
php artisan queue:work --daemon
```

### 7. Monitoring and Logs

#### Log Rotation
```bash
# Configure logrotate
sudo nano /etc/logrotate.d/raah-e-haq-admin

# Add:
/var/www/raah-e-haq-admin/storage/logs/*.log {
    daily
    missingok
    rotate 14
    compress
    notifempty
    create 644 www-data www-data
}
```

#### Health Check
```bash
# Create health check script
sudo nano /usr/local/bin/health-check.sh

#!/bin/bash
curl -f http://localhost/up || exit 1
```

### 8. Backup Strategy

#### Database Backup
```bash
# Create backup script
sudo nano /usr/local/bin/backup-db.sh

#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u username -p database_name > /backup/raah-e-haq-admin_$DATE.sql
find /backup -name "raah-e-haq-admin_*.sql" -mtime +7 -delete
```

#### File Backup
```bash
# Create file backup script
sudo nano /usr/local/bin/backup-files.sh

#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
tar -czf /backup/raah-e-haq-admin-files_$DATE.tar.gz /var/www/raah-e-haq-admin
find /backup -name "raah-e-haq-admin-files_*.tar.gz" -mtime +7 -delete
```

### 9. Deployment Checklist

- [ ] Server requirements met
- [ ] Application deployed
- [ ] Database configured and migrated
- [ ] Environment variables set
- [ ] Web server configured
- [ ] SSL certificate installed
- [ ] Firewall configured
- [ ] File permissions set
- [ ] Performance optimizations applied
- [ ] Monitoring configured
- [ ] Backup strategy implemented
- [ ] Health checks working
- [ ] Admin users created
- [ ] Application tested

### 10. Post-Deployment

#### Test Admin Access
1. Visit `https://your-domain.com/admin`
2. Login with admin credentials
3. Test all admin panel features
4. Verify user management functionality

#### Performance Testing
```bash
# Test response times
curl -w "@curl-format.txt" -o /dev/null -s "https://your-domain.com/admin"

# Load testing (optional)
ab -n 1000 -c 10 https://your-domain.com/admin
```

### 11. Maintenance

#### Regular Updates
```bash
# Update dependencies
composer update
npm update

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### Monitoring
- Check application logs regularly
- Monitor server resources
- Review security logs
- Update SSL certificates
- Test backup restoration

---

**Note**: This deployment guide assumes a standard Linux server setup. Adjust commands and paths according to your specific server configuration.
