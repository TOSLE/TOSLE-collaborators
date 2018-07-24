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
                        <canvas id="chart-view-tosle"></canvas>
                    </div>
                </section>
            </div>
        </div>
        <div class="col-6">
            <div>
                <section class="block-stat" id="stat-visit">
                    <div class="title">
                        <h4>Registration to the site</h4>
                        <select id="select-user-registered" onchange="statUserRegistered()">
                            <option value="month">month</option>
                            <option value="year">year</option>
                            <option value="day">day</option>
                        </select>
                    </div>
                    <div class="container" id="stat-tosle">
                        <canvas id="chart-user-registered-year" style="display: none;"></canvas>
                        <canvas id="chart-user-registered-month"></canvas>
                        <canvas id="chart-user-registered-day" style="display: none;"></canvas>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div>
                <section class="block-stat" id="stat-visit">
                    <div class="title">
                        <h4>Lesson consulted</h4>
                        <select id="select-class" onchange="statClassConsulted()">
                            <option value="month">month</option>
                            <option value="year">year</option>
                            <option value="day">day</option>
                        </select>
                    </div>
                    <div class="container" id="stat-tosle">
                        <canvas id="chart-class-consulted-year" style="display: none;"></canvas>
                        <canvas id="chart-class-consulted-month"></canvas>
                        <canvas id="chart-class-consulted-day" style="display: none;"></canvas>
                    </div>
                </section>
            </div>
        </div>
        <div class="col-6">
            <div>
                <section class="block-stat" id="stat-visit">
                    <div class="title">
                        <h4>Article consulted</h4>
                        <select id="select-article" onchange="statBlogConsulted()">
                            <option value="month">month</option>
                            <option value="year">year</option>
                            <option value="day">day</option>
                        </select>
                    </div>
                    <div class="container" id="stat-tosle">
                        <canvas id="chart-article-consulted-year" style="display: none;"></canvas>
                        <canvas id="chart-article-consulted-month"></canvas>
                        <canvas id="chart-article-consulted-day" style="display: none;"></canvas>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<script>

    function getMonth() {
        var month = new Array();
        month[0] = "January";
        month[1] = "February";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";

        var d = new Date();
        var n = month[d.getMonth()];

        return n;
    }
    function getDay() {
        var d = new Date();
        var dayIndex = d.getDay();
        return ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"][dayIndex];
    }

    var currentTime = new Date();
    var year = currentTime.getFullYear();

    var containerStatTosle = document.getElementById('chart-view-tosle');
    var chartViewTosle = new Chart(containerStatTosle, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: "Number of visitor",
                data: <?php echo '[' . implode(' ,', $statViewTosle) . ']'; ?>,
                fill: false,
                borderColor: "#1A5CCB",
                lineTension: 0.1
            }]
        },
        options: {
            showLines: true
        }
    });

    var statUserRegisteredDay = document.getElementById('chart-user-registered-day');
    var statUserRegisteredMonth = document.getElementById('chart-user-registered-month');
    var statUserRegisteredYear = document.getElementById('chart-user-registered-year');

    var chartUserRegisteredByYear = new Chart(statUserRegisteredYear, {
        type: 'doughnut',
        data: {
            labels: [year.toString()],
            datasets: [
                {
                    label: "User registered",
                    data: <?php if (isset($statUserRegisteredYear)) echo '[' . $statUserRegisteredYear . ']'; else echo '[0]'; ?>,
                    backgroundColor: ["#3e95cd"]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of user registered this year'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });
    var chartUserRegisteredByMonth = new Chart(statUserRegisteredMonth, {
        type: 'doughnut',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [
                {
                    label: "User registered",
                    data: <?php echo '[' . implode(' ,', $statUserRegisteredMonth) . ']'; ?>,
                    backgroundColor: ["#a6cee3", "#1f78b4", "#b2df8a", "#33a02c", "#fb9a99", "#e31a1c", "#fdbf6f", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of user registered this month'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });
    var chartUserRegisteredByDay = new Chart(statUserRegisteredDay, {
        type: 'doughnut',
        data: {
            labels: [getDay()],
            datasets: [
                {
                    label: "User registered",
                    data: <?php if (isset($statUserRegisteredDay)) echo '[' . $statUserRegisteredDay . ']'; else echo '[0]'; ?>,
                    backgroundColor: ["#5AD3D1"]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of user registered this day'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });

    function statUserRegistered() {
        var selected = document.getElementById("select-user-registered").value;

        switch (selected) {
            case 'year' :
                statUserRegisteredDay.style.display = "none";
                statUserRegisteredYear.style.display = "block";
                statUserRegisteredMonth.style.display = "none";
                break;

            case 'month' :
                statUserRegisteredDay.style.display = "none";
                statUserRegisteredYear.style.display = "none";
                statUserRegisteredMonth.style.display = "block";
                break;

            case 'day' :
                statUserRegisteredDay.style.display = "block";
                statUserRegisteredYear.style.display = "none";
                statUserRegisteredMonth.style.display = "none";
                break;

        }
    }

    var chartClassByYear = document.getElementById('chart-class-consulted-year');
    var chartClassByMonth = document.getElementById('chart-class-consulted-month');
    var chartClassByDay = document.getElementById('chart-class-consulted-day');

    var chartClassMonth = new Chart(chartClassByMonth, {
        type: 'pie',
        data: {
            labels: <?php if (isset($labelStatClassMonth)) echo $labelStatClassMonth; else echo '["empty"]'; ?>,
            datasets: [
                {
                    label: "Consulted class",
                    data: <?php if (isset($statClassMonth)) echo $statClassMonth; else echo '[0]'; ?>,
                    backgroundColor: ["#a6cee3", "#1f78b4", "#b2df8a", "#33a02c", "#fb9a99", "#e31a1c", "#fdbf6f", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of consultation of a class this month'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });
    var chartClassYear = new Chart(chartClassByYear, {
        type: 'pie',
        data: {
            labels: <?php if (isset($labelStatClassYear)) echo $labelStatClassYear; else echo '["empty"]'; ?>,
            datasets: [
                {
                    label: "Consulted class",
                    data: <?php if (isset($statClassYear)) echo $statClassYear; else echo '[0]'; ?>,
                    backgroundColor: ["#a6cee3", "#1f78b4", "#b2df8a", "#33a02c", "#fb9a99", "#e31a1c", "#fdbf6f", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"]
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of consultation of a class this year'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });
    var chartClassDay = new Chart(chartClassByDay, {
        type: 'pie',
        data: {
            labels: <?php if (isset($labelStatClassDay)) echo $labelStatClassDay; else echo '["empty"]'; ?>,
            datasets: [
                {
                    label: "Consulted class",
                    data: <?php if (isset($statClassDay)) echo $statClassDay; else echo '[0]'; ?>,
                    backgroundColor: ["#a6cee3", "#1f78b4", "#b2df8a", "#33a02c", "#fb9a99", "#e31a1c", "#fdbf6f", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of consultation of a class this day'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });

    function statClassConsulted() {
        var selected = document.getElementById("select-class").value;

        switch (selected) {
            case 'year' :
                chartClassByDay.style.display = "none";
                chartClassByYear.style.display = "block";
                chartClassByMonth.style.display = "none";
                break;

            case 'month' :
                chartClassByDay.style.display = "none";
                chartClassByYear.style.display = "none";
                chartClassByMonth.style.display = "block";
                break;

            case 'day' :
                chartClassByDay.style.display = "block";
                chartClassByYear.style.display = "none";
                chartClassByMonth.style.display = "none";
                break;

        }
    }

    var chartArticleByYear = document.getElementById('chart-article-consulted-year');
    var chartArticleByMonth = document.getElementById('chart-article-consulted-month');
    var chartArticleByDay = document.getElementById('chart-article-consulted-day');

    var chartArticleMonth = new Chart(chartArticleByMonth, {
        type: 'pie',
        data: {
            labels: <?php if (isset($labelStatBlogMonth)) echo $labelStatBlogMonth; else echo '["empty"]'; ?>,
            datasets: [
                {
                    label: "Consulted article",
                    data: <?php if (isset($statBlogMonth)) echo $statBlogMonth; else echo '[0]'; ?>,
                    backgroundColor: ["#F6511D", "#F3A712", "#073475", "#8EA604", "#FF006E", "#8338EC", "#3A86FF", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of consultation of a article this month'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });
    var chartArticleYear = new Chart(chartArticleByYear, {
        type: 'pie',
        data: {
            labels: <?php if (isset($labelStatBlogYear)) echo $labelStatBlogYear; else echo '["empty"]'; ?>,
            datasets: [
                {
                    label: "Consulted class",
                    data: <?php if (isset($statBlogYear)) echo $statBlogYear; else echo '[0]'; ?>,
                    backgroundColor: ["#F6511D", "#F3A712", "#073475", "#8EA604", "#FF006E", "#8338EC", "#3A86FF", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of consultation of a article this year'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }

        }
    });
    var chartArticleDay = new Chart(chartArticleByDay, {
        type: 'pie',
        data: {
            labels: <?php if (isset($labelStatBlogDay)) echo $labelStatBlogDay; else echo '["empty"]'; ?>,
            datasets: [
                {
                    label: "Consulted class",
                    data: <?php if (isset($statBlogDay)) echo $statBlogDay; else echo '[0]'; ?>,
                    backgroundColor: ["#F6511D", "#F3A712", "#073475", "#8EA604", "#FF006E", "#8338EC", "#3A86FF", "#ff7f00", "#cab2d6", "#6a3d9a", "#ffff99", "#b15928"],
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Number of consultation of a article this day'
            },
            animation: {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true
            }
        }
    });

    function statBlogConsulted() {
        var selected = document.getElementById("select-article").value;

        switch (selected) {
            case 'year' :
                chartArticleByDay.style.display = "none";
                chartArticleByYear.style.display = "block";
                chartArticleByMonth.style.display = "none";
                break;

            case 'month' :
                chartArticleByDay.style.display = "none";
                chartArticleByYear.style.display = "none";
                chartArticleByMonth.style.display = "block";
                break;

            case 'day' :
                chartArticleByDay.style.display = "block";
                chartArticleByYear.style.display = "none";
                chartArticleByMonth.style.display = "none";
                break;

        }
    }

</script>
