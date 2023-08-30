<html>

<head>
    <style>
    .grid-container {
        display: grid;
        row-gap: 15px;
        column-gap: 10px;
        grid-template-columns: auto auto auto auto auto auto auto;
        padding: 8px;

    }

    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        border: 0.1px solid rgba(0, 0, 0, 0.1);
        padding: 6px;
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        /* margin-top: 30; */
        /* margin-bottom: 25; */
    }
    </style>
</head>

<body>


    <div class="grid-container">
        <?php foreach ($data as $xx) : ?>
        <div class="grid-item">

            <?php
                $kal = $xx['item_code'];
                $titik = '..';

                if (strlen($kal) >= 20) {
                    $desc = substr($kal, 0, 20) . $titik;
                } else {
                    $desc = substr($kal, 0, 20);
                }

                ?>



            <div>
                <?= $desc; ?>
            </div>
            <div>
                <img src="<?= base_url('assets/images/item/') . $xx['remark']; ?>" class="card-img" height="120px">
            </div>

        </div>

        <?php endforeach; ?>
    </div>

</body>

</html>