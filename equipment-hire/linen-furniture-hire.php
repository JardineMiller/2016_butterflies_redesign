<?php 

$section = "equipment";
include("../includes/header.php"); 
include("../includes/linen.php");

?>



<section class="equipment linen">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="equipment-heading">Linen &amp; Furniture</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-push-8 equipment-info clearfix">
                <p>Butterflies table linen is available in a variety of colours and sizes. Our high quality laundering service ensures all linen is delivered in individually sealed packs which are clearly marked as to size and content.</p>
                <h3 class="ranges">Our Ranges</h3>
                <div class="col-xs-6" style="padding: 0;">
                <h4 class="orange">Tableclothes<br>Square:</h4>
                    <ul>
                        <li>36" x 36" (91cm x 91cm)</li>
                        <li>54" x 54" (137cm x 137cm)</li>
                        <li>70" x 70" (178cm x 178cm)</li>
                        <li>90" x 90" (228cm x 228cm)</li>
                    </ul>
                </div>
                <div class="col-xs-6" style="padding: 0;">
                    <h4 class="orange">Tableclothes<br>Rectangular:</h4>
                    <ul>
                        <li>70" x 108" (178cm x 274cm)</li>
                        <li>70" x 144" (178cm x 365cm)</li>
                    </ul>
                </div>
                <div class="col-xs-12" style="padding: 0;">
                    <div class="col-xs-6" style="padding: 0;">
                        <h4 class="orange">Tableclothes<br>Round:</h4>
                        <ul>
                            <li>90" (228cm)</li>
                            <li>108" (274cm)</li>
                            <li>120" (305cm)</li>
                            <li>130" (330cm)</li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <h4 class="orange">Napkins:</h4>
                        <ul>
                            <li>22" x 22" (56cm x 56cm)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0;">
                    <div class="col-xs-6" style="padding: 0;">
                       <h4 class="orange">Tables</h4>
                        <ul>
                            <li>3ft round table</li>
                            <li>4ft round table</li>
                            <li>5ft round table</li>
                            <li>6ft round table</li>
                            <li>6ft trestle table</li>
                        </ul>
                    </div>
                    <div class="col-xs-6" style="padding: 0;">
                       <h4 class="orange">Chairs</h4>
                        <ul>
                            <li>Gold Banqueting Chair</li>
                            <li>Silver Banqueting Chair</li>
                            <li>White Bistro Chair</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12" style="padding: 0;">
                   <br>
                    <p>We offer a wide selection of colours and sizes. please refer to our linen chart for details.</p>
                </div>
                <div class="col-sm-12" style="padding: 0;">
                    <a href="../files/linen-table-chart.pdf" target="_blank">
                        <button class="col-xs-12 btn btn-butterflies hvr-fade">View Chart</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-8 col-sm-pull-4">
                <div class="col-sm-12">
                    <div class="linen-main box">
                        <img src="../images/linen/linen-main.JPG" alt="">
                    </div>
                </div>
                
                <?php 
                
                $i = 1; 
                foreach ($linen as $index) { ?>
                    <div class="col-sm-3">
                        <div class="linen box" id="linen-<?php echo $i; ?>"><img src="<?php echo $index[src]; ?>" alt="<?php echo $index[name]; ?>"></div>
                    </div>
                   <?php $i++;
                }; ?>
                
            </div>
        </div>
    </div>
</section>



<?php include("../includes/footer.php");  ?>
