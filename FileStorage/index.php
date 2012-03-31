<?php
if (!$_GET['page']) {
    header("Location:index.php?page=index");
}
$page = $_GET['page'];

include_once 'php/actions/search.php';
include_once 'php/actions/upload.php';
include_once 'php/forms/display.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>FileStorage</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

        <table id="logos">
            <tr>
                <td style="margin: auto;">
                    <a rel="license" href="http://creativecommons.org/licenses/by-nc/3.0/">
                        <img alt="Creative Commons Lizenzvertrag" style="border-width:0" src="http://i.creativecommons.org/l/by-nc/3.0/88x31.png" />
                    </a>
                </td>
            </tr>
        </table>  
        <div id="header">
            <table id="headingtable">
                <tr>
                    <td colspan="2"><h1 id="title">FileStorage</h1></td>
                </tr>

                <tr>
                    <td id="TD_home"><label id="BTN_home"><a href="index.php?page=index" style="color: #ffffff">Home</a></label></td>  
                    <td id="TD_upload"><label id="BTN_upload"><a href="index.php?page=upload" style="color: #ffffff">Upload</a></label></td>
                </tr>
            </table>

        </div>

        <div id="sidebar">
            <h1>Files</h1>
            <ul>
                <?php
                display::drawside();
                ?>
            </ul>
        </div>

        <div id="container">
            <?php
            if ($page == "index") {
                display::draw();
            } else if ($page == "upload") {
                upload::design();
            } else {
                header("Location:index.php?page=index");
            }
            ?>

        </div>

        <div id="footer">

        </div>
    </body>
</html>
