<div class="container">
    <div class="row">
        <section class="title-page col-12">
            <div class="marg-container">
                <h2><a class="btn-sm btn-dark" href="<?php echo $this->slugs["dashboardhome"]; ?>">Dashboard</a><span
                        class="additional-message-title"> / Statistics</span></h2>
            </div>
        </section>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div>
                <section class="block-stat" id="stat-visit">
                    <div class="title">
                        <h4>Number of visitor</h4>
                    </div>
                    <div class="container" id="stat-tosle">
                        <canvas id="chart-view-tosle" width="400" height="400"></canvas>
                        <canvas id="myChart" width="600" height="220"></canvas>

                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<?php
echo '<pre>';
//print_r($statUserRegisteredDay);
echo '</pre>';
?>
<script>
    var containerStatTosle = document.getElementById('chart-view-tosle');
    var chartViewTosle = new Chart(containerStatTosle, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                data: <?php echo '['.implode(' ,', $statViewTosle).']'; ?>
            }]
        },
        options: {
            showLines: true
        }
    });
</script>
