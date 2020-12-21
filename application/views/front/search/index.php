<style>
    #search-banner{
        background-image: url(template/newAboutUs/images/banner/0.jpg);
        background-size: cover;
        min-height:360px;
    }
    .page-title{
        text-align:center;
        color:#e62e04;
        padding:20px;
    }
    .main-search{
        margin:50px;
    }
    .search-options{
        margin:auto;
    }
    .search-options input[type='text']{
        border-radius: 5px;
        height: 45px;
        margin-top: 30px;
        padding: 0.7em;
        margin: 0.4em 1em;
        background: none;
        outline: none;
        font-size: 1.1em;
        border: 1px solid #e6e6e6;
    }

    .search-options input[type='button']{
        width:150px; 
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.3333333;
        border-radius: 6px;
        color: #fff;
        background-color: #e62e04;
        border-color: #e62e04;
    }

    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 2px);
        width: 250px;
    }
   

</style>
<div class="noprint">

<section id="search-banner">
</section>

<section class="main-search">
    <div class="container">
<?php 
    if ($nav_dropdown == 'id-search')
    {
?>
        <h1 class="page-title">ID Search</h1>
        <form class="form-inline  text-center" id="search-form" action="<?php echo base_url('id-search')?>" method="post">
            <input type="hidden" name="search_type" value="id-search">
            <div class="form-group search-options">                
                <input type="text" class="form-control" name="search_id" id="search_id" placeholder="Enter ID" style=" width: 250px; height:45px; ">
                <input type="button" class="search-btn btn btn-lg btn-info btn-base-1" value="Submit">
            </div>
        </form>
        <script>
            $(document).ready(function() {
                $(".search-btn").click(function() {
                    var search_id = $("#search_id").val();
                    if (search_id.trim() == '')
                    {
                        $("#search_id").focus();
                        return;
                    }
                    filter_members(0);
                });
            });
        </script>
<?php
    }

    if ($nav_dropdown == 'basic-search')
    {
?>
        <h1 class="page-title">Basic Search</h1>
        <form class="form-inline  text-center" id="search-form" action="<?php echo base_url('basic-search')?>" method="post" style="flex-flow: column wrap;">
            <input type="hidden" name="search_type" value="basic-search">
            <div class="form-group search-options">
                <table>
                    <tbody>
                        <?php
                        $genders = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'gender');
                        if($genders == 1) $user_gender = 2;
                        else $user_gender = 1;
                        ?>
                        <input type="hidden" name="gender" value="<?php echo $user_gender; ?>">
                        <tr>
                            <td>Age: </td>
                            <td style="display:inline-flex">
                                <div class="col-md-6 ">
                                    <select class="form-control from-age" name="from_age" id="from_age" style="width:180px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <?php
                                        for ($i = 18; $i <=65; $i++ )
                                        {
                                    ?>
                                            <option value=<?php echo $i?>><?php echo $i?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>

                                <div class="col-md-6 contact-top2">
                                    <select class="form-control to-age" name="to_age" id="to_age" style="width:180px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <?php
                                        for ($i = 18; $i <=65; $i++ )
                                        {
                                    ?>
                                            <option value=<?php echo $i?>><?php echo $i?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Religion: </td>
                            <td>
                                <select class="form-control religion" name="religion" id="religion" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <option value="">Choose One</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Muslim">Muslim</option>
                                    <option value="Christian">Christian</option>
                                    <option value="Sikh">Sikh</option>
                                    <option value="Jain">Jain</option>
                                    <option value="Buddhist">Buddhist</option>
                                    <option value="Spiritual">Spiritual</option>
                                    <option value="Parsi">Parsi</option>
                                    <option value="Jewish">Jewish</option>
                                    <option value="Inter-Religion">Inter-Religion</option>
                                    <option value="Others">Others</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Caste: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control span12 caste" name="caste" id="caste" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                        <option value=""><?php echo translate('choose_religion_first')?></option>	
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>With Photo: </td>
                            <td>
                                <div class="col-md-12 text-left">
                                    <input type="checkbox" name="with_photo" class="checkbox" id="with_photo">                            
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group search-options">
                <input type="button" class="search-btn btn btn-lg btn-info btn-base-1" value="Submit">
            </div>
        </form>
        <script>
            $(document).ready(function(){                

                $(".religion").change(function(){
                    var religion_id = $(this).val();
                    if (religion_id == "") {
                        $(".caste").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {
                                $(".caste").html(data);
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });

                $(".search-btn").click(function() {
                    filter_members(0);
                });
            });

            function init()
            {
                $.ajax({
                    url: "<?=base_url()?>home/get_dropdown_by_id/religion", // form action url
                    type: 'POST', // form submit method get/post
                    dataType: 'html', // request type html/json/xml
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function(data) {
                        $(".religion").html(data);
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }

            init();
        </script>
<?php
    }

    if ($nav_dropdown == 'education-search')
    {
?>
        <h1 class="page-title">Education Search</h1>
        <form class="form-inline  text-center" id="search-form" action="<?php echo base_url('education-search')?>" method="post" style="flex-flow: column wrap;">
            <input type="hidden" name="search_type" value="education-search">
            <div class="form-group search-options">
                <table>
                    <tbody>
                    <?php
                        $genders = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'gender');
                        if($genders == 1) $user_gender = 2;
                        else $user_gender = 1;
                        ?>
                        <input type="hidden" name="gender" value="<?php echo $user_gender; ?>">
                        <tr>
                            <td>Age: </td>
                            <td style="display:inline-flex">
                                <div class="col-md-6 ">
                                    <select class="form-control from-age" name="from_age" id="from_age" style="width:180px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <?php
                                        for ($i = 18; $i <=65; $i++ )
                                        {
                                    ?>
                                            <option value=<?php echo $i?>><?php echo $i?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>

                                <div class="col-md-6 contact-top2">
                                    <select class="form-control to-age" name="to_age" id="to_age" style="width:180px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <?php
                                        for ($i = 18; $i <=65; $i++ )
                                        {
                                    ?>
                                            <option value=<?php echo $i?>><?php echo $i?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Education: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control country" name="education" id="education" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                             
                                    </select>
                                </div>                           
                            </td>
                        </tr>
                        <tr>
                            <td>With Photo: </td>
                            <td>
                                <div class="col-md-12 text-left">
                                    <input type="checkbox" name="with_photo" class="checkbox" id="with_photo">                            
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group search-options">
                <input type="button" class="search-btn btn btn-lg btn-info btn-base-1" value="Submit">
            </div>
        </form>
        <script>
            $(document).ready(function(){ 
                             
                
                $(".search-btn").click(function() {
                    filter_members(0);
                });
            });
            function init()
            {
                $.ajax({
                    url: "<?=base_url()?>home/get_dropdown_by_id/education", // form action url
                    type: 'POST', // form submit method get/post
                    dataType: 'html', // request type html/json/xml
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function(data) {
                        $(".country").html(data);
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }

            init();
        </script>
<?php
    }

    if ($nav_dropdown == 'location-search')
    {
?>
        <h1 class="page-title">Location Search</h1>
        <form class="form-inline  text-center" id="search-form" action="<?php echo base_url('location-search')?>" method="post" style="flex-flow: column wrap;">
            <input type="hidden" name="search_type" value="location-search">
            <div class="form-group search-options">
                <table>
                    <tbody>
                    <?php
                        $genders = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'gender');
                        if($genders == 1) $user_gender = 2;
                        else $user_gender = 1;
                        ?>
                        <input type="hidden" name="gender" value="<?php echo $user_gender; ?>">
                        <tr>
                            <td>Age: </td>
                            <td style="display:inline-flex">
                                <div class="col-md-6 ">
                                    <select class="form-control from-age" name="from_age" id="from_age" style="width:180px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <?php
                                        for ($i = 18; $i <=65; $i++ )
                                        {
                                    ?>
                                            <option value=<?php echo $i?>><?php echo $i?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>

                                <div class="col-md-6 contact-top2">
                                    <select class="form-control to-age" name="to_age" id="to_age" style="width:180px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                    <?php
                                        for ($i = 18; $i <=65; $i++ )
                                        {
                                    ?>
                                            <option value=<?php echo $i?>><?php echo $i?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Country: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control country" name="country" id="country" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                             
                                    </select>
                                </div>                           
                            </td>
                        </tr>
                        <tr>
                            <td>State: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control span12 state" name="state" id="state" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                        <option value=""><?php echo translate('choose_a_country_first')?></option>	
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <!--tr>
                            <td>District: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control span12 dist" name="dist" id="dist" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6" onchange="fillcity(this.value)">
                                        <option value="Any" selected="">Any</option>
                                    </select>
                                </div>
                            </td>
                        </tr-->
                        <tr>
                            <td>City: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control span12 city" name="city" id="city" style="width:390px;margin-top:7px;border:thin; border-style:solid;border-color:#e6e6e6">
                                        <option value=""><?php echo translate('choose_a_state_first')?></option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>With Photo: </td>
                            <td>
                                <div class="col-md-12 text-left">
                                    <input type="checkbox" name="with_photo" class="checkbox" id="with_photo">                            
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group search-options">
                <input type="button" class="search-btn btn btn-lg btn-info btn-base-1" value="Submit">
            </div>
        </form>
        <script>
            $(document).ready(function(){                
                $(".country").change(function(){
                    var country_id = $(this).val();
                    if (country_id == "") {
                        $(".state").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
                        $(".city").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {
                                $(".state").html(data);      
                                $(".city").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });
                

                $(".state").change(function(){
                    var state_id = $(this).val();
                    if (state_id == "") {
                        $(".city").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id/city/state_id/"+state_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {
                                $(".city").html(data);
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });

                $(".search-btn").click(function() {
                    filter_members(0);
                });
            });

            function init()
            {
                $.ajax({
                    url: "<?=base_url()?>home/get_dropdown_by_id/country", // form action url
                    type: 'POST', // form submit method get/post
                    dataType: 'html', // request type html/json/xml
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function(data) {
                        $(".country").html(data);
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }

            init();
        </script>
<?php
    }

    if ($nav_dropdown == 'advance-search')
    {
?>
        <h1 class="page-title">Advance Search</h1>
        <form class="form-inline  text-center" id="search-form" action="<?php echo base_url('advance-search')?>" method="post" style="flex-flow: column wrap;">
            <input type="hidden" name="search_type" value="advance-search">
            <div class="form-group search-options">
                <table>
                    <?php
                    $genders = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'gender');
                    if($genders == 1) $user_gender = 2;
                    else $user_gender = 1;
                    ?>
                    <input type="hidden" name="gender" value="<?php echo $user_gender; ?>">
                    <tbody>
                    <?php
                        $genders = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata('member_id'), 'gender');
                        if($genders == 1) $user_gender = 2;
                        else $user_gender = 1;
                        ?>
                        <input type="hidden" name="gender" value="<?php echo $user_gender; ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <td>Age: </td>
                                    <td style="display:inline-flex">
                                        <div class="col-md-6 ">
                                            <select class="form-control from-age" name="from_age" id="from_age" style="width: 108px; border:thin; border-style:solid;border-color:#e6e6e6">
                                            <?php
                                                for ($i = 18; $i <=65; $i++ )
                                                {
                                            ?>
                                                    <option value=<?php echo $i?>><?php echo $i?></option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>

                                        <div class="col-md-6 contact-top2">
                                            <select class="form-control to-age" name="to_age" id="to_age" style="width: 108px; border:thin; border-style:solid;border-color:#e6e6e6">
                                            <?php
                                                for ($i = 18; $i <=65; $i++ )
                                                {
                                            ?>
                                                    <option value=<?php echo $i?>><?php echo $i?></option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </td>
                                </div>
                                <div class='col-sm-4'>
                                    <td>MemberId:</td>
                                    <td>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="id" id="id" style="height: 35px;margin: 0em 0em;">
                                        </div>
                                    </td>
                                </div>
                                <div class='col-sm-4'>
                                <td>Height: </td>
                                    <td style="display:inline-flex">
                                        <div class="col-sm-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control form-control-sm height_mask" name="min_height" id="min_height" value="<?php if($min_height != ""){echo $min_height;}else{echo '0.00';}?>" style="width: 108px; border:thin; border-style:solid;border-color:#e6e6e6; height: 35px; font-size: 14px">
                                            <div class="help-block with-errors">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group has-feedback">
                                                <input type="text" class="form-control form-control-sm height_mask" name="max_height" id="max_height" value="<?php if($max_height != ""){echo $max_height;}else{echo '8.00';}?>" style="width: 108px; border:thin; border-style:solid;border-color:#e6e6e6; height: 35px; font-size: 14px">
                                            </div>
                                            <div class="help-block with-errors">
                                            </div>
                                        </div>
                                    </td>
                                </div>
                            </div>
                        </div>
                        
                        
                        <tr>
                            <td>Country: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control country" name="country" id="country" style="border:thin; border-style:solid;border-color:#e6e6e6">
                                             
                                    </select>
                                </div>                           
                            </td>

                            <td>State: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control span12 state" name="state" id="state" style="border:thin; border-style:solid;border-color:#e6e6e6">
                                        <option value=""><?php echo translate('choose_a_country_first')?></option>	
                                    </select>
                                </div>
                            </td>

                            <td>City: </td>
                            <td>
                                <div class="col-md-6 ">
                                    <select class="form-control span12 city" name="city" id="city" style="border:thin; border-style:solid;border-color:#e6e6e6">
                                        <option value=""><?php echo translate('choose_a_state_first')?></option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr> 
                            <td>Religion</td>
                            <td>
                                <div class="col-md-6">
                                    <?= $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker s_religion', $home_religion, '', '', ''); ?>
                                </div>
                            </td>
                            <td>Caste</td>
                            <td>
                                <div class="col-md-6">
                                    <select class="form-control form-control-sm selectpicker s_caste" name="caste" >
                                        <option value="<?= $home_caste ?>"><?php echo translate('choose_a_religion_first')?></option>
                                    </select>
                                </div>
                            </td>    
                            <td>SubCaste</td>   
                            <td>
                                <div class="col-md-6">
                                    <select class="form-control form-control-sm selectpicker s_sub_caste" name="sub_caste">
                                        <option value="<?= $home_sub_caste ?>"><?php echo translate('choose_a_caste_first')?></option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>MotherTounge</td>
                            <td>
                            <div class="col-md-6">
                                <?= $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $home_language, '', '', ''); ?>
                                </div>
                            </td>
                            <td>MaritalState</td>   
                            <td>
                                <div class="col-md-6">
                                    <?= $this->Crud_model->select_html('marital_status', 'marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                </div>
                            </td>
                            <td>Education</td>
                            <td>
                                <div class="col-md-6">
                                    <?= $this->Crud_model->select_html('education', 'education', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', '', ''); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>With Photo: </td>
                            <td>
                                <div class="col-md-12 text-left">
                                    <input type="checkbox" name="with_photo" class="checkbox" id="with_photo">                            
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group search-options">
                <input type="button" class="search-btn btn btn-lg btn-info btn-base-1" value="Submit">
            </div>
        </form>
        <script>
            $(document).ready(function(){                
                $(".country").change(function(){
                    var country_id = $(this).val();
                    if (country_id == "") {
                        $(".state").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
                        $(".city").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {
                                $(".state").html(data);      
                                $(".city").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });      

                $(".state").change(function(){
                    var state_id = $(this).val();
                    if (state_id == "") {
                        $(".city").html("<option value=''><?php echo translate('choose_a_state_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id/city/state_id/"+state_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {
                                $(".city").html(data);
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });

                $(".s_religion").change(function(){
                    var religion_id = $(".s_religion").val();
                    if (religion_id == "") {
                        $(".s_caste").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
                        $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {

                                $(".s_caste").html(data);
                                $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });

                $(".s_caste").change(function(){
                    var caste_id = $(".s_caste").val();
                    if (caste_id == "") {
                        $(".s_sub_caste").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id_sub_caste/sub_caste/sub_caste_id/"+caste_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function (data) {
                                if(data == false ){
                                    $(".s_sub_caste").html("<option value=''><?php echo translate('none')?></option>");
                                } else {
                                    $(".s_sub_caste").html(data);
                                };
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });

                $(".religion").change(function(){
                    var religion_id = $(this).val();
                    if (religion_id == "") {
                        $(".caste").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
                    } else {
                        $.ajax({
                            url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                            type: 'POST', // form submit method get/post
                            dataType: 'html', // request type html/json/xml
                            cache       : false,
                            contentType : false,
                            processData : false,
                            success: function(data) {
                                $(".caste").html(data);
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                });

                $(".search-btn").click(function() {
                    filter_members(0);
                });
            });

            function init()
            {
                $.ajax({
                    url: "<?=base_url()?>home/get_dropdown_by_id/country", // form action url
                    type: 'POST', // form submit method get/post
                    dataType: 'html', // request type html/json/xml
                    cache       : false,
                    contentType : false,
                    processData : false,
                    success: function(data) {
                        $(".country").html(data);
                    },
                    error: function(e) {
                        console.log(e)
                    }
                });
            }

            init();
            </script>
<?php
    }
?>
</section>
<script>  
    function filter_members(page, type)
    {
        var url = '<?php echo base_url(); ?>home/ajax_search_list/' + page + '/';
        var form = $('#search-form');
        var place = $('#result');
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
        console.log("here");
        // $(".btn-back-to-top").click();
        $.ajax({
            url: url, // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: formdata ? formdata : form.serialize(), // serialize form data
            cache       : false,
            contentType : false,
            processData : false,
            beforeSend: function() {
                place.html("");
                place.html("<div class='text-center pt-5 pb-5' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i><p>Please Wait...</p></div>").fadeIn();
            },
            success: function(data) {
                console.log('hello');
                console.log(data);
                var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
                if (width <= 768) {
                    $(".size-sm").css("display", "none");
                    $(".size-sm-btn").css("display", "block");
                }
                setTimeout(function(){
                    place.html(data);// fade in response data
                }, 20);
                setTimeout(function(){
                    place.fadeIn(); // fade in response data
                }, 30);
            },
            error: function(e) {
                console.log(e)
            }
        });
    }
</script>
</div>

<section class="slice sct-color-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="margin:auto">
                <input type="hidden" id="member_type" value="<?php if(!empty($member_type)){echo $member_type;}?>">
                <div class="block-wrapper" id="result">
                </div>
                <div id="pagination" style="float: right;">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7110.342296643133!2d75.76782217529804!3d26.993135282372016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db38bfb061ef3%3A0xe19ce734a7b10b26!2sthe%20varvadhu!5e0!3m2!1sen!2sin!4v1595499468169!5m2!1sen!2sin" frameborder="0" style="border:0; width:100%; min-height:352px;" allowfullscreen></iframe>
</section>


