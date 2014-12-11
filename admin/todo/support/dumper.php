<?php

class dumper {

    function dumper() {
        if (file_exists(PATH . "dumper.cfg.php")) {
            include(PATH . "dumper.cfg.php");
        } else {
            $this->SET['last_action'] = 0;
            $this->SET['last_db_backup'] = '';
            $this->SET['tables'] = '';
            $this->SET['comp_method'] = 2;
            $this->SET['comp_level'] = 7;
            $this->SET['last_db_restore'] = '';
            $this->SET['conn'] = '';
        }
        $this->tabs = 0;
        $this->records = 0;
        $this->size = 0;
        $this->comp = 0;
    }

    function backup() {
        if (!isset($_POST)) {
            $this->main();
        }

        //set_error_handler("SXD_errorHandler");
        //$buttons = "<A ID=save HREF='' STYLE='display: none;'>Download the File</A> &nbsp; <INPUT ID=back TYPE=button class=button VALUE='Go Back' DISABLED onClick=\"history.back();\">";
        //echo tpl_page(tpl_process("Create Backup Database"), $buttons);
        /*
          $this->SET['last_action']     = 0;
          $this->SET['last_db_backup']  = 'transformer';  //isset($_POST['db_backup']) ? $_POST['db_backup'] : '';
          $this->SET['tables_exclude']  ='0';             // !empty($_POST['tables']) && $_POST['tables']{0} == '^' ? 1 : 0;
          $this->SET['tables']          ='';              // isset($_POST['tables']) ? $_POST['tables'] : '';
          $this->SET['comp_method']     ='1';                // isset($_POST['comp_method']) ? intval($_POST['comp_method']) : 0;
          $this->SET['comp_level']      ='7';                // isset($_POST['comp_level']) ? intval($_POST['comp_level']) : 0;
          //$this->fn_save();
         */
        $this->SET['tables'] = explode(",", $this->SET['tables']);
        if (!empty($_POST['tables'])) {
            foreach ($this->SET['tables'] AS $table) {
                $table = preg_replace("/[^\w*?^]/", "", $table);
                $pattern = array("/\?/", "/\*/");
                $replace = array(".", ".*?");
                $tbls[] = preg_replace($pattern, $replace, $table);
            }
        } else {
            $this->SET['tables_exclude'] = 1;
        }

        if ($this->SET['comp_level'] == 0) {
            $this->SET['comp_method'] = 0;
        }
        $db = $this->SET['last_db_backup'];

        if (!$db) {
            tpl_l("ERROR! No database selected!", C_ERROR);
            //echo tpl_enableBack();
            exit;
        }

        //tpl_l( Exportofdatabase . `{$db}`); DISABLE phpShell
        tpl_l(Exportofdatabase);
        mysqli_select_db($this->SET['conn'], $db) or trigger_error("No database selected.<BR>" . mysqli_error(), E_USER_ERROR);
        $tables = array();
        $result = mysqli_query($this->SET['conn'], "SHOW TABLES");
        $all = 0;
        while ($row = mysqli_fetch_array($result)) {

            $status = 0;
            if (!empty($tbls)) {
                foreach ($tbls AS $table) {
                    $exclude = preg_match("/^\^/", $table) ? true : false;
                    if (!$exclude) {
                        if (preg_match("/^{$table}$/i", $row[0])) {
                            $status = 1;
                        }
                        $all = 1;
                    }
                    if ($exclude && preg_match("/{$table}$/i", $row[0])) {
                        $status = -1;
                    }
                }
            } else {
                $status = 1;
            }
            if ($status >= $all) {
                $tables[] = $row[0];
            }
        }

        $tabs = count($tables);
        $result = mysqli_query($this->SET['conn'], "SHOW TABLE STATUS");
        $tabinfo = array();
        $tabinfo[0] = 0;
        $info = '';

        while ($item = mysqli_fetch_assoc($result)) {
            if (in_array($item['Name'], $tables)) {
                $item['Rows'] = empty($item['Rows']) ? 0 : $item['Rows'];
                $tabinfo[0] += $item['Rows'];
                $tabinfo[$item['Name']] = $item['Rows'];
                $this->size += $item['Data_length'];
                $tabsize[$item['Name']] = 1 + round(LIMIT * 1048576 / ($item['Avg_row_length'] + 1));
                if ($item['Rows'])
                    $info .= "|" . $item['Rows'];
            }
        }
        $show = 10 + $tabinfo[0] / 50;
        $info = $tabinfo[0] . $info;

        //$name = $db . '_' . date("Y-m-d_H-i");
        $name = $db . '_SQL_' . date("Y-m-d_H-i") . '_' . md5(rand(0, 999999) . date('Y-m-d_H-i-s'));

        $fp = $this->fn_open($name, "w");
        tpl_l((Createfilewithbackupdatabase) . ":<br/>   {$this->filename}");

        $this->fn_write($fp, "#SKD101|{$db}|{$tabs}|" . date("Y.m.d H:i:s") . "|{$info}\n\n");
        $t = 0;
        tpl_l(str_repeat("-", 60));
        $result = mysqli_query($this->SET['conn'], "SET SQL_QUOTE_SHOW_CREATE = 1");
        foreach ($tables AS $table) {
            tpl_l((TableManipulation) . " {$table} " . (NumberOfRows) . fn_int($tabinfo[$table]) . ".");
            $result = mysqli_query($this->SET['conn'], "SHOW CREATE TABLE {$table}");
            //$tab = mysqli_fetch_array($result);
            $tab = @mysqli_fetch_array($result);
            $tab = preg_replace('/(default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP|DEFAULT CHARSET=\w+|COLLATE=\w+|character set \w+|collate \w+)/i', '/*!40101 \\1 */', $tab);
            @$this->fn_write($fp, "DROP TABLE IF EXISTS {$table};\n{$tab[1]};\n\n");
            $NumericColumn = array();
            $result = mysqli_query($this->SET['conn'], "SHOW COLUMNS FROM {$table}");
            $field = 0;
            //while($col = mysqli_fetch_row($result)) {
            while ($col = @mysqli_fetch_row($result)) {
                $NumericColumn[$field++] = preg_match("/^(\w*int|year)/", $col[1]) ? 1 : 0;
            }
            $fields = $field;
            $from = 0;
            $limit = $tabsize[$table];
            $limit2 = round($limit / 3);
            if ($tabinfo[$table] > 0) {
                if ($tabinfo[$table] > $limit2) {
                    //echo tpl_s(0, $t / $tabinfo[0]);
                }
                $i = 0;
                $this->fn_write($fp, "INSERT INTO `{$table}` VALUES");
                while (($result = mysqli_query($this->SET['conn'], "SELECT * FROM {$table} LIMIT {$from}, {$limit}")) && ($total = mysqli_num_rows($result))) {
                    while ($row = mysqli_fetch_row($result)) {
                        $i++;
                        $t++;

                        for ($k = 0; $k < $fields; $k++) {
                            if ($NumericColumn[$k])
                                $row[$k] = isset($row[$k]) ? $row[$k] : "NULL";
                            else
                                $row[$k] = isset($row[$k]) ? "'" . mysqli_escape_string($this->SET['conn'], $row[$k]) . "'" : "NULL";
                        }

                        $this->fn_write($fp, ($i == 1 ? "" : ",") . "\n(" . implode(", ", $row) . ")");
                        if ($i % $limit2 == 0)
                            echo ""; //tpl_s($i / $tabinfo[$table], $t / $tabinfo[0]);
                    }

                    mysqli_free_result($result);
                    if ($total < $limit) {

                        break;
                    }
                    $from += $limit;
                }

                $this->fn_write($fp, ";\n\n");
                //echo tpl_s(1, $t / $tabinfo[0]);
            }
        }
        $this->tabs = $tabs;
        $this->records = $tabinfo[0];
        $this->comp = $this->SET['comp_method'] * 10 + $this->SET['comp_level'];
        //echo tpl_s(1, 1);
        tpl_l(str_repeat("-", 100));
        $this->fn_close($fp);
        tpl_l((DatabaseBackup) . " `{$db}` " . (Created) . ".", C_RESULT);
        tpl_l((Databasesize) . ":       " . round($this->size / 1048576, 2) . " Mb", C_RESULT);
        $filesize = round(filesize(PATH . $this->filename) / 1048576, 2) . " Mb";
        tpl_l((FileSize) . ": {$filesize}", C_RESULT);
        tpl_l((NumberOfTables) . ": {$tabs}", C_RESULT);
        tpl_l((Recordsfound) . ":   " . fn_int($tabinfo[0]), C_RESULT);
        //echo "<SCRIPT>with (document.getElementById('save')) {style.display = ''; innerHTML = 'Download The Export ({$filesize})'; href = '" . URL . $this->filename . "'; }document.getElementById('back').disabled = 0;</SCRIPT>";
    }

