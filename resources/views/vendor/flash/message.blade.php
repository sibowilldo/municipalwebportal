
@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'level' => $message['level'],
            'title' => $message['title'],
            'body'  => $message['message']
        ])
    @else
        <script>
            swalToast.fire({
                icon: "{{ $message['level']!=='danger'? $message['level'] :'error' }}",
                title: "{!! $message['message']  !!}"
            })
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
