<!doctype html>
<html>
    <head>
        <title>CI Upload</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
        <style>
            form p{
                margin: 5px 0px;
                color: red;
            }
        </style>
    </head>
    <body>

    <?php $this->load->view('navigasi'); ?>

    <?php $this->load->view('waktuterkini'); ?>

        <div class="container">
            <h2>Upload Soal</h2>
            <?php echo form_open_multipart('uploadfile/proses'); ?>
            <div class="form-group">
                <label>Mata Pelajaran <?php echo form_error('judul'); ?></label>
                <select name="judul" class="form-control">
                    <option>Pilih Mata Pelajaran</option>
                <?php foreach ($mp->result() as $d) {
                    ?>
                    <option value="<?php echo $d->id; ?>"><?php echo $d->nama; ?></option>
                    <?php
                } ?>
                </select>
            </div>
            <div class="form-group">
                <label>File <?php echo $error; ?></label>
                <?php echo form_upload('gambar'); ?>
            </div>
            <?php echo form_submit('mysubmit', 'Upload Soal','class="btn btn-primary"'); ?>
            <?php echo form_close(); ?>
        </div>

        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
    </body>
</html>