<?php

namespace PrivacyPolicyTests;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\Router;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Webflorist\PrivacyPolicy\PrivacyPolicyServiceProvider;

class TestCase extends BaseTestCase
{
	protected function getPackageProviders($app)
	{
		return [PrivacyPolicyServiceProvider::class];
	}

	protected function getPackageAliases($app)
	{
		return [
			'PrivacyPolicy' => \Webflorist\PrivacyPolicy\Facades\PrivacyPolicy::class,
		];
	}

	protected function getEnvironmentSetUp($app)
	{
		$app['router']->view('/privacy-policy', 'privacy-policy');

		$app['config']->set('view.paths', [dirname(__FILE__) . '/Feature/Views']);

		$app['config']->set('app.locale', 'en');

		$app['config']->set('privacy-policy.data_processing', [
			'webhosting' => [
				'processor' => ['netlify', 'storyblok'],
				'data_categories' => ['usage_data'],
			],
			'analytics' => [
				'processor' => 'google_eu',
				'service' => 'Google Analytics',
				'data_categories' => ['usage_data', 'usage_statistics'],
			],
			'maps' => [
				'processor' => 'google_usa',
				'service' => 'Google Maps',
				'data_categories' => ['usage_data', 'geo_data'],
			],
			'send_emails' => [
				'processor' => 'twilio_eu',
				'service' => 'Twilio Sendgrid',
				'data_categories' => ['usage_data', 'inventory_data'],
			],
		]);

		$app['config']->set('privacy-policy.cookies', [
			'first_party' => [
				[
					'name' => 'session',
					'purpose' => 'session',
					'written_on' => 'every_visit',
					'duration' => 'end_of_session',
				],
			],
			'third_party' => [
				[
					'name' => '_ga, _gat, _gid',
					'purpose' => 'analytics_third_party',
					'written_on' => 'accept_cookies',
					'duration' => 'various',
					'processor' => 'google_eu',
					'service' => 'Google Analytics',
				],
			],
		]);
	}
}
