<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print diagram</title>
    <?php include_once 'views/admin/partial/link-admin-style.php' ?>
</head>
<body class="bg-white">
    <div class="container-fluid py-5 px-2">
        <input type="hidden" name="nama_group" value="<?= $nama_group ?>">
        <input type="hidden" name="nama_quis" value="<?= $nama_quis ?>">
        <div class="chart">
            <canvas id="data-chart-bar" style="min-height: 450px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
        </div>
    </div>

    <?php include_once 'views/admin/partial/link-admin-script.php' ?>
    <script>
        function loadChart() {
            const namaGroup = $('input[name="nama_group"]');
            const namaQuis = $('input[name="nama_quis"]');

            $.ajax({
                type: "GET",
                url: `detail-chart?nama_group=${namaGroup.val()}&nama_quis=${namaQuis.val()}`,
                success: function (response) {
                var object = $.parseJSON(response);

                const labels = object.labels;
                const dataBar = {
                    labels : labels,
                    datasets: [
                    {
                        label : 'Rating nilai',
                        backgroundColor : 'rgb(209, 236, 241)',
                        borderColor : 'rgb(12, 84, 96)',
                        borderWidth : '1.2',
                        pointRadius : false,
                        pointHighlightFill  : '#fff',
                        data : object.data,
                    },
                    ]
                };

                new Chart(document.getElementById('data-chart-bar'), {
                    type: 'bar',
                    data: dataBar,
                    options: {
                    responsive : true,
                    maintainAspectRatio : false,
                    title : {
                        display : true,
                        text : `Nilai ${namaQuis.val()} ${namaGroup.val()}`,
                    },
                    legend : {
                        display : false,
                    },
                    scales : {
                        yAxes : [{
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 100,
                            }
                        }]
                    }
                    }
                });
                }
            });
        }
        document.onload = loadChart();
        setTimeout(() => window.print(), 500);
    </script>
</body>
</html>