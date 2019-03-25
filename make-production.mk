U := root

production-setup:
	ansible-playbook ansible/site.yml -i ansible/production -u $U --ask-vault-pass

production-setup-env:
	ansible-playbook ansible/production.yml -i ansible/production -vv --ask-vault-pass

production-deploy:
	ansible-playbook ansible/deploy.yml -i ansible/production -u $U --ask-vault-pass
