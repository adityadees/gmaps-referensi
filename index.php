<?php
include "config.php";
?>

<html>    
<head> 
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="assets/css/gmaps.css" />
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="assets/js/gmap3.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAogXD-AHrsmnWinZIyhRORJ84bgLwDPpg"></script>


  <body>
    <div id="test" class="gmap3"></div>
    <script>
      $(function () {
        $('#test')
        .gmap3({
          center: [-1.7333385,102.7458134],
          zoom: 8
        })

        .cluster({
          size: 200,
          markers: [

          <?php
          $query = mysqli_query($connect,"select * from lokasi");
          while ($data = mysqli_fetch_array($query))
          {
            $lat = $data['lat'];
            $lng = $data['lng'];
            $value=$data['value'];
            ?>

            {position: [<?php echo $lat;?>, <?php echo $lng;?>], icon: <?php if ($value>50){echo "'https://png.icons8.com/color/50/000000/green-flag.png'";} else{ echo "'https://png.icons8.com/color/50/000000/filled-flag.png'";}?>},

            <?php
          }
          ?> 	
          ],
          cb: function (markers) {
            if (markers.length > 1) { 
              if (markers.length < 20) {
                return {
                  content: "<div class='cluster cluster-1'>" + markers.length + "</div>",
                  x: -26,
                  y: -26
                };
              }
              if (markers.length < 50) {
                return {
                  content: "<div class='cluster cluster-2'>" + markers.length + "</div>",
                  x: -26,
                  y: -26
                };
              }
              return {
                content: "<div class='cluster cluster-3'>" + markers.length + "</div>",
                x: -33,
                y: -33
              };
            }
          }
        })
        ;
      });
    </script>

  </body>
  </html>