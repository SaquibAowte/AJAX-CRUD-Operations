<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    
    <title>CRUD  Operations</title>
    </head>
  <body>
    <div class="container">
        <h2 class="text-center mt-3 mb-4">CRUD Operation using AJAX</h2>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Record</button>
        </div>
        <h2>All Inserted Records</h2>      
        <div id="records"></div>

        <!-- Insert Record Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insert New Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">                            
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="" aria-describedby="FirstNameHelp" placeholder="E.g Saquib" required>                                        
                        </div>
                    </div>    
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="" aria-describedby="LastNameHelp" placeholder="E.g Aowte" required>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="email" class="form-control" id="email" name="" aria-describedby="EmailHelp" placeholder="E.g abcd@gmail.com" required>                                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="mobnumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="mobnumber" name=" " aria-describedby="NumberHelp" placeholder="E.g 0123456789" maxlength="10" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addRecord()">Save</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
        </div>

        <!-- Update Record Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">                            
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="update_firstname" class="form-label">Update First Name</label>
                            <input type="text" class="form-control" id="update_firstname" name="" aria-describedby="update_FirstNameHelp" placeholder="E.g Saquib" required>                                        
                        </div>
                    </div>    
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="update_lastname" class="form-label">Update Last Name</label>
                            <input type="text" class="form-control" id="update_lastname" name="" aria-describedby="update_LastNameHelp" placeholder="E.g Aowte" required>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="update_email" class="form-label">Update Email ID</label>
                            <input type="email" class="form-control" id="update_email" name="" aria-describedby="update_EmailHelp" placeholder="E.g abcd@gmail.com" required>                                        
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="update_mobnumber" class="form-label">Update Contact Number</label>
                            <input type="text" class="form-control" id="update_mobnumber" name="" aria-describedby="update_NumberHelp" placeholder="E.g 0123456789" maxlength="10" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="updateUserDetails()">Update</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <input type="hidden" name="" id="hidden_user_id">
            </div>
            </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            readRecords();
        })

        function readRecords(){
            var readrecord="readrecord";
            $.ajax({
                url:"./process.php",
                type:"post",
                data:{ readrecord:readrecord },
                success:function(data,status){
                    $('#records').html(data);    
                }       
            });        
        }

        function addRecord(){
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var email = $('#email').val();
            var mobnumber = $('#mobnumber').val();   

            // Using AJAX
            $.ajax({
                url:"./process.php",
                type:'post',
                data:{ firstname:firstname, lastname:lastname, email:email, mobnumber:mobnumber },
                success:function(data,status){
                    readRecords();
                },
            });
            
        }

        // Deleting Record
        function DeleteUser(deleteid){
            var conf=confirm("Are you sure to delete this record?");
            if(conf==true){
                $.ajax({
                    url:"./process.php",
                    type:"post",
                    data: {deleteid:deleteid},
                    success:function(data,status){
                        readRecords();
                    }
                });
            }

        }

        function GetUserDetails(id){
           $('#hidden_user_id').val(id);
           $.post("./process.php", {
               id:id
           },function(data,status){
               var user=JSON.parse(data);
               $('#update_firstname').val(user.firstname),
               $('#update_lastname').val(user.lastname),
               $('#update_email').val(user.email),
               $('#update_mobnumber').val(user.contact);
           }
           );

        $('#updateModal').modal("show");     

        }

        function updateUserDetails(){
            var firstnameupdate=$('#update_firstname').val();
            var lastnameupdate=$('#update_lastname').val();
            var emailupdate=$('#update_email').val();
            var mobnumberupdate=$('#update_mobnumber').val();
            var hidden_user_idupdate=$('#hidden_user_id').val();

            $.post("./process.php", {
                hidden_user_idupdate:hidden_user_idupdate,
                firstnameupdate:firstnameupdate,
                lastnameupdate:lastnameupdate,
                emailupdate:emailupdate,
                mobnumberupdate:mobnumberupdate,
            },
            function(data,status){
                $('#updateModal').modal("hide");
                readRecords();
            }
            );
        }
    </script>

        
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>
 </body>
</html>