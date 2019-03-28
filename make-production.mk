U := root

production-setup:
	ansible-playbook ansible/site.yml -i ansible/production -u $U --ask-vault-pass
	docker-compose run --user=$(USER) app php artisan key:generate

production-setup-env:
	ansible-playbook ansible/production.yml -i ansible/production -u $U --ask-vault-pass

production-deploy:
	ansible-playbook ansible/deploy.yml -i ansible/production -u $U --ask-vault-pass
