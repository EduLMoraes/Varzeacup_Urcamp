FROM postgres

COPY ./database/varzea.sql /docker-entrypoint-initdb.d/

RUN chmod 0444 /docker-entrypoint-initdb.d/varzea.sql
EXPOSE 5432