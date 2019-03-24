development-setup-env:
	ansible-playbook ansible/development.yml -i ansible/development -vv --ask-vault-pass
	docker-compose run --user=$(USER) app php artisan key:generate
