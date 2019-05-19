FROM php:7.2-cli

ENV VERSION 7.2_5.3

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN apt update && apt install -y lua5.3 liblua5.3-0 liblua5.3-dev
RUN ln -s /usr/bin/lua5.3 /usr/bin/lua
RUN ln -s /usr/bin/luac5.3 /usr/bin/luac
RUN cp /usr/include/lua5.3/*.h /usr/include/
RUN cp /usr/lib/x86_64-linux-gnu/liblua5.3.a /usr/lib/liblua.a
RUN cp /usr/lib/x86_64-linux-gnu/liblua5.3.so /usr/lib/liblua.so
RUN pecl install lua
RUN echo "extension=lua.so" > /usr/local/etc/php/conf.d/lua.ini
RUN cp /usr/local/lib/php/build/run-tests.php /usr/local/bin/run-tests.php
RUN chmod 755 /usr/local/bin/run-tests.php
ENV TEST_PHP_EXECUTABLE /usr/local/bin/php
