<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Orders App')</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body>
@yield('content')
<script type="text/javascript">
    document.getElementById('pagination-links').addEventListener('click', function (event) {
        if (event.target.matches('.pagination-button')) {
            const pageUrl = event.target.getAttribute('data-href');
            if (pageUrl && pageUrl !== '#') {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', pageUrl, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        const response = JSON.parse(xhr.responseText);
                        document.getElementById('orders-container').innerHTML = response.html;
                        document.getElementById('pagination-links').innerHTML = response.pagination;
                        window.history.pushState(null, '', pageUrl);
                    }
                };
                xhr.onerror = function () {
                    console.error('Page loading error');
                };
                xhr.send();
            }
        }
    });
</script>
</body>
</html>
