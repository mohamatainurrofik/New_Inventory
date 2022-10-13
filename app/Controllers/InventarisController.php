<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Logactivities;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;

class InventarisController extends BaseController
{

    public function __construct()
    {
        $this->kategori = new Product();
        $this->logactivities = new Logactivities();
        $this->product = new Unit();
        $this->supplier = new Supplier();
    }

    public function index()
    {
        //
    }

    public function viewKategori()
    {
        $data['allKategori'] = $this->kategori->where('parent_id_product is null')->findAll();
        return view('Master/Inventaris/kategorilist', $data);
    }
    public function viewProduct()
    {
        $data['allKategori'] = $this->kategori->where('parent_id_product is not null')->findAll();
        return view('Master/Inventaris/productlist', $data);
    }
    public function viewSupplier()
    {
        $data['allSupplier'] = $this->supplier->findAll();
        return view('Master/Inventaris/supplierlist', $data);
    }

    public function kategoriDetail($id)
    {
        $data['kategori'] = $this->kategori->where('id_product', $id)->findAll();
        $data['allKategori'] = $this->kategori->findAll();

        return view('Master/Inventaris/kategoridetail', $data);
    }
    public function subkategoriDetail($id)
    {
        $data['subkategori'] = $this->db->table('products as a')->select('b.*, a.content_product as kategori')->join('products as b', 'a.id_product = b.parent_id_product')->where('b.id_product', $id)->get()->getRowArray();
        $data['allSubKategori'] = $this->kategori->where('parent_id_product is not null')->findAll();

        return view('Master/Inventaris/subkategoridetail', $data);
    }

    public function productDetail($id)
    {
        $data['product'] = $this->db->table('units')->select('units.*,products.content_product as kategori')->join('products', 'products.id_product = units.product_id')->where('units.id_unit', $id)->get()->getRowArray();
        $data['allProduct'] = $this->product->findAll();

        return view('Master/Inventaris/productdetail', $data);
    }

    public function supplierDetail($id)
    {
        $data['supplier'] = $this->db->table('suppliers')->where('id_supplier', $id)->get()->getRowArray();
        $data['allSupplier'] = $this->supplier->findAll();

        return view('Master/Inventaris/supplierdetail', $data);
    }

    public function kategoriList()
    {
        $data = $this->kategori->where('parent_id_product is null')->findAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $linked = $this->db->table('products as a')->select('b.id_product')->join('products as b', 'a.id_product = b.parent_id_product')->where('a.id_product', $data[$i]['id_product'])->countAllResults();
            $jsonData[] = array(
                "id" => $data[$i]['id_product'],
                "kode" => $data[$i]['kode_content_product'],
                "nama" => $data[$i]['content_product'],
                "deskripsi" => $data[$i]['deskripsi_product'],
                "linked" => $linked,
            );
        }

