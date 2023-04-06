<style>
    .dashboard_menu .nav-tabs li.nav-item a {
        text-align: left;
        padding: 12px 20px;
        border-radius: 0;
        border-bottom: 1px solid #efefef;
        color: #2b2f4c;

    }

    .dashboard_menu .nav-tabs li.nav-item a.active {
        background-color: #5f8fb3;
        color: #fff;
    }


    .nav-tabs li.nav-item a {

        border: 0;
        font-weight: 500;
        text-align: center;
        text-transform: capitalize;
        padding: 5px 20px;
    }

    .dashboard {
        padding: 15px 20px;
    }

    .dashboard_content {
        margin: 0;
    }


    .faq-drawer {
        /* margin-bottom: 20px; */
    }

    .faq-drawer__content-wrapper {
        font-size: 1.25em;
        line-height: 1.4em;
        max-height: 0px;
        overflow: hidden;
        transition: 0.25s ease-in-out;
        margin: 15px 0 0 25px;
    }

    .faq-drawer__title {
        border-top: #efefef 1px solid;
        cursor: pointer;
        display: block;

        padding: 20px 0 0 0;
        position: relative;
        margin-bottom: 0;
        transition: all 0.25s ease-out;
        color: #2b2f4c;
        left: 25px;
    }

    .faq-drawer__title::after {
        border-style: solid;
        border-width: 1px 1px 0 0;
        content: " ";
        display: inline-block;
        float: right;
        height: 10px;
        left: 2px;
        position: relative;
        right: 20px;
        top: 2px;
        transform: rotate(135deg);
        transition: 0.35s ease-in-out;
        vertical-align: top;
        width: 10px;

    }


    /* OPTIONAL HOVER STATE */
    .faq-drawer__title:hover {
        color: #5f8fb3;
    }

    .faq-drawer__trigger:checked+.faq-drawer__title+.faq-drawer__content-wrapper {
        max-height: 350px;
    }

    .faq-drawer__trigger:checked+.faq-drawer__title::after {
        transform: rotate(-45deg);
        transition: 0.3s ease-in-out;
        color: #5f8fb3;
    }

    input[type="checkbox"] {
        display: none;
    }


    @media screen and (max-width: 767px) and (min-width: 360px) {
        container {
            padding: 20px;
        }

        .dashboard_content {
            padding: 15px 20px;
        }

        .faq-drawer__title {

            color: #2b2f4c;
            font-size: 1.05em;
            left: 0px;
        }


    }




    /* .accordion .container.active .label::before {
  content: url();
  font-size: 30px;
  color: #5f8fb3;
} */
</style>

<h3 class="text-center mb-4 mt-4">FAQ</h3>


<p class="mb-4 mt-4">

<div class="section desktopsection">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="dashboard_menu" style="box-shadow: 0 0px 4px 0 #e9e9e9;">
                    <ul class="nav nav-tabs flex-column" role="tablist">
                     <? $i=0; foreach($faq_category_data->result() as $faq_cat1){?>
                        <li class="nav-item">
                            <a class="nav-link <?if($i==0){echo 'active';}?>" id="<?=$faq_cat1->name?>" data-toggle="tab" href="#tab_<?=$faq_cat1->id?>" role="tab" aria-controls="<?=$faq_cat1->name?>" aria-selected="false"><?=$faq_cat1->name?></a>
                        </li>
                        <?$i++;}?>
                    </ul>
                </div>
            </div>


            <div class="col-lg-9 col-sm-6">
                <div class="tab-content dashboard_content">
                <? $a=0; foreach($faq_category_data2->result() as $faq_cat){
                    $q_a_data = $this->db->order_by('sequence','asc')->get_where('tbl_faq_qna', array('is_active'=> 1,'cat_id'=> $faq_cat->id))->result();   
                    ?>
        <div class="tab-pane fade  <?if($a==0){echo 'active show';}?>" id="tab_<?=$faq_cat->id?>" class="dashboard" role="tabpanel" aria-labelledby="<?=$faq_cat->name?>-tab">
                    <?$b=121;foreach($q_a_data as $q_a){
                        ?>
                        <div class="faq-drawer">
                            <input class="faq-drawer__trigger" id="faq-drawer-<?=$q_a->id.$b?>" type="checkbox" /><label class="faq-drawer__title" for="faq-drawer-<?=$q_a->id.$b?>" style="display: flex;justify-content: space-between;"><b><?=$q_a->question?></b></label>
                            <div class="faq-drawer__content-wrapper">
                                <div class="faq-drawer__content">      
                                    <?=$q_a->answer?>
                                </div>
                            </div>
                        </div>
                        <?$b++;}?>
                    </div>
                    <?$a++;}?>
                </div>
            </div>
        </div>
    </div>
</div>




</p>