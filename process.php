<?php
    // Making Database Connection
    $con = mysqli_connect('localhost','root','','muchmark');

    extract($_POST);
    if(isset($_POST['readrecord'])){
        $data= '<table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Mobile Number</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>';
        $displayquery="SELECT * FROM userdata";
        $result=mysqli_query($con,$displayquery);
        $check=mysqli_num_rows($result);
        if($check>0){
            $number=1;
            while($row=mysqli_fetch_array($result)){
                $data .='<tr>
                      <td>'.$number.'</td>
                      <td>'.$row['firstname'].'</td>
                      <td>'.$row['lastname'].'</td>
                      <td>'.$row['email'].'</td>
                      <td>'.$row['contact'].'</td>
                      <td> <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button></td>
                      <td> <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button></td>  
                    </tr>';
                $number++;        
            }
        }
        $data.='</table>';
        echo $data;
    } 

    //Inserting Data
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobnumber']))
    {        
       $firstname=$_POST['firstname'];
       $lastname=$_POST['lastname'];
       $email=$_POST['email'];
       $mobnumber=$_POST['mobnumber'];     
       $query="INSERT INTO userdata('firstname','lastname','email','contact') VALUES ('$firstname','$lastname','$email','$mobnumber')"; 
       mysqli_query($con,$query);
       
    }

    // Delete Records
    if(isset($_POST['deleteid'])){
        $userid=$_POST['deleteid'];
        $deletequery="DELETE FROM userdata WHERE id='$userid'";
        mysqli_query($con,$deletequery);
    }

    // Userid for update
    if(isset($_POST['id']) && isset($_POST['id'])!="")
    {
        $user_id=$_POST['id'];
        $query="SELECT * FROM userdata WHERE id='$user_id'";
        if(!$result=mysqli_query($con,$query)){
            exit(mysqli_error());
        }

        $response =array();

        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $response=$row;
            }
        }else{
            $response['status']=200;
            $response['message']="Ops...Data not found!";     
        }
        echo json_encode($response);
    }
    else{
        $response['status']=200;
        $response['message']="Invalid Request";
    }

    // Update Table
    if(isset($_POST['hidden_user_idupdate'])){
        $hidden_user_idupdate = $_POST['hidden_user_idupdate'];
        $firstnameupdate=$_POST['firstnameupdate'];
        $lastnameupdate=$_POST['lastnameupdate'];
        $emailupdate=$_POST['emailupdate'];
        $mobnumberupdate=$_POST['mobnumberupdate'];

        $query="UPDATE userdata SET 'firstname'='$firstnameupdate','lastname'='$lastnameupdate','email'='$emailupdate','contact'='$mobnumberupdate' WHERE id='hidden_user_id'";
        mysqli_query($con,$query);    
    }
?>