        return json_encode($jsonData);
    }

    public function supplierList()
    {
        $data = $this->supplier->findAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $linked = $this->db->table('suppliers')->select('suppliers.id_supplier')->join('detailunits', 'detailunits.supplier_id = suppliers.id_supplier')->where('suppliers.id_supplier', $data[$i]['id_supplier'])->countAllResults();
            $jsonData[] = array(
                "id" => $data[$i]['id_supplier'],
                "email" => $data[$i]['email_supplier'],
                "nama" => $data[$i]['supplier'],
                "alamat" => $data[$i]['alamat'],
                "contact" => $data[$i]['contact1'],
                "linked" => $linked,
            );
        }

        return json_encode($jsonData);
    }

    public function productList()
    {
        $data = $this->product->findAll();

        for ($i = 0; $i < sizeof($data); $i++) {
            $linked = $this->db->table('units')->select('units.id_unit')->join('detailunits', 'units.id_unit = detailunits.unit_id')->where('units.id_unit', $data[$i]['id_unit'])->countAllResults();
            $jsonData[] = array(
                "id" => $data[$i]['id_unit'],
                "brand" => $data[$i]['brand'],
                "nama" => $data[$i]['nama_unit'],
                "satuan" => $data[$i]['satuan'],
                "jenis" => $data[$i]['jenis_unit'],
                "linked" => $linked,
            );
        }

        return json_encode($jsonData);
    }

    public function kategoriHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'products'])->findAll();
        return json_encode($data);
    }
    public function productHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'units'])->findAll();
        return json_encode($data);
    }
    public function supplierHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'suppliers'])->findAll();
        return json_encode($data);
    }

    public function subkategoriList()
    {
        $data = $this->db->table('products as a')->select('b.*, a.content_product as kategori')->join('products as b', 'a.id_product = b.parent_id_product')->where('b.parent_id_product is not null')->get()->getResultArray();

        for ($i = 0; $i < sizeof($data); $i++) {
            $linked = $this->db->table('products as a')->select('a.id_product')->join('units', 'a.id_product = units.product_id')->where('a.id_product', $data[$i]['id_product'])->countAllResults();
            $jsonData[] = array(
                "id" => $data[$i]['id_product'],
                "kode" => $data[$i]['kode_content_product'],
                "nama" => $data[$i]['content_product'],
                "kategori" => $data[$i]['kategori'],
                "jenis" => $data[$i]['jenis_product'],
                "deskripsi" => $data[$i]['deskripsi_product'],
                "linked" => $linked,
            );
        }

        return json_encode($jsonData);
    }

    public function kategoriCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'parent_id_product' => null,
            'kode_content_product' => $jsonData->kategori_kode,
            'content_product' => $jsonData->kategori_name,
            'jenis_product' => null,
            'deskripsi_product' => $jsonData->kategori_deskripsi,
            'created_by' => user()->username,
        );
        $isValid = $this->validate([
            'kategori_kode'  => 'is_unique[products.kode_content_product]',
        ]);
        try {
            if ($isValid) {
                # code...
                $this->kategori->insert($tempData);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }
    public function subkategoriCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'parent_id_product' => $jsonData->kategori_kategori,
            'kode_content_product' => $jsonData->kategori_kode,
            'content_product' => $jsonData->kategori_name,
            'jenis_product' => $jsonData->kategori_jenis,
            'deskripsi_product' => $jsonData->kategori_deskripsi,
            'created_by' => user()->username,
        );
        try {
            $this->kategori->insert($tempData);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function productCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'product_id' => $jsonData->product_subkategori,
            'brand' => $jsonData->product_brand,
            'nama_unit' => $jsonData->product_name,
            'satuan' => $jsonData->product_satuan,
            'jenis_unit' => $jsonData->product_jenis,
        );
        try {
            $this->product->insert($tempData);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function supplierCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'supplier' => $jsonData->supplier_name,
            'email_supplier' => $jsonData->supplier_email,
            'alamat' => $jsonData->supplier_alamat,
            'contact1' => $jsonData->supplier_contact,
            'contact2' => 0,
        );
        try {
            $this->supplier->insert($tempData);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function kategoriUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('products')->select('content_product, kode_content_product, deskripsi_product')->where('id_product', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'content_product' => $jsonData->editKategoriName,
            'kode_content_product' => $jsonData->editKategoriKode,
            'deskripsi_product' => $jsonData->editKategoriDeskripsi,
        );
        $dataOldUpdated = array_diff_assoc($oldData, $tempData);
        $dataNewUpdated = array_diff_assoc($tempData, $oldData);
        $dataOldUpdateds = array();
        $dataNewUpdateds = array();
        if (sizeof($dataOldUpdated) == sizeof($dataNewUpdated)) {
            foreach ($dataOldUpdated as $key => $value) {
                $d =  "<strong>" . $key . "</strong> : " . $value . " ";
                $e =  "<strong>" . $key . "</strong> : " . $dataNewUpdated[$key] . " ";
                array_push($dataOldUpdateds, $d);
                array_push($dataNewUpdateds, $e);
            }
        }
        $message = array(
            'before' => implode('<br>', $dataOldUpdateds),
            'after' => implode('<br>', $dataNewUpdateds),
        );
        $isValid = $this->validate([
            'editKategoriKode'  => 'is_unique[products.kode_content_product,products.id_product,' . $jsonData->id . ']',
        ]);
        try {
            if ($isValid) {
                $this->db->table('products')->update($tempData, array('id_product' => $jsonData->id));
                $this->logactivities->createLog($jsonData->id, 'products', user()->username, $message);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }
    public function subkategoriUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('products')->select('content_product, kode_content_product, deskripsi_product')->where('id_product', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'content_product' => $jsonData->editSubKategoriName,
            'kode_content_product' => $jsonData->editSubKategoriKode,
            'deskripsi_product' => $jsonData->editSubKategoriDeskripsi,
        );
        $dataOldUpdated = array_diff_assoc($oldData, $tempData);
        $dataNewUpdated = array_diff_assoc($tempData, $oldData);
        $dataOldUpdateds = array();
        $dataNewUpdateds = array();
        if (sizeof($dataOldUpdated) == sizeof($dataNewUpdated)) {
            foreach ($dataOldUpdated as $key => $value) {
                $d =  "<strong>" . $key . "</strong> : " . $value . " ";
                $e =  "<strong>" . $key . "</strong> : " . $dataNewUpdated[$key] . " ";
                array_push($dataOldUpdateds, $d);
                array_push($dataNewUpdateds, $e);
            }
        }
        $message = array(
            'before' => implode('<br>', $dataOldUpdateds),
            'after' => implode('<br>', $dataNewUpdateds),
        );
        try {
            $this->db->table('products')->update($tempData, array('id_product' => $jsonData->id));
            $this->logactivities->createLog($jsonData->id, 'products', user()->username, $message);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function productUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('units')->select('nama_unit, brand, satuan')->where('id_unit', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'nama_unit' => $jsonData->editProductName,
            'brand' => $jsonData->editProductBrand,
            'satuan' => $jsonData->editProductSatuan,
        );
        $dataOldUpdated = array_diff_assoc($oldData, $tempData);
        $dataNewUpdated = array_diff_assoc($tempData, $oldData);
        $dataOldUpdateds = array();
        $dataNewUpdateds = array();
        if (sizeof($dataOldUpdated) == sizeof($dataNewUpdated)) {
            foreach ($dataOldUpdated as $key => $value) {
                $d =  "<strong>" . $key . "</strong> : " . $value . " ";
                $e =  "<strong>" . $key . "</strong> : " . $dataNewUpdated[$key] . " ";
                array_push($dataOldUpdateds, $d);
                array_push($dataNewUpdateds, $e);
            }
        }
        $message = array(
            'before' => implode('<br>', $dataOldUpdateds),
            'after' => implode('<br>', $dataNewUpdateds),
        );
        try {
            $this->db->table('units')->update($tempData, array('id_unit' => $jsonData->id));
            $this->logactivities->createLog($jsonData->id, 'units', user()->username, $message);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function supplierUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('suppliers')->select('supplier, email_supplier, contact1, alamat')->where('id_supplier', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'supplier' => $jsonData->editSupplierName,
            'email_supplier' => $jsonData->editSupplierEmail,
            'contact1' => $jsonData->editSupplierContact,
            'alamat' => $jsonData->editSupplierAlamat,
        );
        $dataOldUpdated = array_diff_assoc($oldData, $tempData);
        $dataNewUpdated = array_diff_assoc($tempData, $oldData);
        $dataOldUpdateds = array();
        $dataNewUpdateds = array();
        if (sizeof($dataOldUpdated) == sizeof($dataNewUpdated)) {
            foreach ($dataOldUpdated as $key => $value) {
                $d =  "<strong>" . $key . "</strong> : " . $value . " ";
                $e =  "<strong>" . $key . "</strong> : " . $dataNewUpdated[$key] . " ";
                array_push($dataOldUpdateds, $d);
                array_push($dataNewUpdateds, $e);
            }
        }
        $message = array(
            'before' => implode('<br>', $dataOldUpdateds),
            'after' => implode('<br>', $dataNewUpdateds),
        );
        try {
            $this->db->table('suppliers')->update($tempData, array('id_supplier' => $jsonData->id));
            $this->logactivities->createLog($jsonData->id, 'suppliers', user()->username, $message);
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }


    public function kategoriDelete()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->kategori->where('id_product', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function productDelete()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->product->where('id_unit', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function supplierDelete()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            foreach ($jsonData as $key => $value) {
                $this->supplier->where('id_supplier', $value['id'])->delete();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function asetInsubKategori($id)
    {
        $data = $this->kategori->listAsetInSubKategori($id);

        return json_encode($data);
    }

    public function asetInProduct($id)
    {
        $data = $this->product->listAsetInProduct($id);

        return json_encode($data);
    }
}
