<?php

namespace Revo\Paloma;

use Revo\Paloma\Exceptions\SmsException;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\Client\Exception\Exception as VonageClientException;
use Vonage\SMS\Collection;
use Vonage\SMS\Message\SMS;

class Sender implements Contracts\Sender
{
    /**
     * @throws SmsException
     */
    public function send(string $phone, string $message, ?string $from = null)
    {
        try {
            $smsResponse = $this->vonageClient()->sms()->send(
                new SMS(
                    to: $phone,
                    from: $from ?? config('paloma.sms_from'),
                    message: $message,
                    type: 'unicode'
                )
            );
        } catch (\RuntimeException | VonageClientException $e) {
            throw new SmsException($e->getMessage());
        }

        throw_if($this->getStatus($smsResponse) != 0, SmsException::class, "The message failed with status: {$this->getStatus($smsResponse)}");
    }

    protected function getStatus(Collection $smsResponse): int|null
    {
        return $smsResponse->current()->getStatus() ?? null;
    }

    protected function vonageClient(): Client
    {
        $credentials = app(Basic::class, [
            'key' => config('paloma.vonage_key'),
            'secret' => config('paloma.vonage_secret'),
        ]);

        return app(Client::class, ['credentials' => $credentials]);
    }
}
