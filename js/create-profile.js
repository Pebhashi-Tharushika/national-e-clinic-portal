window.onload = function () {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.has('status') && urlParams.get('status') === 'success') {
      // Clear local form data
      document.getElementById('step1Form').reset();
      document.getElementById('step2Form').reset();
  }
};


// document.getElementById('appointment-form').addEventListener('submit', function(event) {
//   event.preventDefault(); 

//   const fname = document.getElementById('fname').value;
//   const lname = document.getElementById('lname').value;
//   const email = document.getElementById('email').value;
//   const nic = document.getElementById('nic').value;
//   const phone = document.getElementById('phone').value;
//   const address = document.getElementById('address').value;
//   const bdate = document.getElementById('bdate').value;
//   const province = document.getElementById('province').value;
//   const date = document.getElementById('date').value;
//   const time = document.getElementById('time').value;

//   if (!fname || !lname || !email || !nic || !phone || !address || !bdate || !province || !date) {
//       alert('Please fill out all fields.');
//       return;
//   }

//   document.getElementById('confirmation-message').innerText = `Appointment booked successfully for ${name} on ${date} at ${time}.`;

// });
