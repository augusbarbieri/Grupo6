<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

<div class="ms-3 me-3 mt-5">
    <div class="d-flex align-items-center mb-4">
        <h2 class="mb-0">Listado de Paseadores</h2>
        <button type="button" class="btn btn-primary ms-auto" onclick="location.href='adminFormAddPaseador.php'">Agregar Paseador</button>
    </div>
    <div class="table-responsive">
        <table class="table w-auto ba" style="height: 150px;">

            <thead class="bg-body-custom">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Marcos</td>
                    <td>Herrera</td>
                    <td>33457698</td>
                    <td>marcos.herrera@manadas.com</td>
                    <td>+5491112345678</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>James</td>
                    <td>Trinchero</td>
                    <td>36726437</td>
                    <td>james.trinchero@manadas.com</td>
                    <td>+5491123456789</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Juan</td>
                    <td>Gilerdo</td>
                    <td>40227698</td>
                    <td>juan.gilerdo@manadas.com</td>
                    <td>+5491134567890</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../componentes/footer.php'; ?>
