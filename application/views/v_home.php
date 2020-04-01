<!-- ##### Hero Area Start ##### -->
    <section class="hero-area bg-img bg-overlay-2by5" style="background-image: url(<?php echo base_url("assets/img/bg-img/bc8.jpg");?>);">
        <p class="text-white"><h10>Photo by 烧不酥在上海 老的 on Unsplash</h10></p>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Hero Content -->
                    <div class="hero-content text-center">
                        <h2>Social Distancing</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->
    <!--Ambil Data JSON dari folder assets/json-->
    <?php
      $file = 'assets/json/corona.json';
      $req=file_get_contents($file);
      $get_json=json_decode($req,true);
    

      foreach ($get_json as $key => $d) {
    // Perbarui data kedua
        if ($d['attributes']['OBJECTID'] === 87) {
    
           $negara = $get_json[$key]['attributes']['Country_Region'];
           $terjangkit = $get_json[$key]['attributes']['Confirmed'];
           $perawatan = $get_json[$key]['attributes']['Active'];
           $sembuh = $get_json[$key]['attributes']['Recovered'];
           $meninggal = $get_json[$key]['attributes']['Deaths'];
           $update = $get_json[$key]['attributes']['Last_Update'];
        }
      }

      $update = "/Date(".$update.")/";
      $timestamp = preg_replace( '/[^0-9]/', '', $update );
      $date = date("d-m-Y H:i", $timestamp / 1000);

      ?>
    <!-- ##### Cool Facts Area Start ##### -->
    <section class="cool-facts-area section-padding-100-0">
        <div class="container">
           <h2>Data Pandemi Covid-19 di <?php echo $negara; ?></h2>
            <h6>Terakhir diperbaharui <?php echo $date; ?></h6><p><a href="<?php echo base_url("Home") ?>" class="text-primary">Perbarui data</a></p> 
            <div class="row">
                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp bg-light" data-wow-delay="250ms">
                        <div class="icon">
                            <img src="<?php echo base_url()?>assets/img/core-img/tertular.png" alt="">
                        </div>
                        <h1><span class="counter text-danger"><?php echo $terjangkit; ?></span></h1>
                        <h6>Orang</h6>
                        <h4>Terjangkit Virus</h4>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp bg-light" data-wow-delay="500ms">
                        <div class="icon">
                            <img src="<?php echo base_url()?>assets/img/core-img/dirawat.png" alt="">
                        </div>
                        <h1><span class="counter text-primary"><?php echo $perawatan; ?></span></h1>
                        <h6>Orang</h6>
                        <h4>Perawatan</h4>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp bg-light" data-wow-delay="750ms">
                        <div class="icon">
                            <img src="<?php echo base_url()?>assets/img/core-img/sembuh.png" alt="">
                        </div>
                         <h1><span class="counter text-success"><?php echo $sembuh; ?></span></h1>
                        <h6>Orang</h6>
                        <h4>Sembuh</h4>
                    </div>
                </div>

                <!-- Single Cool Facts Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp bg-light" data-wow-delay="1000ms">
                        <div class="icon">
                            <img src="<?php echo base_url()?>assets/img/core-img/ko.png" alt="">
                        </div>
                        <h1><span class="counter"><?php echo $meninggal; ?></span></h1>
                        <h6>Orang</h6>
                        <h4>Meninggal</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Cool Facts Area End ##### -->

    <!-- ##### Popular Courses Start ##### -->
    <section class="popular-courses-area section-padding-100-0" style="background-image: url(assets/img/core-img/texture.png);">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Data Provinsi Terpapar Virus Covid-19</h3>
                        
                    </div>
                </div>
            </div>
            <label for="input">Cari Provinsi</label>
            <input type='text' id='input' onkeyup='searchTable()' placeholder="Cari berdasarkan provinsi" class="form-control" width="10px">
            <table class="table table-boarder">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Provinsi</th>
                    <th>Positif</th>
                    <th>Sembuh</th>
                    <th>Meninggal</th>
                  </tr>
                </thead>
              <?php
              $file1= "assets/json/corona_indo.json";
              $req1=file_get_contents($file1);
              $get_json1=json_decode($req1,true);
              $nomer=1;
              for($i=0;$i<count($get_json1);$i++){
                ?>
                <?php
                echo "<tr><td>".$nomer++."</td>";
                echo "<td>".$get_json1[$i]['attributes']['Provinsi']."</td>";
                echo "<td>".$get_json1[$i]['attributes']['Kasus_Posi']."</td>";
                echo "<td>".$get_json1[$i]['attributes']['Kasus_Semb']."</td>";
                echo "<td>".$get_json1[$i]['attributes']['Kasus_Meni']."</td></tr>";
                ?>
                <?php
              }
              ?>
            </table>
        <p>Sumber data : </p><p><a href="https://api.kawalcorona.com/" class="text-primary">www.kawalcorona.com</a></p>

            </div>
        </div>
    </section>
    <!-- ##### Popular Courses End ##### -->

</body>

</html>

 <script>
      function searchTable() {
          var input;
          var saring;
          var status; 
          var tbody; 
          var tr; 
          var td;
          var i; 
          var j;
          input = document.getElementById("input");
          saring = input.value.toUpperCase();
          tbody = document.getElementsByTagName("tbody")[0];;
          tr = tbody.getElementsByTagName("tr");
          for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td");
              for (j = 0; j < td.length; j++) {
                  if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                      status = true;
                  }
              }
              if (status) {
                  tr[i].style.display = "";
                  status = false;
              } else {
                  tr[i].style.display = "none";
              }
          }
      }
    </script>