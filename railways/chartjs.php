<?php
session_start();
include_once('config/database.php');

if(!isset($_SESSION['username'])){
    header('location: login.php');
}
else {
$username=$_SESSION['username'];
$get_user="select * from users where username='$username'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$id=$row['id'];
$user_password=$row['password'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" name="viewport">
  <title>Railway Tweets Portal</title>

  <link rel="stylesheet" href="dist/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/modules/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css">

  <!-- <link rel="stylesheet" href="dist/css/demo.css"> -->
  <link rel="stylesheet" href="dist/css/style.css">
</head>

<body class="sidebar-gone">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg "></div>
      <nav class="navbar navbar-expand-lg main-navbar ">
        
      </nav>
      <div class="main-sidebar">
        
      </div>
      <div class="main-content">
        <section class="section">
          <div><h3 class="section-header">
            Tweets Analysis
            <a style="float:right;"href="index.php"><button class="btn btn-primary navbar-right b2">Back</button></a>
          </h1>
          </div>
          <div class="section-body">
            <!-- <div class="card">
              <div class="card-body">
                <div class="alert alert-info mb-0">
                  We use 'Chart.JS' made by @chartjs. You can check the full documentation <a href="http://www.chartjs.org/">here</a>.
                </div>
              </div>
            </div> -->
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Emergency Tweets Chart (Montly Basis)</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Feedback Tweets Chart (Montly Basis)</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart2"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Emergency Tweets Categorization</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Feedback tweets Categorization</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart4"></canvas>
                  </div>
                </div>
              </div>
            </div>
        </section>
      </div>
    </div>
  </div>

  <script src="dist/modules/jquery.min.js"></script>
  <script src="dist/modules/popper.js"></script>
  <script src="dist/modules/tooltip.js"></script>
  <script src="dist/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="dist/modules/scroll-up-bar/dist/scroll-up-bar.min.js"></script>
  <script src="dist/js/sa-functions.js"></script>
  
  <script src="dist/modules/chart.min.js"></script>
  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["11/2019", "12/2019", "01/2020", "02/2020","03/2020"],
        datasets: [{
          label: 'Emergency',
          data: [13, 12, 20, 13,9],
          borderWidth: 2,
          backgroundColor: 'rgb(87,75,144)',
          borderColor: 'rgb(87,75,144)',
          borderWidth: 2.5,
          pointBackgroundColor: '#ffffff',
          pointRadius: 4
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 9
            }
          }],
          xAxes: [{
            ticks: {
              display: false
            },
            gridLines: {
              display: false
            }
          }]
        },
      }
    });

    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["11/2019", "12/2019", "01/2020", "02/2020","03/2020"],
        datasets: [{
          label: 'Feedbacks',
          data: [43, 32, 27, 23, 19],
          borderWidth: 2,
          backgroundColor: 'rgb(87,75,144)',
          borderColor: 'rgb(87,75,144)',
          borderWidth: 2.5,
          pointBackgroundColor: '#ffffff',
          pointRadius: 4
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 10
            }
          }],
          xAxes: [{
            ticks: {
              display: false
            },
            gridLines: {
              display: false
            }
          }]
        },
      }
    });

    var ctx = document.getElementById("myChart3").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [
            8,
            38,
            36,
            14,
            32,
          ],
          backgroundColor: [
            '#574B90',
            '#28a745',
            '#ffc107',
            '#dc3545',
            '#343a40',
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Medical',
          'AC Complaint',
          'Train Component',
          'Water Complaint',
          'Others'
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom',
        },
      }
    });

    var ctx = document.getElementById("myChart4").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            24,
            44,
            38,
            12,
            36,
          ],
          backgroundColor: [
            '#574B90',
            '#28a745',
            '#ffc107',
            '#dc3545',
            '#343a40',
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Train Timing',
          'Food Feedback',
          'Cleanliness',
          'Ticket Serivces',
          'Others'
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom',
        },
      }
    });
  </script>
  <script src="dist/js/scripts.js"></script>
  <script src="dist/js/custom.js"></script>
  <!-- <script src="dist/js/demo.js"></script> -->
</body>
</html>
<?php } ?>