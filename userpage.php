<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MNZ Horizon</title>
<link rel="icon" href="M n zEE (1)_adobe_express.png">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-0sK4p4n3e7Jd0od2bXR4BOjfUqH8SbYsOFLrDJLvo4p2oFEmkE0lzcusvG4VpOEf" crossorigin="anonymous">
<style>
  /* Overall layout styles */
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f8f9fa; /* Light grayish background */
    position: relative; /* Position relative for the footer */
  }
  
  .container {
    display: flex;
    flex-direction: column;
    padding: 20px;
    border-radius: 10px; /* Rounded corners */
    margin: 20px auto; /* Add margin for separation */
    background-image: url('background.png'); /* Add background image */
    background-size: cover; /* Cover the entire container */
    background-position: center; /* Center the background image */
    position: relative; /* Position relative for child elements */
    /* Define linear gradient background */
    background: linear-gradient(45deg, #a8c0ff, #ffa8e0);
}


  
  /* Styles for MNZ Horizon */
  .mnz-horizon {
    font-size: 24px;
    color: #333;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center; /* Align text and image vertically */
  }
  
  /* Styles for the top-right buttons */
  .top-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    position: absolute; /* Position absolute within container */
    top: 20px; /* Adjust the distance from the top */
    right: 20px; /* Adjust the distance from the right */
  }
  
  .first-row {
    display: flex;
    align-items: center;
    gap:5px;
  }
  
  .second-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap; /* Allow buttons to wrap to the next line */
    gap:5px;
  }
  
  /* Adjust button styles */
.top-right button {
  margin-left: 10px;
  margin-bottom: 10px; /* Add margin between buttons */
  padding: 8px 16px; /* Reduced padding */
  font-size: 14px; /* Reduced font size */
  color: #333333; /* Text color */
  border: none; /* Remove border */
  border-radius: 50px; /* Make the border radius half of the button's height to create an ellipse */
  cursor: pointer;
  display: flex;
  align-items: center;
  transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for color change, transform, and box-shadow */
}

