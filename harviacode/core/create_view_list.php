<?php 

$string = " 
        


<!-- Page Heading -->
                    <h1 class=\"h3 mb-2 text-gray-800\">".ucfirst($table_name)." List</h1> 

                    <!-- DataTales Example -->
                    <div class=\"card shadow mb-4\">
                        <div class=\"card-header py-3\">

                        <div class=\"row\" style=\"margin-bottom: 10px\">
                            <div class=\"col-md-4\">
                                <?php echo anchor(site_url('".$c_url."/create'),'Create', 'class=\"btn btn-primary\"'); ?>
                            </div>
                            <div class=\"col-md-4 text-center\">
                                <div style=\"margin-top: 8px\" id=\"message\">
                                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                                </div>
                            </div>
                            <div class=\"col-md-1 text-right\">
                            </div>
                            <div class=\"col-md-3 text-right\">
                                <form action=\"<?php echo site_url('$c_url/index'); ?>\" class=\"form-inline\" method=\"get\">
                                    <div class=\"input-group\">
                                        <input type=\"text\" class=\"form-control\" name=\"q\" value=\"<?php echo \$q; ?>\">
                                        <span class=\"input-group-btn\">
                                            <?php 
                                                if (\$q <> '')
                                                {
                                                    ?>
                                                    <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-default\">Reset</a>
                                                    <?php
                                                }
                                            ?>
                                          <button class=\"btn btn-primary\" type=\"submit\">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        </div>
                        <div class=\"card-body\">
                            <div class=\"table-responsive\">
                                <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                                    <tr>
                                    <th>No</th>";
                                    foreach ($non_pk as $row) {
                                        $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
                                    }
                                    $string .= "\n\t\t<th>Action</th>
                                                </tr>";
                                    $string .= "<?php
                                                foreach ($" . $c_url . "_data as \$$c_url)
                                                {
                                                    ?>
                                                    <tr>";

                                    $string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
                                    foreach ($non_pk as $row) {
                                        $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
                                    }


                                    $string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\">"
                                            . "\n\t\t\t\t<?php "
                                            . "\n\t\t\t\techo anchor(site_url('".$c_url."/read/'.$".$c_url."->".$pk."),'<button class=\"btn btn-primary\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i></button>'); "
                                            . "\n\t\t\t\techo anchor(site_url('".$c_url."/update/'.$".$c_url."->".$pk."),'<button class=\"btn btn-warning\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></button>'); "
                                            . "\n\t\t\t\techo anchor(site_url('".$c_url."/delete/'.$".$c_url."->".$pk."),'<button class=\"btn btn-danger\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
                                            . "\n\t\t\t\t?>"
                                            . "\n\t\t\t</td>";

                                    $string .=  "\n\t\t</tr>
                                                    <?php
                                                }
                                                ?>
                                </table>


                                <div class=\"row\">
                                    <div class=\"col-md-6\">
                                                <a href=\"#\" class=\"btn btn-primary\">Total Record : <?php echo \$total_rows ?></a>";
                                if ($export_excel == '1') {
                                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
                                }
                                if ($export_word == '1') {
                                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
                                }
                                if ($export_pdf == '1') {
                                    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF', 'class=\"btn btn-primary\"'); ?>";
                                }
                                $string .= "\n\t    </div>
                                            <div class=\"col-md-6 text-right\">
                                                <?php echo \$pagination ?>
                                            </div>
                                        </div>


                            </div>
                        </div>
                    </div>

                     ";


$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>