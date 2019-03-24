ansible-terraform-vars-generate:
	ansible-playbook ansible/terraform.yml -i ansible/production -vv --ask-vault-pass
