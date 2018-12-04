<!DOCTYPE html>
<html>
<head>
    <?php include'header.php'; ?>
    <title></title>
</head>
<body>
    <?php include 'asideView.php'; ?>
    <input type="hidden" name="rowColor" id="rowColor" value="0">
    <main class="col-md-10 ml-sm-auto col-lg-10 col-xl-10 px-4">
        <section class="row backButton">
            <button id="backButtonPreguntas"> <i class="fas fa-arrow-left"></i></button>
        </section>
        <div class="d-flex flex-wrap flex-md-nowrap align-items-center pl-5 pt-3 pb-2 mb-3 border-bottom">
            <h1 class="titulo"><?php echo $formato->nombre ?></h1>
        </div>
        <section class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Número</th>
                    <th scope="col">Pregunta</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($allPreguntas as $pregunta){?>
                <tr>
                    <td> <h3><?php echo $pregunta->numero ?></h3></td>
                    <td>
                        <?php $this->visualizarPreguntaId($pregunta->idPregunta); ?>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </section>
    </main>
</body>
</html>