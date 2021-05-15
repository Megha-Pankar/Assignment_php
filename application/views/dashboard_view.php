<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title><?= $title; ?></title>
    <style>
.avatar {
  vertical-align: middle;
  width: 50px;
  height: 50px;
  border-radius: 50%;
}
</style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
                    <div class="shadow m-4 p-4">
                        <h3>Dashboard</h3>
                        
                        <form action="<?= base_url('DashboardController/updateProfile'); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group text-right">
                            <a href="<?= base_url('LoginController/logout'); ?>" class="btn btn-danger btn-sm">Log Out</a>
                            </div>
                            <?php if($this->session->flashdata('profileUpdated')): ?>
                            <div class="form-group text-center">
                                <div class="alert alert-success">
                                    <p><?= $this->session->flashdata('profileUpdated'); ?></p>
                                </div>
                            </div>
                            <?php endif;?>

                           
                            <?php if(isset($userData[0]->profile_picture) && $userData[0]->profile_picture != ''){

                                  $file_photo = $userData[0]->profile_picture;
                                  
                            

                                }else{
                                  $file_photo = 'default.jpg';
                                }
                                
                                ?>
                            <div class="text-center">
                                <!-- <label for="file">Profile Picture Preview</label> -->
                                <img src="<?=base_url('uploads/'); ?><?= $file_photo?>" alt="" class="rounded">
                            </div>
                            <br>
                            

                            <div class="form-group"  class="form-label">
                                <label for="file">Upload Profile Picture</label>
                                <input type="file" class="form-control" name="file" style="padding-bottom: 37px"}>
                            </div>

                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="Enter first name" value="<?= $userData[0]->first_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" name="lname" placeholder="Enter last name" value="<?= $userData[0]->last_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email" value="<?= $userData[0]->email; ?>" readonly>
                            </div>
                           
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select name="department" id="department" class="form-control" onchange="fetchSubDepartmentDD()">
                                <option value="">Select</option>
                                <?php
                                if(isset($departmentDD)) {
                                    foreach($departmentDD as $key=>$value) {
                                        if ($userData[0]->department == $value->id){
                                    
                                            echo '<option value="'.$value->id.'"selected>'.$value->department_name.'</option>';

                                        } else{
                                        echo '<option value="'.$value->id.'">'.$value->department_name.'</option>';
                                        }
                                    }
                                }
                                
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_department">Sub Department</label>
                                <select name="sub_department" id="sub_department" class="form-control">
                                <option value="">Select</option>
                                </select>
                            </div>
                            <input type="hidden" id="base_url" value="<?= base_url(); ?>">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>

fetchSubDepartmentDD();

function fetchSubDepartmentDD() {
   
    var department_id = $('#department').val();
   
    var base_url = $('#base_url').val();
    
    if(department_id == '' || department_id == null || department_id == undefined) {
        return false;
    }
    
    
    $.ajax({
        url : base_url+'DashboardController/fetchSubDepartmentDD',
        method : 'post',
        dataType : 'JSON',
        data : {
            department_id : department_id
        },
        success : function(response) {
        
            if(response != '') {
                
                var idd = "<?php echo $userData[0]->sub_department ?>" ;
                  
                var i = 0;
                var html = '';
                var len = response.length;
                html += '<option value="">select</option>';
                for(i; i < len; i++) {
                    if(response[i].id == idd){
                    html += '<option value="'+response[i].id+'"selected>'+response[i].sub_department_name+'</option>';
                    }else{
                        html += '<option value="'+response[i].id+'">'+response[i].sub_department_name+'</option>';
                    }
                }
                $('#sub_department').html(html);
            }
        },
        error : function(request, status, error) {
        alert(request.responseText);
            console.log('has error'+error);
        }
    });
    
    
}
</script>
</body>
</html>