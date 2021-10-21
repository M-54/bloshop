<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('7afcbbcd2953f8573ab9', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('comment-like');
        channel.bind('App\\Events\\CommentLiked', function (data) {
            document.querySelector(`#comment_like_${data.like.likeable_id} .like span`).innerHTML = data.count.count_like;
            document.querySelector(`#comment_like_${data.like.likeable_id} .dislike span`).innerHTML = data.count.count_dislike;
        });

        pusher.subscribe('new-post-channel')
            .bind('new-post', function (data) {
                const Toast = sweetAlert.mixin({
                    toast: true,
                    position: 'bottom-right',
                    showConfirmButton: false,
                    timer: 7000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', sweetAlert.stopTimer)
                        toast.addEventListener('mouseleave', sweetAlert.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'مطلب جدیدی در سایت منتشر شد. صفحه را بروزرسانی کنید.'
                })
            });
    </script>

    @livewireStyles
</head>
<body>
<main>
    {{ $slot }}
</main>

@livewireScripts
</body>
</html>
