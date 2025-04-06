
# Dynamic DDNS

Project that connects to DYNU (https://www.dynu.com) to dynamically configure the ddns IP.

To do this, a CRON must be configured to run from time to time, where it will check the current external IP, compare it with the old one, and duly update the IP in the Service.



# How to use

### Configure the environment
#### Create an account and API KEY at:
```http
    https://www.dynu.com/en-US/ControlPanel/APICredentials
```

#### Clone the Repository
```
    git clone https://github.com/oTrasel/dynimic-dns
```
#### In the repository directory, run:

```
    composer install
```
##### And:

```
    docker compose up -d
```
#### Copy the .env-example to the .env, and then put your api key
### Configure the CRON:
#### Configure your cron, to execute:
```
    docker exec -it dynimic-dns-dynimic-dns-1 php index.php
```
#### Example of configuration:
##### This example will run every 2 hours
```
    echo "0 */2 * * docker exec -it dynimic-dns-dynimic-dns-1 php index.php" > /etc/cron.d/updateIP
```
