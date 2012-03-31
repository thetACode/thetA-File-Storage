<?php
/*
 * Search-Engine
 */

class search {

    public function init() {
        
    }

    public function searchsidebar() {
        // Home Search

        $ordner = "files/";
        $handle = opendir($ordner);
        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                if (is_dir($ordner . "/" . $file)) {
                    if (file_exists($ordner . "/" . $file . "/title.theta")) {
                        $infodatei = fopen($ordner . "/" . $file . "/title.theta", "r");
                        while (!feof($infodatei)) {
                            $title = fgets($infodatei, 1024);


                            $path = "files/" . $file . "/" . $file . "";
                            ?>
                            <li class='SideBar_item'><a href="<?php echo($path); ?>" style="color: #ffffff"><?php echo($title); ?></a></li>
                            <?php
                        }
                    }
                    fclose($infodatei);
                }
            }
        }
        closedir($handle);
    }

    public function searchhome() {
        // Home Search
        $search = new search();
        //$search->removeRekursiv("files/" . $_FILES["file"]["name"]);
        $ordner = "files/";
        $handle = opendir($ordner);
        while ($file = readdir($handle)) {
            if ($file != "." && $file != "..") {
                if (is_dir($ordner . "/" . $file)) {
                    if (file_exists($ordner . "/" . $file . "/title.theta")) {
                        $infodatei = fopen($ordner . "/" . $file . "/title.theta", "r");
                        while (!feof($infodatei)) {
                            $title = fgets($infodatei, 1024);


                            $path = "'files/" . $file . "/" . $file . "'";
                            search::design(true);
                            ?>
                            <form method="POST">
                                <input type='button' value='Download' onClick="window.location.href=<?php echo($path); ?>">
                                <?php
                                echo ("Title: " . $title . "<input type='submit' name=" . $title . " value='Delete' style='float: right; margin-right: 5px;'>");
                                ?>
                            </form>

                            <?php
                            if (isset($_POST[$title])) {
                                fclose($infodatei);
                                closedir($handle);
                                $search->removeRekursiv('files/' . $file);
                                header("Location:index.php");
                                exit;
                            }
                            search::design(false);
                        }
                    }
                    fclose($infodatei);
                }
            }
        }
        closedir($handle);
    }

    public static function design($startend) {
        // TRUE = start
        // FALSE = finish

        if ($startend == true) {
            echo ("<div class='content'>");
        } else {
            echo ("</div>");
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