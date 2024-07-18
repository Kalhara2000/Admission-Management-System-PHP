<!-- container -->
<div class="container" style="padding-top: 55px;">
    <div class="row justify-content-md-center">
        <div class="col-12">
            <img src="./assets/student_table.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>

    <div class="row justify-content-md-center" style="padding-top: 20px; padding-bottom: 20px;">
        <div class="col-10 bg-success bg-gradient text-light" style="padding-top: 10px; padding-bottom: 10px;">
            <h3>
                <center>Students Data Lists</center>
            </h3>
        </div>
    </div>

    <div class="row justify-content-md-center border-top border-success" style="padding: 10px;">
        <div class="col-12" style="padding-top: 20px; padding-bottom: 20px;">
            
        <?php

            if (isset($_GET['did'])) {
                delete($con_db);
                echo '<script>alert("Student data Deleted...!")</script>'; 
            }

            $sql = "SELECT * FROM students";
            $table = mysqli_query($con_db, $sql);

            print '<table class="table">';
                print '<thead style="background-color: rgb(220, 239, 216);">';
                    print '<tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Gurdian Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Blood Group</th>
                        <th scope="col">Division</th>
                        <th scope="col">Action</th>
                    </tr>';
                print '</thead>';
                print '<tbody style="background-color: rgb(235, 239, 234);">';
                   
                    while ($row = mysqli_fetch_assoc($table)) {
                        print '<tr>';
                            print '<td scope="row">'.htmlentities($row["sname"]).'</td>';
                            print '<td>'.htmlentities($row["gname"]).'</td>';
                            print '<td>'.htmlentities($row["contact"]).'</td>';
                            print '<td>'.htmlentities($row["email"]).'</td>';
                            print '<td>'.htmlentities($row["address"]).'</td>';
                            print '<td>'.htmlentities($row["gender"]).'</td>';
                            print '<td>'.htmlentities($row["blgroup"]).'</td>';
                            print '<td>'.htmlentities($row["division"]).'</td>';
                            print '<td>
                                <a href="?a=student_update&eid='.$row["id"].'" class="btn btn-warning" style="margin-bottom: 5px;">Update</a>
                                <a href="?a='.$_GET['a'].'&did='.$row['id'].'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this student?\')">Delete</a>
                            </td>';
                        print '</tr>';
                    }
                print '</tbody>';
            print '</table>';

            function delete($con_db) {
                $sql = "DELETE FROM students WHERE id = " . intval($_GET['did']);
                mysqli_query($con_db, $sql);
            }

            mysqli_close($con_db);
        ?>

        </div>
    </div>

    <div class="row justify-content-md-center border-top border-success" style="padding-bottom: 10px; padding-top: 20px;">
    </div>
</div>
<!-- container -->
