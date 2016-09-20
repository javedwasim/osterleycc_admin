<?php
session_start();
include("include/db_config.php");
include("include/session_timeout.php");
include("include/functions.php");

if (isset($_SESSION['source_type'])) {
    $source_type = $_SESSION['source_type'];
}

if ($source_type == 1) {
    $redirect_file = "colts_info.php";
} elseif ($source_type == 2) {
    $redirect_file = "adutls_info.php";
} elseif ($source_type == 3) {
    $redirect_file = "social_info.php";
} else {
    $redirect_file = "home.php";
}

if (isset($_SESSION['UserName']) && $_SESSION['UserName'] != 'Administrator') {
    redirect_to("home.php");
    die();
}

$username = 'Welcome' . '&nbsp;' . $_SESSION['UserName'];

$isPosted = count($_POST);


if (isset($_REQUEST['etmpl'])) {
    $SrcId = $_REQUEST['etmpl'];
    $selectQuery = mysql_query("select * from email_tmpl where empl_id = $SrcId limit 1");
    $result = mysql_fetch_array($selectQuery);
    //echo "<pre>"; print_r($result['empl_src_code'] );    die();
}

if (isset($_REQUEST['UserId'])) {
    $SrcId = isset($_GET['UserId']);

    $etmplquery = mysql_query('select * from email_tmpl limit 1');
    $etotalrows = mysql_num_rows($etmplquery);

}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $username; ?></title>

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
                            <h2>Email Template</h2>

                        </div>

                        <div class="panel-body">
                            <?php if (isset($_GET['UserId'])) {
                                $etmplquery = mysql_query('select * from email_tmpl');
                                $etotalrows = mysql_num_rows($etmplquery);
                                ?>
                                <hr/>
                                <form id="formToggleLine" class="form-horizontal no-margin form-border"
                                      name="SendETmplDetails" id="SendETmplDetails" method="post"
                                      action="<?php echo $_SERVER['PHP_SELF'] . '?UserId=' . $_GET['UserId']; ?>">
                                    <input type="hidden" name="userid" id="userid"
                                           value="<?php echo $_GET['UserId']; ?>"/>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Templates :</label>
                                        <div class="col-lg-10">
                                            <select name="etmpl" id="etmpl" class="form-control"
                                                    onchange="this.form.submit()">
                                                <option value="">Please Select Template</option>
                                                <?php
                                                if ($etotalrows > 0) {
                                                    while ($etrows = mysql_fetch_array($etmplquery)) {
                                                        $etdata[] = $etrows;
                                                        ?>
                                                        <option
                                                            value="<?php echo $etrows['empl_id']; ?>" <?php if ($result['empl_id'] == $etrows['empl_id']) {
                                                            echo "selected";
                                                        } ?>><?php echo $etrows['empl_name']; ?></option>
                                                    <?php }
                                                } ?>
                                            </select>
                                        </div><!-- /.col -->
                                    </div>
                                    <?php if (isset($result['empl_src_code'])): ?>
                                        <script src="tinymce/js/tinymce/tinymce.min.js"></script>
                                        <script>
                                            tinymce.init(
                                                {
                                                    selector: '#maintextarea',
                                                    menu: {
                                                        file: {title: 'File', items: 'newdocument'},
                                                        edit: {
                                                            title: 'Edit',
                                                            items: 'undo redo | cut copy paste pastetext | selectall'
                                                        },
                                                        insert: {title: 'Insert', items: 'link media | template hr'},
                                                        view: {title: 'View', items: 'visualaid'},
                                                        format: {
                                                            title: 'Format',
                                                            items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'
                                                        },
                                                        table: {
                                                            title: 'Table',
                                                            items: 'inserttable tableprops deletetable | cell row column'
                                                        },
                                                        tools: {title: 'Tools', items: 'spellchecker code'}
                                                    },
                                                    menubar: 'file edit insert view format table tools image',
                                                    plugins: "code autolink advlist print textcolor link image media anchor imagetools preview lists anchor emoticons",

                                                    toolbar: [
                                                        'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify |  bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons | code '
                                                    ]
                                                }
                                            );

                                            function GetHTMLContent() {
                                                var htmlContent = tinyMCE.get('maintextarea').getContent();


                                            }
                                            function SetHTMLContent(htmlContent) {
                                                tinyMCE.get('maintextarea').setContent(htmlContent);
                                            }
                                        </script>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Subject :</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="subject" id="subject"
                                                       value="<?php echo $result['empl_name']; ?>"
                                                       class="form-control"/>
                                            </div><!-- /.col -->
                                        </div><!-- /form-group -->
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Body :</label>
                                            <div class="col-lg-10">
                                                <textarea id="maintextarea" name="smleCode" rows=10"
                                                          cols="150"><?php echo $result['empl_src_code']; ?></textarea>
                                            </div><!-- /.col -->
                                        </div><!-- /form-group -->
                                    <?php endif; ?>

                                    <div class="form-group">
                                        <h5 id="emailsend"style ="font-size: 18px; color: green; text-align: center"></h5>
                                        <label class="col-lg-12 control-label" style="text-align:center;">
                                            <button type="button" id="sendemail" class="btn btn-primary btn-sm">Send
                                                Email
                                            </button>
                                        </label>

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
    $(document).ready(function () {
        $("#sendemail").click(function (e) {
            e.preventDefault();
            var htmlContent = tinyMCE.get('maintextarea').getContent();
            // alert($("#etmpl").val());
            $.ajax({
                type: "POST",
                url: "emailsend.php",
                data: {
                    smleCode: btoa(htmlContent),
                    userid: $("#userid").val(),
                    etmpl: $("#etmpl").val(),
                    subject: $("#subject").val()
                },
                success: function (result) {
                   // alert();
                    $("#emailsend").html(result);
                }
            });
        });
    });
</script>
<?php include_once("footer.php"); ?>

