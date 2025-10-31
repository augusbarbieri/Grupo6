<?php
$basePath = '../../';
include_once '../../componentes/header.php';
?>

<div class="ms-3 me-3 mt-5">
    <div class="d-flex align-items-center mb-4">
        <h2 class="mb-4 text-start">Listado de Clientes</h2>
    </div>
    <div class="table-responsive">
        <table class="table w-auto" style="height: 150px;">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Mascotas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Marcos</td>
                    <td>Herrera</td>
                    <td>33457698</td>
                    <td>marcos.herrera@gmail.com</td>
                    <td>+5491112345678</td>
                    <td>1</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>James</td>
                    <td>Trinchero</td>
                    <td>36726437</td>
                    <td>james.trinchero@gmail.com</td>
                    <td>+5491123456789</td>
                    <td>3</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Juan</td>
                    <td>Gilerdo</td>
                    <td>40227698</td>
                    <td>juan.gilerdo@gmail.com</td>
                    <td>+5491134567890</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../../componentes/footer.php'; ?>
