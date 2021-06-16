<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Comic Detail</h2>
            <div class="card mb-3 mt-4" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $comics['image']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comics['title']; ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                            <a href="/comics/edit/<?= $comics['slug']; ?>" class="btn btn-warning">Edit</a>
                            <form action="/comics/delete/<?= $comics['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-danger" onclick="confirm('Are you sure want to delete?');">Delete</button>
                            </form>

                            <br>
                            <a href="../comics">Return to comic registration page.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>