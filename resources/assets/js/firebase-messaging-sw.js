// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here, other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/6.3.4/firebase-messaging.js');
var config = {
    apiKey: "AIzaSyBXdTNczFlvE1koz3HYZWSWDFyJU10vCFM",
    authDomain: "nomasi-solutions-tp.firebaseapp.com",
    databaseURL: "https://nomasi-solutions-tp.firebaseio.com",
    projectId: "nomasi-solutions-tp",
    storageBucket: "",
    messagingSenderId: "296694516593",
    appId: "1:296694516593:web:08611e56574d6cc6bc44d0"
}
// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp(config);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload){
    console.log(payload)
    const title = 'Nomasi Solutions'
    const options = {
        body: payload
    }
    return self.registration.showNotification(title, options)
})
