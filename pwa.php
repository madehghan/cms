index.php : 
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نصب DGcollege</title>
    <link rel="manifest" href="manifest.json">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="icon" type="image/x-icon" href="logo.png">
     
    <link rel="apple-touch-icon" sizes="180x180" href="logo.png">
    <link rel="apple-touch-icon" sizes="192x192" href="logo.png">
    <link rel="apple-touch-icon" sizes="512x512" href="logo.png">
    
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif; 
            background-color: #fff;
            color: dark;
            text-align: right;
            direction:rtl;
            line-height:2;
        }
        h1, h2, h3 {
            color: #FFFFFF;
        }
        .btn-primary {
            background-color: #3B3B3B;
            border-color: #3B3B3B;
        }
        .btn-primary:hover {
            background-color: #555555;
            border-color: #555555;
        }
        ol {
            text-align: right;
            direction: rtl;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h4 class="mb-4 text-center">اپلیکیشن آیفون DGcollege</h4>
        <center><img src="logo.png" class="w-50"></center>
        <hr>
        <div class=" mb-3">جهت نصب اپلیکیشن ios روی دکمه زیر کلیک نمایید:</div>
        <button id="installButton" class="btn btn-warning w-100 mb-4">نصب اپلیکیشن آیفون <i class="bi bi-apple"></i> </button>
        <hr>
        <button data-bs-toggle="collapse" class="btn btn-outline-dark btn-sm w-100 text-dark" data-bs-target="#problem"> <i class="bi bi-question-circle-fill"></i> اگر در نصب مشکل داشتید اینجا کلیک کنید!</button>
        <div id="problem" class="collapse">
        <ul>
            <li>در صورتی که در نصب اپلیکیشن از روی دکمه بالا مشکل داشتید:</li>
            <ul>
                <li class="text-warning">سیستم عامل ios موبایل آیفون:</li>
                    <ol class="text-end">
                        <li>سافاری را باز کنید و به این صفحه بروید.</li>
                        <li>روی آیکون "Share" (آیکون با مربع و فلش) در پایین صفحه کلیک کنید.</li>
                        <li>از منوی باز شده، گزینه "Add to Home Screen" را انتخاب کنید.</li>
                        <li>سپس روی "Add" کلیک کنید تا اپلیکیشن به صفحه اصلی دستگاه شما اضافه شود.</li>
                    </ol>
                <li class="text-warning">سیستم عامل Android موبایل های اندروید:</li>
                <ol class="text-end">
                    <li>گوگل کروم را باز کنید و به این صفحه بروید.</li>
                    <li>هنگامی که پیام "Add to Home Screen" ظاهر شد، روی آن کلیک کنید.</li>
                    <li>در پنجره باز شده، روی "Add" کلیک کنید تا اپلیکیشن به صفحه اصلی دستگاه شما اضافه شود.</li>
                </ol>
            </ul>
        </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('service-worker.js')
                    .then(registration => {
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                    }, error => {
                        console.log('ServiceWorker registration failed: ', error);
                    });
            });
        }

        let deferredPrompt;

        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('installButton').style.display = 'block';
            deferredPrompt.prompt();
        });

        document.getElementById('installButton').addEventListener('click', async () => {
            document.getElementById('installButton').style.display = 'none';
            deferredPrompt.prompt();
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                console.log('User accepted the install prompt');
            } else {
                console.log('User dismissed the install prompt');
            }
            deferredPrompt = null;
        });

        window.addEventListener('appinstalled', (evt) => {
            console.log('B Arts has been installed');
        });
    </script>
</body>
</html>



manifest.json :
{
  "name": "DGcollege",
  "short_name": "DGcollege",
  "description": "This is the DGcollege Progressive Web App.",
  "start_url": "https://dc248.com/roots/.application",
  "display": "fullscreen",
  "background_color": "#f1f1f1",
  "theme_color": "#80D853",
  "icons": [
    {
      "src": "logo.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "logo.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ]
}


service-worker.js :
const CACHE_NAME = 'b-arts-cache-v1';
const urlsToCache = [
  '/',
  '/index.html',
  '/styles.css',
  '/app.js',
  'logo.png'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        return fetch(event.request);
      }
    )
  );
});

self.addEventListener('activate', event => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

//add logo.png
