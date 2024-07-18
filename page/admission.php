<?php
$sname = "";
$gname = "";
$contact = "";
$email = "";
$address = "";
$gender = "";
$blgroup = "";
$division = "";

$esname = "";
$egname = "";
$econtact = "";
$eemail = "";
$eaddress = "";
$egender = "";
$eblgroup = "";
$edivision = "";

if(isset($_POST['submit'])) {
    $sname = $_POST['sname'];
    $gname = $_POST['gname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $blgroup = $_POST['blgroup'];
    $division = $_POST['division'];

    $er = 0;

    if($sname == "") {
        $er++;
        $esname = "*Required";
    } else {
        $sname = test_input($sname);
        if(!preg_match("/^[a-zA-Z ]*$/", $sname)) {
            $er++;
            $esname = "*Only letters and white space allowed";
        }
    }

    if($gname == "") {
        $er++;
        $egname = "*Required";
    } else {
        $gname = test_input($gname);
        if(!preg_match("/^[a-zA-Z ]*$/", $gname)) {
            $er++;
            $egname = "*Only letters and white space allowed";
        }
    }

    if($contact == "") {
        $er++;
        $econtact = "*Required";
    } else {
        $contact = test_input($contact);
        if(!preg_match("/^[+0-9]*$/", $contact)) {
            $er++;
            $econtact = "*Only numbers are allowed";
        }
    }

    if($email == "") {
        $er++;
        $eemail = "*Required";
    } else {
        $email = test_input($email);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $er++;
            $eemail = "*Email format is invalid";
        }
    }

    if($address == "") {
        $er++;
        $eaddress = "*Required";
    }

    if(empty($gender)) {
        $er++;
        $egender = "*Gender is required";
    } else {
        $gender = test_input($gender);
    }

    if($blgroup == "") {
        $er++;
        $eblgroup = "*Required";
    } elseif(strlen($blgroup) > 4) {
        $er++;
        $eblgroup = "*Not more than 3 characters";
    } else {
        $blgroup = test_input($blgroup);
        if(!preg_match("/^[a-zA-Z+-]*$/", $blgroup)) {
            $er++;
            $eblgroup = "*Blood group not valid";
        }
    }

    if($division == "N/A") {
        $er++;
        $edivision = "*Please select Division";
    }

    if($er == 0) {
       
        $sql = "INSERT INTO students (sname, gname, contact, email, address, gender, blgroup, division) VALUES (
            '".mysqli_real_escape_string($con_db, strip_tags($sname))."',
            '".mysqli_real_escape_string($con_db, strip_tags($gname))."', 
            '".mysqli_real_escape_string($con_db, strip_tags($contact))."', 
            '".mysqli_real_escape_string($con_db, strip_tags($email))."', 
            '".mysqli_real_escape_string($con_db, strip_tags($address))."', 
            '".mysqli_real_escape_string($con_db, strip_tags($gender))."', 
            '".mysqli_real_escape_string($con_db, strip_tags($blgroup))."', 
            '".mysqli_real_escape_string($con_db, strip_tags($division))."'
        )";

        if(mysqli_query($con_db , $sql)) {
			echo '<script>alert("Data saved into system..!")</script>'; 
            $sname = "";
            $gname = "";
            $contact = "";
            $email = "";
            $address = "";
            $gender = "";
            $blgroup = "";
            $division = "";
        } else {
			echo '<script>alert("'.mysqli_error($con_db).'")</script>';
        }

        mysqli_close($con_db);
    } else {
		echo '<script>alert("Please fill all the required fields correctly...!")</script>'; 
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> 
 
<!-- container -->
<div class="container" style="padding-top: 55px;">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <img src="./assets/addmisiom.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>

    <div class="row justify-content-md-center" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="col-8 bg-info bg-gradient text-light" style="padding-top: 10px; padding-bottom: 10px;">
            <h3>
                <center>Students Admission Form</center>
            </h3>
        </div>
    </div>

    <div class="row justify-content-md-center border-top border-success" style="padding: 10px;">
        <div class="col-12" style="padding-top: 20px; padding-bottom: 20px; background-color: rgb(220, 230, 234);">
            <form class="" style="padding: 10px;" action="" method="post">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="sname">Student name</label>
                        <span class="text-danger"><?php print $esname; ?></span>
                        <input type="text" name="sname" value="<?php print $sname; ?>" class="form-control" placeholder="Student name">
                    </div>
                    <div class="form-group col-6">
                        <label for="gname">Guardian name</label>
                        <span class="text-danger"><?php print $egname; ?></span>
                        <input type="text" name="gname" value="<?php print $gname; ?>" class="form-control" placeholder="Guardian name">
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6">
                        <label for="contact">Contact</label>
                        <span class="text-danger"><?php print $econtact; ?></span>
                        <input type="text" name="contact" value="<?php print $contact; ?>" class="form-control" placeholder="Contact">
                    </div>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <span class="text-danger"><?php print $eemail; ?></span>
                        <input type="text" name="email" value="<?php print $email; ?>" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6">
                        <label for="address">Address</label>
                        <span class="text-danger"><?php print $eaddress; ?></span>
                        <input name="address" value="<?php print $address; ?>" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group col-6">
                        <label for="gender">Gender</label>
                        <div class="form-check">
                            <input type="radio" name="gender" value="Male"><span> Male</span>
                            <input type="radio" name="gender" value="Female"><span> Female</span>
                            <input type="radio" name="gender" value="Others"><span> Others</span>
                            <span class="text-danger"><?php print $egender; ?></span>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6">
                        <label for="blgroup">Blood group</label>
                        <span class="text-danger"><?php print $eblgroup; ?></span>
                        <input type="text" name="blgroup" value="<?php print $blgroup; ?>" class="form-control" placeholder="Blood group ex:(O+)">
                    </div>
                    <div class="form-group col-3">
                        <label for="division">Division</label>
                        <select name="division" class="form-control">
                            <option value="N/A">N/A</option>
                            <option value="Maths">Maths</option>
                            <option value="Science">Science</option>
                            <option value="Technology">Technology</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Arts">Arts</option>
                        </select>
                        <span class="text-danger"><?php echo $edivision; ?></span>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6"></div>
                    <div class="form-group col-6">
                        <button type="submit" name="submit" value="Submit" class="btn btn-info" style="padding-left: 20px; padding-right: 20px;">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-md-center border-top border-success" style="padding-bottom: 10px; padding-top: 20px;"></div>
</div>
<!-- container -->
