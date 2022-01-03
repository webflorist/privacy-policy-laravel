<?php

namespace PrivacyPolicyTests\Feature;

use PrivacyPolicyTests\TestCase;

class PrivacyPolicyTest extends TestCase
{

    public function test_privacy_policy()
    {
        $response = $this->get('privacy-policy');
        $response->assertSee('The privacy and protection of your data is of great concern to us.');
        $response->assertSee('We handle your data in accordance with the European General Data Protection Regulation');
        $response->assertSee('Acme Corporation');
        $response->assertSee('Our website takes many technical measures to provide a secure transmission');
        $response->assertSee('First Party Cookies');
        $response->assertSee('session');
        $response->assertSee('Third Party Cookies');
        $response->assertSee('_ga, _gat, _gid');
        $response->assertSee('When visiting any website, your browser is automatically transmitting information to the server and infrastructure it is hosted on');
        $response->assertSee('If you accept web analytics in the cookie notification, our website will forward log data to the service');
        $response->assertSee('Our website provides the functionality of interactive maps on demand');
        $response->assertSee('Our website includes forms, that can be used to send us an e-mail.');
        $response->assertSee('Our website includes links to other websites, which are not operated by us');
        $response->assertSee('2325 3rd Street, Suite 296, San Francisco, CA 94107, USA');
    }
}
