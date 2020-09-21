// Copyright 2016 Google Inc.

//

// Licensed under the Apache License, Version 2.0 (the "License");

// you may not use this file except in compliance with the License.

// You may obtain a copy of the License at

//

//      http://www.apache.org/licenses/LICENSE-2.0

//

// Unless required by applicable law or agreed to in writing, software

// distributed under the License is distributed on an "AS IS" BASIS,

// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.

// See the License for the specific language governing permissions and

// limitations under the License.



var dataCacheName = 'numekoDataCache-v12';

var cacheName = 'numekoCache-12';

/*********************

CACHELENECEKLER

  Dosyalar:

    index.html (MAIN -> PWA Login)

    header.html

    topbar.html

    footer.html

    index.html (Main -> Login sonrası) Yalnız burada Libs/View.php tarafında bir argüman olması lazım ki html olsun.

  tüm scriptler (Bootstrap, jquery, timepicker, datatable, grafik)

  tüm css'ler (özel ve bootstrap)

  resimler

**********************/

var filesToCache = [

  '/',

  '/index.html',

  '/public/css/default.css'

];



self.addEventListener('install', function(e) {

  // console.log('[ServiceWorker] Install');

  e.waitUntil(

    caches.open(cacheName).then(function(cache) {

      // console.log('[ServiceWorker] Caching app shell');

      return cache.addAll(filesToCache);

    })

  );

});



self.addEventListener('activate', function(e) {

  // console.log('[ServiceWorker] Activate');

  e.waitUntil(

    caches.keys().then(function(keyList) {

      return Promise.all(keyList.map(function(key) {

        if (key !== cacheName && key !== dataCacheName) {

          // console.log('[ServiceWorker] Removing old cache', key);

          return caches.delete(key);

        }

      }));

    })

  );

  /*

   * Fixes a corner case in which the app wasn't returning the latest data.

   * You can reproduce the corner case by commenting out the line below and

   * then doing the following steps: 1) load app for first time so that the

   * initial New York City data is shown 2) press the refresh button on the

   * app 3) go offline 4) reload the app. You expect to see the newer NYC

   * data, but you actually see the initial data. This happens because the

   * service worker is not yet activated. The code below essentially lets

   * you activate the service worker faster.

   */

  return self.clients.claim();

});







// EMRE

// Burasını çıkardım. yerine bir altında bulunan fetch fonksiyonunu koydum.

self.addEventListener('fetch', function(e) {

 // console.log('[Service Worker] Fetch', e.request.url);

 var dataUrl = 'https://numeko.bar/';

 if (e.request.url.indexOf(dataUrl) > -1) {

   /*

    * When the request URL contains dataUrl, the app is asking for fresh

    * weather data. In this case, the service worker always goes to the

    * network and then caches the response. This is called the "Cache then

    * network" strategy:

    * https://jakearchibald.com/2014/offline-cookbook/#cache-then-network

    */

   e.respondWith(

     caches.open(dataCacheName).then(function(cache) {

       return fetch(e.request).then(function(response){

         cache.put(e.request.url, response.clone());

          // console.log("ReelVeri_____________", response);

         return response;

       });

     })

   );

 } else {

   /*

    * The app is asking for app shell files. In this scenario the app uses the

    * "Cache, falling back to the network" offline strategy:

    * https://jakearchibald.com/2014/offline-cookbook/#cache-falling-back-to-network

    */

   e.respondWith(

       caches.match(e.request).then(function (response) {

       if (e.request.cache === 'only-if-cached' && e.request.mode !== 'same-origin') return;

       return response || fetch(e.request);

        console.log("Cache:________", response);

     })

   );

 }

});



// EMRE

// self.addEventListener('fetch', function(event) {

//   event.respondWith(

//     fetch(event.request).catch(function() {

//       return caches.match(event.request);

//     })

//   );

// });







// Emre PUSH Notifications

// TODO 2.6 - Handle the notificationclose event

self.addEventListener('notificationclose', event => {

  const notification = event.notification;

  const primaryKey = notification.data.primaryKey;



  // console.log('Bildirim kapandı: ' + primaryKey);

});

// TODO 2.7 - Handle the notificationclick event

self.addEventListener('notificationclick', event => {

  const notification = event.notification;

  const primaryKey = notification.data.primaryKey;

  const action = event.action;



  if (action === 'close') {

    notification.close();

  } else {

    clients.openWindow('/');

    notification.close();

  }



  // TODO 5.3 - close all notifications when one is clicked



});

// TODO 3.1 - add push event listener

self.addEventListener('push', event => {

  let body;

  // console.log(event.data.text());

  if (event.data) {

    body = event.data.text();

  } else {

    body = 'Mesajınız var.';

  }



  const options = {

    body: body,

    icon: '/images/notification-flat.png',

    vibrate: [100, 50, 100],

    data: {

      dateOfArrival: Date.now(),

      primaryKey: 1

    },

    actions: [

      {action: 'explore', title: 'Hemen incele',

        icon: '/images/checkmark.png'},

      {action: 'close', title: 'Kapat',

        icon: '/images/xmark.png'},

    ]

  };



  event.waitUntil(

    self.registration.showNotification('Push Notification', options)

  );

});
