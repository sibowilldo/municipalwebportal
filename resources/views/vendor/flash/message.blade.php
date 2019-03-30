@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <script>
            var level = "{{ $message['level'] }}";
            console.log(level);
            var content ={};
            content.message = "{!!$message['message']  !!}";
            content.title = "{{ $message['title'] }}";
            content.icon = "";
            var notify = jQuery.notify(content, {
                type: "{{ $message['level'] }}",
                allow_dismiss: true,
                newest_on_top: false,
                mouse_over:  true,
                showProgressbar: false,
                spacing: 10,
                timer: 5000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay:1000,
                z_index:10000,
                animate: {
                    enter: 'animated fadeInUp',
                    exit: 'animated fadeOutUp'
                }
            });
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
