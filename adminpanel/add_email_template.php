<?php
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];


if (isset($_POST['edit_id']) && ($_POST['edit_id'] > 0)) {

    $empl_id = $_POST['edit_id'];
    $templateName = $_POST['tmplName'];
    $htmlCode = $_POST['smleCode'];
    $status = $_POST['empl_status'];
    $update_query = "UPDATE `email_tmpl` SET `empl_name`= '$templateName' ,`empl_src_code`= '$htmlCode' ,`empl_status`= '$status' WHERE empl_id = $empl_id";
    mysql_query($update_query);
    message("Template updated succesfully!");
    redirect_to("template_list.php");
    die();

}

$isPosted = count($_POST);
if (($isPosted > 0) && ($_POST['tmplName'] != NULL) && ($_POST['edit_id'] == 0)) {

    $adtmplName = $_POST['tmplName'];
    $adsmleCode = $_POST['smleCode'];
    $empl_status = $_POST['empl_status'];

    $query = mysql_query("INSERT INTO `email_tmpl` (`empl_name`,`empl_src_code`,`empl_created_date`,`empl_status`) VALUES ('$adtmplName','$adsmleCode',NOW(),$empl_status)");
    if (mysql_affected_rows() > 0) {
        $message = "Template Added Successfully!";
        message($message);
        redirect_to("template_list.php");
    } else {
        $message = mysql_error();

    }
}

if (isset($_GET['UserId'])) {
    $SrcId = isset($_GET['UserId']);

    $etmplquery = mysql_query('select * from email_tmpl limit 1');
    $etotalrows = mysql_num_rows($etmplquery);

}


if (isset($_REQUEST['empl_id'])) {

    $SrcId = $_REQUEST['empl_id'];
    $edit_query = "select * from email_tmpl where empl_id = $SrcId  limit 1";
    $edit_result = mysql_query($edit_query);
    $result = mysql_fetch_array($edit_result);
    $edit_result_count = mysql_num_rows($edit_result);
}


?>

