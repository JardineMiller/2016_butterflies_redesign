<?php 

$section = "main";
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
        
        
        $query = "INSERT INTO `db_butterflies`.`users` (`id` ,`name` ,`email` ,`last_contact`,`added`)VALUES (NULL , '$name', '$email', NULL, CURRENT_TIMESTAMP)";
    
        if(mysqli_query($connection, $query)){
            
        } else {
            echo "Error". $query . "<br>" . mysqli_error($connection);
        }
        
    }
    

}



?>
    
<div class="jumbo">
   <div class="container">
        <div class="jumbo-text">
            <h1 class="animated">Butterflies</h1>
            <h2 class="animated">Catering Equipment Hire</h2>
            <h3 class="animated">Turning Your Event Into An Occasion</h3>
        </div>
        <button class="scroll-down animated hidden-xs">
            <span class="glyphicon glyphicon-menu-down"></span>
        </button>
    </div>
</div>
   
<section id="usp">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 center">
                <h3 class="usp-heading orange">Delivery & Collection</h4>
                <!-- <span class="glyphicon glyphicon-star"></span> -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare mattis lobortis. Quisque feugiat dapibus sapien nec suscipit. Aenean sodales orci at neque fringilla ullamcorper. Ut eu commodo elit, vel congue sem. Suspendisse dictum augue id hendrerit hendrerit</p>
            </div>
            <div class="col-sm-4 center">
                <h3 class="usp-heading orange">Free Washing Up</h4>
                <!-- <span class="glyphicon glyphicon-tint"></span> -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare mattis lobortis. Quisque feugiat dapibus sapien nec suscipit. Aenean sodales orci at neque fringilla ullamcorper. Ut eu commodo elit, vel congue sem. Suspendisse dictum augue id hendrerit hendrerit</p>
            </div>
            <div class="col-sm-4 center">
                <h3 class="usp-heading orange">7 Day Service</h4>
                <!-- <span class="glyphicon glyphicon-ok-sign"></span> -->
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ornare mattis lobortis. Quisque feugiat dapibus sapien nec suscipit. Aenean sodales orci at neque fringilla ullamcorper. Ut eu commodo elit, vel congue sem. Suspendisse dictum augue id hendrerit hendrerit</p>
            </div>
        </div>
    </container>
</section>

<section id="getQuote">
    <div class="container">
        <h3 class="cta col-sm-6 col-xs-12">Get a free quote today</h2>
        <button type="button" id="enquire" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-butterflies col-sm-4 col-sm-offset-1 col-xs-12">Click to enquire</button>
    </div>
</section>
  
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="form-head center" id="myLargeModalLabel">Enquiry Form</h4>
            </div>
            <div class="modal-body">
               <div class="row">
                    <h5 class="col-sm-12 form-instr">Please provide some contact information with details of your event so that we can help you find exactly what you need.</h5>
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
   
<section id="products">
    <div class="container">
       <div class="row">
           <div class="col-sm-12">
               <h2 class="section-heading">Catering Equipment</h3>
           </div>
       </div>
        <div class="row">
            <div class="col-sm-4 ">
               <a href="/equipment-hire/china-hire.php">
	                    <div class="product-tile" id="china">
	                        <h3 class="product-title">China</h3>
	                        <div class="overlay"></div>
	                    </div>
                </a>   
            </div>
            <div class="col-sm-4">
               <a href="/equipment-hire/cutlery-hire.php">
                    <div class="product-tile" id="cutlery">
                        <h3 class="product-title">Cutlery</h3>
                        <div class="overlay"></div>
                    </div>
                </a>   
            </div>
            <div class="col-sm-4">
               <a href="/equipment-hire/kitchen-equipment-hire.php">
                    <div class="product-tile" id="kitchen-equipment">
                        <h3 class="product-title">Kitchen Equipment</h3>
                        <div class="overlay"></div>
                    </div>
                </a>   
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
               <a href="//equipment-hire/glassware-hire.php">
                    <div class="product-tile" id="glassware">
                        <h3 class="product-title">Glassware</h3>
                        <div class="overlay"></div>
                    </div>
                </a>   
            </div>
            <div class="col-sm-4">
               <a href="/equipment-hire/linen-furniture-hire.php">
                    <div class="product-tile" id="linen-furniture">
                        <h3 class="product-title">Linen &amp; Furniture</h3>
                        <div class="overlay"></div>
                    </div>
                </a>   
            </div>
            <div class="col-sm-4">
               <a href="/equipment-hire/finishing-touches.php">
                    <div class="product-tile" id="finishing-touches">
                        <h3 class="product-title">Finishing Touches</h3>
                        <div class="overlay"></div>
                    </div>
                </a>   
            </div>
        </div>
    </div>
