#
# Makefile
#

up: init install

init:
	php bin/console doctrine:database:create
	php bin/console doctrine:schema:create
	php bin/console doctrine:fixtures:load -n

# Install
install: update-bin install-composer
install-composer: bin/composer
	cp app/config/parameters.yml.dist app/config/parameters.yml
	./bin/composer install --no-interaction -o


# Binaries
bin/composer:
	curl -sS https://getcomposer.org/installer | php -- --install-dir=bin --filename=composer
	chmod +x bin/composer || /bin/true
update-bin: bin/composer
	./bin/composer self-update


# Tests
test:
	./vendor/bin/phpunit
test-coverage:
	./vendor/bin/phpunit --coverage-html var/coverage