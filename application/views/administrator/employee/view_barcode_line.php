<html>

<head>
    <style>
        .grid-container {
            display: grid;
            row-gap: 25px;
            column-gap: 10px;
            grid-template-columns: auto auto auto auto auto auto auto;
            padding: 5px;

        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 0.1px solid rgba(0, 0, 0, 0.1);
            padding: 5px;
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
                $kal = $xx['employee_name'];
                $titik = '..';

                if (strlen($kal) >= 12) {
                    $desc = substr($kal, 0, 12) . $titik;
                } else {
                    $desc = substr($kal, 0, 12);
                }

                ?>


                <div>
                    <?= substr($xx['employee_id'], -4) ?> | <?= $desc ?>
                </div>
                <div>
                    <img src="<?= base_url('assets/images/employee/') . $xx['remark']; ?>" class="card-img" height="120px">
                </div>

            </div>

        <?php endforeach; ?>
    </div>

</body>

</html>