    function restore() {
        if (!isset($_POST)) {
            $this->main();
        }
        //set_error_handler("SXD_errorHandler");
        //$buttons = "<INPUT ID=back TYPE=button class='button' VALUE='Go Back' DISABLED onClick=\"history.back();\">";
        tpl_l((RestoreofDatabasefromfile));

        $this->SET['last_action'] = 1;
        $this->SET['last_db_restore'] = isset($_POST['db_restore']) ? $_POST['db_restore'] : '';
        $file = isset($_POST['file']) ? $_POST['file'] : '';
        $this->fn_save();
        $db = $this->SET['last_db_restore'];

        if (!$db) {
            tpl_l((ERRORDatabasenotselected), C_ERROR);
            //echo tpl_enableBack();
            exit;
        }
        tpl_l((ImportinDatabase) . " `{$db}`.");
        mysqli_select_db($this->SET['conn'], $db) or trigger_error((IErrorindatabaseselection) . "<BR>" . mysqli_error(), E_USER_ERROR);
        preg_match("/^(\d+)\.(\d+)\.(\d+)/", mysqli_get_server_info($this->SET['conn']), $m);
        $this->mysqli_version = sprintf("%d%02d%02d", $m[1], $m[2], $m[3]);
        if (preg_match("/^(.+?)\.sql(\.(bz2|gz))?$/", $file, $matches)) {
            if (isset($matches[3]) && $matches[3] == 'bz2') {
                $this->SET['comp_method'] = 2;
            } elseif (isset($matches[2]) && $matches[3] == 'gz') {
                $this->SET['comp_method'] = 1;
            } else {
                $this->SET['comp_method'] = 0;
            }
            $this->SET['comp_level'] = '';
            if (!file_exists(PATH . "/{$file}")) {
                tpl_l((ERRORFilenotfound), C_ERROR);
                //echo tpl_enableBack();
                exit;
            }
            tpl_l((Readingfile) . ": <br/> {$file}");
            $file = $matches[1];
        } else {
            tpl_l((ERRORNofileselected), C_ERROR);
            //echo tpl_enableBack();
            exit;
        }
        tpl_l(str_repeat("-", 60));
        $fp = $this->fn_open($file, "r");
        $this->file_cache = $sql = $table = $insert = '';
        $is_skd = $query_len = $execute = $q = $t = $i = $aff_rows = 0;
        $limit = 300;
        $index = 4;
        $tabs = 0;
        $cache = '';
        $info = array();
        while (($str = $this->fn_read_str($fp)) !== false) {
            if (empty($str) || preg_match("/^(#|--)/", $str)) {
                if (!$is_skd && preg_match("/^#SKD101\|/", $str)) {
                    $info = explode("|", $str);
                    //echo tpl_s(0, $t / $info[4]);
                    $is_skd = 1;
                }
                continue;
            }
            $query_len += strlen($str);

            if (!$insert && preg_match("/^(INSERT INTO `?([^` ]+)`? .*?VALUES)(.*)$/i", $str, $m)) {
                if ($table != $m[2]) {
                    $table = $m[2];
                    $tabs++;
                    tpl_l("������� `{$table}`.");
                    $i = 0;
                    if ($is_skd)
                        echo tpl_s(100, $t / $info[4]);
                }
                $insert = $m[1] . ' ';
                $sql .= $m[3];
                $index++;
                $info[$index] = isset($info[$index]) ? $info[$index] : 0;
                $limit = round($info[$index] / 20);
                $limit = $limit < 300 ? 300 : $limit;
                if ($info[$index] > $limit) {
                    echo $cache;
                    $cache = '';
                    //echo tpl_s(0 / $info[$index], $t / $info[4]);
                }
            } else {
                $sql .= $str;
                if ($insert) {
                    $i++;
                    $t++;
                    if ($is_skd && $info[$index] > $limit && $t % $limit == 0) {
                        //echo tpl_s($i / $info[$index], $t / $info[4]);
                    }
                }
            }

            if (!$insert && preg_match("/^CREATE TABLE (IF NOT EXISTS )?`?([^` ]+)`?/i", $str, $m) && $table != $m[2]) {
                $table = $m[2];
                $insert = '';
                $tabs++;
                $cache .= tpl_l("table `{$table}`.");
                $i = 0;
            }
            if ($sql) {
                if (preg_match("/;$/", $str)) {
                    $sql = rtrim($insert . $sql, ";");
                    if (empty($insert)) {
                        if ($this->mysqli_version < 40101) {
                            $sql = preg_replace("/ENGINE\s?=/", "TYPE=", $sql);
                        }
                    }
                    $insert = '';
                    $execute = 1;
                }
                if ($query_len >= 65536 && preg_match("/,$/", $str)) {
                    $sql = rtrim($insert . $sql, ",");
                    $execute = 1;
                }
                if ($execute) {
                    $q++;
                    mysqli_query($this->SET['conn'],$sql) or trigger_error((Errorfound) . ": .<BR>" . mysqli_error($this->SET['conn']), E_USER_ERROR);
                    if (preg_match("/^insert/i", $sql)) {
                        $aff_rows += mysqli_affected_rows($this->SET['conn']);
                    }
                    $sql = '';
                    $query_len = 0;
                    $execute = 0;
                }
            }
        }
        echo $cache;
        //echo tpl_s(1 , 1);
        tpl_l(str_repeat("-", 100));
        tpl_l((RestorSuccess), C_RESULT);
        if (isset($info[3]))
            tpl_l((Date) . ": {$info[3]}", C_RESULT);
        tpl_l((QUERIES) . ": {$q}", C_RESULT);
        tpl_l((NumberOfTables) . ": {$tabs}", C_RESULT);
        tpl_l((records) . ": {$aff_rows}", C_RESULT);
        $this->tabs = $tabs;
        $this->records = $aff_rows;
        $this->size = filesize(PATH . $this->filename);
        $this->comp = $this->SET['comp_method'] * 10 + $this->SET['comp_level'];
        //echo "<SCRIPT>document.getElementById('back').disabled = 0;</SCRIPT>";

        $this->fn_close($fp);
    }

