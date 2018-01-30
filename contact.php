<?php 

$section = "contact";
include("includes/header.php");
include("includes/connection.php");

// Queries the SQL database
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

// Form validation
$error = ""; 
$successMessage = "";
$email = $_POST["email"];



if ($_POST) {
    
    // If name field is empty - return an error
    if (!$_POST["name"]) {
        $error .= "A name is required. <br>";
    } else {
        $name = $_POST["name"];
    }
    
    // If email field is empty - return an error
    if (!$_POST["email"]) {
        $error .= "An email address is required. <br>";
    } else {
        $email = $_POST["email"];
    }
    
    // If event-size is empty - return an error
    if (!$_POST["event-size"]) {
        $error .= "Please select an event size. <br>";
    }
    
    // Email validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $error .= "The email address is invalid. <br>";
    }
    
    if ($error != "") {
        $error = '<div class="alert alert-danger" role="alert"><p><strong>There was an error with your form:</strong></p>' . $error . '</div>';
    } else {
        
        $emailTo = "jardine.miller@gmail.com";
        $subject = "Butterflies Website Enquiry";
        $content = "<html><body>";
        $content .= '<table rules="all" style="border-color: #666; width: 100%;" cellpadding="10">';
        $content .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
        $content .= "<tr><td style='width: 20%'><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
        $content .= "<tr><td style='width: 20%'><strong>Phone:</strong> </td><td>" . strip_tags($_POST['phone']) . "</td></tr>";
        $content .= "<tr><td style='width: 20%'><strong>Event Type:</strong> </td><td>" . strip_tags($_POST['event-type']) . "</td></tr>";
        $content .= "<tr><td style='width: 20%'><strong>Event Size:</strong> </td><td>" . strip_tags($_POST['event-size']) . "</td></tr>";
        $content .= "<tr><td style='width: 20%'><strong>Additional Info:</strong> </td><td>" . strip_tags($_POST['comments']) . "</td></tr>";
        $content .= "</table>";
        $content .= "</html></body>";
        $headers = "From: enquiries@butterflies-hire.co.uk". "\r\n";
        $headers .= "Reply-To: ". strip_tags($_POST['$email']) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        if (mail($emailTo, $subject, $content, $headers)) {
            $successMessage = '<div class="alert alert-success" role="alert"><p>Your message was sent.</p></div>';
        } else {
            $error = '<div class="alert alert-danger" role="alert"><p>Your message could not be sent.</p></div>';
        }
        
        
        $query = "INSERT INTO `cl52-maildb`.`users` (`id` ,`name` ,`email` ,`last_contact`,`added`)VALUES (NULL , '$name', '$email', NULL, CURRENT_TIMESTAMP)";
    
        if(mysqli_query($connection, $query)){
            
        } else {
            echo "Error". $query . "<br>" . mysqli_error($connection);
        }
        
    }
    

}



?>

<div class="wrapper">
	<div id="map" style="height: 95vh;"></div>
	<div class="over_map1">
		<div class="container-fluid">
			<div class="col-md-3 col-md-offset-7">
				<!-- <div class="box-black"> -->
					<div class="box-white">
						<h4 class="orange form-head" style=" margin: 0 0 25px 0;">Butterflies Catering Equipment Hire</h4>
                        <ul class="contact-list">
                            <li>Unit 10</li>
                            <li>Elm Tree Business Park</li>
                            <li>Sheepway</li>
                            <li>Portbury</li>
                            <li>North Somerset</li>
                            <li>BS20 7TF</li>
                        
                            <li style="margin-top: 10px;"><a href="mailto:imogen@butterflies-hire.co.uk">imogen@butterflies-hire.co.uk</a><br></li>
                            <li><a href="tel:01275375545">01275&nbsp;375&nbsp;545</a></li>
                        </ul>
                        <button type="button" id="enquire" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-butterflies" style="margin-bottom: 0;">Send a message</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title form-head center" id="myLargeModalLabel">Send A Message</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                    <h5 class="col-sm-12 form-instr">Please provide some contact details with details of your event so that we can help you find exactly what you need.</h5>
               </div>
               <div id="error"><? echo $error.$successMessage; ?></div>
                <form method="post" style="margin-top: 15px;">
                   <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="name" class="col-form-label">Name: <span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="email" class="col-form-label">Email: <span style="color: red;">*</span></label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group col-sm-6">
	                           <label for="phone" class="col-form-label">Phone Number:</label>
	                            <input type="tel" class="form-control" name="phone" id="phone">
	                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                           <label for="event-type" class="col-form-label">Event Type:</label>
                            <select class="form-control" name="event-type" id="event-type">
                               <option selected disabled>Please select</option>
                                <option value="Wedding">Wedding</option>
                                <option value="Something">Something else</option>
                                <option value="One More Thing">One more thing</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                           <label for="event-size" class="col-form-label">Event Size: <span style="color: red;">*</span></label>
                            <select class="form-control" name="event-size" id="event-size" required>
                               <option selected disabled>Please select</option>
                                <option value="1 - 10">1 - 10</option>
                                <option value="20 - 50">20 - 50</option>
                                <option value="50 - 100">50 - 100</option>
                                <option value="100+">100+</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                           <label for="comments" class="col-form-label">Additional Comments:</label>
                            <textarea class="form-control" name="comments" id="comments" rows="10"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-butterflies">Submit</button>
                    <label style="color: #999; padding: 0 10px;"for="email">*We will never share your contact details with anyone else.</label>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
      function initMap() {
        var butterflies = {lat: 51.4810246, lng: -2.7418519999999944};
        var center = {lat: 51.3810246, lng: -2.418519999999944};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 9,
          center: center,
          styles: [
         		{ "stylers": [ { "hue": "#FF5800" }, { "saturation": 100 } ] },
			    { "featureType": "water", "stylers": [ { "color": "#ffffff" } ] },
			    { "featureType": "administrative.country", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },
			    { "featureType": "administrative.land_parcel", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.neighborhood", "stylers": [ { "visibility": "off" } ] }, 
			    { "featureType": "poi", "elementType": "labels.text", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, 
			    { "featureType": "water", "elementType": "labels.text", "stylers": [ { "visibility": "off" } ] },
			    { "featureType": "road.arterial", "stylers": [ { "visibility": "off" } ] }, 
			    { "featureType": "road.highway", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, 
			    { "featureType": "road.local", "stylers": [ { "visibility": "off" } ] }, 
			    { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#ff5800" } ] }, 
			    { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#000" } ] }
	    	]
        });

        map.setOptions({'scrollwheel': false, 'disableDefaultUI': true,});

        var marker = new google.maps.Marker({
          position: butterflies,
          map: map
        });


      }
    

</script>



 <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgaHw4fcx4oUxuEuTUBAKZNMgv8lZl9Bo&callback=initMap">
 </script>

<?php include("includes/footer.php"); ?>