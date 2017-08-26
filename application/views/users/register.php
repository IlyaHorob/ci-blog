<?php include_once APPPATH.'views'.DIRECTORY_SEPARATOR . 'header.php' ?>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <?php $errors = validation_errors(); ?>
            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php echo $errors; ?>
                </div>
            <?php endif;?>
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            $cssClass = $message = '';
            if($error) {
                $cssClass = 'alert alert-danger';
                $message = $error;
            } elseif($success) {
                $cssClass = 'alert alert-success';
                $message  = $success;
            }
            if(!empty($message)):
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="<?php echo $cssClass ?>">
                            <?php echo $message; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Log In</div>
                    <div class="panel-body">
                        <?php echo form_open('authorize/login'); ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" name="email"
                                   id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password"
                                   id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                        <div class="panel-heading">Registration</div>
                        <div class="panel-body">
                            <?php echo form_open('authorize/register'); ?>
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" name="firstname"
                                           id="firstname" placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lasttname</label>
                                    <input type="text" class="form-control" name="lastname"
                                           id="lastname" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email"
                                           id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password"
                                           id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="PasswordConfirm">Confirm Password</label>
                                    <input type="password" class="form-control"
                                           name="password_confirm"
                                           id="PasswordConfirm" placeholder="Password Confirm">
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            <?php echo form_close() ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php include_once APPPATH.'views'.DIRECTORY_SEPARATOR . 'footer.php' ?>

