<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>


<!--begin::Navbar-->
<h5 id="locationpath" class="d-none">/Data/transaksi</h5>

<!--begin::details View-->

<div class=" card mb-5 mb-xl-10" id="kt_departemen_details_view">
    <!--begin::Card header-->
    <div class="card-header  ">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Transaksi Details</h3>
        </div>
        <!--end::Card title-->
        <!--begin::Action-->
        <a type="button" data-unique="cetak" class="btn btn-primary align-self-center">Cetak</a>
        <div data-unique="tempDiv" class="card-title d-none">
            <a type="button" data-unique="cancel" class="btn btn-danger align-self-center ">Cancel</a>
        </div>
        <!--end::Action-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div data-unique="viewDepartemen" class="card-body p-9">
        <!--begin::Row-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">ID Transaksi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8" data-unique="departemenName">
                <span class="fw-bolder fs-6 text-gray-800"><?= $order['id_order'] ?></span>
                <input type="text" class="d-none" id="id_detailorder" value="<?= $order['id_order'] ?>">
            </div>
            <!--end::Col-->
        </div>
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Deskripsi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8" data-unique="departemenName">
                <span class="fw-bolder fs-6 text-gray-800"><?= $order['description'] ?></span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Input group-->
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">User Transaksi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8 fv-row" data-unique="departemenUnitkerja">
                <span class="fw-bold text-gray-800 fs-6"><?= $order['nama'] ?></span>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <!--end::Input group-->
        <!--begin::Input group-->

        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Status Transaksi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?= $order['status_order'] ?></a>
            </div>
            <!--end::Col-->
        </div>
        <div class="row mb-7">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">Lokasi</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?= $order['unitkerja'] ?></a>
            </div>
            <!--end::Col-->
        </div>
        <hr>
        <div class="row mb-7">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="detailTransaksiTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            #
                        </th>
                        <th class="min-w-125px">Kode Inventaris</th>
                        <th class="min-w-125px">Inventaris</th>
                        <th class="min-w-125px">Brand</th>
                        <th class="min-w-125px">QTY</th>
                        <th class="min-w-125px">Status</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <tbody>
                    <?php foreach ($dataorder as $key => $data) { ?>
                        <tr>
                            <td>#</td>
                            <td><?= $data['kode'] ?></td>
                            <td><?= $data['nama_unit'] ?></td>
                            <td><?= $data['brand'] ?></td>
                            <td><?= $data['qty'] ?></td>
                            <td><?= $data['status_unit'] ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
                <!--end::Table head-->
                <!--begin::Table body-->

                <!--end::Table body-->
            </table>
        </div>


    </div>


</div>





</div>

<div>

    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src="<?= base_url('assets/js/custom/apps/data/transaksi/detailTable.js') ?>"></script>
    <?= $this->endSection() ?>