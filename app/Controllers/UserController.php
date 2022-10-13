<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Karyawan;
use App\Models\Logactivities;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->karyawan = new Karyawan();
        $this->logactivities = new Logactivities();
    }

    public function index()
    {
        //
    }

    public function viewUser()
    {
        return view('Master/UserManagement/User/userList');
    }
    public function viewRoles()
    {
        $data['allRoles'] = $this->db->table('auth_groups')->select('auth_groups.*,COUNT(a.user_id) as userlinked')->join('auth_groups_users as a', 'a.group_id = auth_groups.id', 'LEFT')->groupBy('auth_groups.id')->get()->getResultArray();
        $data['parentPermissions'] = $this->db->table('auth_permissions')->select('description')->groupBy('description')->get()->getResultArray();
        $data['allPermissions'] = $this->db->table('auth_permissions as b')->select('SUBSTRING(b.name, -6) as nama, b.id, b.description, b.name')->get()->getResultArray();
        return view('Master/UserManagement/Roles/rolesList', $data);
    }

    public function accountList()
    {
        $data = $this->db->table('users')->select('users.*, auth_groups.name, karyawans.nama')->join('auth_groups_users', 'users.id = auth_groups_users.user_id')->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')->join('karyawans', 'users.karyawan_id = karyawans.id_karyawan')->get()->getResultArray();

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id'],
                "role" => $data[$i]['name'],
                "email" => $data[$i]['email'],
                "nama" => $data[$i]['nama'],
                "username" => $data[$i]['username'],
                "created_at" => $data[$i]['created_at'],
            );
        }

        return json_encode($jsonData);
    }

    public function accountCreate()
    {
        $jsonData = $this->request->getJSON();
        $tempData = array(
            'karyawan_id' => $jsonData->karyawan_id,
            'email' => $jsonData->email,
            'username' => $jsonData->username,
            'password_hash' => Password::hash($jsonData->password),
            'reset_hash' => null,
            'reset_at' => null,
            'reset_expires' => null,
            'activate_hash' => null,
            'status' => null,
            'status_message' => null,
            'active' => 0,
            'force_pass_reset' => 0,
        );
        $isValid = $this->validate([
            'email'  => 'is_unique[users.email]',
            'username'  => 'is_unique[users.username]',
        ]);
        try {
            if ($isValid) {
                $this->user->insert($tempData);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            echo '<script>console.log(' . $th . ')</script>';
        }
    }

    public function rolesCreate()
    {
        $jsonData = $this->request->getJSON(TRUE);
        $tempDataRoles = array(
            'name' => $jsonData['rolename']
        );
        $tempDataPermissionRoles[] = [];

        try {
            $this->db->table('auth_groups')->insert($tempDataRoles);
            $id = $this->db->insertID();
            foreach ($jsonData['values'] as $key => $value) {
                $data = array(
                    'group_id' => $id,
                    'permission_id' => $value
                );
                $this->db->table('auth_groups_permissions')->insert($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function accountUpdate()
    {
        $jsonData = $this->request->getJSON();
        $oldData = $this->db->table('users')->select('email, username, active ,group_id')->join('auth_groups_users as a', 'a.user_id = users.id')->where('id', $jsonData->id)->get()->getRowArray();
        $tempData = array(
            'email' => $jsonData->editAccountEmail,
            'username' => $jsonData->editAccountUsername,
            'active' => $jsonData->editstatus,
        );
        $this->db->table('users')->update($tempData, array('id' => $jsonData->id));
        $tempData['group_id'] = $jsonData->editAccountRole;
        $this->db->table('auth_groups_users')->set('group_id', $jsonData->editAccountRole)->where('user_id', $jsonData->id)->update();
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
            'editAccountUsername'  => 'is_unique[users.username,users.id,' . $jsonData->id . ']',
            'editAccountEmail'  => 'is_unique[users.email,users.id,' . $jsonData->id . ']',
        ]);
        try {
            if ($isValid) {
                $this->logactivities->createLog($jsonData->id, 'users', user()->username, $message);
                return json_encode($isValid);
            } else {
                return json_encode($isValid);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function passwordUpdate()
    {
        try {
            $jsonData = $this->request->getJSON();
            $tempData = array(
                'password_hash' => Password::hash($jsonData->password),
            );

            $this->db->table('users')->update($tempData, array('id' => $jsonData->id));
            $message = array(
                'before' => '<strong>Password</strong>: *********',
                'after' => '<strong>Password</strong>: *********',
            );
            $this->logactivities->createLog($jsonData->id, 'users', user()->username, $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function roleUpdate()
    {
        try {
            $jsonData = $this->request->getJSON(TRUE);
            $this->db->table('auth_groups')->set('name', $jsonData['editRoleName'])->where('id', $jsonData['id'])->update();
            $tempDataPermissionRoles[] = [];
            $this->db->table('auth_groups_permissions')->delete(['group_id' => $jsonData['id']]);
            foreach ($jsonData['values'] as $key => $value) {
                $data = array(
                    'group_id' => $jsonData['id'],
                    'permission_id' => $value
                );
                $this->db->table('auth_groups_permissions')->replace($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function accountDetail($id)
    {
        $data['account'] = $this->db->query("SELECT users.*,b.name,a.group_id, karyawans.nama FROM users INNER JOIN karyawans on karyawans.id_karyawan = users.karyawan_id INNER JOIN auth_groups_users as a on a.user_id = users.id INNER JOIN auth_groups as b on b.id = a.group_id WHERE users.id = $id")->getRowArray();
        $data['allAccount'] = $this->user->get()->getResultArray();
        $data['allRole'] = $this->db->table('auth_groups')->get()->getResultArray();
        // $data['ruanganAtKaryawan'] = $this->departemen->where('parent_id', $id)->findAll();
        // $data['thisLogActivities'] = $this->logactivities->where('table_id', $id)->findAll();

        return view('Master/UserManagement/User/userDetail', $data);
    }

    public function rolesDetail($id)
    {
        $data['roles'] = $this->db->table('auth_groups')->select('auth_groups.*,COUNT(a.user_id) as userlinked')->join('auth_groups_users as a', 'a.group_id = auth_groups.id', 'LEFT')->groupBy('auth_groups.id')->where('id', $id)->get()->getRowArray();

        return view('Master/UserManagement/Roles/rolesDetail', $data);
    }

    public function userInRoles($id)
    {
        $data = $this->db->table('auth_groups_users as a')->select('users.*')->join('users', 'users.id = a.user_id')->where('group_id', $id)->get()->getResultArray();

        return json_encode($data);
    }

    public function accountHistoryList($id)
    {
        $data = $this->logactivities->where(['table_id' => $id, 'table_names' => 'users'])->findAll();

        return json_encode($data);
    }

    public function eventInAccount($id)
    {
        $data = $this->db->table('users')->select('logactivities.*')->join('logactivities', 'logactivities.created_by = users.username')->where('users.id', $id)->get()->getResultArray();

        return json_encode($data);
    }

    public function loginInAccount($id)
    {
        $data = $this->db->table('users')->select('auth_logins.*,users.username')->join('auth_logins', 'users.email = auth_logins.email')->where('users.id', $id)->get()->getResultArray();
        return json_encode($data);
    }

    public function roleHasPermissions()
    {
        try {
            $jsonData = $this->request->getJSON();
            $data = $this->db->table('auth_groups as a')->select('b.*, a.name')->join('auth_groups_permissions as b', 'b.group_id = a.id', 'LEFT')->where('id', $jsonData->id)->get()->getResultArray();

            return json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }








    public function listKaryawanSelect2()
    {
        $data = $this->karyawan->listKaryawanbySelect2($this->request->getPost('searchTerm'));

        for ($i = 0; $i < sizeof($data); $i++) {
            $jsonData[] = array(
                "id" => $data[$i]['id_karyawan'],
                "text" => $data[$i]['nama'],
            );
        }

        return json_encode($jsonData);
    }
}
