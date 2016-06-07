<!-- Paging dan form pencarian -->
    <a href="<?php echo $link_create; ?>" class="btn btn-primary">Tambah Data</a>
    <?php
        if(isset($link_back)){
            echo '
                <a href="'.$link_back.'" class="btn btn-default">
                <span class="glyphicon glyphicon-arrow-left"></span> 
                Kembali
                </a>
            ';
        }
    ?>
    
    <div class="row">
        <!-- Paging -->
        <div class="col-xs-12 col-md-6">
            <?php echo $link_paging; ?>
        </div>
        <!-- /Paging -->

        <!-- Form Pencarian -->
        <div class="col-xs-12 col-md-4 pull-right form-pencarian">
            <form role="form" action='<?php echo $link_search; ?>' method='GET' class="form-horizontal form-search">
                <div class="input-group">
                    <input type="text" name="kata_kunci" class="form-control" placeholder="Search Data" id="kata_kunci" value="<?php echo $this->input->get('kata_kunci'); ?>" />
                    <div class="input-group-btn">
                        <button class="btn btn-default" type='submit'><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /Form Pencarian -->
    </div>
    <!-- /Paging dan form pencarian -->