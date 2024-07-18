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
   

    if(isset($_GET['eid'])) {
        $sql = "SELECT * FROM students WHERE id = ".$_GET['eid'];
        $table = mysqli_query($con_db, $sql);
        if ($table) {
            $row = mysqli_fetch_assoc($table);
        } else {
            echo 'Error fetching data: ' . mysqli_error($con_db);
        }
    }

    if(isset($_POST['submit'])) {
        $sname = $_POST['sname'];
        $gname = $_POST['gname'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if(isset($_POST['gender'])) {
            $gender = $_POST['gender'];
        }

        $blgroup = $_POST['blgroup'];
        $division = $_POST['division'];

        $er = 0;

        if($sname == "") {
            $er++;
            $esname = "*Required";
        } else {
            $sname = test_input($sname);
            if(!preg_match("/^[a-zA-Z ]*$/",$sname)) {
                $er++;
                $esname = "*Only letters and white space allowed";
            }
        }

        if($gname == "") {
            $er++;
            $egname = "*Required";
        } else {
            $gname = test_input($gname);
            if(!preg_match("/^[a-zA-Z ]*$/",$gname)) {
                $er++;
                $egname = "*Only letters and white space allowed";
            }
        }

        if($contact == "") {
            $er++;
            $econtact = "*Required";
        } else {
            $contact = test_input($contact);
            if(!preg_match("/^[+0-9]*$/",$contact)) {
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

        if (empty($gender)) {
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
            if(!preg_match("/^[a-zA-Z+-]*$/",$blgroup)) {
                $er++;
                $eblgroup = "*Blood group not valid";
            }
        }

        if($division == "N/A") {
            $er++;
            $edivision = "*Please select Division";
        }

        if($er == 0) {
            $sql = "UPDATE students SET 
                sname = '".strip_tags($sname)."', 
                gname = '".strip_tags($gname)."',
                contact = '".strip_tags($contact)."',
                email = '".strip_tags($email)."',
                address = '".strip_tags($address)."',
                gender = '".strip_tags($gender)."',
                blgroup = '".strip_tags($blgroup)."',
                division = '".strip_tags($division)."'
                WHERE id = ".$_GET['eid'];

            if(mysqli_query($con_db, $sql)) {
                echo '<script>alert("Data updated successfully..!")</script>';
                $row = [
                    'sname' => '',
                    'gname' => '',
                    'contact' => '',
                    'email' => '',
                    'address' => '',
                    'gender' => '',
                    'blgroup' => '',
                    'division' => ''
                ];

                if(mysqli_query($con_db, $sql)) {
                    // Redirect to student_view page after successful update
                    header('Location: ?a=student_view');
                    exit();
                } else {
                    echo '<script>alert("Error: '.mysqli_error($con_db).'")</script>';
                }
    
                mysqli_close($con_db);

            } else {
                echo '<script>alert("Please fill all the required fields correctly...!")</script>';
            }
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
            <img src="./assets/update_student.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>

    <div class="row justify-content-md-center" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="col-8 bg-warning bg-gradient text-dark" style="padding-top: 10px; padding-bottom: 10px;">
            <h3>
                <center><?php echo htmlspecialchars($row["sname"]); ?>'s information</center>
            </h3>
        </div>
    </div>

    <div class="row justify-content-md-center border-top border-warning" style="padding: 10px;">
        <div class="col-12" style="padding-top: 20px; padding-bottom: 20px; background-color: rgb(234, 234, 220);">
            <form class="" style="padding: 10px;" action="" method="post">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="sname">Student name</label>
                        <span class="text-danger"><?php echo $esname; ?></span>
                        <input type="text" name="sname" value="<?php print $row['sname']; ?>" class="form-control" placeholder="Student name">
                    </div>
                    <div class="form-group col-6">
                        <label for="gname">Guardian name</label>
                        <span class="text-danger"><?php echo $egname; ?></span>
                        <input type="text" name="gname" value="<?php print $row['gname']; ?>" class="form-control" placeholder="Guardian name">
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6">
                        <label for="contact">Contact</label>
                        <span class="text-danger"><?php echo $econtact; ?></span>
                        <input type="text" name="contact" value="<?php print $row['contact']; ?>" class="form-control" placeholder="Contact">
                    </div>
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <span class="text-danger"><?php echo $eemail; ?></span>
                        <input type="text" name="email" value="<?php print $row['email']; ?>" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6">
                        <label for="address">Address</label>
                        <span class="text-danger"><?php echo $eaddress; ?></span>
                        <input name="address" value="<?php print $row['address']; ?>" class="form-control" placeholder="Address">
                    </div>
                    <div class="form-group col-6">
                        <label for="gender">Gender</label>
                        <div class="form-check">
                            <input type="radio" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked'; ?>> Male
                            <input type="radio" name="gender" value="Female" <?php if ($row['gender'] == 'Female') echo 'checked'; ?>> Female
                            <input type="radio" name="gender" value="Others" <?php if ($row['gender'] == 'Others') echo 'checked'; ?>> Others
                            <span class="text-danger"><?php echo $egender; ?></span>
                        </div>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6">
                        <label for="blgroup">Blood group</label>
                        <span class="text-danger"><?php echo $eblgroup; ?></span>
                        <input type="text" name="blgroup" value="<?php print $row['blgroup']; ?>" class="form-control" placeholder="Blood group ex:(O+)">
                    </div>
                    <div class="form-group col-3">
                        <label for="division">Division</label>
                        <select name="division" class="form-control">
                            <option value="N/A" <?php if ($row['division'] == 'N/A') echo 'selected'; ?>>N/A</option>
                            <option value="Maths" <?php if ($row['division'] == 'Maths') echo 'selected'; ?>>Maths</option>
                            <option value="Science" <?php if ($row['division'] == 'Science') echo 'selected'; ?>>Science</option>
                            <option value="Technology" <?php if ($row['division'] == 'Technology') echo 'selected'; ?>>Technology</option>
                            <option value="Commerce" <?php if ($row['division'] == 'Commerce') echo 'selected'; ?>>Commerce</option>
                            <option value="Arts" <?php if ($row['division'] == 'Arts') echo 'selected'; ?>>Arts</option>
                        </select>
                        <span class="text-danger"><?php echo $edivision; ?></span>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px;">
                    <div class="form-group col-6"></div>
                    <div class="form-group col-6">
                        <button type="submit" name="submit" value="Submit" class="btn btn-warning" style="padding-left: 20px; padding-right: 20px;">Change Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-md-center border-top border-warning" style="padding-bottom: 10px; padding-top: 20px;"></div>
</div>
<!-- container -->
