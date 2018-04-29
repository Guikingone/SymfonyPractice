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

# Blackfire (Docker approach) & Blackfire Player
RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/alpine/amd64/$version \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp \
    && mv /tmp/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && mkdir -p /tmp/blackfire \
    && curl -A "Docker" -L https://blackfire.io/api/v1/releases/client/linux_static/amd64 | tar zxp -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire /usr/bin/blackfire \
    && rm -Rf /tmp/blackfire \
    && curl -OLsS http://get.blackfire.io/blackfire-player.phar \
    && chmod +x blackfire-player.phar \
    && mv blackfire-player.phar /usr/local/bin/blackfire-player

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
