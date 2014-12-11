<div class="header">
    <div class="language_menu">
        <?php
        global $Lang, $Prog;

        $db_def_lang = new db();
        $lang_def_rs = $db_def_lang->get_results("select * from languages where `Deleted`<>'1'; ");
        foreach ($lang_def_rs as $lang_row) {
            if ($lang_row->LangName == $Lang) {
                $def_class = '';
            } else {
                $def_class = ' class="selected" ';
            }

            $def_lang_href = LangLink(NewLangLink($Lang, $lang_row->LangName));


            echo '<div class="lang_cell"><a href="' . $def_lang_href . '" ' . $def_class . ' >' . $lang_row->LangName . '</a></div>';
        }
        ?>


    </div>

    <div class="menu_container">
        {MenuCont}
    </div>
</div>