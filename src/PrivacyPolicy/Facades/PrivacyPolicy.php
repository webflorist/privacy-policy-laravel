<?php

namespace Webflorist\PrivacyPolicy\Facades;

use Illuminate\Support\Facades\Facade;
use Webflorist\PrivacyPolicy\PrivacyPolicy as PrivacyPolicyService;

/**
 * @see \Webflorist\PrivacyPolicy\PrivacyPolicy
 */
class PrivacyPolicy extends Facade
{

    /**
     * Static access-proxy for the PrivacyPolicy service.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return PrivacyPolicyService::class;
    }

}