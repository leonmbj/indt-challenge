sudo apt -y install php7.0 php7.0-bcmath php7.0-bz2 php7.0-cgi php7.0-cli php7.0-common php7.0-curl php7.0-enchant php7.0-gd php7.0-imap php7.0-interbase php7.0-intl php7.0-json php7.0-ldap php7.0-mbstring php7.0-mcrypt php7.0-mysql php7.0-odbc php7.0-pgsql php7.0-pspell php7.0-readline php7.0-recode php7.0-soap php7.0-sqlite3 php7.0-sybase php7.0-tidy php7.0-xml php7.0-xsl php7.0-zip apache2 apache2-dev apache2-utils libapache2-mod-php7.0 git composer curl nodejs npm

git clone https://github.com/leonmbj/indt-challenge.git

cd indt-challenge

composer install

php artisan serve
