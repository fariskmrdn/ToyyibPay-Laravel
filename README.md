# ToyyibPay-Laravel
Intergrate ToyyibPay API using Laravel 11 (GuzzleHTTP with CA Certificate)

After executing the create-project command, install GuzzleHttp with command
```composer require guzzlehttp/guzzle```. Update the composer by using ```composer update```.
To prevent cURL error, make sure to include the Certificate Authority (CA) by executing
```curl -o cacert.pem https://curl.se/ca/cacert.pem```. Create a directory inside ```storage```
with the name ```certificate``` (refer to ToyyibPayController.php)
