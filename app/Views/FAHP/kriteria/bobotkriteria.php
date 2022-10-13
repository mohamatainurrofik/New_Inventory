<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>


<div class="card">
    <h5 id="locationpath" class="d-none">/Fahp/kriteriabobot</h5>
    <div class="card-header border-0 pt-6">

    </div>


    <div class="card-body pt-0">

        <form id="kt_ubah_pairwise_kriteria" class="form" action="#">
            <div class="fv-row row">
                <div class="col-md-3 pl-0">
                    <label class="required form-label fs-6 fw-bold">Left Kriteria :</label>
                    <select name="pairwise_leftcolumn" id="pairwise_leftcolumn" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                        <option></option>
                        <?php foreach ($kriteria as $key => $teria1) { ?>
                            <option data-kode="<?= $teria1['kode_kriteria'] ?>" value="<?= $teria1['id_kriteria'] ?>">[<strong><?= $teria1['kode_kriteria'] ?></strong>] - <?= $teria1['kriteria'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-4 pl-0">
                    <label class="required form-label fs-6 fw-bold">Perbandingan :</label>
                    <select name="fuzzy_set" id="fuzzy_set" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                        <option></option>
                        <?php foreach ($fuzzy as $key => $fuzz) { ?>
                            <option data-valueUp="<?= $fuzz['up'] ?>" data-valueMid="<?= $fuzz['middle'] ?>" data-valueLow="<?= $fuzz['low'] ?>" value="<?= $fuzz['id_fuzzy'] ?>">[<strong><?= $fuzz['value'] ?></strong>] - <?= $fuzz['deskripsi'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 pl-0">
                    <label class="required form-label fs-6 fw-bold">Right Kriteria :</label>
                    <select name="pairwise_rightcolumn" id="pairwise_rightcolumn" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                        <option></option>
                        <?php foreach ($kriteria as $key => $teria2) { ?>
                            <option data-kode="<?= $teria2['kode_kriteria'] ?>" value="<?= $teria2['id_kriteria'] ?>">[<strong><?= $teria2['kode_kriteria'] ?></strong>] - <?= $teria2['kriteria'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2 pl-0">
                    <br>
                    <button type="button" class="btn btn-danger mt-3" data-kt-ubah-matrikpairwise="pairwise">Ubah</button>
                </div>
            </div>
        </form>
        <br>
        <br>
        <hr>

        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="pairwiseTable">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">#</th>
                    <?php foreach ($kriteria as $key => $teria) { ?>
                        <th class="min-w-125px"><?= $teria['kode_kriteria'] ?></th>
                    <?php } ?>
                </tr>
                <!--end::Table row-->
            </thead>
            <tbody>
                <?php
                $count = sizeof($kriteria);
                foreach ($kriteria as $key => $krit) { ?>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <td class=" min-w-125px"><?= $krit['kode_kriteria'] ?></td>
                        <?php foreach ($pairwise as $key1 => $wise) { ?>
                            <?php if ($wise['kriteria_kolom'] == $krit['kode_kriteria']) { ?>
                                <?php if ($wise['kriteria_baris'] == $krit['kode_kriteria']) { ?>
                                    <td data-rowKriteria="<?= $wise['kriteria_kolom'] ?>" data-colKriteria="<?= $wise['kriteria_baris'] ?>" class="min-w-125px"><?= $wise['value'] ?></td>
                                <?php } else { ?>
                                    <td data-rowKriteria="<?= $wise['kriteria_kolom'] ?>" data-colKriteria="<?= $wise['kriteria_baris'] ?>" class=" min-w-125px"><?= $wise['value'] ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">Sum</td>
                    <?php foreach ($kriteria as $key => $crit) { ?>
                        <td class="sumPairWise" data-sum="<?= $crit['kode_kriteria'] ?>">0</td>
                    <?php }  ?>
                </tr>
            </tbody>
            <!--end::Table head-->
            <!--begin::Table body-->

            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>


    <div class="card-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="SummaryPairwiseTable">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">#</th>
                    <?php foreach ($kriteria as $key => $teria3) { ?>
                        <th class="min-w-125px"><?= $teria3['kode_kriteria'] ?></th>
                    <?php } ?>
                    <th class="min-w-125px">Bobot</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <tbody>
                <?php
                $count = sizeof($kriteria);
                foreach ($kriteria as $key => $krit1) { ?>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <td class="min-w-125px"><?= $krit1['kode_kriteria'] ?></td>
                        <?php foreach ($pairwise as $key1 => $wise1) { ?>
                            <?php if ($wise1['kriteria_kolom'] == $krit1['kode_kriteria']) { ?>
                                <td data-rowSummaryKriteria="<?= $wise1['kriteria_kolom'] ?>" data-colSummaryKriteria="<?= $wise1['kriteria_baris'] ?>" class="min-w-125px">0</td>
                            <?php } ?>
                        <?php } ?>
                        <td data-bobot="<?= $krit1['kode_kriteria'] ?>" class="min-w-125px bobotkriteria">0</td>
                    </tr>
                <?php } ?>
            </tbody>
            <!--end::Table head-->
            <!--begin::Table body-->

            <!--end::Table body-->
        </table>
        <br>
        <br>
        <table>
            <tr class="fw-bolder">
                <td>Consistency Index</td>
                <td class="min-w-125px">:</td>
                <td id="consistencyIndex">0.000</td>
            </tr>
            <tr class="fw-bolder">
                <td>Ratio Index</td>
                <td class="min-w-125px">:</td>
                <td id="ratioIndex">0.000</td>
            </tr>
            <tr class="fw-bolder">
                <td>Consistency Ratio</td>
                <td class="min-w-125px">:</td>
                <td id="consistencyRatio">0.000</td>
                <td id="statusBobot">0.000</td>
            </tr>
        </table>
        <a role="button" id="saveBobotKriteria" class="btn btn-sm btn-primary">Save</a>
    </div>
    <!--end::Card body-->
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('assets/js/custom/apps/fahp/bobotkriteria/table.js') ?>"></script>
<?= $this->endSection() ?>