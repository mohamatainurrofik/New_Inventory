<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Laporan/qrcode</h5>
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <!--begin: Pic-->
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">Laporan QR Code Inventaris</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class=" card mb-5 mb-xl-10" id="kt_mutasiinventaris">
    <div class="card-body border-0 pt-6">
        <form id="kt_printqrcode_form" class="form" action="#">
            <div class="d-flex fv-row row">
                <div class="col-md-4 pl-0">
                    <label class="required form-label fs-6 fw-bold">Lokasi Inventaris :</label>
                    <select name="ruanganprint" id="ruanganprint" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                        <option></option>
                        <?php foreach ($lokasi as $key => $loka) { ?>
                            <option value="<?= $loka['id'] ?>"> <strong><?= $loka['ruangan'] ?></strong> => <?= $loka['unitkerja'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 pl-0">
                    <br>
                    <button class="btn btn-primary" data-kt-printQRcode-action="printQRcode">Print</button>
                    <!-- <button class="btn btn-danger" data-kt-reset-action="resetqrcode">Reset</button> -->
                </div>
            </div>


        </form>
    </div>

</div>





<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src=" <?= base_url('assets/js/custom/apps/laporan/inventaris/qrcode.js') ?>"></script>
<?= $this->endSection() ?>