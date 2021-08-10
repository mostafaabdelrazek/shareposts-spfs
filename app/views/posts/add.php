<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?=URLROOT . '/posts'?>" class=" mb-4 btn btn-outline-secondary"> <i class='fa fa-backward'> Back </i> </a>
<div class="card bg-light">
    <div class="card-header">
        <h3 class="font-weight-bold">
            Add Post
        </h3>
        <p class='mb-0'>create a new post</p>
    </div>
    <div class="card-body">
        <form action="<?=URLROOT. '/posts/add'?>" class="form text-left" method='POST'>

            <label class='label '>Title</label>
            <input type="text" class='form-control  <?= !empty($data['title_err'])? 'is-invalid' : ''?>'     
            name='title' value='<?=$data['title']?>'>
            <div class="invalid-feedback">
                <?=$data['title_err']?>
            </div>

            <label class='label'>Passoword:</label>
            <textarea type="password" class='form-control  <?= !empty($data['body_err'])? 'is-invalid' : ''?>' 
            name='body' rows='6'><?=$data['body']?></textarea>
                <div class="invalid-feedback">
                <?=$data['body_err']?>
                </div>
                <input type="submit" value='Add New Post' class='btn btn-success mt-3'>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>
