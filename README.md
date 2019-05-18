PHP-LUA integrated docker image
========================

The docker image provides official [PHP](https://hub.docker.com/_/php) image with integrated [LUA](https://www.lua.org) interpreter and installed [lua](https://www.php.net/manual/ru/book.lua.php) library.

# Build
To build image
```bash
docker build -t php-lua .
```

# Run
To run interactive shell
```bash
docker run -it --rm -v $(pwd):/repo php-lua bash
```