    /*
      function main(){
      $this->comp_levels = array('9' => '9 (maximum)', '8' => '8', '7' => '7', '6' => '6', '5' => '5 (normal)', '4' => '4', '3' => '3', '2' => '2', '1' => '1 (minimum)','0' => 'No compression');

      if (function_exists("bzopen")) {
      $this->comp_methods[2] = 'BZip2';
      }
      if (function_exists("gzopen")) {
      $this->comp_methods[1] = 'GZip';
      }
      $this->comp_methods[0] = 'No compression';
      if (count($this->comp_methods) == 1) {
      $this->comp_levels = array('0' =>'No compression');
      }

      $dbs = $this->db_select();
      $this->vars['db_backup']    = $this->fn_select($dbs, $this->SET['last_db_backup']);
      $this->vars['db_restore']   = $this->fn_select($dbs, $this->SET['last_db_restore']);
      $this->vars['comp_levels']  = $this->fn_select($this->comp_levels, $this->SET['comp_level']);
      $this->vars['comp_methods'] = $this->fn_select($this->comp_methods, $this->SET['comp_method']);
      $this->vars['tables']       = $this->SET['tables'];
      $this->vars['files']        = $this->fn_select($this->file_select(), '');
      $buttons = "<INPUT TYPE=submit class=button VALUE=Go>";
      echo tpl_page(tpl_main(), $buttons);
      }

      function db_select(){
      if (DBNAMES != '') {
      $items = explode(',', trim(DBNAMES));
      foreach($items AS $item){
      if (mysqli_select_db($item)) {
      $tables = mysqli_query( $this->SET['conn'],"SHOW TABLES");
      if ($tables) {
      $tabs = mysqli_num_rows($tables);
      $dbs[$item] = "{$item} ({$tabs})";
      }
      }
      }
      }
      else {
      $result = mysqli_query( $this->SET['conn'],"SHOW DATABASES");
      $dbs = array();
      while($item = mysqli_fetch_array($result)){
      if (mysqli_select_db($item[0])) {
      $tables = mysqli_query( $this->SET['conn'],"SHOW TABLES");
      if ($tables) {
      $tabs = mysqli_num_rows($tables);
      $dbs[$item[0]] = "{$item[0]} ({$tabs})";
      }
      }
      }
      }
      return $dbs;
      }
     */

