<div class="container-fluid contact-box-container" style="margin-top:<?php echo $top ?>;padding:20px;">
    <div class="container contact-box">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 title-box">
                <?php
                    if($pheasa=="en"){
                        $title="OUR INFORMATION";
                    }else{
                        $title="ព័ត៌មានរបស់យើង";
                    }
                ?>
                <h1><?php echo $title; ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 item-box">
                <div class="box">
                    <i class="fas fa-map-marker-alt"></i>
                </div> 
                <p>
                    TOA Coating (Cambodia) Co.,Ltd 
                    <br>Sales Office: The Point Community Mall
                    <br>No.#113C, Mao Tse Tung Blvd, Sangkat Toul Svay Prey,
                    <br>Khan Beong Keng Kong Phnom Penh, Cambodia.                
                </p>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 item-box">
                <div class="box">
                    <i class="fas fa-envelope"></i>
                </div>
                <p>
                    info.toacambodia@toagroup.com 
                </p>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 item-box">
                <div class="box">
                    <i class="fas fa-phone"></i>
                </div>
                <p>
                    Product information: (+855) 095 999 538
                </p>
            </div>
        </div>
        <div class="row frm-submit">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 title-box">
                <?php
                    if($pheasa=="en"){
                        $title="SUBMIT YOUR INFORMATION";
                    }else{
                        $title="បញ្ជូនព័ត៌មានរបស់អ្នក";
                    }
                ?>
                <h1><?php echo $title; ?></h1>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 thanks-contact">
                <h1>
                </h1>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 control">
                <input type="text" name="" id="txt-fname" class="frm-control" placeholder="Last Name" autocomplete="off">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 control">
                <input type="text" name="" id="txt-lname" class="frm-control" placeholder="First Name" autocomplete="off">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 control">
                <input type="text" name="" id="txt-phone" class="frm-control" placeholder="Phone" autocomplete="off">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 control">
                <input type="text" name="" id="txt-email" class="frm-control" placeholder="Email" autocomplete="off">
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 control">
                <textarea name="" id="txt-sms" rows="10" class="frm-control" placeholder="Description"></textarea>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm012 col-12 submit-footer">
                <a class="btn-submit-contact">Submit</a>
            </div>
        </div>
    </div>
</div>