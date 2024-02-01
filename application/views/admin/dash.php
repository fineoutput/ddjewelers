      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <!-- <small>Version 2.0</small> -->
          </h1>
          <ol class="breadcrumb">
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i style="margin-top: 20px;" class="ionicons ion-android-happy"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Users</span>
                  <span class="info-box-number"><? $this->db->select('*');
                                                $this->db->from('tbl_users');
                                                $total_users = $this->db->count_all_results();
                                                echo $total_users;
                                                ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i style="margin-top: 20px;" class="ionicons ion-bag"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">New Orders</span>
                  <span class="info-box-number"><? $this->db->select('*');
                                                $this->db->from('tbl_order1');
                                                $this->db->where('order_status', 1);
                                                $new_orders = $this->db->count_all_results();
                                                echo $new_orders;
                                                ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i style="margin-top: 20px;" class="ionicons ion-android-bookmark"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Category</span>
                  <span class="info-box-number"><?= $category ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <a href="<?=base_url()?>dcadmin/Products/view_cron_job">
                <div class="info-box">
                  <span class="info-box-icon bg-purple"><i style="margin-top: 20px;" class="ionicons ion-android-bookmark"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Cron Cobs</span>
                    <span class="info-box-number">View Cron Jobs</span>
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
              </a>
            </div><!-- /.col -->
          </div><!-- /.row -->


          <? $i = 1;
          foreach ($inventory->result() as $data) {
            $tid = $data->tid;
            $pid = $data->pid;

            $this->db->select('*');
            $this->db->from('tbl_types');
            $this->db->where('id', $tid);
            $data = $this->db->get();

            $i = 1;
            foreach ($data->result() as $da) {
              $name = $da->name;

              $this->db->select('*');
              $this->db->from('tbl_products');
              $this->db->where('id', $pid);
              $da = $this->db->get();



              $i = 1;
              foreach ($da->result() as $dam) {
                $na = $dam->product_name;


          ?>
              <? $i++;
              } ?>
            <? $i++;
            } ?>

            <div class="alert alert-warning alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <? echo 'Inventory less than 10 for Product ' . $na .  ' and Type ', $name; ?>
              <? $this->session->unset_userdata('smessage'); ?>
            </div>
          <? $i++;
          } ?>



        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      </div><!-- ./wrapper -->