<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OnePage Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage - v3.0.1
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a>OnePage</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#departments">Kasus</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          {{-- <li><a href="#contact">Contact</a></li> --}}

        </ul>
      </nav><!-- .nav-menu -->

      <!-- <a href="#about" class="get-started-btn scrollto">Get Started</a> -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <h1>KAWAL CORONA</h1>
          <h2>Coronavirus Global & Indonesia Live Data</h2>
        </div>
      </div>  

      <div class="row icon-boxes">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
          <div class="card bg-danger img-card box-secondary-shadow">
           <div class="card-body">
            <div class="d-flex">
             <div class="text-white">
              <div class="ml-auto">
                 <img src="{{asset('assets/img/iconpositif.png')}}" width="50" height="50" alt="Positif">
              </div>
              <p class="text-white mb-0">TOTAL POSITIF</p>
              <span data-toggle="counter-up"><b><?php echo $posglobal['value'] ?></b></span>
              <p class="description">ORANG</p>
             </div>           
            </div>
           </div>
          </div>
         </div>

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
          <div class="card bg-primary img-card box-secondary-shadow">
           <div class="card-body">
            <div class="d-flex">
             <div class="text-white">
              <div class="ml-auto">
                 <img src="{{asset('assets/img/iconsembuh.png')}}" width="50" height="50" alt="Sembuh">
              </div>
              <p class="text-white mb-0">TOTAL SEMBUH</p>
              <span data-toggle="counter-up"><b><?php echo $semglobal['value'] ?></b></span>
              <p class="description">ORANG</p>
             </div>           
            </div>
           </div>
          </div>
         </div>
        

        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
          <div class="card  bg-success img-card box-success-shadow">
           <div class="card-body">
            <div class="d-flex">
             <div class="text-white">
              <div class="ml-auto">
                 <img src="{{asset('assets/img/iconmeninggal.png')}}" width="50" height="50" alt="Meninggal"> 
              </div>
              <p class="text-white mb-0">TOTAL MENINGGAL</p>
              <span data-toggle="counter-up"><b><?php echo $menglobal['value'] ?></b></span>
              <p class="description">ORANG</p>
             </div>            
            </div>
           </div>
          </div>
        </div>
      
         <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
          <div class="card  bg-info img-card box-success-shadow">
           <div class="card-body">
            <div class="d-flex">
             <div class="text-white">
              <div class="ml-auto"> <img src="{{asset('assets/img/iconindonesia.png')}}" width="50" height="50" alt="Positif"> </div>
              <h2 class="text-white mb-0">INDONESIA</h2>
              <p class="mb-0 number-font"><b>{{$positif}}</b> POSITIF, <b>{{$sembuh}}</b> SEMBUH, <b>{{$meninggal}}</b> MENINGGAL</p>
             </div>
            </div>
           </div>
          </div>
         </div>
       
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

  <section id="departments" class="departments">
    <div class="row">
     <div class="col-sm">
      <div class="card">
            <div class="card-header ">
                    <h3 class="card-title">Data Kasus Corona virus Global</h3>
                    </div>
                     <div class="card-body" >
                         <div style="height:600px;overflow:auto;margin-right:15px;">
                                 <table class="table table-striped"  fixed-header  >
                                 <thead>
                                     <tr>
                                     <th scope="col">No</th>
                                     <th scope="col">Negara</th>
                                     <th scope="col">Positif</th>
                                     <th scope="col">Sembuh</th>
                                     <th scope="col">Meninggal</th>
                                     </tr>
                                 </thead>
                                 <tbody>
             
                                 @php
                                     $no = 1;    
                                 @endphp
                                 <?php
                                     for ($i= 0; $i <= 191; $i++){
             
                                     
                                     ?>
                                 <tr>
                                     <td> <?php echo $i+1 ?></td>
                                     <td> <?php echo $dunia[$i]['attributes']['Country_Region'] ?></td>
                                     <td> <?php echo $dunia[$i]['attributes']['Confirmed'] ?></td>
                                     <td><?php echo $dunia[$i]['attributes']['Recovered']?></td>
                                     <td><?php echo $dunia[$i]['attributes']['Deaths']?></td>
                                 </tr>
                                     <?php 
                                 
                                 } ?>
                                 </tbody>
                                 </table>
                                
                               
                     </div>
                   </div>
                   <br>
                   
                   <div class="card mb-4">
                            <div class="card-header">
                                    Data Coronavirus Berdasarkan Provinsi di Negara Indonesia
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>NO.</th>
                                             
                                                <th>PROVINSI</th>
                                                <th>POSITIF</th>
                                                <th>SEMBUH</th>
                                                <th>MENINGGAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $no=1; @endphp
                                        @foreach ($tampil as $tmp)
                                        <tr>
                                            <th>{{$no++}}</th>
                                            
                                            <th>{{$tmp->nama_provinsi}}
                                              <th>{{number_format($tmp->Positif)}}</th>
                                              <th>{{number_format($tmp->Sembuh)}}</th>
                                              <th>{{number_format($tmp->Meninggal)}}</th>  
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
     </div>
     
    </section>

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Portfolio</h2>
          <p>5 Cara Efektif Agar Tidak Tertular Virus Corona.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-lg-12 d-flex justify-content-center">
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/mencucitangan.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4></h4>
                <p>Mencuci tangan dengan benar adalah cara paling sederhana namun efektif untuk mencegah penyebaran virus 2019-nCoV. Cucilah tangan dengan air mengalir dan sabun, setidaknya selama 20 detik. Pastikan seluruh bagian tangan tercuci hingga bersih, termasuk punggung tangan, pergelangan tangan, sela-sela jari, dan kuku.</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/mencucitangan.jpg" data-gall="portfolioGallery" class="venobox" title="Mencuci Tangan"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/masker.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4></h4>
                <p>Bersihkan Wajah Terlebih Dahulu. Sebelum memakai masker, pastikan dulu bahwa kulit wajahmu sudah bersih secara menyeluruh.</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/masker.jpg" data-gall="portfolioGallery" class="venobox" title="Masker"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/jagajarak.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <p>Sapa orang lain dengan lambaian tangan, bukan dengan berjabat tangan.</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/jagajarak.png" data-gall="portfolioGallery" class="venobox" title="Jaga Jarak"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/dayatahantubuh.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <p>Konsumsi makanan bergizi seimbang, Perbanyak konsumsi vitamin C, Istirahat cukup, Kelola stres,
                    Rajin berolahraga, Menghindari rokok, Rajin cuci tangan, Jaga kebersihan diri.</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/dayatahantubuh.png" data-gall="portfolioGallery" class="venobox" title="Daya Tahan Tubuh"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/membersihkanrumah.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <p>Menjaga kebersihan rumah juga sangat penting dilakukan selama pandemi COVID-19 berlangsung.
                 Hal ini dikarenakan virus Corona terbukti dapat bertahan hidup selama berjam-jam dan bahkan berhari-hari di permukaan suatu benda.</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/membersihkanrumah.jpg" data-gall="portfolioGallery" class="venobox" title="Membersihkan Rumah"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>


        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Contact Section ======= -->
    {{-- <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
        </div>

        <div class="row mt-5">

          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-3">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section --> --}}

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>OnePage</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>