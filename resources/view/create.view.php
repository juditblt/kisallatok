<?php
include VIEW_PATH . 'layout/header.view.php';
?>

<main class="container">

    <section class="row justify-content-center m-3">
        <h3 class="col-4 display-6">Új kisállat felvétele</h3>
    </section>
    <section class="row justify-content-center">
        <form action="/create" method="post" class="col-6">
            <div class="mb-3">
                <label for="tipus" class="form-label">Típusa</label>
                <input class="form-control" type="text" name="type" id="tipus">
            </div>
            <div class="mb-3">
                <label for="nev" class="form-label">Állat neve</label>
                <input class="form-control" type="text" name="name" id="nev">
            </div>
            <div class="mb-3">
                <label for="ar" class="form-label">Ára</label>
                <input class="form-control" type="text" name="price" id="ar">
            </div>
            <div>
                <button class="btn btn-success btn-lg mt-3" id="submitButton" type="submit">Mentés</button>
            </div>
        </form>
    </section>
</main>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>
