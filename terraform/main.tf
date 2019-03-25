provider "digitalocean" {
  token = "${var.do_token}"
}

resource "digitalocean_ssh_key" "roman" {
  name       = "roman"
  public_key = "${file("./files/roman.pub")}"
}

resource "digitalocean_droplet" "web" {
  image  = "docker-18-04"
  name   = "web-1"
  region = "sgp1"
  size   = "s-1vcpu-1gb"
  ssh_keys = ["${digitalocean_ssh_key.roman.fingerprint}"]
}
