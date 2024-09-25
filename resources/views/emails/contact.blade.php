@component('mail::message')
    Xin chào {{ $user->name }},
    <p>Cảm ơn bạn đã liên hệ với chúng tôi. Đội ngũ của chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất. </p>
    Cảm ơn, <br>
    {{ config('app.name') }}
@endcomponent
