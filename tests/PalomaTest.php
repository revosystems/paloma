<?php

namespace Revo\Paloma\Tests;

use Revo\Paloma\Contracts\Sender;
use Revo\Paloma\Exceptions\SmsException;
use Revo\Paloma\Fakers\FakeSmsSender;
use Revo\Paloma\Models\SentSms;
use Revo\Paloma\Paloma;

class PalomaTest extends TestCase
{
    public function setUp(): Void
    {
        parent::setUp();
        app()->bind(Sender::class, FakeSmsSender::class);
    }

    /** @test */
    public function sms_is_sent_if_tenant_has_balance()
    {
        $this->assertCount(0, SentSms::all());

        $response = app(Paloma::class)->send('123456789', 'message prova', 'service prova');

        $this->assertTrue($response);
        $this->assertCount(1, SentSms::all());
    }

    // /** @test */
    // public function sms_is_not_sent_if_tenant_has_no_balance_and_NoBalanceException_is_throwed()
    // {
    //     $this->expectException(TenantCannotSendSmsException::class);

    //     app(Paloma::class)->send('123456789', 'message prova', 'service prova');

    //     $this->assertCount(0, SentSms::all());
    // }

    /** @test */
    public function sms_is_not_sent_if_client_fails_and_SmsException_is_throwed()
    {
        app()->bind(Sender::class, fn () => new FakeSmsSender(shouldFail: true));

        $this->expectException(SmsException::class);

        app(Paloma::class)->send('123456789', 'message prova', 'service prova');

        $this->assertCount(0, SentSms::all());
    }
}
