resource "google_sql_database_instance" "alx-wp-db" {
  database_version = "MYSQL_8_0"
  name             = "alx-wp-db"
  project          = "${var.project}"
  region           = "us-central1"

  settings {
    activation_policy = "ALWAYS"
    availability_type = "ZONAL"

    backup_configuration {
      backup_retention_settings {
        retained_backups = 7
        retention_unit   = "COUNT"
      }

      binary_log_enabled             = true
      enabled                        = true
      location                       = "us"
      start_time                     = "21:00"
      transaction_log_retention_days = 7
    }

    disk_autoresize       = true
    disk_autoresize_limit = 0
    disk_size             = 10
    disk_type             = "PD_HDD"

    ip_configuration {
      authorized_networks {
        name  = "Rede interna"
        value = "0.0.0.0/0"
      }

      ipv4_enabled    = true
      private_network = "projects/${var.project}/global/networks/${var.project}"
    }

    location_preference {
      zone = "us-central1-b"
    }

    maintenance_window {
      update_track = "stable"
    }

    pricing_plan = "PER_USE"
    tier         = "db-f1-micro"
  }
}
# terraform import google_sql_database_instance.me_wp_db projects/${var.project}/instances/alx-wp-db
