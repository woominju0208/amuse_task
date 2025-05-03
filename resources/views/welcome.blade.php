<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- script삭제, vite로 js연결해야함 --}}
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <title>미니프로젝트</title>
        @vite('resources/js/app.js')
        {{-- @inertiaHead --}}
    </head>
    <body>
        <div id="app">
            <App-Component></App-Component>
        </div>
        {{-- @inertia --}}
    </body>
</html>