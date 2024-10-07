
function sendEventToServer(eventType) {
fetch('/script/php/track_event.php', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    event: eventType,
    timestamp: new Date().toISOString().split('T')[0] // Только дата
  })
});
}

document.addEventListener('DOMContentLoaded', function() {
sendEventToServer('visit');
});

document.getElementById('registerButton').addEventListener('click', function() {
sendEventToServer('registration');
});

// document.getElementById('purchaseButton').addEventListener('click', function() {
// sendEventToServer('purchase');
// });
