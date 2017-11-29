# JplararSESBundle
A simple Symfony2 bundle for the API for AWS SES.

## Setup

### Step 1: Download JplararSESBundle using composer

Add SES Bundle in your composer.json:

```js
{
    "require": {
        "jplarar/ses-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update "jplarar/ses-bundle"
```


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Jplarar\SESBundle\JplararSESBundle()
    );
}
```

### Step 3: Add configuration

``` yml
# app/config/config.yml
jplarar_ses:
        amazon_ses:
            amazon_ses_key:    %amazon_ses_key%
            amazon_ses_secret: %amazon_ses_secret%
            amazon_ses_region: %amazon_ses_region%
```

## Usage

**Using service**

``` php
<?php
        $sesClient = $this->get('amazon_ses_client');
?>
```

##Example

###Send new email to SES
``` php
<?php 
    $result = $sesClient->sendEmail(
                'recipient@example.com', 
                'subject', 
                'sender@example.com', 
                '<h1>AWS Amazon Simple Email Service Test Email</h1>',
                'This email was send with Amazon SES using the AWS SDK for Symfony.'
            );
            
            $messageId = $result->get('MessageId');
            echo("Email sent! Message ID: $messageId"."\n");
?>
```
