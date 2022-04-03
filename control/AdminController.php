<?php 
session_start();
include_once('../layout/functions/functions.php');
$method = $_GET['method'];
if($method != "") {
    $admin = new AdminController();
    if($method == 'showLogin') {
        $admin->showLogin();
    }

    if($method == 'login') {
        $admin->login();
    }

    if($method == 'showSettings') {
        $admin->showSettings();
    }

    if($method == 'showChangePassword') {
        $admin->showChangePassword();
    }

    if($method == 'editProfile') {
        $admin->editProfile();
    }

    if($method == 'changePassword') {
        $admin->changePassword();
    }

    if($method == 'showProfile') {
        $admin->showProfile();
    }

    if($method == 'dashboard') {
        $admin->showDashboard();
    }

    if($method == 'showSubAdmins') {
        $admin->showSubAdmins();
    }

    if($method == 'showUniverisities') {
        $admin->showUniverisities();
    }

    if($method == 'showAllFaculities') {
        $admin->showAllFaculities();
    }

    if($method == 'showAllBooks') {
        $admin->showAllBooks();
    }


    if($method == 'showAboutUs') {
        $admin->showAboutUs();
    }

    if($method == 'showAddSubAdmin') {
        $admin->showAddSubAdmin();
    }

    if($method == 'showAddUniverisity') {
        $admin->showAddUniverisity();
    }

    if($method == 'showAddFaculity') {
        $admin->showAddFaculity();
    }

    if($method == 'showAddAboutUs') {
        $admin->showAddAboutUs();
    }


    if($method == 'showEditSubAdmin') {
        $id = $_GET['id'];
        $admin->showEditSubAdmin($id);
    }

    if($method == 'showEditUniverisity') {
        $id = $_GET['id'];
        $admin->showEditUniverisity($id);
    }

    if($method == 'showEditFaculity') {
        $id = $_GET['id'];
        $admin->showEditFaculity($id);
    }

    if($method == 'showEditAboutUs') {
        $id = $_GET['id'];
        $admin->showEditAboutUs($id);
    }

    if($method == 'addSubAdmin') {
        $admin->addSubAdmin();
    }
    if($method == 'addUniverisity') {
        $admin->addUniverisity();
    }
    if($method == 'addFaculity') {
        $admin->addFaculity();
    }
    if($method == 'addAboutUs') {
        $admin->addAboutUs();
    }
    if($method == 'editSubAdmin') {
        $id = $_GET['id'];
        $admin->editSubAdmin($id);
    } 
if($method == 'editUniverisity') {
        $id = $_GET['id'];
        $admin->editUniverisity($id);
    } 
    if($method == 'editFaculty') {
        $id = $_GET['id'];
        $admin->editFaculty($id);
    } 
    if($method == 'editAboutUs') {
        $id = $_GET['id'];
        $admin->editAboutUs($id);
    } 
    if($method == 'delSubAdmin') {
        $id = $_GET['id'];
        $admin->delSubAdmin($id);
    } 
if($method == 'delUniverisity') {
        $id = $_GET['id'];
        $admin->delUniverisity($id);
    }
    if($method == 'delFaculity') {
        $id = $_GET['id'];
        $admin->delFaculity($id);
    }
    if($method == 'delAboutUs') {
        $id = $_GET['id'];
        $admin->delAboutUs($id);
    }
    if($method == 'logout') {
        $admin->logout();
    }
    
    

}

class AdminController {
    private $Path = "../admin/";
    public function showLogin() {
        header('location: '.$this->Path.'login.php');
    }

