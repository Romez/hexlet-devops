production-setup-env:
	ansible-playbook ansible/production.yml -i ansible/production -vv --ask-vault-pass
