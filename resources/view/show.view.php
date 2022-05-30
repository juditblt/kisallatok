<?php
include VIEW_PATH . 'layout/header.view.php';
?>

<?php if (isset($pet)) : ?>

<main class="container">

    <section class="row justify-content-center m-3">
        <h3 class="col-2 display-6">Részletek</h3>
    </section>

    <section class="row justify-content-center">
        <div class="col-6 mb-3">
            <table class="table table-bordered">
                <tr class="table-primary">
                    <th>Típus</th>
                    <th>Név</th>
                    <th>Ár</th>
                    <th>Létrehozva</th>
                </tr>
                <tr>
                    <td><?= $pet ["type"] ?></td>
                    <td><?= $pet ["name"] ?></td>
                    <td><?= $pet ["price"] ?></td>
                    <td><?= $pet ["created_at"] ?></td>
                </tr>
            </table>
        </div>
    </section>

    <section class="row justify-content-center">
    <div class="col-2 offset-1">
        <a href="/sell?id=<?= $pet["id"] ?>" class="btn btn-success btn-lg">Eladás</a>
    </div>
    <div class="col-2 offset-2">
        <a href="/delete?id=<?= $pet["id"] ?>" class="btn btn-danger btn-lg">Törlés</a>
    </div>
    </section>

</main>

<?php endif; ?>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>