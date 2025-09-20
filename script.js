 const form = document.getElementById("registrationForm");
 const message = document.getElementById("message");

 form.addEventListener("submit", function (e) {
  const phone = form.phone.value;
  if (phone.length < 10) {
    e.preventDefault();
    message.textContent = "Phone number must be at least 10 digits";
    message.style.color = "red";
  }
  else { // Only proceed with submission if phone number is valid
    // Prevent the default form submission (page reload)
    e.preventDefault();
    
    // Get all form data
    const formData = new FormData(form);

    // Send the data to insert.php using the fetch API
    fetch(form.action, {
      method: 'POST',
      body: formData,
    })
    .then(response => response.json()) // Get the JSON response from the server
    .then(data => {
      // Check the response status
      if (data.status === 'success') {
        alert('✅ ' + data.message);
        // Redirect to the event registration page after a successful submission
        window.location.href = 'event.html'; 
      } else {
        alert('❌ Error: ' + data.message);
        form.reset(); // Clear the form on error
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An unexpected error occurred. Please try again.');
    });
  }
 });