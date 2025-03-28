<!DOCTYPE html>
<head>
    <title>{{ Qs::getStringAbbreviation(config('app.name')) }} &#183; Offline</title>

    <style>
        body {
            min-height: 100vh;
            overflow: hidden;
            font-size: 18px;
            font-family: system-ui;
        }

        .retryBtn {
            align-items: center;
            background: #1A73E8;
            border-radius: 4px;
            color: #FFFFFF;
            cursor: pointer;
            display: flex;
            flex: none;
            flex-direction: column;
            flex-grow: 0;
            font-family: 'Google Sans', Arial, sans-serif;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.25px;
            line-height: 20px;
            order: 0;
            padding: 8px 24px;
            justify-content: center;
            text-align: center;
        }

        [data-theme=dark] #offlineViewBody {
            background-color: #121212;
        }

        [data-theme=dark] .text-white {
            color: white;
        }

        [data-theme=dark] .fill-white {
            fill: white;
        }

        .cover {
            display: flex;
            margin: 0;
            position: absolute;
            left: 50%;
            display: block;
            top: 50%;
            transform: translate(-50%, -50%);
            outline: none;
            text-align: center;
        }

        #offlineText {
            font-weight: 400;
            font-family: 'system-ui', sans-serif;
            font-size: 24px;
            line-height: 32px;
            text-align: center;
        }

        #offlineIcon {
            display: inline;
            height: 34px;
            margin-inline-end: 10px;
            width: 24px;
        }

        #backOnlineAlert {
            color: #285b2a;
            position: fixed;
            right: 0;
            bottom: 0;
            margin: auto;
            justify-content: center;
            width: 100%;
            height: 2rem;
            background-color: #e2f2e3;
            box-shadow: 0px -14px 14px #e2f2e3;
            display: inline-flex;
            transition: display 3s ease;
            display: none;
        }

        [data-theme=dark] #backOnlineAlert {
            color: #75b798 !important;
            background-color: #051b11 !important;
            box-shadow: 0px -14px 14px #051b11 !important;
        }

    </style>

    @laravelPWA

    <script>
        const setTheme = theme => {
            if (theme === 'auto') {
                document.documentElement.setAttribute('data-theme', (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'));
            } else {
                document.documentElement.setAttribute('data-theme', theme);
            }
        }

        const getStoredTheme = () => localStorage.getItem('theme');

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme();
            if (storedTheme) {
                return storedTheme;
            }

            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        setTheme(getPreferredTheme());

    </script>
</head>

<body id="offlineViewBody">
    <div class="cover">
        <div style="display: inline-flex">
            <svg class="fill-white" id="offlineIcon" xmlns="http://www.w3.org/2000/svg" height="48" viewBox="0 -960 960 960" width="48">
                <path d="M824.218-40.173 707.641-156.87H248q-93.067 0-157.034-62.967T27-375.87q0-81.695 51.63-139.652 51.631-57.957 129.327-70.522.87-11.174 4.239-28.108 3.37-16.935 10.804-28.674L57.565-808.261l47.087-45.957L871.74-87.13l-47.522 46.957ZM248.246-236.087h382.058L291.218-575.173q-10.435 12.739-13.55 29.733-3.114 16.995-3.114 32.788H248q-59.053 0-100.417 37.89-41.365 37.89-41.365 96.741t41.365 100.392q41.364 41.542 100.663 41.542Zm211.232-170.826ZM863.044-191.26l-60.566-61.131q24.435-17 37.87-36.438 13.434-19.437 13.434-47.273 0-39.76-29.394-68.655-29.395-28.895-69.388-28.895h-73.218v-87.218q0-85.046-59.117-142.914-59.116-57.868-143.972-57.868-28.748 0-59.525 9.283-30.777 9.282-56.081 27.587l-56.131-56.131q36-30.131 81.174-45.044 45.174-14.913 90.051-14.913 112.806 0 195.269 79.565 82.463 79.565 86.985 192.261v21q73.131 4.087 122.848 52.368 49.718 48.281 49.718 120.999 0 37.764-18.196 79.373t-51.761 64.044ZM583.565-468.87Z"></path>
            </svg>
            <span class="text-white" id="offlineText">You are Offline</span><br>
        </div>
        <div class="text-white">
            The page you tried seems to not be cached. Only pages you visit are cached.
            Please visit the page for offline access when you're back online.
        </div>
        <div style="padding-top:20px; display:flex; justify-content:center;" dir="auto">
            <div role="button" id="retryBtn" class="retryBtn" tabindex="0"><span>Retry</span></div>
        </div>
    </div>
    <div id="backOnlineAlert">
        Back online. Reloading...
    </div>

    <script>
        document.getElementById("retryBtn").addEventListener('click', (e) => window.location.reload());
        const offlineIcon = document.getElementById("offlineIcon");
        offlineIcon.addEventListener('error', (e) => {
            offlineIcon.style.display = 'none';
        });

        const backOnlineDiv = document.getElementById("backOnlineAlert");
        window.addEventListener('online', function(e) {
            backOnlineDiv.style.display = 'inline-flex';
            window.location.reload();
        });

    </script>
</body>

</html>