/* Change button color on hover */
.top-right button:hover {
  background-color: #65baff; /* Change to desired color */
  transform: scale(1.05); /* Scale up on hover */
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Add shadow effect on hover */
}

  /* Dropdown container */
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  /* Dropdown content (hidden by default) */
  .dropdown-content {
    font-family: 'fantasy'; 
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: #fff;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    padding: 20px;
    height: auto; /* Extend based on the content */
    overflow-y: auto; /* Add scrollbar if content overflows */
  }
  
  /* Links inside the dropdown */
  .dropdown-content a {
    font-family: 'fantasy'; 
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  /* Remove underline from links */
  a {
    text-decoration: none;
  }
  
  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {
    background-color: #a6fff8;
  }
  
  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content {
    display: block;
  }
  
  /* Style for the image */
  .photo {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    opacity: 0.5; /* Adjust opacity as needed */
  }
  
  /* Style for photo input container */
  .photo-input-container {
    width: 100%; /* Fill the container */
    height: 800px; /* Adjust the height as needed */
    background-color: #fff; /* White background */
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Box shadow */
    margin-top: 20px; /* Add margin */
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    position: relative;
  }
  
  /* Style for photo input */
  .photo-input {
    display: none; /* Hide the input */
  }

  /* Style for container to push content above the footer */
.container {
  flex: 1; /* Fill remaining vertical space */
  margin-bottom: 0; /* Remove margin bottom */
}
/* Font style for buttons */
.top-right button {
  font-family: 'fantasy'; /* Change to desired font family */
  font-weight: bold; /* Make the font bold */
  text-transform: uppercase; /* Transform text to uppercase */
}

/* Style for tagline */
.tagline {
  font-family: 'ciao'; /* Change to desired font family */
  font-size: 30px; /* Adjust font size */
  font-weight: bold; /* Make the font bold */
  color: #333; /* Dark color for better readability */
  text-align: center; /* Center-align text */
  margin-top: 20px; /* Add margin from the top */
  padding: 0 20px; /* Add padding to space out the text */
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Add shadow effect */
  transform: scale(1); /* Initial scale */
  transition: transform 0.3s ease; /* Add transition effect */
}

/* Add hover effect */
.tagline:hover {
  transform: scale(1.1); /* Scale up on hover */
}

/* Style for footer */
footer {
  background-color: #004080; /* Change to the desired background color */
  color: #fff; /* White text color */
  padding: 40px 0; /* Padding for content within footer */
  text-align: center; /* Center-align text */
  width: 100%; /* Full width */
  bottom: 0; /* Stick to the bottom */
}

/* Style for footer columns */
.footer-columns {
  display: flex;
  justify-content: space-around;
}

/* Style for individual footer column */
.footer-column {
  width: 30%; /* Adjust width as needed */
}

/* Style for footer heading */
.footer-heading {
  font-weight: bold;
  margin-bottom: 20px;
}

/* Style for footer content */
.footer-content { 
  font-family: 'fantasy';
  font-size: 16px; /* Adjust font size */
  font-weight: bold; /* Make the font bold */
}

/* Style for footer links */
footer a {
  font-family: 'fantasy';
  color: #fff; /* White text color for links */
  text-decoration: none; /* Remove underline */
  margin: 0 10px; /* Add margin to separate links */
}

</style>
</head>
<body>
<div class="container">
  <!-- MNZ Horizon -->
  <div class="mnz-horizon">
    <img src="M n zEE (1)_adobe_express.png" style="width: 100px; height: 100px; float: left;">
  </div>

  <!-- Top right buttons -->
  <div class="top-right">
    <!-- First row buttons -->
<div class="first-row">
  <button onclick="scrollToFooter()"><i class="fas fa-envelope"></i> Contact Us</button>
  <a href="support.html">
    <button><i class="fas fa-life-ring"></i> Support</button>
  </a>
  <a href="userprofile.php">
    <button><i class="fas fa-user-plus"></i> User Profile</button>
  </a>
</div>

    <!-- Second row buttons -->
    <div class="second-row">
      <div class="dropdown">
        <button class="dropbtn"><i class="fas fa-book"></i> Book & Manage</button>
        <div class="dropdown-content">
          <a href="booking.php">Search Flights & Book</a>
          <!--<a href="flightDisplay.html">Manage Booking</a>-->
          <a href="seatselection.html">Seat Selection </a>
          <a href="ticketConf.html">Flight Ticket</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn"><i class="fas fa-globe"></i> Where We Fly</button>
        <div class="dropdown-content">
          <a href="routemap.html">Route Map</a>
          <a href="flightbooking.php">Popular Flights</a>
        </div>
      </div>
      <div class="dropdown">
        <button class="dropbtn"><i class="fas fa-suitcase"></i> Prepare to Travel</button>
        <div class="dropdown-content">
          <a href="baggageguidelines.html">Baggage Guidelines</a>
          <a href="traveltips.html">Travel Tips</a>
          <a href="healthandmedical.html">Health and Medical Assistance</a>
        </div>
      </div>
      <a href="experience.html">
      <button><i class="fas fa-hands-helping"></i> MNZ Experience</button></a>
    </div>
  </div>
  
  <!-- Photo input container -->
  <div class="photo-input-container">
    <input type="file" class="photo-input" accept="image/*">
    <i class="fas fa-camera"></i>
    <img src="background.jpg" class="photo" alt="Background">
    <div class="tagline" id="tagline">
      Unlock Limitless Horizons with MNZ: Where Every Journey Inspires
    </div>
  </div>
</div>

<!-- Footer -->
<footer id="footer">
  <div class="footer-columns">
    <div class="footer-column">
      <div class="footer-content">
        <p>Manohara M</p>
        <p>manoharamambady@gmail.com</p>
        <p>+91 9482402873</p>
      </div>
    </div>
    <div class="footer-column">
      <div class="footer-content">
        <p>Mohammad Zaafir</p>
        <p>mohammadzaafir123@gmail.com</p>
        <p>+91 8088422835</p>
      </div>
    </div>
    <div class="footer-column">
      <div class="footer-content">
        <p>Nithin</p>
        <p>nithinshetty949@gmail.com</p>
        <p>+91 7892162963</p>
      </div>
    </div>
  </div>
</footer>
<script>
  // JavaScript function to scroll to the footer
  function scrollToFooter() {
    const footer = document.getElementById('footer');
    footer.scrollIntoView({ behavior: 'smooth' });
  }
</script>
</body>
</html>
