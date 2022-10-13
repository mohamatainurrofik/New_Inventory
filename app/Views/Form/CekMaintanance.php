<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Form/cekmaintanance</h5>



<div class="card mb-5 mb-xl-10">
    <div class="card-header">
        <div class="card-title">
            <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Form Cek Perawatan</a>
        </div>
    </div>
    <div class="card-body formDiv">
        <form id="kt_add_maintanance_form" class="form" action="#">
            <div class="fv-row row">
                <div class="col pl-0">
                    <label class="required form-label fs-6 fw-bold">Pilih Ruangan :</label>
                    <select name="ruangan_maintananceInventaris" id="ruangan_maintananceInventaris" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                        <option></option>
                        <?php foreach ($ruangan as $key => $ruang) { ?>
                            <option value="<?= $ruang['id_unitkerja'] ?>"><?= $ruang['unitkerja'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col pl-0">
                    <label class="required form-label fs-6 fw-bold">Pilih Unit :</label>
                    <select disabled name="inventaris_maintananceunit" id="inventaris_maintananceunit" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                        <option></option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="mt-3 fv-row row">
                <?php foreach ($kriteria as $key => $value) { ?>
                    <div class="col pl-0">
                        <label class="required fw-bold fs-6 mb-2"><?= $value['kriteria'] ?>:</label>
                        <?php if ($value['kriteria'] == 'Biaya') { ?>
                            <select name="<?= $value['kriteria'] ?>" id="<?= $value['kriteria'] ?>" class="form-select form-select-solid fw-bolder kriteriaForAlternatif" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                                <option value="1">Sangat Murah</option>
                                <option value="2">Murah</option>
                                <option value="3">Cukup</option>
                                <option value="4">Mahal</option>
                                <option value="5">Sangat Mahal</option>
                            </select>
                        <?php } ?>
                        <?php if ($value['kriteria'] == 'Kerusakan') { ?>
                            <select name="<?= $value['kriteria'] ?>" id="<?= $value['kriteria'] ?>" class="form-select form-select-solid fw-bolder kriteriaForAlternatif" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                                <option value="1">Tidak Rusak</option>
                                <option value="2">Sedikit Rusak</option>
                                <option value="3">Cukup</option>
                                <option value="4">Rusak</option>
                                <option value="5">Sangat Rusak</option>
                            </select>
                        <?php } ?>
                        <?php if ($value['kriteria'] == 'Kepentingan') { ?>
                            <select name="<?= $value['kriteria'] ?>" id="<?= $value['kriteria'] ?>" class="form-select form-select-solid fw-bolder kriteriaForAlternatif" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                                <option value="1">Tidak Penting</option>
                                <option value="2">Sedikit Penting</option>
                                <option value="3">Cukup</option>
                                <option value="4">Penting</option>
                                <option value="5">Sangat Penting</option>
                            </select>
                        <?php } ?>
                        <?php if ($value['kriteria'] == 'JumlahPersediaan') { ?>
                            <select name="<?= $value['kriteria'] ?>" id="<?= $value['kriteria'] ?>" class="form-select form-select-solid fw-bolder kriteriaForAlternatif" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                                <option value="1">Sangat Sedikit</option>
                                <option value="2">Sedikit</option>
                                <option value="3">Cukup</option>
                                <option value="4">Banyak</option>
                                <option value="5">Sangat Banyak</option>
                            </select>
                        <?php } ?>
                    </div>
                <?php } ?>

            </div>

            <div class="d-flex mt-3 justify-content-between">
                <button class="btn btn-primary" data-kt-addmaintanance-table-action="addtotable">Tambah Ke Tabel</button>
                <button class="btn btn-success" data-kt-addmaintanance-hitung-action="hitung">Hitung</button>
            </div>
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-maintanance-table-toolbar="afterhitung">
                <button type="button" class="btn btn-primary" data-kt-maintanance-table-save="save">Save</button>
                <a href="/Form/pengajuanMaintanance" class="btn btn-danger" data-kt-maintanace-table-recount="recount">Hitung Ulang</a>
            </div>


        </form>

    </div>
</div>
<div>
    <div class=" card mb-5 mb-xl-10">
        <div class="card-header">
            <div class="card-title">
                <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Tabel Alternatif</a>
            </div>
        </div>
        <div class="card-body formDiv">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="alternatifTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-125px">#</th>
                        <?php foreach ($kriteria as $key => $namakriteria) { ?>
                            <th class="min-w-125px"><?= $namakriteria['kode_kriteria'] ?></th>
                        <?php } ?>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <tbody>

                </tbody>
                <!--end::Table head-->
                <!--begin::Table body-->

                <!--end::Table body-->
            </table>
        </div>
    </div>
    <div class="d-none" id="hitungDiv">
        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Matrix Perbandingan Kriteria AHP</a>
                </div>
            </div>
            <div class="card-body formDiv">
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
                        foreach ($kriteria as $key => $krit1) { ?>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <td class=" min-w-125px"><?= $krit1['kode_kriteria'] ?> - <?= $krit1['kriteria'] ?></td>
                                <?php foreach ($pairwise as $key1 => $wise1) { ?>
                                    <?php if ($wise1['kriteria_kolom'] == $krit1['kode_kriteria']) { ?>
                                        <?php if ($wise1['kriteria_baris'] == $krit1['kode_kriteria']) { ?>
                                            <td data-rowKriteria="<?= $wise1['kriteria_kolom'] ?>" data-colKriteria="<?= $wise1['kriteria_baris'] ?>" class="min-w-125px"><?= $wise1['value'] ?></td>
                                        <?php } else { ?>
                                            <td data-rowKriteria="<?= $wise1['kriteria_kolom'] ?>" data-colKriteria="<?= $wise1['kriteria_baris'] ?>" class=" min-w-125px"><?= $wise1['value'] ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>
        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Matrix Perbandingan Kriteria Fuzzy AHP</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="pairwiseFuzzyTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">#</th>
                            <?php foreach ($kriteria as $key => $teria1) { ?>
                                <th colspan="3" class=""><?= $teria1['kode_kriteria'] ?></th>
                            <?php } ?>
                            <th colspan="3" class="">Jumlah Baris</th>
                        </tr>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class=""></th>
                            <?php foreach ($kriteria as $key => $teria3) { ?>
                                <th class="">L</th>
                                <th class="">M</th>
                                <th class="">U</th>
                            <?php } ?>
                            <th class="">L</th>
                            <th class="">M</th>
                            <th class="">U</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>
                        <?php

                        foreach ($kriteria as $key => $krit) { ?>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <td class=""><?= $krit['kode_kriteria'] ?></td>
                                <?php foreach ($fuzzyPairwise as $key1 => $fuzzy) { ?>
                                    <?php if ($fuzzy['kriteria_kolom'] == $krit['kode_kriteria']) { ?>
                                        <?php if ($fuzzy['kriteria_baris'] == $krit['kode_kriteria']) { ?>
                                            <td data-fuzzy="l" data-rowKriteria="<?= $fuzzy['kriteria_kolom'] ?>" data-colKriteria="<?= $fuzzy['kriteria_baris'] ?>" class="table-active"><?= $fuzzy['low'] ?></td>
                                            <td data-fuzzy="m" data-rowKriteria="<?= $fuzzy['kriteria_kolom'] ?>" data-colKriteria="<?= $fuzzy['kriteria_baris'] ?>" class="table-active"><?= $fuzzy['middle'] ?></td>
                                            <td data-fuzzy="u" data-rowKriteria="<?= $fuzzy['kriteria_kolom'] ?>" data-colKriteria="<?= $fuzzy['kriteria_baris'] ?>" class="table-active"><?= $fuzzy['up'] ?></td>
                                        <?php } else { ?>
                                            <td data-fuzzy="l" data-rowKriteria="<?= $fuzzy['kriteria_kolom'] ?>" data-colKriteria="<?= $fuzzy['kriteria_baris'] ?>" class=""><?= $fuzzy['low'] ?></td>
                                            <td data-fuzzy="m" data-rowKriteria="<?= $fuzzy['kriteria_kolom'] ?>" data-colKriteria="<?= $fuzzy['kriteria_baris'] ?>" class=""><?= $fuzzy['middle'] ?></td>
                                            <td data-fuzzy="u" data-rowKriteria="<?= $fuzzy['kriteria_kolom'] ?>" data-colKriteria="<?= $fuzzy['kriteria_baris'] ?>" class=""><?= $fuzzy['up'] ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <td data-fuzzySum="l" data-jumlah="<?= $krit['kode_kriteria'] ?>" class="jumlah">0</td>
                                <td data-fuzzySum="m" data-jumlah="<?= $krit['kode_kriteria'] ?>" class="jumlah">0</td>
                                <td data-fuzzySum="u" data-jumlah="<?= $krit['kode_kriteria'] ?>" class="jumlah">0</td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="13">Total (L,M,U)</td>
                            <td data-Summary="l" class="summary">0</td>
                            <td data-Summary="m" class="summary">0</td>
                            <td data-Summary="u" class="summary">0</td>
                        </tr>
                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>
        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Perhitungan Nilai Sintesis (Si)</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="fuzzySintesisTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="">#</th>
                            <th colspan="3" class="">Jumlah Baris</th>
                            <th colspan="3" class="">Nilai Sintesis</th>
                        </tr>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class=""></th>
                            <th class="">L</th>
                            <th class="">M</th>
                            <th class="">U</th>
                            <th class="">L</th>
                            <th class="">M</th>
                            <th class="">U</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>
                        <?php
                        foreach ($kriteria as $key => $teria2) { ?>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <td class=""><?= $teria2['kode_kriteria'] ?></td>
                                <td data-fuzzySumSintesis="l" data-invers="u" data-jumlahSintesis="<?= $teria2['kode_kriteria'] ?>" class="tempJumlah">0</td>
                                <td data-fuzzySumSintesis="m" data-invers="m" data-jumlahSintesis="<?= $teria2['kode_kriteria'] ?>" class="tempJumlah">0</td>
                                <td data-fuzzySumSintesis="u" data-invers="l" data-jumlahSintesis="<?= $teria2['kode_kriteria'] ?>" class="tempJumlah">0</td>
                                <td data-sintesis="l" data-sintesisFrom="<?= $teria2['kode_kriteria'] ?>" class="sintesisValue">0</td>
                                <td data-sintesis="m" data-sintesisFrom="<?= $teria2['kode_kriteria'] ?>" class="sintesisValue">0</td>
                                <td data-sintesis="u" data-sintesisFrom="<?= $teria2['kode_kriteria'] ?>" class="sintesisValue">0</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>
        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Perbandingan Nilai Vektor (V) dan Nilai Ordinat Defuzzyfikasi (d`)</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <?php foreach ($kriteria as $key => $value1) { ?>
                    <div class="card shadow-sm card-bordered mt-2 mb-2">
                        <div class="card-body">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 vektorTable" id="<?= $value1['kriteria'] ?>">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class=""><?= $value1['kriteria'] ?></th>
                                        <th class="">a=l-u[<?= $value1['kode_kriteria'] ?>] </th>
                                        <th class="">b=m[<?= $value1['kode_kriteria'] ?>]-u[<?= $value1['kode_kriteria'] ?>]</th>
                                        <th class="">c=m-l</th>
                                        <th class="">d=b-c</th>
                                        <th class="">e=a/d</th>
                                        <th class="">d`</th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($kriteria as $key => $teria4) { ?>
                                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                            <td><?= $value1['kode_kriteria'] ?>><?= $teria4['kode_kriteria'] ?></td>
                                            <td class="a" data-fromsintesis="l" data-position="<?= $teria4['kode_kriteria'] ?>" data-uposition="<?= $value1['kode_kriteria'] ?>">0</td>
                                            <td class="b" data-mPosition="<?= $value1['kode_kriteria'] ?>">0</td>
                                            <td class="c" data-cposition="<?= $teria4['kode_kriteria'] ?>">0</td>
                                            <td class="d" data-dposition="<?= $teria4['kode_kriteria'] ?>">0</td>
                                            <td class="e" data-eposition="<?= $teria4['kode_kriteria'] ?>">0</td>
                                            <td class="f" data-fposition="<?= $teria4['kode_kriteria'] ?>">0</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tfoot class="fw-bolder">
                                    <td>Min :</td>
                                    <td id="weight<?= $value1['kriteria'] ?>">0</td>
                                </tfoot>
                                <!--end::Table body-->
                            </table>
                        </div>
                    </div>
                <?php } ?>


            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Normalisasi Bobot Vektor (W)</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="normalisasiBobotTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Kriteria</th>
                            <th class="min-w-125px">W</th>
                            <th class="min-w-125px">W (Normalisasi)</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>
                        <?php
                        foreach ($kriteria as $key => $teria5) { ?>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <td class="min-w-125px"><?= $teria5['kode_kriteria'] ?> - <?= $teria5['kriteria'] ?></td>
                                <td class="min-w-125px bobotjumlah" data-weightkriteria="<?= $teria5['kode_kriteria'] ?>">0</td>
                                <td class="min-w-125px bobotnormalisasi" data-kriterianorm1="<?= $teria5['kriteria'] ?>" data-kriterianorm="<?= $teria5['kode_kriteria'] ?>">0</td>
                            </tr>
                        <?php } ?>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Normalisasi</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="NormalisasiAlternatifTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">#</th>
                            <?php foreach ($kriteria as $key => $namakriteria1) { ?>
                                <th class="min-w-125px"><?= $namakriteria1['kode_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Normalisasi Terbobot</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="NormalisasTerbobotAlternatifTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">#</th>
                            <?php foreach ($kriteria as $key => $namakriteria2) { ?>
                                <th class="min-w-125px"><?= $namakriteria2['kode_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Solusi Ideal</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="SolusiIdealTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Alternatif</th>
                            <?php foreach ($kriteria as $key => $namakriteria3) { ?>
                                <th class="min-w-125px"><?= $namakriteria3['kode_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <td class="min-w-125px">Positif</td>
                            <?php
                            foreach ($kriteria as $key => $teria6) { ?>
                                <td data-solusikriteria="<?= $teria6['kriteria'] ?>" data-solusi="positif" data-attributekriteria="<?= $teria6['atribut'] ?>" class="min-w-125px">0</td>
                            <?php } ?>
                        </tr>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <td class="min-w-125px">Negatif</td>
                            <?php
                            foreach ($kriteria as $key => $teria7) { ?>
                                <td data-solusikriteria="<?= $teria7['kriteria'] ?>" data-solusi="negatif" data-attributekriteria="<?= $teria7['atribut'] ?>" class="min-w-125px">0</td>
                            <?php } ?>
                        </tr>
                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Solusi Ideal Positif</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="SolusiPositifTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">#</th>
                            <?php foreach ($kriteria as $key => $namakriteria4) { ?>
                                <th class="min-w-125px"><?= $namakriteria4['kode_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Solusi Ideal Negatif</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="SolusiNegatifTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">#</th>
                            <?php foreach ($kriteria as $key => $namakriteria5) { ?>
                                <th class="min-w-125px"><?= $namakriteria5['kode_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

        <div class=" card mb-5 mb-xl-10">
            <div class="card-header">
                <div class="card-title">
                    <a role="button" id="formDiv" class="text-gray-500 text-hover-primary fs-2 fw-bolder me-1">Perangkingan Prioritas</a>
                </div>
            </div>
            <div class="card-body formDiv">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="PerangkinganTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Ranking</th>
                            <th class="min-w-125px">Kode</th>
                            <th class="min-w-125px">Alternatif</th>
                            <th class="min-w-125px">Nilai Preventif</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody id="tbodyPerangkingan">

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>
    </div>





</div>






<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src=" <?= base_url('assets/js/custom/apps/form/maintanance/hitung.js') ?>">
</script>
<?= $this->endSection() ?>