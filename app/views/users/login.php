<?php require APPROOT . '/views/inc/header.php';?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <?= flash('register_success')?>
        <div class="card ">
            <h4 class="font-weight-bold card-header">
                Login Form
            </h4>
            <div class="card-body">
                <form action="<?=URLROOT. '/users/login'?>" class="form text-left" method='POST'>

                    <label class='label '>Email:</label>
                    <input type="text" class='form-control  <?= !empty($data['email_err'])? 'is-invalid' : ''?>'     
                    name='email' value='<?=$data['email']?>'>
                    <div class="invalid-feedback">
                        <?=$data['email_err']?>
                    </div>

                    <label class='label'>Passoword:</label>
                    <input type="password" class='form-control  <?= !empty($data['password_err'])? 'is-invalid' : ''?>' 
                    name='password' >
                     <div class="invalid-feedback">
                        <?=$data['password_err']?>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <input type="submit" class="btn btn-primary btn-block" value='Login'>
                        </div>
                        <div class="col text-center">
                            <a href="<?=URLROOT.'/users/register'?>" class="link "> 
                                Havn't An Account Register!
                            </a>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-footer text-muted">
                All information not be able to share with anybody
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>
