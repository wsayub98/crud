<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">Add Comic Form</h2>

            <form action="/comics/save" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" value="<?= old('title'); ?>" id="title" autofocus>
                        <div id="validationServer03Feedback" class="invalid-feedback">
                            <?= $validation->getError('title'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" value="<?= old('author'); ?>" id="author">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="publisher" value="<?= old('publisher'); ?>" id="publisher">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="imagec" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <input type="file" class="form-control <?= ($validation->hasError('image')) ? 'is-invalid' : ''; ?>" name="image" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload Image</label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('image'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                First radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                Second radio
                            </label>
                        </div>
                        <div class="form-check disabled">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                            <label class="form-check-label" for="gridRadios3">
                                Third disabled radio
                            </label>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                                Example checkbox
                            </label>
                        </div>
                    </div>
                </div> -->
                <button type="submit" class="btn btn-primary">SAVE</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>