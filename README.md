# Wordpress_REST_API_PHPMailer
Send emails using PHPMailler and wordpress REST API endpoint. 

## Steps to follow

1. Create a custom endpoint with POST request. 
2. Download PHPMailer (https://github.com/PHPMailer/PHPMailer) and upload it to your theme folder. Mine twenty nineteen.
3. Create a folder inside your theme and add demo.html email template to it. The folder name should be "emails".

## Parse variables to email template

Remove 

```php
$mail->Body = $body;
```
and Add

```php
$message = $body;
$message = str_replace('%myName%', 'My Name Is Bla Bla', $message);
$mail->msgHTML($message);
```

You can use 'myName' variable inside your email template like this

Hi, %myName%
