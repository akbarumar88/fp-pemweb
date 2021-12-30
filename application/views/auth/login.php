<?= flash('errlogin') ?>

<form method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input required type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
        <small id="emailHelp" class="form-text text-muted">Masukkan username anda.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input required type="password" class="form-control" id="exampleInputPassword1" name="pass">
        <small id="emailHelp" class="form-text text-muted">Masukkan kata sandi.</small>
    </div>
    <!-- <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div> -->
    <button type="submit" class="btn btn-primary">Submit</button>
</form>