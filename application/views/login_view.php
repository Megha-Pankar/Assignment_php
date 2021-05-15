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
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mt-5">
                    <div class="shadow m-4 p-4">
                    <legend>Login Form</legend>
                        <form action="<?= base_url('LoginController/validateEmail'); ?>" method="post">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                                <span class="text-danger">
                                <?php if(isset($error)) {
                                    echo $error;
                                } ?>
                                </span>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <div class="text-right">
                            <a href="<?= base_url('SignupController'); ?>">Signup Now</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>