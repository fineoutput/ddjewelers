<div class="content-wrapper">
               <section class="content-header">
                  <h1>
                 Add New Products
                 </h1>

               </section>
           <section class="content">
           <div class="row">
              <div class="col-lg-12">

                               <div class="panel panel-default">
                                   <div class="panel-heading">
                                       <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add New Products</h3>
                                   </div>

                                            <? if(!empty($this->session->flashdata('smessage'))){  ?>
                                                 <div class="alert alert-success alert-dismissible">
                                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                             <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                            <? echo $this->session->flashdata('smessage');
                                            $this->session->unset_userdata('smessage'); ?>
                                           </div>
                                              <? }
                                              if(!empty($this->session->flashdata('emessage'))){  ?>
                                              <div class="alert alert-danger alert-dismissible">
                                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                           <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                          <? echo $this->session->flashdata('emessage');
                                          $this->session->unset_userdata('emessage');  ?>
                                         </div>
                                            <? }  ?>


                                   <div class="panel-body">
                                       <div class="col-lg-10">
                                          <form action=" <?php echo base_url()  ?>dcadmin/NewArrivals/add_products_data/<? echo base64_encode(1);  ?>" method="POST" id="slide_frm" enctype="multipart/form-data">
                                       <div class="table-responsive">
                                           <table class="table table-hover">

 <!-- <tr>
<td> <strong>Category</strong>  <span style="color:red;">*</span></strong> </td>
<td> -->
  <input type="hidden" value="1" name="post_en">
<!-- </td>
</tr> -->

<tr>
<td> <strong>Category IDs </strong>  <span style="color:red;">*</span></strong> </td>
<!-- <td>
<input type="text" class="form-control" name="api_ids" id="api_ids" value="" required>
</td> -->
<td> <input type="text" name="api_ids" id="api_ids"  class="form-control" placeholder="write  ,  seprated categoryIDs..." required value="" />  </td>
</tr>




<!-- <tr>
<td> <strong>Mini-SubCategory</strong>  <span style="color:red;">*</span></strong> </td>
<td> <select class="form-control" name="minisubcategory" id="minisubcategory">
    <option value="">Select MiniSubCategory</option>

</select>
</tr> -->


</tr>
  <!-- <tr>
<td class="text-center text-uppercase"> <strong>Click on the button to add new arrivals products.</strong> </strong> </td>

</tr> -->
  <tr>


                                 <tr class="mt-5 mb-5">
                                   <td colspan="2" class="text-center ">
                                     <input type="submit" class="btn btn-success" value="Add New Arrival Products">
                                   </td>
                                 </tr>
                                               </table>
                                           </div>

                                        </form>

                                           </div>



                                       </div>

                                   </div>

                               </div>
                               </div>
                   </section>
                 </div>


<script type="text/javascript" src=" <?php echo base_url()  ?>assets/slider/ajaxupload.3.5.js"></script>
     <link href=" <? echo base_url()  ?>assets/cowadmin/css/jqvmap.css" rel='stylesheet' type='text/css' />

     <script>

     $(document).ready(function(){
       	$("#category").change(function(){
     		var vf=$(this).val();
       //  var yr = $("#year_id option:selected").val();
     		if(vf==""){
     			return false;

     		}else{
     			$('#sub_category option').remove();
     			  // var opton="<option value='0'>Please select</option>";
     			  var opton="<option value='0'>No Sub Category</option>";
     			$.ajax({
     				url:base_url+"dcadmin/Products/getSub_category?isl="+vf,
     				data : '',
     				type: "get",
     				success : function(html){
     						if(html!="NA")
     						{
     							var s = jQuery.parseJSON(html);
     							$.each(s, function(i) {

     							opton +='<option value="'+s[i]['id']+'">'+s[i]['name']+'</option>';
     							});
     							$('#sub_category').append(opton);
     							//$('#city').append("<option value=''>Please Select State</option>");

                           //var json = $.parseJSON(html);
                           //var ayy = json[0].name;
                           //var ayys = json[0].pincode;
     						}
     						else
     						{
     							alert('No Sub Category Found');
     							return false;
     						}

     					}

     				})
     		}


     	})
     });
       </script>


       <script>

       $(document).ready(function(){
          $("#sub_category").change(function(){
          var vf=$(this).val();
         //  var yr = $("#year_id option:selected").val();
          if(vf==""){
            return false;

          }else{
            $('#minisubcategory option').remove();
              // var opton="<option value='0'>Please select</option>";
              var opton="<option value='0'>No Sub Category</option>";
            $.ajax({
              url:base_url+"dcadmin/Products/getminiSub_category?isl="+vf,
              data : '',
              type: "get",
              success : function(html){
                  if(html!="NA")
                  {
                    var s = jQuery.parseJSON(html);
                    $.each(s, function(i) {

                    opton +='<option value="'+s[i]['id']+'">'+s[i]['name']+'</option>';
                    });
                    $('#minisubcategory').append(opton);
                    //$('#city').append("<option value=''>Please Select State</option>");

                             //var json = $.parseJSON(html);
                             //var ayy = json[0].name;
                             //var ayys = json[0].pincode;
                  }
                  else
                  {
                    alert('No MiniSub Category Found');
                    return false;
                  }

                }

              })
          }


        })
       });
         </script>
