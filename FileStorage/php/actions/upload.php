<?php

class upload {

    public static function design() {
        // TRUE = start
        // FALSE = finish
        ?>
        <div class='uploader'>
            <form method='POST' enctype="multipart/form-data">
                <script>
                    function changebg() {
                        document.getElementById("submit").style.backgroundColor = "#ff9900";
                        document.getElementById("submit").value = "Uploading...";
                    }
                </script>
                <table id='uploadertable'>
                    <tr>
                        <td><label>Name:</label></td>
                        <td><input type="text" name="name" style="width: 420px;" required="required"></td>
                    </tr>
                    <tr>
                        <td><label>Datei:</label></td>
                        <td><input required="required" type="file" name="file"><input id="submit" type="submit" name="submit" value="Upload" onClick="changebg()"></td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                ?>
                <table class="uploaderinfo">
                    <tr>
                        <td>Upload</td>
                        <td><?php echo ($_FILES["file"]["name"]); ?></td>
                        <td rowspan="3" style="height: 100%;"><div class= "uploadersuccessful" id="uploadersuccessfulID"></div></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><?php echo ($_FILES["file"]["type"]); ?></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                        <td><?php echo round(($_FILES["file"]["size"] / 1048576), 2) . "MB"; ?></td>
                    </tr>
                </table>

                <?php
                if (!($_FILES["file"]["name"] == "")) {
                    $uploadsite = new upload();
                    $uploadsite->uploadfile();
                }
            }
            ?>

        </div>
        <?php
    }

    public function uploadfile() {
        $uploadsite = new upload();
        if (!(is_dir("files/" . $_FILES["file"]["name"]))) {
            mkdir("files/" . $_FILES["file"]["name"]);
        } else {
            $uploadsite->removeRekursiv("files/" . $_FILES["file"]["name"]);
            mkdir("files/" . $_FILES["file"]["name"]);
        }
        $info = fopen("files/" . $_FILES["file"]["name"] . "/title.theta", "w");

        fwrite($info, $_POST['name']);

        if (move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $_FILES["file"]["name"] . "/" . $_FILES["file"]["name"])) {
            
        } else {
            ?>
            <script type="text/javascript">
                document.getElementById('uploadersuccessfulID').className = 'uploaderNOTsuccessful';
                alert("FAIL!");
            </script>
            <?php
        }
    }

    public function removeRekursiv($dir) {
        $dp = opendir($dir);

        while ($file = readdir($dp)) {
            $name = $dir . "/" . $file;

            if ($file != "." && $file != "..") {
                if (is_dir($name))
                    removeRekursiv($name);
                else
                    unlink($name);
            }
        }

        closedir($dp);

        rmdir($dir);
    }

}
?>