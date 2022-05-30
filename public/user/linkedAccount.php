<?php

require __DIR__ . "/../../config/bootstrap.php";

redirectOutside();


require "../htmlib/header.inc.php";?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-container-bg-solid page-sidebar-fixed">
    <div class="page-wrapper">

        <?php require "../htmlib/top.inc.php"; ?>
        <?php require "../htmlib/menu.inc.php"; ?>


        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <span>Home</span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>User</span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
			<span><a href="<?php echo $GLOBALS['URL'];?>user/usrProfile.php#tab_1_4">My Keys</a></span>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Linked Accounts</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title"> Linked Accounts </h1>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $error_data = false;
                        if ($_SESSION['errorData']) {
                            $error_data = true;
                            ?>
                            <?php if ($_SESSION['errorData']['Info']) { ?>
                                <div class="alert alert-info">
                                <?php } else { ?>
                                    <div class="alert alert-danger">
                                    <?php } ?>

                                    <?php
                                    foreach ($_SESSION['errorData'] as $subTitle => $txts) {
                                        print "<strong>$subTitle</strong><br/>";
                                        foreach ($txts as $txt) {
                                            print "<div>$txt</div>";
                                        }
                                    }
                                    unset($_SESSION['errorData']);
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <form name="linkedAccount" id="linkedAccount" action="applib/linkedAccount.php" method="post">
                  
			<input type="hidden" name="account" id="account" value="<?php echo $_REQUEST['account'];?>">
			<input type="hidden" name="action"  id="action"  value="<?php echo $_REQUEST['action'];?>">

		    <!--  EUROBIOIMAGING FORM     -->

		    <?php if ($_REQUEST['account'] == "euBI"){

		    	// set form default values

		    	$defaults = array();
		    	if (isset($_SESSION['formData'])){
		    		$defaults = $_SESSION['formData'];
                                unset($_SESSION['formData']);
			}elseif($_REQUEST['action'] == 'update'){
				$defaults['alias_token'] = $_SESSION['User']['linked_accounts']['euBI']['alias']; 
				$defaults['secret']      = $_SESSION['User']['linked_accounts']['euBI']['secret']; 
			}

			// print html form
			?>

			<div class="portlet box blue-oleo">
                            <div class="portlet-title">
                                <div class="caption">
                                    <div style="float:left;margin-right:20px;"> <i class="fa fa-link"></i> euro-BioImaging</div>
                                </div>
			    </div>
                            <div class="portlet-body form">
                                <div class="form-body">
				<p>euro-BioImaging provides Alias Tokens for allowing external applications to <strong>authenticate a session on your behalf</strong> for a limited period of time. If your are sure you want to allow <?php echo $GLOBALS['NAME']?> VRE access, fill in the following form.</p>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
					    <div class="form-group">
							<a target="_blank" href="https://wiki.xnat.org/documentation/how-to-use-xnat/generating-an-alias-token-for-scripted-authentication">How to generate an euro-BioImaging Alias Token?</a><br/>
							<a target="_blank" href="https://xnat.bmia.nl/">Go to euro-BioImaging</a></br>
						<a href="javascript:openTermsOfUse();"><?php echo $GLOBALS['NAME']?> VRE terms of use</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Alias Token</label>
						<input type="text" name="alias_token" id="alias_token" class="form-control" value="<?php echo $defaults['alias_token'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Secret</label>
                                                <input type="text" name="secret" id="secret" class="form-control" value="<?php echo $defaults['secret'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Time limit (hours)</label>
                                                <span  class="form-control" readonly>48</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Submit</button>
                                    <button type="reset" class="btn default">Reset</button>
				    <button onclick="window.history.go(-1); return false;" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
		 
		    <?php } elseif ($_REQUEST['account'] == "MN"){

		    	// set form default values

		    	$defaults = array();
		    	if (isset($_SESSION['formData'])){
		    		$defaults = $_SESSION['formData'];
                                unset($_SESSION['formData']);
			#}elseif($_REQUEST['action'] == 'update'){
			}else{
				$defaults['priv_key'] = (isset($_SESSION['User']['linked_accounts']['MN']['priv_key'])?$_SESSION['User']['linked_accounts']['MN']['priv_key']:null); 
				$defaults['pub_key']  = (isset($_SESSION['User']['linked_accounts']['MN']['pub_key'])?$_SESSION['User']['linked_accounts']['MN']['pub_key']:null);
				$defaults['username'] = (isset($_SESSION['User']['linked_accounts']['MN']['username'])?$_SESSION['User']['linked_accounts']['MN']['username']:null); 
				$defaults['password'] = (isset($_SESSION['User']['linked_accounts']['MN']['password'])?$_SESSION['User']['linked_accounts']['MN']['password']:"bsccns"); 
			}

			// print html form
			?>
			<div class="portlet box blue-oleo">

                            <div class="portlet-title">
                                <div class="caption">
                                    <div style="float:left;margin-right:20px;"> <i class="fa fa-link"></i> HPC: Mare Nostrum</div>
                                </div>
			   </div>
                            <div class="portlet-body form">
                                <div class="form-body">
				<p>Enable the use public key authentication for your account in 'High Performance Computer: Mare Nostrum'</p>
                                    <div class="row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
					    <div class="form-group">
						<a target="_blank" href="">Mare Nostrum Guide</a></br>
						<a href="javascript:openTermsOfUse();"><?php echo $GLOBALS['NAME']?> VRE terms of use</a>
                                            </div>
                                        </div>
				    </div>


				    <h4> Stored Credentials</h4>
				   These are the credentials currently used by VRE for tools configured to be remotely executed at external HPC resources (MareNostrum). 
                                    <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Private Key</label>
                                                <input type="text" readonly required name="priv_key" id="priv_key" class="form-control" value="<?php echo $defaults['priv_key'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Public Key</label>
						<input type="text" required readonly name="pub_key" id="pub_key" class="form-control" value="<?php echo $defaults['pub_key'];?>">
                                            </div>
                                        </div>
				    </div>
				    </div>

				   <h4> Generate SSH Key Pair</h4>
				   If you have a user account for 'High Performance Computer: Mare Nostrum', create an new SSH Key Pair to enable VRE access to it
                                    <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
						<span  class="form-control" style="height:auto" readonly>
						<strong>How to </strong> authorize the new keys into your HPC user account is a two-steps process:
						<ol>
							<li>Generate a new pair of encrypted RSA keys here</li>
							<li>Download and copy the resulting 'Public Key' in the HPC server. Install it under your home directory, in the <a href="https://www.ssh.com/academy/ssh/authorized-keys-file>">authorized keys file</a> </li>
						</ol>
						Remember that you always can <strong>disable</strong> the VRE access simply deleting or commenting the 'Public Key' line from your HPC server.  
						</span>
					    </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">HPC Account Username</label>
                                                <input type="text" required name="username" id="username" class="form-control" value="<?php echo $defaults['username'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">New SSH key passphrase</label>
                                                <input type="text" required name="password" id="password" class="form-control" value="<?php echo $defaults['password'];?>">
                                            </div>
                                        </div>
                                    </div>
				    <input type="hidden" name="generate_keys" id="generate_keys" value="false"/>
				    <button type="submit" class="btn blue" onclick="document.getElementById('generate_keys').value=true"><i class="fa fa-cog"></i> Generate keys</button>
				    </div>
                            </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="fa fa-check"></i> Accept</button>
                                    <button type="reset" class="btn default">Reset</button>
				    <button onclick="window.history.go(-1); return false;" class="btn default">Cancel</button>
                                </div>
                        </div>
		 
			<?php } ?>	


                    </form>


                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

            <div class="modal fade bs-modal-sm" id="myModal1" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <?php
                        if (isset($_SESSION['errorData'])) {
                            ?>
                            <div class="alert alert-warning">
                                <?php foreach ($_SESSION['errorData'] as $subTitle => $txts) {
                                    ?>
                                    <h4 class="modal-title"><?php echo $subTitle; ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php foreach ($txts as $txt) {
                                        print $txt . "</br>";
                                    } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Accept</button>
                                </div>
                            <?php
                        }
                        unset($_SESSION['errorData']);
                        ?>

                        <?php } ?>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade bs-modal-sm" id="myModal5" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <?php

            require "../htmlib/footer.inc.php";
            require "../htmlib/js.inc.php";

            ?>
