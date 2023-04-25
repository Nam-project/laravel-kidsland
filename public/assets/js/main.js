// Get the input element
var input = document.querySelector('.details__quantity-add .details__quantity-input');

// Get the minus button
var minusButton = document.querySelector('.details__quantity-add .minus-btn');

// Get the plus button
var plusButton = document.querySelector('.details__quantity-add .plus-btn');

// Add event listener for minus button
// minusButton.addEventListener('click', function () {
//     // Get the current value of the input
//     var currentValue = parseInt(input.value);

//     // If the current value is greater than 1, decrement it
//     if (currentValue > 1) {
//         input.value = currentValue - 1;
//     }
// });

// Add event listener for plus button
// plusButton.addEventListener('click', function () {
//     // Get the current value of the input
//     var currentValue = parseInt(input.value);

//     // If the current value is less than 100, increment it
//     if (currentValue < 100) {
//         input.value = currentValue + 1;
//     }
// });

// 
function scrollToElement(id) {
  var element = document.getElementById(id);
  element.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Cart update
// function updateCartCount() {
//   fetch('/cart/count')
//     .then(response => {
//       if (!response.ok) {
//         throw new Error('Network response was not ok');
//       }
//       return response.json();
//     })
//     .then(data => {
//       // Lấy số lượng mặt hàng từ dữ liệu JSON
//       const count = data.count;

//       // Hiển thị số lượng mặt hàng trên trang web
//       const countElement = document.querySelector('.cart__number');
//       if (countElement) {
//         countElement.innerText = count + 1;
//       } else {
//         console.error('The cart count element could not be found.');
//       }
//     })
//     .catch(error => {
//       console.error('There was a problem with the fetch operation:', error);
//     });
// }


// Clock
// Set the date we're counting down to
var countDownDate = new Date("2023/04/30 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function () {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  if (document.getElementById("demo") !== null) {
    document.getElementById("demo").innerHTML = `${hours.toString().length >= 2 ? hours : '0' + hours}` + " : "
      + `${minutes.toString().length >= 2 ? minutes : '0' + minutes}` + " : " + `${seconds.toString().length >= 2 ? seconds : '0' + seconds}` + "";
    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }


}, 1000);
