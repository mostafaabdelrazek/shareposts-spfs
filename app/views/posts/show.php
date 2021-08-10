<?php require APPROOT . '/views/inc/header.php';?>
<a href="<?=URLROOT . '/posts'?>" class=" mb-4 btn btn-outline-secondary"> <i class='fa fa-backward'> Back </i> </a>
<h1>
    <?=$data['post']->title?>
</h1>
<div class="bg-light p-2 mb3 text-right">
    written by : <?= $data['user']->name?> on <?= $data['post']->created_at?>
</div>
<?php if($data['post']->user_id == $_SESSION['user_id']): ?>
    <hr>
    <a href="<?=URLROOT . '/posts/edit/' . $data['post']->id?>" class="btn btn-dark">
        Edit
    </a>
    <form class = 'float-right' action="<?=URLROOT . '/posts/delete/' . $data['post']->id?>" method='POST'>
        <input type="submit" value='delete' class = 'btn btn-danger'>
    </form>
<?php endif ?>
<div class="row">
<div class='mt-4 col-md-10 offset-md-1'>
    <p>
    <?=$data['post']->body?>
    </p>
</div>
<div class='rounded col-md-10 offset-md-2 offset-1 bg-light'>
    <span class="m-4 btn btn-secondary">Comments <?=count($data['comments']) ?></span>
    <div>
       <?php foreach($data['comments'] as $comment):?>
        <div class='d-flex align-items-center'>
            <img src="https://www.drivetest.de/wp-content/uploads/2019/08/drivetest-avatar-m-254x300.png" alt="avatar-image" class=' m-4 rounded-circle' height="80">
            <p class='text-muted'>
                <span class='small text-muted d-block'><?= $comment->username . ' - ' . $comment->created_at ?></span>
                <?=$comment->body?>
            </p>
        </div>
       <?php endforeach;?>
    </div>
    <div>
        <h6 class='mb-4 ml-2'>New Comment</h6>
        <form action="<?= URLROOT . '/comments/add/'. $data['post']->id .'/' . $_SESSION['user_id']?>" method='POST'>
            <textarea name="comment" id="" class='form-control' rows='3' ></textarea>
            <input type="submit" value='Comment' class='btn btn-primary mt-3 mb-2'>
        </form>
    </div>
</div>

</div>


<?php require APPROOT . '/views/inc/footer.php';?>
