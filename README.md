# A Privacy Policy Package for Laravel Applications<!-- omit in toc -->

[![Build Status](https://travis-ci.com/webflorist/privacy-policy-laravel.svg?branch=master)](https://travis-ci.com/webflorist/privacy-policy-laravel)
[![Latest Stable Version](https://poser.pugx.org/webflorist/privacy-policy-laravel/v/stable)](https://packagist.org/packages/webflorist/privacy-policy-laravel)

This is a **Laravel** package providing an **open source** privacy policy available in **german** and **english**.

## Table of Contents<!-- omit in toc -->

- [Demo](#demo)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
  - [`data-controller`: array (mandatory)](#data-controller-array-mandatory)
  - [`singular`: boolean (mandatory)](#singular-boolean-mandatory)
  - [`data-processing`: array (optional)](#data-processing-array-optional)
  - [`cookies`: array|false (mandatory)](#cookies-arrayfalse-mandatory)
  - [`processors`: array (optional)](#processors-array-optional)
- [Component Slots](#component-slots)
- [Disclaimer](#disclaimer)
- [License](#license)

## Demo

An demo application using the sister-package [webflorist/privacy-policy-vue](https://github.com/webflorist/privacy-policy-vue) with the same texts is avaliable at:  
<https://privacy-policy-vue-demo.netlify.app/>

## Features

- **Languages**  
  Currently the package includes texts in **german** and **english** language.

- **Singular/Plural**  
  You can choose between a singular or plural point of view.  
  (e.g. `My website...` vs `Our website...`)

- **Included Texts**

  - A general **intro text**
  - Listing of **GDPR rights**
  - Introduction of **data controller**
  - General **data security** text (SSL, etc.)
  - **Cookies** information
  - Information on **data processing** of third party data processors:
    - Webhosting
    - Web analytics
    - Interactive maps
    - Sending of emails (e.g. contact forms)
  - Disclaimer regarding **outgoing links**
  - Listing of all used **processors**

## Requirements

This package supports [`Laravel`](https://laravel.com/) from version 5.5 up until 8.x.

## Installation

1. Require the package via composer:  
`composer require webflorist/privacy-policy-laravel`
2. Publish config:  
`php artisan vendor:publish --provider="Webflorist\PrivacyPolicy\PrivacyPolicyServiceProvider"`
3. Configure your privacy policy with the `privacy-policy.php` file in Laravel's `config` folder. (see below for details).
4. Include the privacy policy component in your view:

```blade
    @component('webflorist-privacy-policy::privacy-policy')
    @endcomponent
```

## Configuration

### `data-controller`: array (mandatory)

Contact info for the data controller. The array can have the following elements:

```php
[
  'organisation' => 'Acme Corporation',
  'name' => 'John Doe',
  'address' => 'Acme Street 1, 123456 Acme City, USA',
  'email' => 'privacy@example.com',
  'phone' => '+1 555-0123'
]
```

### `singular`: boolean (mandatory)

Set to `true` for singular viewpoint (e.g. "My website...").

Set to `false` for plural viewpoint (e.g. "Our website...").

### `data-processing`: array (optional)

The data processings used by your site. Each process must be stated as two-dimenstional array with the type of process as it's key and it's properties stated as a value-array.

Supported types of processes are:

- `webhosting`
- `analytics`
- `maps`
- `send_emails`

The properties of a process can be:

- `processor`: String (mandatory)  
  The key of the processor providing this processing (either one of the [included ones](https://github.com/webflorist/privacy-policy-text/blob/main/src/processors.php) or one stated via the [processors property](#processors-array-optional))
- `service`: String (optional)  
  Name of the service providing this processing (e.g. `Google Analytics` or `Google Maps`)
- `data_categories`: Array (mandatory)  
  Array of data categories processed by this process. Supported values are:
  - `inventory_data`
  - `usage_data`
  - `geo_data`
  - `usage_statistics`
  - `contract_data`
  - `payment_data`

Here is an example for a full `data_processing` config:

```php
[
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
]
```

### `cookies`: array|false (mandatory)

This config describes the cookies used by your site.

If your site uses no cookies at all, simply set this to `false`.

If not, divide the used cookies into first party cookies and third party ones, and list them as sub-arrays of the `first_party` and `third_party` arrays of the `cookies` config.

Each cookie is described as an array with the following possible properties:

- `name`: String (mandatory)  
  The name of the cookie
- `purpose`: String (mandatory)  
  The key of the cookie purpose. Can be one of the following:
  - `session`: Session cookie
  - `xsrf`: Cookie to prevent "Cross-Site Request Forgery" attacks
  - `hide_alert`: Cookie to prevent displaying the cookie dialog again after hiding it
  - `all_choices`: Cookie storing the choices regarding various cookies displayed in the cookie dialog
  - `analytics_choice`: Cookie storing the choice regarding the usage of web analytics in the cookie dialog
  - `maps_choice`: Cookie storing the choice regarding the usage of interactive maps
  - `analytics_third_party`: Cookies written by the web analytics tool
  - `maps_third_party`: Cookies set on displaying interactive maps.
- `written_on`: String (mandatory)  
  When the cookie is created. Can be one of the following:
  - `every_visit`: Written on every visit
  - `hide_alert`: Written on hiding the cookie dialog
  - `maps`: Written on acknowledging the usage of interactive maps
  - `accept_cookies`: Written on accepting the corresponding cookies
- `duration`: String (mandatory)  
  The duration of the cookie. Can be one of the following:
  - `end_of_session`
  - `1_year`
  - `2_years`
  - `24_hours`
  - `1_minute`
  - `various`
- `processor`: String (mandatory with third party cookies)
  The key of the processor providing this processing (either one of the [included ones](https://github.com/webflorist/privacy-policy-text/blob/main/src/processors.php) or one stated via the [processors property](#processors-array-optional))

Here is an example of the cookie config:

```php
[
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
]
```

### `processors`: array (optional)

Definition of processors stated with [data processings](#data-processing-array-optional) or [cookies](#cookies-arrayfalse-mandatory).

Several processors are [already included](https://github.com/webflorist/privacy-policy-text/blob/main/src/processors.php).

State your own ones in the processors config in an array with the shorthand-key of the processor as the key and it's info as an array with the following elements:

- `name` String (mandatory)  
  Company name
- `address` String (mandatory)  
  Full address of the company
- `privacy_policy` String (mandatory)
  Link to the processors privacy policy
- `privacy_shield` String (optional)  
  Link to the [privacy shield](https://www.privacyshield.gov) entry of the processor.

Here is and example:

```php
[
  'acme_corp' => [
    'name' => 'Acme Corporation',
    'address' => 'Acme Street 1, 123456 Acme City, USA',
    'privacy_policy' => 'https://www.example.com/privacy',
    'privacy_shield' => 'https://www.privacyshield.gov/participant?id=a2zt0000000TOWQAA4'
  ]
]
```

## Component Slots

The `webflorist-privacy-policy::privacy-policy` component provides the following named slots to insert custom text on various positions:

| Slot Name                         | Usage                                                                   |
| --------------------------------- | ----------------------------------------------------------------------- |
| after_intro                       | `@slot('after_intro') Custom Text @endslot`                       |
| gdpr_rights_start                 | `@slot('gdpr_rights_start') Custom Text @endslot`                 |
| gdpr_rights_end                   | `@slot('gdpr_rights_end') Custom Text @endslot`                   |
| data_controller_start             | `@slot('data_controller_start') Custom Text @endslot`             |
| data_controller_end               | `@slot('data_controller_end') Custom Text @endslot`               |
| security_start                    | `@slot('security_start') Custom Text @endslot`                    |
| security_end                      | `@slot('security_end') Custom Text @endslot`                      |
| cookies_start                     | `@slot('cookies_start') Custom Text @endslot`                     |
| cookies_end                       | `@slot('cookies_end') Custom Text @endslot`                       |
| data_processing_start             | `@slot('data_processing_start') Custom Text @endslot`             |
| data_processing_webhosting_start  | `@slot('data_processing_webhosting_start') Custom Text @endslot`  |
| data_processing_webhosting_end    | `@slot('data_processing_webhosting_end') Custom Text @endslot`    |
| data_processing_analytics_start   | `@slot('data_processing_analytics_start') Custom Text @endslot`   |
| data_processing_analytics_end     | `@slot('data_processing_analytics_end') Custom Text @endslot`     |
| data_processing_maps_start        | `@slot('data_processing_maps_start') Custom Text @endslot`        |
| data_processing_maps_end          | `@slot('data_processing_maps_end') Custom Text @endslot`          |
| data_processing_send_emails_start | `@slot('data_processing_send_emails_start') Custom Text @endslot` |
| data_processing_send_emails_end   | `@slot('data_processing_send_emails_end') Custom Text @endslot`   |
| data_processing_end               | `@slot('data_processing_end') Custom Text @endslot`               |
| outgoing_links_start              | `@slot('outgoing_links_start') Custom Text @endslot`              |
| outgoing_links_end                | `@slot('outgoing_links_end') Custom Text @endslot`                |
| processor_list_start              | `@slot('processor_list_start') Custom Text @endslot`              |
| processor_list_end                | `@slot('processor_list_end') Custom Text @endslot`                |

## Disclaimer

The included text _should_ be suitable for a GDPR-compliant website.

**I however do not take any responsibility whatsowever for that.**

## License

This package is open-sourced software licensed under the [MIT license](https://github.com/laravel/framework/blob/8.x/LICENSE.md).