    function file_select() {
        $files = array('');
        if (is_dir(PATH) && $handle = opendir(PATH)) {
            while (false !== ($file = readdir($handle))) {
                if (preg_match("/^.+?\.sql(\.(gz|bz2))?$/", $file)) {
                    $files[$file] = $file;
                }
            }
            closedir($handle);
        }
        return $files;
    }

    function fn_open($name, $mode) {
        if ($this->SET['comp_method'] == 2) {
            $this->filename = "{$name}.sql.bz2";
            return bzopen(PATH . $this->filename, "{$mode}b{$this->SET['comp_level']}");
        } elseif ($this->SET['comp_method'] == 1) {
            $this->filename = "{$name}.sql.gz";
            return gzopen(PATH . $this->filename, "{$mode}b{$this->SET['comp_level']}");
        } else {
            $this->filename = "{$name}.sql";
            return fopen(PATH . $this->filename, "{$mode}b");
        }
    }

    function fn_write($fp, $str) {
        if ($this->SET['comp_method'] == 2) {
            bzwrite($fp, $str);
        } elseif ($this->SET['comp_method'] == 1) {
            gzwrite($fp, $str);
        } else {
            fwrite($fp, $str);
        }
    }

    function fn_read($fp) {
        if ($this->SET['comp_method'] == 2) {
            return bzread($fp, 4096);
        } elseif ($this->SET['comp_method'] == 1) {
            return gzread($fp, 4096);
        } else {
            return fread($fp, 4096);
        }
    }

