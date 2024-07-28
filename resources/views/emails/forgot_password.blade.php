@component('mail::message')
    Hello {{ $user->name }},
    <p>Chúng tôi hiểu nó xảy ra. </p>
    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Đặt lại mật khẩu của bạn
    @endcomponent
    <p>Trong trường hợp bạn có bất kỳ vấn đề nào khi khôi phục mật khẩu, vui lòng liên hệ với chúng tôi. </p>
    Cảm ơn, <br>
    {{ config('app.name') }}
@endcomponent
