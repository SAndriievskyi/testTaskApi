Task:

Console command in Dockerised environment
Command should generate a message and send it via 3rd party providers (twillio/mailgun...etc) as sms AND email.
Message with phone number and email can be set via console.

Run command 
docker build -t my-php-app . && docker run -e PHONE='+380991111111' -e EMAIL='test@test.com' -e MESSAGE='some text!' -it --rm --name my-running-app my-php-app php run.php

If u change fixtures run this two commands one more time!