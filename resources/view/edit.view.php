<?php
include VIEW_PATH . 'layout/header.view.php';
?>

<?php if (isset($pet)) : ?>

<main class="container">

    <section class="row justify-content-center m-3">
        <h3 class="col-4 display-6">Adatok szerkesztése</h3>
    </section>
    <section class="row justify-content-center">
        <form action="/edit" method="post" class="col-6">
            <input type="hidden" name="id" value="<?= $pet['id'] ?? -1 ?>">
            <div class="mb-3">
                <label for="tipus" class="form-label">Típusa</label>
                <input class="form-control" type="text" name="type" id="tipus" value="<?= $pet['type'] ?? ""?>">
            </div>
            <div class="mb-3">
                <label for="nev" class="form-label">Állat neve</label>
                <input class="form-control" type="text" name="name" id="nev" value="<?= $pet['name'] ?? ""?>">
            </div>
            <div class="mb-3">
                <label for="ar" class="form-label">Ára</label>
                <input class="form-control" type="text" name="price" id="ar" value="<?= $pet['price'] ?? ""?>">
            </div>
            <div>
                <button class="btn btn-success btn-lg mt-3" id="submitButton" type="submit">Mentés</button>
            </div>
        </form>
    </section>
</main>

<?php endif; ?>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>