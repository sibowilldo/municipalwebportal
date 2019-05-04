@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <script>
            let level = "{{ $message['level'] }}";
            let content ={};

            switch (level) {
                case "success":
                    content.icon = "icon la la-check-circle";
                    content.title = "Success";
                    break;
                case "info":
                    content.icon = "icon la la-info-circle";
                    content.title = "Important";
                    break;
                case "warning":
                    content.icon = "icon la la-exclamation-circle";
                    content.title = "Warning";
                    break;
                case "danger":
                    content.icon = "icon la la-times-circle";
                    content.title = "Error";
                    break;
            }
            content.message = "{!!$message['message']  !!}";
            jQuery.notify(content, {
                type: level
            });
        </script>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
