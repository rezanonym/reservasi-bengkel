<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Blocked</title>
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style_not_found.css">
</head>

<body>
    <div class="text">
        <div>ERROR</div>
        <h1 class="error mx-auto" data-text="403">403</h1>
        <hr>
        <div>Access Forbidden</div>
        <a href="<?= base_url('user'); ?>">&larr; Back to Dashboard</a>
    </div>

    <div class="astronaut">
        <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="" class="src">
    </div>

    <script src="<?= base_url('assets/'); ?>js/not_found.js"></script>
</body>

</html>