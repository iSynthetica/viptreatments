<?php
include_once (BA_INCLUDES_PATH . '/sms/Twilio/autoload.php');

class BA_Sms
{
    private $client = null;
    private $settings = null;

    public function __construct($AccountSid = false, $AuthToken = false)
    {
        $this->settings = array_merge (
            BA_Settings()->get_settings()['sms'],
            BA_Settings()->get_settings()['general']
        );

        if(!$AccountSid) {
            $AccountSid = $this->settings['AccountSid'];
        }

        if(!$AuthToken) {
            $AuthToken = $this->settings['AuthToken'];
        }

        $this->client = new Twilio\Rest\Client ($AccountSid, $AuthToken);
    }

    public function sendSms($to, $body, $from = false, $args = array()) {

        if (!$this->settings['sendSms']) {
            wp_mail($this->settings['admin_emails'], 'SMS sending is disabled',
                'SMS sending is disabled on your site. You can enable it in settings file.'
            );
            return;
        }

        $options = array();
        if(!$from) {
            $from = $this->settings['from'];
        }

        $options['from'] = $from;
        $options['body'] = $body;

        $options = array_merge($options, $args);

        try{
            $this->client->account->messages->create($to, $options);
            wp_mail($this->settings['admin_emails'], 'SMS was sent', 'SMS was sent to vendor.');
        } catch(Exception $e){
            wp_mail($this->settings['admin_emails'], 'SMS was sent', 'Error while sending SMS' . $e->getMessage());
        }
    }
}