<?php

namespace Jplarar\SESBundle\Services;

use Aws\Ses\SesClient;
use Aws\Ses\Exception\SesException;

/**
 * Reference: http://docs.aws.amazon.com/ses/latest/DeveloperGuide/send-using-sdk-php.html
 * Class AmazonSESClient
 * @package Jplarar\SESBundle\Services
 */
class AmazonSESClient
{

    protected $service;

    /**
     * AmazonSESClient constructor.
     * @param $amazon_ses_key
     * @param $amazon_ses_secret
     * @param $amazon_ses_region
     */
    public function __construct($amazon_ses_key, $amazon_ses_secret, $amazon_ses_region)
    {
        $this->service = SesClient::factory(array(
            'credentials' => [
                'key'    => $amazon_ses_key,
                'secret' => $amazon_ses_secret
            ],
            'version'=> 'latest',
            'region' => $amazon_ses_region
        ));
    }

    /**
     * @param $toAddress //If your account is still in the sandbox, this address must be verified.
     * @param $subject
     * @param $sender //This address must be verified with Amazon SES.
     * @param $htmlBody
     * @param $textBody
     * @param string $charSet
     * @param string $configSet
     * @return \Aws\Result|\Guzzle\Service\Resource\Model|null
     * @throws \Exception
     */
    public function sendEmail($toAddress, $subject, $sender, $htmlBody, $textBody, $charSet = "UTF-8", $configSet = "")
    {
        $content = array([
            'Destination' => [
                'ToAddresses' => [
                    $toAddress,
                ],
            ],
            'Message' => [
                'Body' => [
                    'Html' => [
                        'Charset' => $charSet,
                        'Data' => $htmlBody,
                    ],
                    'Text' => [
                        'Charset' => $charSet,
                        'Data' => $textBody,
                    ],
                ],
                'Subject' => [
                    'Charset' => $charSet,
                    'Data' => $subject,
                ],
            ],
            'Source' => $sender,
        ]);

        // If using a configuration set
        if (strlen($configSet) > 0) {
            $content["ConfigurationSetName"] = $configSet;
        }

        try {
            $result = $this->service->sendEmail($content);
            return $result;
        } catch (SesException $error) {
            throw new \Exception("The email was not sent. Error message: ".$error->getAwsErrorMessage()."\n");
        }
    }
}