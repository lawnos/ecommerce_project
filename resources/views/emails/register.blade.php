@component('mail::message')
    Xin chào <b>{{ $user->name }}!</b>
    <p>Bạn gần như đã sẵn sàng để bắt đầu tận hưởng những lợi ích của Trendy Threads.</p>
    <p>Vui lòng xác minh địa chỉ email của bạn.</p>
    <p> @component('mail::button', ['url' => url('activate/' . base64_encode($user->id))])
            Xác minh
        @endcomponent
    </p>
    <p>Điều này sẽ xác minh địa chỉ email của bạn và sau đó bạn sẽ chính thức trở thành một phần của the Trendy Threads</p>
@endcomponent
