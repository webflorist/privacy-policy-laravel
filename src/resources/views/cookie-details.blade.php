<section>
    <h4>{{ $cookie['name'] }}</h4>

    <dl>
        <dt>{!! \PrivacyPolicy::translate('cookies.purpose.title') !!}</dt>
        <dd>{!! \PrivacyPolicy::translate('cookies.purpose.'.$cookie['purpose']) !!}</dd>

        @if($type === 'third_party')
            <dt>{!! \PrivacyPolicy::translate('cookies.origin') !!}</dt>
            <dd>
                {{ $cookie['service'] }}
                (<a href="#processor-{{$cookie['processor']}}">
                    {{ $processors[$cookie['processor']]['name'] }}
                </a>)
            </dd>
        @endif

        <dt>{!! \PrivacyPolicy::translate('cookies.written_on.title') !!}</dt>
        <dd>{!! \PrivacyPolicy::translate('cookies.written_on.'.$cookie['written_on']) !!}</dd>

        <dt>{!! \PrivacyPolicy::translate('cookies.duration.title') !!}</dt>
        <dd>{!! \PrivacyPolicy::translate('cookies.duration.'.$cookie['duration']) !!}</dd>
    </dl>
</section>