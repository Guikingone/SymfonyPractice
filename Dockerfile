FROM composer
FROM php:fpm-alpine3.7

ENV WORKPATH "/var/www/skeleton"

RUN set -xe \
          	&& apk add --no-cache --virtual .build-deps \
          		$PHPIZE_DEPS \
          		icu-dev \
          		postgresql-dev \
          		zlib-dev \
          		gnupg \
          		graphviz \
          		make \
          	&& docker-php-ext-install \
          		intl \
          		pdo_pgsql \
          		zip \
          	&& pecl install apcu \
                   && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
                   && docker-php-ext-install pdo_mysql opcache json pdo_pgsql pgsql mysqli \
                   && docker-php-ext-enable apcu mysqli \
          	&& runDeps="$( \
          		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
          			| tr ',' '\n' \
          			| sort -u \
          			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
          	)" \
          	&& apk add --no-cache --virtual .php-phpexts-rundeps $runDeps \
          	&& apk del .build-deps

COPY docker/php/conf/php.ini /usr/local/etc/php/php.ini

# Composer
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=0 /usr/bin/composer /usr/bin/composer

RUN mkdir -p ${WORKPATH}

RUN rm -rf ${WORKDIR}/vendor \
    && ls -l ${WORKDIR}

RUN mkdir -p \
		${WORKDIR}/var/cache \
		${WORKDIR}/var/logs \
		${WORKDIR}/var/sessions \
	&& chown -R www-data ${WORKDIR}/var \
	&& chown -R www-data /tmp/

RUN chown www-data:www-data -R ${WORKPATH}

WORKDIR ${WORKPATH}

COPY . ./

EXPOSE 9000

CMD ["php-fpm"]
