@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
Yêu cầu khôi phục mật khẩu.
@endcomponent
@endslot
{{-- Body --}}
Đây là email xác nhận yêu cầu khôi phục mật khẩu của bạn. Nếu thật sự bạn không tạo ra yêu cầu như vậy thì xin bỏ qua. Yêu cầu sẽ hết hạn sau 30 phút.
Để khôi phục mật khẩu vui lòng nhất nút phía dưới.<br>
<a style="margin-top: 20px" href="{{route('admin.password.reset',$token)}}" class="button button-xs button-primary">Khôi phục mật khẩu</a>
{{-- Subcopy --}}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }}. Phòng tổng hợp trường Đai học Văn Lang.
@endcomponent
@endslot
@endcomponent