    public function login() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['admin_login'])) {
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $data = [
                    'email'=>$email,
                ];
                $error=[];
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($password)) {
                    array_push($error,"password requires");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                }  
                $admin = selectOne('*','admins',"email = '$email'");
                if (empty($admin)) {
                    array_push($error,"this email not exist in Database");
                } 

                if (!empty($admin) ) {
                    if(! password_verify($password,$admin['password'])) {
                            array_push($error,"this password is invalid");
                    }
                }

                if(!empty($error))
                {
                    $_SESSION['oldData'] = $data;
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'login.php');
                    exit();
                }
                
                if($admin['role'] == 1) {
                    $_SESSION['admin'] = $admin;
                    $_SESSION['auth'] = 'admin';
                }
                else {
                    $_SESSION['sub_admin'] = $admin;
                    $_SESSION['auth'] = 'sub_admin';
                }
                $_SESSION['username'] = $admin['name'];
                $_SESSION['msg'] = $_SESSION['auth']." Login Successfuly";
                $this->showDashboard();
            }
        }
    }

    public function changePassword() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['change_password'])) {
                $confirm_password = trim($_POST['confirm_password']);
                $password = trim($_POST['password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                if($_SESSION['auth'] == 'admin')
                    $admin_id = $_SESSION['admin']['id'];
                else 
                    $admin_id = $_SESSION['sub_admin']['id'];
                $data = [
                    'password'=>$hashpassword,
                    'id'=>$admin_id
                ];
                $error=[];
                if (empty($password)) {
                    array_push($error,"password required");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                } 
                if (empty($confirm_password)) {
                    array_push($error,"confirm_password required");
                } 
                if ($password!=$confirm_password) {
                    array_push($error,"passwords not matched");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    header('location: '.$this->Path.'changePassword.php');
                    exit();
                }

                $success = update('password = ?','admins',array_values($data),'id = ?');
                if($success) {
                    if($_SESSION['auth'] == 'admin')
                        $_SESSION['admin']['password'] = $hashpassword;
                    else
                        $_SESSION['sub_admin']['password'] = $hashpassword;

                    $_SESSION['msg'] = "Change Password Successfuly";

                    header('location: '.$this->Path);
                }

            }
        }
    }

    public function editProfile() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_profile'])) {
                $email = trim($_POST['email']);
                $name = trim($_POST['name']);
                $phone = trim($_POST['phone']);
                $photoName = $_FILES['photo']['name'];
                if(!empty($photoName)) {
                    $photoSize = $_FILES['photo']['size'];
                    $photoTmp	= $_FILES['photo']['tmp_name'];
                    $photoAllowedExtension = array("jpeg", "jpg", "png");
                    $explode = explode('.', $photoName);
                    $photoExtension = strtolower(end($explode));
                }
                if($_SESSION['auth'] == 'admin') {
                    $admin_id = $_SESSION['admin']['id'];
                    $auth = $_SESSION['admin'];
                }
                else
                {
                    $admin_id = $_SESSION['sub_admin']['id'];
                    $auth = $_SESSION['sub_admin'];
                }
                $data = [
                    'email'=>$email,
                    'name'=>$name,
                    'phone'=>$phone,
                    'id'=>$admin_id

                ];
                $error=[];
                if (! empty($photoName) && ! in_array($photoExtension, $photoAllowedExtension)) {
                    $error[] = 'This Extension Is Not <strong>Allowed</strong>';
                }
                if (! empty($photoName) && $photoSize > 4194304) {
                    $error[] = 'photo Cant Be Larger Than <strong>4MB</strong>';
                }
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($phone) || strlen($phone)<6 || !is_numeric($phone)) 
                {
                    if(empty($phone))
                    {
                        array_push($error,"phone required");
                    }
                    else if(strlen($phone)<8)
                    {
                        array_push($error,"Must be 8 digit");
                    }
                    else{
                        array_push($error,"phone number contains numbers only");
                    }
                } 
                if($email != $auth['email']) {
                    $result = selectOne('*','admins',"email = '$email'");
                    if (!empty($result) ) {
                        array_push($error,"this email exist in Database");
                    } 
                }
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    header('location: '.$this->Path.'settings.php');
                    exit();
                }

                $oldphoto = $_SESSION[$_SESSION['auth']]['photo'];
                if(!empty($photoName)) {
                    $path = '../assets/images/admins/'.$admin_id;
                    if(!is_dir($path)) {
                        mkdir($path);
                    } 
                    if($oldphoto != null) {
                        unlink($path.'/'.$oldphoto);
                    }
                    move_uploaded_file($photoTmp, $path.'/'. $photoName);
                }
                $photo = !empty($photoName) ? $photoName : $oldphoto;
                if($photo) {
                    $data = [
                        'email'=>$email,
                        'name'=>$name,
                        'phone'=>$phone,
                        'photo'=>$photo,
                        'id'=>$admin_id
    
                    ];
                    $success = update('email = ? , name = ? , phone = ? , photo = ?','admins',array_values($data),'id = ?');

                }
                else {
                    $success = update('email = ? , name = ? , phone = ?','admins',array_values($data),'id = ?');
                }
                if($success) {
                    $_SESSION['username'] = $name;
                    $_SESSION[$_SESSION['auth']]['name'] = $name; 
                    $_SESSION[$_SESSION['auth']]['email'] = $email; 
                    $_SESSION[$_SESSION['auth']]['phone'] = $phone; 
                    $_SESSION[$_SESSION['auth']]['photo'] = $photo; 
                    $_SESSION['msg'] = "Edit Profile Successfuly";
                    header('location: '.$this->Path);

                }


            }
        }
    }

    public function showSettings() {
        header('location: '.$this->Path.'settings.php');
    }

    public function showChangePassword() {
        header('location: '.$this->Path.'changePassword.php');

    }

    public function showProfile() {
        header('location: '.$this->Path);
    }

    public function showDashboard() {
        if($_SESSION['auth'] == 'admin') {
            $subadmin = selectOne('count(*) as count','admins','role = 0');
            $aboutus = selectOne('count(*) as count','aboutus');
            $faculities = selectOne('count(*) as count','faculities');
            $univerisities = selectOne('count(*) as count','univerisities');
            $books = selectOne('count(*) as count','books');
            $students = selectOne('count(*) as count','students');
            $orders = selectOne('count(*) as count','orders');
            $_SESSION['dashboardcount'] = [
                'subadmin_count' => $subadmin['count'],
                'aboutus_count' => $aboutus['count'],
                'faculities_count' => $faculities['count'],
                'univerisities_count' => $univerisities['count'],
                'books_count' => $books['count'],
                'students_count' => $students['count'],
                'orders_count' => $orders['count']

            ];
        } else {
            $faculities = selectOne('count(*) as count','faculities f, univerisities u',
            'f.uni_id = u.id and u.sub_admin_id = '.$_SESSION['sub_admin']['id']);
            $students = selectOne('count(*) as count','students s ,faculities f, univerisities u',
            's.fac_id = f.id and f.uni_id = u.id and u.sub_admin_id = '.$_SESSION['sub_admin']['id']);
            $books = selectOne('count(*) as count','books b,faculities f, univerisities u',
            'b.faculty_id = f.id and f.uni_id = u.id and u.sub_admin_id = '.$_SESSION['sub_admin']['id']);
            $_SESSION['dashboardcount'] = [
                'faculities_count' => $faculities['count'],
                'books_count' => $books['count'],
                'students_count' => $students['count'],
            ];
        }

        header('location: '.$this->Path.'dashboard.php');
    }

    public function showSubAdmins() {
        
        $_SESSION['subadmins'] = selectAll('a.* , u.name as univerisity', 'admins a LEFT JOIN univerisities u ON a.id = u.sub_admin_id where a.role = 0');
        header('location: '.$this->Path.'show/allSubAdmins.php');
    }

    public function showUniverisities() {
        $joins = 'univerisities u LEFT JOIN admins a ON a.id = u.sub_admin_id LEFT JOIN faculities f ON f.uni_id = u.id GROUP BY u.id';
        $_SESSION['univerisities'] = selectAll('u.* , a.name as sub_admin , count(f.id) as count', $joins);
        header('location: '.$this->Path.'show/allUniverisites.php');
    }

    public function showAllFaculities() {
        if($_SESSION['auth'] == 'sub_admin') {
            $joins = 'univerisities u Right JOIN faculities f ON f.uni_id = u.id where u.sub_admin_id ='.$_SESSION['sub_admin']['id'];
            $_SESSION['faculities'] = selectAll('u.name univerisity_name, f.*', $joins);
        }
        else
        {
            $joins = 'faculities f LEFT JOIN books b ON b.faculty_id = f.id LEFT JOIN univerisities u ON f.uni_id = u.id GROUP BY f.id';
            $_SESSION['faculities'] = selectAll('u.name univerisity_name, f.* , count(b.id) as count', $joins);
        }
        header('location: '.$this->Path.'show/allFaculities.php');
    }

    public function showAllBooks() {
        $joins = 'univerisities u LEFT JOIN admins a ON a.id = u.sub_admin_id LEFT JOIN faculities f ON f.uni_id = u.id GROUP BY u.id';
        $_SESSION['univerisities'] = selectAll('u.* , a.name as sub_admin , count(f.id) as count', $joins);
        header('location: '.$this->Path.'show/allUniverisites.php');
    }


    public function showAboutUs() {
        $_SESSION['allaboutus']=selectAll('*','aboutus');
        header('location: '.$this->Path.'show/allAboutUs.php');
    }

    public function showAddSubAdmin() {
        
        header('location: '.$this->Path.'add/add-subadmin.php');
    }
    public function showAddUniverisity() {
        $sub_admins = [];
        $subadmins = selectAll('a.* , u.name as univerisity', 'admins a LEFT JOIN univerisities u ON a.id = u.sub_admin_id where a.role = 0');
        foreach($subadmins as $s) {
            if(!$s['univerisity'] && !in_array($s,$sub_admins))
                $sub_admins[] = $s;
        }
        $_SESSION['subadmins'] = $sub_admins;
        if(!$_SESSION['subadmins']) {
            header('location: ../errors/SubAdminError.php');
            exit();
        }
        header('location: '.$this->Path.'add/add-univerisity.php');

    }
    public function showAddFaculity() {
        $_SESSION['uni'] = selectAll('*', 'univerisities');
        header('location: '.$this->Path.'add/add-faculity.php');
    }
    public function showAddAboutUs() {
        
        header('location: '.$this->Path.'add/add-aboutus.php');
    }

    public function showEditSubAdmin($id) {
        $_SESSION['subadmin'] = selectOne('*','admins','id ='.$id);
        header('location: '.$this->Path.'edit/edit-subadmin.php');
    }

    public function showEditUniverisity($id) {
        $uni = selectOne('*','univerisities','id = '.$id);
        $subadmin = selectOne('a.* , u.name as univerisity', 'admins a LEFT JOIN univerisities u ON a.id = u.sub_admin_id where a.id ='.$uni['sub_admin_id']);
        $sub_admins[] = $subadmin;
        $subadmins = selectAll('a.* , u.name as univerisity', 'admins a LEFT JOIN univerisities u ON a.id = u.sub_admin_id where a.role = 0');
        foreach($subadmins as $s) {
            if(!$s['univerisity'] && !in_array($s,$sub_admins))
                $sub_admins[] = $s;
        }
        $_SESSION['subadmins'] = $sub_admins;
        $_SESSION['univerisity'] = $uni;
        if(!$_SESSION['subadmins']) {
            header('location: ../errors/SubAdminError.php');
            exit();
        }        
        header('location: '.$this->Path.'edit/edit-univerisity.php');
    }

    public function showEditFaculity($id) {
        $_SESSION['unis'] = selectAll('*', 'univerisities');
        $_SESSION['faculty'] = selectOne('*', 'faculities','id ='.$id);
        header('location: '.$this->Path.'edit/edit-faculity.php');
    }

    public function showEditAboutUs($id) {
        $_SESSION['aboutus'] = selectOne('*','aboutus','id ='.$id);
        header('location: '.$this->Path.'edit/edit-aboutus.php');
    }


    public function addSubAdmin() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_subadmin'])) {
                $email = trim($_POST['email']);
                $name = trim($_POST['name']);
                $confirm_password = trim($_POST['confirm_password']);
                $password = trim($_POST['password']);
                $hashpassword = password_hash($password, PASSWORD_BCRYPT);
                $data = [
                    'email'=>$email,
                    'name'=>$name,
                    'password' => $hashpassword
                ];
                $error=[];
                
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($password)) {
                    array_push($error,"password required");
                } 
                if (strlen($password)>0 && strlen($password)<8) {
                    array_push($error,"this password less than 8 digit");
                } 
                if (empty($confirm_password)) {
                    array_push($error,"confirm_password required");
                } 
                if ($password!=$confirm_password) {
                    array_push($error,"passwords not matched");
                }
                $result = selectOne('*','admins',"email = '$email'");
                if (!empty($result) ) {
                    array_push($error,"this email exist in Database");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showAddSubAdmin();
                    exit();
                }
                $keys = implode(',',array_keys($data));
                $subadmin_id = insert($keys,'admins','?,?,?',array_values($data));
                if($subadmin_id) {
                    $_SESSION['msg'] = "Add Sub Admin Successfuly";
                    $this->showSubAdmins();
                }
            }
        }
    }

    public function addUniverisity() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_univerisity'])) {
                $name = trim($_POST['name']);
                $address = trim($_POST['address']);
                $description = trim($_POST['description']);
                $sub_admin_id = trim($_POST['subadmin_id']);

                $data = [
                    'name'=>$name,
                    'address' => $address,
                    'description' => $description,
                    'sub_admin_id' => $sub_admin_id
                ];
                $error=[];
                
                
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($address)) {
                    array_push($error,"address required");
                } 
                if (empty($description)) {
                    array_push($error,"description required");
                } 
                
                $result = selectOne('*','univerisities',"name = '$name'");
                if (!empty($result) ) {
                    array_push($error,"this univerisity exist in Database");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showAddUniverisity();
                    exit();
                }

                $keys = implode(',',array_keys($data));
                $univerisity_id = insert($keys,'univerisities','?,?,?,?',array_values($data));
                if($univerisity_id) {
                    $_SESSION['msg'] = "Add Univerisity Successfuly";
                    $this->showUniverisities();
                }
            }
        }
    }

    public function addFaculity() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_faculty'])) {
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);
                $uni_id = trim($_POST['uni_id']);

                $data = [
                    'name'=>$name,
                    'description' => $description,
                    'uni_id' => $uni_id
                ];
                $error=[];
                
                
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($description)) {
                    array_push($error,"description required");
                } 

                $result = selectOne('*','faculities',"name = '$name' and uni_id = $uni_id");
                if (!empty($result) ) {
                    array_push($error,"this Faculty exist in Database");
                }
                
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showAddFaculity();
                    exit();
                }

                $keys = implode(',',array_keys($data));
                $faculty_id = insert($keys,'faculities','?,?,?',array_values($data));
                if($faculty_id) {
                    $_SESSION['msg'] = "Add Faculty Successfuly";
                    $this->showAllFaculities();
                }
            }
        }
    }

    public function addAboutUS() {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['add_aboutus'])) {
                $text = trim($_POST['text']);
                $data = [
                    'text'=>$text
                    
                ];
                $error=[];
                
                if (empty($text)) {
                    array_push($error,"text required");
                } 

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showAddAboutUs();
                }
                $AboutUSid = insert('text','aboutus','?',array_values($data));
                if($AboutUSid) {
                    $_SESSION['msg'] = "Added About US Successfuly";
                    $this->showAboutUS();
                }
            }
        }
    }

    public function editSubAdmin($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_subadmin'])) {
                $email = trim($_POST['email']);
                $name = trim($_POST['name']);
                $confirm_password = trim($_POST['confirm_password']);
                $password = trim($_POST['password']);
                $hashpassword = $password ? password_hash($password, PASSWORD_BCRYPT) : '';
                $data = [
                    'name'=>$name,
                    'email'=>$email,
                    'id' => $id
                ];
                $error=[];
                
                if (empty($email)) {
                    array_push($error,"email required");
                } 
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (!empty($password)) {
                    if (strlen($password)>0 && strlen($password)<8) {
                        array_push($error,"this password less than 8 digit");
                    } 
                    if (empty($confirm_password)) {
                        array_push($error,"confirm_password required");
                    } 
                    if ($password!=$confirm_password) {
                        array_push($error,"passwords not matched");
                    }
                } 
                
                $result = selectOne('*','admins',"id = $id");
                if($email != $result['email']) {
                    if (!empty($result) ) {
                        array_push($error,"this email exist in Database");
                    }
                }
                
                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showEditSubAdmin($id);
                    exit();
                }
                if($hashpassword) {
                    $data = [
                        'name'=>$name,
                        'email'=>$email,
                        'password' => $hashpassword,
                        'id' => $id
                    ];
                }
                $success = $hashpassword ? update('name = ? , email = ? , password = ? ','admins',array_values($data),'id = ?')
                            : update('name = ? , email = ?','admins',array_values($data),'id = ?') ;
                if($success) {
                    $_SESSION['msg'] = "Edit Sub Admin Successfuly";
                    $this->showSubAdmins();
                }
            }
        }
    }

    public function editUniverisity($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_univerisity'])) {
                $name = trim($_POST['name']);
                $address = trim($_POST['address']);
                $description = trim($_POST['description']);
                $sub_admin_id = trim($_POST['subadmin_id']);
                $photoName = $_FILES['photo']['name'];
                if(!empty($photoName)) {
                    $photoSize = $_FILES['photo']['size'];
                    $photoTmp	= $_FILES['photo']['tmp_name'];
                    $photoAllowedExtension = array("jpeg", "jpg", "png");
                    $explode = explode('.', $photoName);
                    $photoExtension = strtolower(end($explode));
                }

                $data = [
                    'name'=>$name,
                    'address' => $address,
                    'description' => $description,
                    'sub_admin_id' => $sub_admin_id,
                    'id' => $id
                ];
                $error=[];
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                if (empty($address)) {
                    array_push($error,"address required");
                } 
                if (empty($description)) {
                    array_push($error,"description required");
                } 
                if (! empty($photoName) && ! in_array($photoExtension, $photoAllowedExtension)) {
                    $error[] = 'This Extension Is Not <strong>Allowed</strong>';
                }
                if (! empty($photoName) && $photoSize > 4194304) {
                    $error[] = 'photo Cant Be Larger Than <strong>4MB</strong>';
                }
                
                $result = selectOne('*','univerities',"name = '$name'");
                if (!empty($result) ) {
                    array_push($error,"this univerisity exist in Database");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showEditUniverisity($id);
                    exit();
                }
                $oldphoto = selectOne('*','univerisities','id ='.$id)['photo'];
                if(!empty($photoName)) {
                    $path = '../assets/images/univerisites/'.$id;
                    if(!is_dir($path)) {
                        mkdir($path);
                    } 
                    if($oldphoto != null) {
                        unlink($path.'/'.$oldphoto);
                    }
                    move_uploaded_file($photoTmp, $path.'/'. $photoName);
                }
                $photo = !empty($photoName) ? $photoName : $oldphoto;
                if($photo) {
                    $data = [
                        'name'=>$name,
                        'address' => $address,
                        'description' => $description,
                        'sub_admin_id' => $sub_admin_id,
                        'photo'=>$photo,
                        'id' => $id
    
                    ];
                    $success = update('name = ? , address = ? , description = ? , sub_admin_id = ? , photo = ?','univerisities',array_values($data),'id = ?');

                }
                else {
                    $success = update('name = ? , address = ? , description = ? , sub_admin_id = ? ','univerisities',array_values($data),'id = ?');
                }
                if($success) {
                    $_SESSION['msg'] = "Edit Univerisity Successfuly";
                    $this->showUniverisities();
                }
            }
        }
    }

    public function editFaculty($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_faculty'])) {
                $name = trim($_POST['name']);
                $description = trim($_POST['description']);
                $uni_id = trim($_POST['uni_id']);
                $photoName = $_FILES['photo']['name'];
                if(!empty($photoName)) {
                    $photoSize = $_FILES['photo']['size'];
                    $photoTmp	= $_FILES['photo']['tmp_name'];
                    $photoAllowedExtension = array("jpeg", "jpg", "png");
                    $explode = explode('.', $photoName);
                    $photoExtension = strtolower(end($explode));
                }

                $data = [
                    'name'=>$name,
                    'description' => $description,
                    'uni_id' => $uni_id,
                    'id' => $id
                ];
                $error=[];
                if (empty($name)) {
                    array_push($error,"name required");
                } 
                
                if (empty($description)) {
                    array_push($error,"description required");
                } 
                if (! empty($photoName) && ! in_array($photoExtension, $photoAllowedExtension)) {
                    $error[] = 'This Extension Is Not <strong>Allowed</strong>';
                }
                if (! empty($photoName) && $photoSize > 4194304) {
                    $error[] = 'photo Cant Be Larger Than <strong>4MB</strong>';
                }
                
                $result = selectOne('*','faculities',"name = '$name' and uni_id = $uni_id and id != $id");
                if (!empty($result) ) {
                    array_push($error,"this Faculty exist in Database");
                }

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showEditFaculity($id);
                    exit();
                }
                $oldphoto = selectOne('*','faculities','id ='.$id)['photo'];
                if(!empty($photoName)) {
                    $path = '../assets/images/faculities/'.$id;
                    if(!is_dir($path)) {
                        mkdir($path);
                    } 
                    if($oldphoto != null) {
                        unlink($path.'/'.$oldphoto);
                    }
                    move_uploaded_file($photoTmp, $path.'/'. $photoName);
                }
                $photo = !empty($photoName) ? $photoName : $oldphoto;
                if($photo) {
                    $data = [
                        'name'=>$name,
                        'description' => $description,
                        'uni_id' => $uni_id,
                        'photo'=>$photo,
                        'id' => $id
    
                    ];
                    $success = update('name = ? , description = ? , uni_id = ? , photo = ?','faculities',array_values($data),'id = ?');

                }
                else {
                    $success = update('name = ? , description = ? , uni_id = ? ','faculities',array_values($data),'id = ?');
                }
                if($success) {
                    $_SESSION['msg'] = "Edit Faculty Successfuly";
                    $this->showAllFaculities();
                }
            }
        }
    }

    public function editAboutUs($id) {
        $error=[];
        if($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if(isset($_POST['edit_aboutus'])) {
                $text = trim($_POST['text']);
                $data = [
                    'text'=>$text,
                    'id'=>$id
                ];
                
                if (empty($text)) {
                    array_push($error,"text required");
                } 

                if(!empty($error))
                {
                    $_SESSION['errors'] = $error;
                    $_SESSION['oldData'] = $data;
                    $this->showEditAboutUs($id);
                }
                $success = update('text = ?','aboutus',array_values($data),'id = ?');
                if($success) {
                    $_SESSION['msg'] = "Updated About US Successfuly";
                    $this->showAboutUS();
                }
            }
        }
    }

    public function delSubAdmin($id) {
        $data=[$id];
        delete('admins',"id= ?",$data) ;
        $_SESSION['msg'] = "Sub Admin Deleted Successfully";
        $this->showSubAdmins();
    }

    public function delUniverisity($id) {
        $data=[$id];
        delete('univerisities',"id= ?",$data) ;
        $_SESSION['msg'] = "Univerisity Deleted Successfully";
        $this->showUniverisities();
    }

    public function delFaculity($id) {
        $data=[$id];
        delete('faculities',"id= ?",$data) ;
        $_SESSION['msg'] = "Faculty Deleted Successfully";
        $this->showAllFaculities();
    }

    public function delAboutUs($id) {
        $data=[$id];
        delete('aboutus',"id= ?",$data) ;
        $_SESSION['msg'] = "About Us Deleted Successfully";
        $this->showAboutUs();
    }

    


    public function logout(){
        unsetAllSession();
        unset($_SESSION['admin']);
        unset($_SESSION['sub_admin']);
        unset($_SESSION['auth']);
        unset($_SESSION['username']);
        header('location: ../');
    }
}