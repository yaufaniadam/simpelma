

    <!-- Main content -->
    <section class="content pt-5">
      <div class="container-fluid">
        <div class="row">
         <!-- <div class="col-md-4">

            <!-- Profile Image --
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">

                   <?php if($mahasiswa['photo'] == '' ) { ?>
                     
                      <img class="profile-mahasiswa-img img-fluid img-circle"
                            src="<?=base_url(); ?>public/dist/img/avatar5.png"
                            alt="mahasiswa profile picture">

                    <?php } else { ?>

                      <img class="profile-mahasiswa-img img-fluid img-circle"
                            src="<?=base_url($mahasiswa['photo'] ); ?>"> 

                    <?php } ?>


                </div>

                <h3 class="profile-mahasiswaname text-center"><?=$mahasiswa['firstname'];?></h3>
                             
               
              </div>
              <!-- /.card-body --
            </div>
            <!-- /.card --

            <!-- About Me Box --
           
          </div>
          !-- /.col -->
          <div class="col-md-6">
             <div class="card card-warning card-outline">
              
              <div class="card-body">

                
                <strong><i class="fas fa-user mr-1"></i>Username</strong>
                <p class="text-muted">
                  <?php echo $mahasiswa['username']; ?>
                </p>
                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                <p class="text-muted">
                  <?php echo $mahasiswa['email']; ?>
                </p>
              
               

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

 <script>
  $("#pengguna").addClass('menu-open');
</script>