    function fn_read_str($fp) {
        $string = '';
        $this->file_cache = ltrim($this->file_cache);
        $pos = strpos($this->file_cache, "\n", 0);
        if ($pos < 1) {
            while (!$string && ($str = $this->fn_read($fp))) {
                $pos = strpos($str, "\n", 0);
                if ($pos === false) {
                    $this->file_cache .= $str;
                } else {
                    $string = $this->file_cache . substr($str, 0, $pos);
                    $this->file_cache = substr($str, $pos + 1);
                }
            }
            if (!$str) {
                if ($this->file_cache) {
                    $string = $this->file_cache;
                    $this->file_cache = '';
                    return trim($string);
                }
                return false;
            }
        } else {
            $string = substr($this->file_cache, 0, $pos);
            $this->file_cache = substr($this->file_cache, $pos + 1);
        }
        return trim($string);
    }

    function fn_close($fp) {
        if ($this->SET['comp_method'] == 2) {
            bzclose($fp);
        } elseif ($this->SET['comp_method'] == 1) {
            gzclose($fp);
        } else {
            fclose($fp);
        }
        @chmod(PATH . $this->filename, 0666);
        $this->fn_index();
    }

    function fn_select($items, $selected) {
        $select = '';
        foreach ($items AS $key => $value) {
            $select .= $key == $selected ? "<OPTION VALUE='{$key}' SELECTED>{$value}" : "<OPTION VALUE='{$key}'>{$value}";
        }
        return $select;
    }

    function fn_save() {
        if (SC) {
            $ne = !file_exists(PATH . "dumper.cfg.php");
            $fp = fopen(PATH . "dumper.cfg.php", "wb");
            fwrite($fp, "<?php\n\$this->SET = " . fn_arr2str($this->SET) . "\n?>");
            fclose($fp);
            if ($ne)
                @chmod(PATH . "dumper.cfg.php", 0666);
            $this->fn_index();
        }
    }

    function fn_index() {
        if (!file_exists(PATH . 'index.html')) {
            $fh = fopen(PATH . 'index.html', 'wb');
            fwrite($fh, tpl_backup_index());
            fclose($fh);
            @chmod(PATH . 'index.html', 0666);
        }
    }

}

//END CLASS

function tpl_l($str, $color = C_DEFAULT) {
    global $LOG;
    $LOG .= $str . "<br/>";
}

//end function

function fn_int($num) {
    return number_format($num, 0, ',', ' ');
}

//end function

function fn_arr2str($array) {
    $str = "array(\n";
   // var_dump($array);
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $str .= "'$key' => " . fn_arr2str($value) . ",\n\n";
        } else {
          //  $str .= "'$key' => '" . str_replace("'", "\'", $value) . "',\n";
        }
    }
    return $str . ")";
}

//end function

function tpl_backup_index() {
    return "";
}

//end function
?>