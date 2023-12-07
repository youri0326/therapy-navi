FROM mariadb:10.5

COPY ./initdb.d/init.sql /docker-entrypoint-initdb.d
COPY ./config/my.cnf /etc/mysql/conf.d/my.cnf

CMD chmod 644 /etc/mysql/conf.d/my.cnf