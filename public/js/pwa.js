/*
Copyright 2018 Google Inc.
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at
    http://www.apache.org/licenses/LICENSE-2.0
Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/
// Store

// Constant değişkenin ismini app 'ten aplikasyon'a çevirdim.
const aplikasyon = (() => {
  'use strict';
  let isSubscribed = false;
  let swRegistration = null;
  // TODO 2.1 - check for notification support
  if (!('Notification' in window)) {
    console.log('This browser does not support notifications!');
    return;
  }
  // TODO 2.2 - request permission to show notifications
  Notification.requestPermission(status => {
    console.log('Notification permission status:', status);
  });
  function initializeUI() {
    // TODO 3.3b - add a click event listener to the "Enable Push" button
    // and get the subscription object
    swRegistration.pushManager.getSubscription()
    .then(subscription => {
      isSubscribed = (subscription !== null);
      updateSubscriptionOnServer(subscription);
      if (isSubscribed) {
        console.log('User IS subscribed.');
      } else {
        console.log('User is NOT subscribed.');
      }
      updateBtn();
    });
  }
  // TODO 4.2a - add VAPID public key
  function subscribeUser() {

    // TODO 3.4 - subscribe to the push service
    swRegistration.pushManager.subscribe({
      userVisibleOnly: true
    })
    .then(subscription => {
      console.log('User is subscribed:', subscription);
      updateSubscriptionOnServer(subscription);
      isSubscribed = true;
      updateBtn();
    })
    .catch(err => {
      if (Notification.permission === 'denied') {
        console.warn('Permission for notifications was denied');
      } else {
        console.error('Failed to subscribe the user: ', err);
      }
      updateBtn();
    });
  }
  function unsubscribeUser() {
    // TODO 3.5 - unsubscribe from the push service
    swRegistration.pushManager.getSubscription()
    .then(subscription => {
      if (subscription) {
        return subscription.unsubscribe();
      }
    })
    .catch(err => {
      console.log('Error unsubscribing', err);
    })
    .then(() => {
      updateSubscriptionOnServer(null);
      console.log('User is unsubscribed');
      isSubscribed = false;
      updateBtn();
    });
  }
  function updateSubscriptionOnServer(subscription) {
    // Here's where you would send the subscription to the application server
    const subscriptionJson = document.querySelector('.js-subscription-json');
    const endpointURL = document.querySelector('.js-endpoint-url');
    const subAndEndpoint = document.querySelector('.js-sub-endpoint');

    if (subscription) {
      subscriptionJson.textContent = JSON.stringify(subscription);
      endpointURL.textContent = subscription.endpoint;
      subAndEndpoint.style.display = 'block';
      let sc = JSON.stringify(subscription);
      // Güncellenen subscription'ı lokal veritabanına yazdırıyoruz.

      if(localStorage.getItem("uniqueSubscription") === null) {
        $.post('/app/araclar/addSubscription', { sc:sc }, function() {})
        .done(function(data){
          console.log(data);
          localStorage.setItem("uniqueSubscription", data);
        });
      } else {
        let uniqueSubscription = localStorage.getItem("uniqueSubscription");
        $.post('/app/araclar/updateSubscription', { sc:sc, us:uniqueSubscription }, function() {})
        .done(function(data){
          console.log(data);
        });
      }
    } else {
      subAndEndpoint.style.display = 'none';
    }
  }
  function updateBtn() {
    if (Notification.permission === 'denied') {
      updateSubscriptionOnServer(null);
      return;
    }
  }
  function urlB64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4);
    const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
      outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
  }
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      console.log('Service Worker and Push is supported');
      navigator.serviceWorker.register('service-worker.js')
      .then(swReg => {
        console.log('Service Worker is registered', swReg);
        swRegistration = swReg;
        // TODO 3.3a - call the initializeUI() function
        initializeUI();
      })
      .catch(err => {
        console.error('Service Worker Error', err);
      });
    });
  } else {
    console.warn('Push messaging is not supported');
  }

    // EMRE install app
    let promtEvent;
    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent Chrome 67 and earlier from automatically showing the prompt
        e.preventDefault();
        localStorage.setItem("uygulamaYuklendimi", false);
        btnAdd.removeAttribute("disabled", "");
        btnAdd.innerText = 'Uygulamayı Yükle';
        // Stash the event so it can be triggered later.
        promtEvent = e;
        // satinalmaKodu.style.display = 'block';
    });
   btnAdd.addEventListener('click', (e) => {
    console.log(window);
        // hide our user interface that shows our A2HS button
       // $('#ayarlarModal').modal('hide');
       // $('#satinalmaKodu').collapse();
        // Show the prompt
        if(promtEvent) promtEvent.prompt();
        // Wait for the user to respond to the prompt
        promtEvent.userChoice
            .then((choiceResult) => {
                promtEvent = null;
            });
   });
    const installed = function(e) {
      promtEvent = null;
      // This fires after onbeforinstallprompt OR after manual add to homescreen.
      localStorage.setItem("uygulamaYuklendimi", true);
    };
     window.addEventListener('appinstalled', installed);
    // EMRE install app END
})();

// Artık yükleme tamamlandığında kullan, service worker işlerini yukarıda yap.
jQuery(document).ready(function($) {
  if(localStorage.getItem("uygulamaYuklendimi") == "true" || window.matchMedia('(display-mode: standalone)').matches) {
      btnAdd.setAttribute("disabled", "");
      btnAdd.innerText = 'Uygulama Yüklendi';
  }
});