<?php
if ($isPosted > 0 && $_POST['etmpl'] != NULL) {

    $query_source = "SELECT * FROM `occ_registrant` WHERE `Id` = {$_GET['UserId']} ";
    $fetch_source = mysql_query($query_source);
    if (mysql_num_rows($fetch_source) > 0) {
        $src = mysql_fetch_array($fetch_source);
        $etmplname = $_POST['etmpl'];
        if ($etotalrows > 0) {

            $etmplquery = mysql_query('select * from email_tmpl limit 1');
            $etdata = mysql_fetch_array($etmplquery);

            foreach ($etdata as $etrow) {

                $body = '';
                $body .= $etrow['empl_src_code'];
                $body = str_replace("#Applicantfullname#", $src['occ_firstname'] . '&nbsp;' . $src['occ_lastname'], $body);
                $body = str_replace("#Dateofbirth#", $src['occ_birthday'], $body);
                $body = str_replace("#Gender#", $src['occ_gender'], $body);
                $body = str_replace("#Contactno#", $src['occ_sec2_daytimetel'], $body);
                $body = str_replace("#Jobtitle#", $src['occ_job_title'], $body);
                $body = str_replace("#Email#", $src['occ_sec2_emailaddress'], $body);
                $body = str_replace("#Totalprice#", $src['occ_total_price'], $body);
                $body = str_replace("#Registrationdate#", $src['date_registration'], $body);


                $headers = "From: omer@osterleycc.com";
                $headers .= "\r\nContent-Type: text/html; charset=iso-8859-1";

                $estatus = @mail("qasimnepster@gmail.com", "Welcome to OsterleyCC", $body, $headers);

            }
        }
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>
    <link rel="shortcut icon" href="http://www.osterleycc.com/wp-content/uploads/2012/09/favicon.jpg"/>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome-->
    <link href="css/font-awesome.min.css" rel="stylesheet">


    <!-- Datatable -->
    <link href="css/jquery.dataTables_themeroller.css" rel="stylesheet">

    <!-- Endless -->
    <link href="css/endless.min.css" rel="stylesheet">
    <link href="css/endless-skin.css" rel="stylesheet">

    <link href="css/styles.css" rel="stylesheet">

    <script>
        function showUser(val) {
            var method = $("#method1").val();
            window.location.assign("add_payment.php?uid=" + method);
        }

    </script>

    <script src="tinymce/js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init(
            {
                selector:'#maintextarea',
                menu: {
                    file: {title: 'File', items: 'newdocument'},
                    edit: {title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall'},
                    insert: {title: 'Insert', items: 'link media | template hr'},
                    view: {title: 'View', items: 'visualaid'},
                    format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
                    table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
                    tools: {title: 'Tools', items: 'spellchecker code'}
                },
                menubar: 'file edit insert view format table tools image',
                plugins: "code autolink advlist print textcolor link image media anchor imagetools preview lists anchor emoticons",

                toolbar: [
                    'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | code '
                ]
            }
        );

        function GetHTMLContent()
        {
            var htmlContent = tinyMCE.get('maintextarea').getContent();


        }
        function SetHTMLContent(htmlContent)
        {
            tinyMCE.get('maintextarea').setContent(htmlContent);
        }
    </script>
</head>
<body>

<div id="overlay" class="transparent"></div>
<div id="wrapper" class="preload">
    <?php
    if ($_SESSION['Administrator']) {
        include("navigation_bar.php");
    } else {
        include("banner.php");
    }
    ?>

    <div id="main-container" style="margin-left:0px; margin-top:40px;">

        <div class="padding-md edit-reg-form">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><?php if (isset($_REQUEST['empl_id'])) {
                                    echo "Edit";
                                } else {
                                    echo "Add";
                                } ?> Email Template</h2>
                        </div>

                        <div class="panel-body">

                            <form id="formToggleLine" class="form-horizontal no-margin form-border" name="paym1"
                                  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input type="hidden" name="edit_id" id="edit_id" value="<?php if (isset($_REQUEST['empl_id'])) {
                                    echo $_REQUEST['empl_id'];
                                } ?>">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Template Name :</label>
                                    <div class="col-lg-10">
                                        <input type="text" value="<?php if (isset($result['empl_name'])) {
                                            echo $result['empl_name'];
                                        } ?>" name="tmplName" required id="tmplName" class="form-control">
                                    </div><!-- /.col -->
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Html Code :</label>
                                    <div class="col-lg-10">
                                         <textarea id="maintextarea" name="smleCode" rows=10" cols="150" required><?php if (isset($result['empl_src_code'])) {
                                                echo $result['empl_src_code'];
                                            } ?></textarea>
                                    </div><!-- /.col -->
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Is active ?</label>
                                    <div class="col-lg-10">
                                        <label class="label-radio inline">
                                            <input type="radio" name="empl_status" id="empl_status" required
                                                   value="1" <?php if (isset($result['empl_status']) && ($result['empl_status'] == 1)) {
                                                echo "checked";
                                            } ?>>
                                            <span class="custom-radio"></span>
                                            Yes
                                        </label>
                                        <label class="label-radio inline">
                                            <input type="radio" name="empl_status" id="empl_status" required
                                                   value="0" <?php if (isset($result['empl_status']) && ($result['empl_status'] == 0)) {
                                                echo "checked";
                                            } ?>>
                                            <span class="custom-radio"></span>
                                            No
                                        </label>
                                    </div>
                                </div><!-- /form-group -->

                                <div class="form-group">
                                    <h5 id="emailsend"style ="font-size: 18px; color: green; text-align: center"></h5>
                                    <label class="col-lg-12 control-label" style="text-align:center;">
                                        <button type="button" id = "emailtemp"
                                                class="btn btn-primary btn-sm"><?php if (isset($_REQUEST['empl_id'])) {
                                                echo "Save Template";
                                            } else {
                                                echo "Add Template";
                                            } ?></button>
                                    </label>

                                </div><!-- /form-group -->


                            </form>

                            <?php if (isset($_GET['UserId'])) {
                                $etmplquery = mysql_query('select * from email_tmpl limit 1');
                                $etotalrows = mysql_num_rows($etmplquery);
                                ?>
                                <hr/>
                                <form id="formToggleLine" class="form-horizontal no-margin form-border"
                                      name="SendETmplDetails" id="SendETmplDetails" method="post"
                                      action="<?php echo $_SERVER['PHP_SELF'] . '?UserId=' . $_GET['UserId']; ?>">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Templates :</label>
                                        <div class="col-lg-10">
                                            <select name="etmpl" id="etmpl" class="form-control">
                                                <?php
                                                if ($etotalrows > 0) {
                                                    while ($etrows = mysql_fetch_array($etmplquery)) {
                                                        $etdata[] = $etrows;
                                                        ?>
                                                        <option
                                                            value="<?php echo $etrows['empl_id']; ?>"><?php echo $etrows['empl_name']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select></td>

                                        </div><!-- /.col -->

                                        <div class="form-group">

                                            <label class="col-lg-12 control-label" style="text-align:center;">
                                                <button type="submit" class="btn btn-primary btn-sm">Process Email
                                                </button>
                                            </label>

                                        </div><!-- /form-group -->

                                    </div><!-- /form-group -->

                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 style = "font-size: 14px;">List of Avaiable Placeholders</h3>
                        </div>

                        <table class="table table-hover table-striped" style="    font-size: 10px;">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Field Name</th>
                                <th>Placeholders</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Full Name</td>
                                <td>#fullname#</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>D.O.B</td>
                                <td>#dateofbirth#</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Gender</td>
                                <td>#gender#</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>Contact No (Day)</td>
                                <td>#contactno#</td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>Job Title</td>
                                <td>#jobtitle#</td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>Email</td>
                                <td>#email#</td>
                            </tr>

                            <tr>
                                <td>7</td>
                                <td>Total Price</td>
                                <td>#totalprice#</td>
                            </tr>

                            <tr>
                                <td>8</td>
                                <td>Registration Datee</td>
                                <td>#registrationdate#</td>
                            </tr>

                            <tr>
                                <td>9</td>
                                <td>Post Code</td>
                                <td>#postcode#</td>
                            </tr>


                            <tr>
                                <td>10</td>
                                <td>Contact No (Evening)</td>
                                <td>#contactnevening#</td>
                            </tr>

                            </tbody>
                        </table>
                    </div><!-- /panel -->
                </div><!-- /.col -->
            </div>
        </div>
    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script>

    var entityMap = {
        "&": "&amp;",
        '"': '&quot;',
        "'": '&#39;',
        "/": '&#x2F;',
        "-": '&hyphen;',
    };

    function escapeHtml(string) {
        return String(string).replace(/[&"'\/-]/g, function (s) {
            return entityMap[s];
        });
    }

    $(document).ready(function(){
        $("#emailtemp").click(function(e){
            e.preventDefault();
            var htmlContent = tinyMCE.get('maintextarea').getContent();
            htmlContent = escapeHtml(htmlContent);
            //alert($("input[name=empl_status]:checked").val());
            $.ajax({type: "POST",
                url: "emailtemplate.php",
                data: {tmplName: $("#tmplName").val(), smleCode: btoa(htmlContent), empl_status: $("input[name=empl_status]:checked").val(),edit_id:$("#edit_id").val() },
                success:function(result){
                    $("#emailsend").html(result);
                }});
        });
    });
</script>
<?php include_once("footer.php"); ?>

