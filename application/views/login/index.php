  <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">LOGIN</h3>
                                       <?= $this->session->flashdata('massage'); ?>

                                       <form class="user" method="post" action="<?= base_url('login'); ?>">
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address" value="<?= set_value('email');  ?>">
                                                <?= form_error('email', '<small class="text-danger pl-3">','</small>'); ?>
                                            </div>
                                            <div class="form-floating mb-3">
                                                 <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                                 <?= form_error('password', '<small class="text-danger pl-3">','</small>'); ?>
                                            </div>
                                             <button type="submit" class="btn btn-primary btn-user btn-block">
                                             Login
                                            </button>
                                            </div>
                                        </form>
                                       
                                        <div class="card-footer text-center py-4">
                                      
                                       </div>
                                 
                                    </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

  