</section>
   

    
<div class="container-fluid aboutbg">
    <section id="about">
        <div class="container">
            <div class="box-white">
                <div class="box-grey">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="section-heading">About Us</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <p>Established in 1991 our family managed company has several decades of experience in catering hire as well as catering.</p>
                            <p>Our dedicated team understand the importance of your event and are trained to provide the highest level of assistance to our customers. We want to ensure your event runs efficiently from start to finish. Whether you are organising a <span class="orange">wedding</span> or a <span class="orange">high profile event for 1,500 guests</span> or more, Butterflies utilises its extensive resources to ensure you order exactly the equipment you require; nothing more, nothing less.</p>
                            <p>We hope you enjoy browsing our web site. Butterflies will make a success of every event and we believe our customers will enjoy the Butterflies experience because…</p>
                            <p class="orange pull-right">…we provide excellence in everything we deliver and our most important customer is you.</p><br>
                        </div>
                        <div class="col-sm-12" style="text-align: center"><a href="/equipment-hire/china-hire.php" class="btn btn-butterflies center">View Products</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
   
<section id="contact">
<div class="container">
    <div class="row">
       <div class="col-sm-12">
           <h2 class="section-heading">Contact Us</h2>
       </div>
   </div>
   <div class="row">
         <div class="col-sm-4 contact">
             <div id="call">
                <a href="tel:(+44)1275375545">
                     <span class="glyphicon glyphicon-earphone"></span>
                     <p class="lead">01275&nbsp;375&nbsp;545</p>
                 </a>
             </div>
         </div>
         <div class="col-sm-4 contact">
             <div id="email">
                 <a href="mailto:imogen@butterflies-hire.co.uk">
                     <span class="glyphicon glyphicon-envelope"></span>
                     <p class="lead">imogen@butterflies-hire.com</p>
                 </a>
             </div>
         </div>
         <div class="col-sm-4 contact">
             <div id="price">
                <a href="files/pricelist.xlsx">
                     <span class="glyphicon glyphicon-list-alt"></span>
                     <p class="lead">Order Form</p>
                 </a>
             </div>
         </div>
    </div>
</div>
</section>

<div class="wrapper">
	<div id="map"></div>
	<div class="over_map">
		<div class="container">
			<!-- <div class="box-black col-md-8 col-md-offset-2"> -->
				<div class="box-white col-md-8 col-md-offset-2">
					<div class="row">
						<h4 class="center form-head" style="color: #FF5800; margin-bottom: 15px;">Send A Message</h4>
					</div>
					<form method="post" style="margin-top: 15px;">
	                   <div class="row">
	                        <div class="form-group col-sm-6">
	                            <label for="name1" class="col-form-label">Name: <span style="color: red;">*</span></label>
	                            <input type="text" class="form-control" name="name1" id="name1" required>
	                        </div>
	                        <div class="form-group col-sm-6">
	                           <label for="email1" class="col-form-label">Email: <span style="color: red;">*</span></label>
	                            <input type="email" class="form-control" name="email1" id="email1" required>
	                        </div>
	                        <div class="form-group col-sm-6">
	                           <label for="phone1" class="col-form-label">Phone Number:</label>
	                            <input type="tel" class="form-control" name="phone1" id="phone1">
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="form-group col-sm-6">
	                           <label for="event-type1" class="col-form-label">Event Type:</label>
	                            <select class="form-control" name="event-type1" id="event-type1">
	                               <option selected disabled>Please select</option>
	                                <option value="Wedding">Wedding</option>
	                                <option value="Something">Something else</option>
	                                <option value="One More Thing">One more thing</option>
	                            </select>
	                        </div>
	                        <div class="form-group col-sm-6">
	                           <label for="event-size1" class="col-form-label">Event Size: <span style="color: red;">*</span></label>
	                            <select class="form-control" name="event-size1" id="event-size1" required>
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
	                           <label for="comments1" class="col-form-label">Additional Comments:</label>
	                            <textarea class="form-control" name="comments1" id="comments1" rows="5"></textarea>
	                        </div>
	                    </div>
	                    <button type="submit" class="btn btn-butterflies">Submit</button>
	                    <label style="color: #999; padding: 0 10px;">*We will never share your contact details with anyone else.</label>
	                </form>
				</div>
			<!-- </div> -->
		</div>
	</div>
</div>




<script>
      function initMap() {
        var butterflies = {lat: 51.4810246, lng: -2.7418519999999944};
        var center = {lat: 51.3810246, lng: -1.118519999999944};
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