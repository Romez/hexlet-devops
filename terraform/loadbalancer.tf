resource "digitalocean_loadbalancer" "balancer" {
  name = "loadbalancer-1"
  region = "lon1"

  forwarding_rule {
    entry_port = 80
    entry_protocol = "http"

    target_port = 80
    target_protocol = "http"
  }

  healthcheck {
    port = 22
    protocol = "tcp"
  }

  droplet_ids = ["${digitalocean_droplet.web.id}"]
}
