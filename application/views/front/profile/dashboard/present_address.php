<?php 
    $present_address = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'present_address');
    $present_address_data = json_decode($present_address, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_present_address">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('present_address')?>
            </h3>
            <div class="pull-right">
                <button type="button" id="unhide_present_address" <?php if ($privacy_status_data[0]['present_address'] == 'yes') {?> style="display: none" <?php }?> class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="unhide_section('present_address')">
                <i class="fa fa-unlock"></i> <?php echo translate('show')?>
                </button>
                <button type="button" id="hide_present_address" <?php if ($privacy_status_data[0]['present_address'] == 'no') {?> style="display: none" <?php }?> class="btn btn-dark btn-sm btn-icon-only btn-shadow mb-1" onclick="hide_section('present_address')">
                <i class="fa fa-lock"></i> <?php echo translate('hide')?>
                </button>
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('present_address')">
                     <!--onclick="edit_section('present_address')"-->
                <i class="ion-edit"></i>
                </button>              
            </div>
        </div>
        <div class="table-full-width">
            <div class="table-full-width">
                <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                    <tbody>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('country')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('country', $get_member[0]->country);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('state')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('state', $get_member[0]->state);?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('city')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('city', $get_member[0]->city);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('address')?></span>
                            </td>
                            <td>
                                <?php echo $present_address_data[0]['address']?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('residence')?></span>
                            </td>
                            <td>
                                <?php echo $this->Crud_model->get_type_name_by_id('residence', $get_member[0]->residence);?>
                            </td>
                            <td class="td-label">
                                <span><?php echo translate('mobile2')?></span>
                            </td>
                            <td>
                                <?php echo $present_address_data[0]['mobile2']?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_present_address" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                <?php echo translate('present_address')?>
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('present_address')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('present_address')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_present_address" class="form-default" role="form">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="first_name" class="text-uppercase c-gray-light present_country_edit"><?php echo translate('country')?></label>
                        <select class="form-control country" name="country" id="country">
                                             
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="state" class="text-uppercase c-gray-light present_state_edit"><?php echo translate('state')?></label>
                        <select class="form-control span12 state" name="state" id="state">
                            <option value=""><?php echo translate('choose_a_country_first')?></option>	
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="city" class="text-uppercase c-gray-light"><?php echo translate('city')?></label>
                        <select class="form-control span12 city" name="city" id="city">
                            <option value=""><?php echo translate('choose_a_state_first')?></option>	
                        </select>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="postal_code" class="text-uppercase c-gray-light"><?php echo translate('address')?></label>
                        <input type="text" class="form-control no-resize" name="address" value="<?php echo $present_address_data[0]['address']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="city" class="text-uppercase c-gray-light"><?php echo translate('residence')?></label>
                        <?php
                            echo $this->Crud_model->select_new_html('residence', 'residence', 'name', 'edit', 'form-control form-control-sm selectpicker ', $get_member[0]->residence, '', '', '');  
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="postal_code" class="text-uppercase c-gray-light"><?php echo translate('mobile2')?></label>
                        <input type="text" class="form-control no-resize" name="mobile2" value="<?php echo $present_address_data[0]['mobile2']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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