<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CdE <?php echo $titulo ?? ''; ?> </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../build/css/app.css">

    <!--Scripts CSS-->
    <!-- 
    <link rel="stylesheet" href="../build/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../build/css/datatables.min.css">
    <link rel="stylesheet" href="../build/fullcalendar/main.css">


    <!--Scripts JS -->
    <script src="../build/js/jquery-3.6.3.min.js"></script>
    <script src="../build/js/popper.min.js"></script>
    <script src="../build/js/bootstrap.min.js"></script>
    <script src="../build/js/datatables.min.js"></script>
    <script src="../build/js/moment-with-locales.js"></script>
    <script src="../build/fullcalendar/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.js"></script>
</head>

<body>

    <?php echo $contenido; ?>
    <?php echo $script ?? ''; ?>

</body>
<footer class="footer">Todos los derechos reservados CdE Veterianaria 2023</footer>

</html>