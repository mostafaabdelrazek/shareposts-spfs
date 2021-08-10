<?php require APPROOT . '/views/inc/header.php';?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card ">
            <h4 class=" font-weight-bold card-header">
                Regisration Form
            </h4>
            <div class=" card-body">
                <form action="<?=URLROOT. '/users/register'?>" class="form text-left" method='POST'>

                    <label class='label '>Name:</label>
                    <input type="text" 
                        class='form-control <?= !empty($data['name_err'])? 'is-invalid' : ''?>'
                         name='name' value='<?=$data['name']?>'>
                    <div class="invalid-feedback">
                        <?=$data['name_err']?>
                    </div>

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

                    <label class='label '>Confermation Password:</label>
                    <input type="password" class='form-control  <?= !empty($data['confirm_password_err'])? 'is-invalid' : ''?>' 
                    name='confirm_password' >
                     <div class="invalid-feedback">
                        <?=$data['confirm_password_err']?>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <input type="submit" class="btn btn-success btn-block" value='Register'>
                        </div>
                        <div class="col text-center">
                            <a href="<?=URLROOT.'/users/login'?>" class="link "> 
                                Have An Account Login!
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
