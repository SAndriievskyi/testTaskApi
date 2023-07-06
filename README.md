Task:

Console command in Dockerised environment
Command should generate a message and send it via 3rd party providers (twillio/mailgun...etc) as sms AND email.
Message with phone number and email can be set via console.

Run tests 
1) docker build -t my-php-app .
2) docker run -e PHONE='9999' -e EMAIL='asd@axzd' -e MESSAGE='asdasd dasd' -it --rm --name my-running-app my-php-app php run.php 

If u change fixtures run this two commands one more time!