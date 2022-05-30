<?php
include VIEW_PATH . 'layout/header.view.php';
?>

<main class="container">

    <section class="row justify-content-center m-3">
        <h3 class="col-2 display-6">
            Állatok
        </h3>
        <h5 class="col-4 pt-3">
        <?php if (isset($sumP)): ?>
            <?php foreach ($sumP as $price): ?>
            Eddig eladott kisállatok összértéke: <span><?= $price ?></span> Ft
            <?php endforeach; ?>
        <?php endif; ?>
        </h5>
        <div class="row justify-content-center">
            <a class="col-2 btn btn-success btn-lg mt-3" href="/create">Létrehozás</a>
        </div>
    </section>

    <section class="row justify-content-center">
        <div class="col-6 mb-3">
        <?php if (isset($data) && count($data) > 0): ?>
            <table class="table table-striped">
                <tr>
                    <th>Típus</th>
                    <th>Név</th>
                    <th>Ár</th>
                    <th></th>
                    <th></th>
                </tr>
            <?php foreach ($data as $pet): ?>
                <tr>
                    <td><?= $pet["type"] ?></td>
                    <td><?= $pet["name"] ?></td>
                    <td><?= $pet["price"] ?></td>
                    <td><a href="/details?id=<?= $pet["id"] ?>" class="btn btn-sm btn-outline-primary">Részletek</a></td>
                    <td><a href="/edit?id=<?= $pet["id"] ?>" class="btn btn-sm btn-outline-warning">Szerkesztés</a></td>
                </tr>
            <?php endforeach; ?>
            </table>
         <?php else: ?>
            Nincsenek állatok a rendszerben!
        <?php endif; ?>
        </div>
    </section>
</main>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>