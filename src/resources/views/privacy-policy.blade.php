<section>
    <p>
        {!! \PrivacyPolicy::translate('intro_content.p1') !!}
    </p>
    <p>
        {!! \PrivacyPolicy::translate('intro_content.p2') !!}
    </p>

    {!! $after_intro ?? '' !!}

    <section>
        <h2>
            {!! \PrivacyPolicy::translate('gdpr_rights.title') !!}
        </h2>

        {!! $gdpr_rights_start ?? '' !!}

        <p>
            {!! \PrivacyPolicy::translate('gdpr_rights.content.p1') !!}
        </p>
        <ul>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li1') !!}
            </li>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li2') !!}
            </li>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li3') !!}
            </li>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li4') !!}
            </li>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li5') !!}
            </li>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li6') !!}
            </li>
            <li>{!! \PrivacyPolicy::translate('gdpr_rights.content.ul1.li7') !!}
            </li>
        </ul>

        {!! $gdpr_rights_end ?? '' !!}
    </section>

    <section>
        <h2>
            {!! \PrivacyPolicy::translate('data_controller.title') !!}
        </h2>

        {!! $data_controller_start ?? '' !!}

        <p>
            {!! \PrivacyPolicy::translate('data_controller.content.p1') !!}
        </p>

        <address>
            @if (config('privacy-policy.data_controller.organisation'))
                <div>
                    {{ config('privacy-policy.data_controller.organisation') }}
                </div>
            @endif
            @if (config('privacy-policy.data_controller.name'))
                <div>
                    {{ config('privacy-policy.data_controller.name') }}
                </div>
            @endif
            @if (config('privacy-policy.data_controller.address'))
                <div>
                    {{ config('privacy-policy.data_controller.address') }}
                </div>
            @endif
            @if (config('privacy-policy.data_controller.email'))
                <div>
                    <a href="mailto:{{ config('privacy-policy.data_controller.email') }}">
                        {{ config('privacy-policy.data_controller.email') }}
                    </a>
                </div>
            @endif
            @if (config('privacy-policy.data_controller.phone'))
                <div>
                    <a href="tel:{{ config('privacy-policy.data_controller.phone') }}">
                        {{ config('privacy-policy.data_controller.phone') }}
                    </a>
                </div>
            @endif
        </address>

        {!! $data_controller_end ?? '' !!}
    </section>

    <section>
        <h2>
            {!! \PrivacyPolicy::translate('security.title') !!}
        </h2>

        {!! $security_start ?? '' !!}

        <p>
            {!! \PrivacyPolicy::translate('security.content.p1') !!}
        </p>
        <p>
            {!! \PrivacyPolicy::translate('security.content.p2') !!}
        </p>

        {!! $security_end ?? '' !!}
    </section>

    <section>
        <h2>
            {!! \PrivacyPolicy::translate('cookies.title') !!}
        </h2>

        {!! $cookies_start ?? '' !!}

        @if (config('privacy-policy.cookies') === false)
            <p>
                {!! \PrivacyPolicy::translate('cookies.no_cookies_content.p1') !!}
            </p>
        @else
            <p>
                {!! \PrivacyPolicy::translate('cookies.content.p1') !!}
            </p>
            <p>
                {!! \PrivacyPolicy::translate('cookies.content.p2') !!}
            </p>
            <p>
                {!! \PrivacyPolicy::translate('cookies.content.p3') !!}
            </p>
            @foreach (config('privacy-policy.cookies') as $cookieType => $cookies)
                <section>
                    <h3>
                        {!! \PrivacyPolicy::translate("cookies.$cookieType.title") !!}
                    </h3>
                    <p>
                        {!! \PrivacyPolicy::translate("cookies.$cookieType.content.p1") !!}
                    </p>
                    @foreach ($cookies as $cookie)
                        @include('webflorist-privacy-policy::cookie-details', [
                        'cookie' => $cookie,
                        'processors' => \PrivacyPolicy::getUsedProcessors(),
                        'type' => $cookieType
                        ])
                    @endforeach
                </section>
            @endforeach
        @endif

        {!! $cookies_end ?? '' !!}
    </section>

    @if (count(config('privacy-policy.data_processing')) > 0)
        <section>
            <h2>
                {!! \PrivacyPolicy::translate('data_processing.title') !!}
            </h2>

            {!! $data_processing_start ?? '' !!}

            @if (is_array(config('privacy-policy.data_processing.webhosting')))
                <section id="process-webhosting">
                    <h3>
                        {!! \PrivacyPolicy::translate('data_processing.webhosting.title') !!}
                    </h3>

                    {!! $data_processing_webhosting_start ?? '' !!}

                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.webhosting.content.p1') !!}
                    </p>
                    <ul>
                        <li>
                            {!! \PrivacyPolicy::translate('data_processing.webhosting.content.ul1.li1') !!}
                        </li>
                        <li>
                            {!! \PrivacyPolicy::translate('data_processing.webhosting.content.ul1.li2') !!}
                        </li>
                        <li>
                            {!! \PrivacyPolicy::translate('data_processing.webhosting.content.ul1.li3') !!}
                        </li>
                        <li>
                            {!! \PrivacyPolicy::translate('data_processing.webhosting.content.ul1.li4') !!}
                        </li>
                    </ul>
                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.webhosting.content.p2') !!}
                    </p>

                    {!! $data_processing_webhosting_end ?? '' !!}
                </section>
            @endif

            @if (is_array(config('privacy-policy.data_processing.analytics')))
                <section id="process-analytics">
                    <h3>
                        {!! \PrivacyPolicy::translate('data_processing.analytics.title') !!}
                    </h3>

                    {!! $data_processing_analytics_start ?? '' !!}

                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.analytics.content.p1') !!}
                    </p>
                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.analytics.content.p2') !!}
                    </p>

                    {!! $data_processing_analytics_end ?? '' !!}
                </section>
            @endif

            @if (is_array(config('privacy-policy.data_processing.maps')))
                <section id="process-maps">
                    <h3>
                        {!! \PrivacyPolicy::translate('data_processing.maps.title') !!}
                    </h3>

                    {!! $data_processing_maps_start ?? '' !!}

                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.maps.content.p1') !!}
                    </p>
                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.maps.content.p2') !!}
                    </p>
                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.maps.content.p3') !!}
                    </p>
                    {!! $data_processing_maps_end ?? '' !!}
                </section>
            @endif

            @if (is_array(config('privacy-policy.data_processing.send_emails')))
                <section id="process-send_emails">
                    <h3>
                        {!! \PrivacyPolicy::translate('data_processing.send_emails.title') !!}
                    </h3>
                    {!! $data_processing_send_emails_start ?? '' !!}
                    <p>
                        {!! \PrivacyPolicy::translate('data_processing.send_emails.content.p1') !!}
                    </p>
                    {!! $data_processing_send_emails_end ?? '' !!}
                </section>
            @endif

            {!! $data_processing_end ?? '' !!}
        </section>
    @endif

    <section>
        <h2>
            {!! \PrivacyPolicy::translate('outgoing_links.title') !!}
        </h2>
        {!! $outgoing_links_start ?? '' !!}
        <p>
            {!! \PrivacyPolicy::translate('outgoing_links.content.p1') !!}
        </p>
        {!! $outgoing_links_end ?? '' !!}
    </section>

    <section>
        <h2>
            {!! \PrivacyPolicy::translate('processor_list') !!}
        </h2>

        {!! $processor_list_start ?? '' !!}

        @foreach (\PrivacyPolicy::getUsedProcessors() as $key => $processor)
            <section id="processor-{{ $key }}">
                <h3>{{ $processor['name'] }}</h3>
                <dl>
                    <dt>
                        {!! \PrivacyPolicy::translate('address') !!}
                    </dt>
                    <dd>
                        {{ $processor['address'] }}
                    </dd>

                    <dt>
                        {!! \PrivacyPolicy::translate('data_purpose.title') !!}
                    </dt>
                    <dd>
                        @foreach ($processor['purposes'] as $purpose)
                            <div>
                                <a href="#process-{{ $purpose }}">
                                    {!! \PrivacyPolicy::translate("data_purpose.$purpose") !!}
                                </a>
                            </div>
                        @endforeach
                    </dd>

                    <dt>
                        {!! \PrivacyPolicy::translate('data_category.title') !!}
                    </dt>
                    <dd>
                        @foreach ($processor['data_categories'] as $key => $category)
                            <span>
                                @if ($key > 0 && $key < count($processor['data_categories'])),@endif
                                {!! \PrivacyPolicy::translate("data_category.$category") !!}
                            </span>
                        @endforeach
                    </dd>

                    <dt>
                        {!! \PrivacyPolicy::translate('privacy_policy') !!}
                    </dt>
                    <dd>
                        <a href="{{ $processor['privacy_policy'] }}" target="_blank" rel="noopener nofollower">
                            {{ $processor['privacy_policy'] }}
                        </a>
                    </dd>

                    @isset($processor['privacy_shield'])
                        <dt>
                            Privacy Shield
                        </dt>
                        <dd>
                            <a href="{{ $processor['privacy_shield'] }}" target="_blank" rel="noopener nofollower">
                                {{ $processor['privacy_shield'] }}
                            </a>
                        </dd>
                    @endisset
                </dl>
            </section>
        @endforeach

        {!! $processor_list_end ?? '' !!}
    </section>
</section>
